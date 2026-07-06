<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use App\Models\Document;
use App\Models\DocumentReview;
use App\Models\DocumentSignature;
use App\Notifications\RecipientSubmittedReviewNotification;
use App\Services\DocumentReviewAuthorizationService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ReviewDocument extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithRecord;

    protected static string $resource = DocumentResource::class;

    protected string $view = 'filament.resources.documents.pages.review-document';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $user = Auth::user();
        abort_unless($user && $user->hasRole('recipient') && $this->record->canRecipientSubmitReview($user), 403);

        $this->form->fill();
    }

    public function getTitle(): string|Htmlable
    {
        return 'Review Document: ' . $this->record->title;
    }

    /**
     * The URL the frontend Alpine component uses to fetch the PDF via pdf.js.
     */
    public function getPdfUrlProperty(): string
    {
        return route('documents.preview', [
            'document' => $this->record,
            'v' => $this->record->updated_at?->timestamp,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Review Workspace')
                    ->tabs([
                        Tab::make('Review Action')
                            ->icon('heroicon-m-clipboard-document-check')
                            ->schema([
                                Radio::make('status')
                                    ->label('Decision')
                                    ->options([
                                        'approved' => 'Approve',
                                        'revision' => 'Request Revision',
                                    ])
                                    ->required()
                                    ->live(),

                                Textarea::make('message')
                                    ->label('Message / Notes')
                                    ->rows(4)
                                    ->placeholder('Write your review feedback, comments, or revision requests here...')
                                    ->required(fn (Get $get): bool => $get('status') === 'revision'),

                                FileUpload::make('attachment_path')
                                    ->label('Attachment (Optional)')
                                    ->helperText('Upload a marked-up document, screenshot, or signature if needed.')
                                    ->directory('review-attachments')
                                    ->storeFileNamesIn('attachment_name')
                                    ->maxSize(5120) // 5MB
                                    ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
                            ]),

                        Tab::make('Document Info')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                Placeholder::make('document_info_details')
                                    ->hiddenLabel()
                                    ->content(fn () => $this->record ? view('filament.documents.review-document-details', [
                                        'document' => $this->record,
                                    ]) : ''),
                            ]),

                        Tab::make('History')
                            ->icon('heroicon-m-clock')
                            ->schema([
                                Placeholder::make('document_history')
                                    ->hiddenLabel()
                                    ->content(fn () => $this->record ? view('filament.documents.review-document-history', [
                                        'document' => $this->record,
                                    ]) : ''),
                            ]),

                        Tab::make('Recipients')
                            ->icon('heroicon-m-users')
                            ->schema([
                                Placeholder::make('document_recipients')
                                    ->hiddenLabel()
                                    ->content(fn () => $this->record ? view('filament.documents.review-document-recipients', [
                                        'document' => $this->record,
                                    ]) : ''),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * Save a signed PDF + QR to disk and create a DocumentSignature record.
     *
     * @param  array{pdf: string, qr: string, hash: string}  $payload
     */
    public function saveSignature(array $payload): void
    {
        $user = Auth::user();
        abort_unless($user && $this->record->canRecipientSubmitReview($user), 403);

        $pdfData = base64_decode($payload['pdf'], strict: true);
        $qrData = base64_decode($payload['qr'], strict: true);
        $signatureHash = $payload['hash'];

        abort_unless($pdfData && $qrData && $signatureHash, 422, 'Invalid signature payload.');

        // Prevent duplicate signatures with the same hash
        $exists = DocumentSignature::query()
            ->where('signature_hash', $signatureHash)
            ->exists();

        if ($exists) {
            FilamentNotification::make()
                ->title('Tanda tangan sudah tersimpan sebelumnya')
                ->warning()
                ->send();

            return;
        }

        $currentVersionId = $this->record->versions()->max('id');
        abort_unless($currentVersionId, 500, 'Document has no version.');

        $baseName = $this->record->id . '_v' . $currentVersionId . '_' . $user->id;
        $signedPath = 'document-signatures/' . $baseName . '.pdf';
        $qrPath = 'document-signatures/qr/' . $baseName . '.png';

        $disk = Storage::disk('public');
        $disk->put($signedPath, $pdfData);
        $disk->put($qrPath, $qrData);

        DocumentSignature::query()->create([
            'document_id' => $this->record->id,
            'document_version_id' => $currentVersionId,
            'user_id' => $user->id,
            'original_document_path' => $this->record->file_path,
            'signed_document_path' => $signedPath,
            'qr_path' => $qrPath,
            'signature_hash' => $signatureHash,
            'signed_at' => now(),
        ]);

        FilamentNotification::make()
            ->title('Tanda tangan berhasil disimpan')
            ->success()
            ->send();
    }

    public function submitReview(): void
    {
        $user = Auth::user();
        abort_unless($user && $this->record->canRecipientSubmitReview($user), 403);

        $formData = $this->form->getState();

        // Enforce the revision limit: block if the user has already requested
        // revision the maximum number of times for this document.
        if (
            $formData['status'] === 'revision' &&
            app(DocumentReviewAuthorizationService::class)->hasExceededRevisionLimit($this->record, $user)
        ) {
            $limit = DocumentReviewAuthorizationService::REVISION_LIMIT;

            FilamentNotification::make()
                ->title('Revision Limit Reached')
                ->body("Anda sudah memberikan revisi sebanyak {$limit}. Anda tidak bisa memberikan revisi lagi untuk dokumen ini.")
                ->warning()
                ->send();
            return;
        }

        $review = null;

        DB::transaction(function () use ($formData, $user, &$review): void {
            $document = Document::query()
                ->whereKey($this->record->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Resolve the current (latest) version — this is what the user is reviewing
            $currentVersionId = $document->versions()
                ->max('id');

            abort_unless($currentVersionId, 500, 'Document has no version.');

            $now = now();

            DocumentReview::query()->upsert(
                [
                    [
                        'document_id'         => $document->id,
                        'document_version_id' => $currentVersionId,
                        'user_id'             => $user->id,
                        'status'              => $formData['status'],
                        'message'             => $formData['message'] ?? null,
                        'attachment_path'     => $formData['attachment_path'] ?? null,
                        'attachment_name'     => $formData['attachment_name'] ?? null,
                        'created_at'          => $now,
                        'updated_at'          => $now,
                    ],
                ],
                ['document_version_id', 'user_id'],
                ['status', 'message', 'attachment_path', 'attachment_name', 'updated_at'],
            );

            $document->updateStatusBasedOnReviews();

            // Fetch the review for notification
            $review = DocumentReview::where('document_id', $document->id)
                ->where('document_version_id', $currentVersionId)
                ->where('user_id', $user->id)
                ->with('reviewer')
                ->first();
        }, 3);

        if ($review) {
            $uploader = $this->record->uploader;
            if ($uploader) {
                $uploader->notify(new RecipientSubmittedReviewNotification($this->record, $review));

                $notificationBody = sprintf(
                    '%s submitted %s for %s (%s).',
                    $review->reviewer?->name ?? 'A recipient',
                    strtoupper((string) $review->status),
                    $this->record->title,
                    $this->record->unique_code,
                );

                $dashboardNotification = FilamentNotification::make()
                    ->title('New Document Review')
                    ->body($notificationBody)
                    ->viewData([
                        'detail' => [
                            'document_id' => $this->record->id,
                            'document_title' => $this->record->title,
                            'document_unique_code' => $this->record->unique_code,
                            'review_id' => $review->id,
                            'review_status' => $review->status,
                            'review_message' => $review->message,
                            'reviewer_name' => $review->reviewer?->name,
                        ],
                    ]);

                if ($review->status === 'revision') {
                    $dashboardNotification->warning();
                } else {
                    $dashboardNotification->success();
                }

                $dashboardNotification->sendToDatabase($uploader);
                try {
                    $dashboardNotification->broadcast($uploader);
                } catch (\Exception $e) {
                    // Ignore broadcast exceptions
                }
            }
        }

        FilamentNotification::make()
            ->title('Review Submitted Successfully')
            ->success()
            ->send();

        $this->redirect(DocumentResource::getUrl('index'));
    }
}
