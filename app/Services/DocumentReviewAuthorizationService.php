<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentReview;
use App\Models\User;

class DocumentReviewAuthorizationService
{
    public function __construct(
        private DocumentStatusService $statusService,
    ) {}

    public const int REVISION_LIMIT = 2;

    /**
     * Check if user can submit a review for this document (current version)
     */
    public function canUserSubmitReview(Document $document, User $user): bool
    {
        if (! $this->isRecipient($document, $user)) {
            return false;
        }

        return ! $this->hasReviewedCurrentVersion($document, $user);
    }

    /**
     * Check if the user has reached the maximum number of revision requests
     * they are allowed to submit for this document across all versions.
     */
    public function hasExceededRevisionLimit(Document $document, User $user): bool
    {
        $count = DocumentReview::query()
            ->where('document_id', $document->id)
            ->where('user_id', $user->id)
            ->where('status', 'revision')
            ->count();

        return $count >= self::REVISION_LIMIT;
    }

    /**
     * Check if user can revise a document (is the uploader)
     */
    public function canUserReviseDocument(Document $document, User $user): bool
    {
        return $document->uploader_id === $user->id && $document->status === 'revision';
    }

    /**
     * Allow a recipient to review again by deleting their review for the current version
     */
    public function allowReviewAgain(Document $document, int $recipientId): void
    {
        $currentVersionId = $document->versions()->max('id');

        $document->reviews()
            ->where('user_id', $recipientId)
            ->when($currentVersionId, fn ($q) => $q->where('document_version_id', $currentVersionId))
            ->delete();

        $this->statusService->updateStatus($document);
    }

    /**
     * Check if user is a recipient
     */
    private function isRecipient(Document $document, User $user): bool
    {
        return $document->recipients()
            ->where('users.id', $user->id)
            ->exists();
    }

    /**
     * Check if user has already submitted any review (approved OR revision) for the current version.
     * This blocks the review button until the uploader uploads a new version.
     */
    private function hasReviewedCurrentVersion(Document $document, User $user): bool
    {
        $currentVersionId = $document->versions()->max('id');

        if (! $currentVersionId) {
            return false;
        }

        return $document->reviews()
            ->where('user_id', $user->id)
            ->where('document_version_id', $currentVersionId)
            ->exists();
    }
}

