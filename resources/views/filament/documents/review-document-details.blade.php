@php
    $versions = $document->versions()->with('uploader')->orderByDesc('version_number')->get();
@endphp

<style>
    .review-version-list {
        display: flex;
        flex-direction: column;
    }

    .review-version-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid rgb(243, 244, 246);
    }

    .dark .review-version-item {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    .review-version-item:last-child {
        border-bottom: none;
    }

    /* Version badge */
    .review-version-label-container {
        flex-shrink: 0;
    }

    .review-version-label-text {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
        color: var(--primary-700);
        box-shadow: inset 0 0 0 1px color-mix(in srgb, var(--primary-600) 15%, transparent);
    }

    .dark .review-version-label-text {
        background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
        color: var(--primary-400);
        box-shadow: inset 0 0 0 1px color-mix(in srgb, var(--primary-400) 30%, transparent);
    }

    /* Title / uploader info */
    .review-version-title-container {
        flex: 1 1 0%;
        min-width: 0;
    }

    .review-version-filename {
        margin: 0;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgb(3, 7, 18);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dark .review-version-filename {
        color: rgb(255, 255, 255);
    }

    .review-version-meta {
        margin: 0.2rem 0 0;
        font-size: 0.75rem;
        color: rgb(107, 114, 128);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dark .review-version-meta {
        color: rgb(156, 163, 175);
    }

    /* Download button */
    .review-download-btn {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        border-radius: 0.5rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;
        font-weight: 600;
        text-decoration: none;
        background-color: var(--primary-600);
        color: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        transition: background-color 0.15s ease-in-out;
        white-space: nowrap;
    }

    .review-download-btn:hover {
        background-color: var(--primary-500);
    }

    .dark .review-download-btn {
        background-color: var(--primary-500);
    }

    .dark .review-download-btn:hover {
        background-color: var(--primary-400);
    }

    .review-download-btn svg {
        width: 1rem;
        height: 1rem;
        color: #fff;
        flex-shrink: 0;
    }

    .review-download-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .review-download-btn.btn-outline {
        background-color: transparent;
        border: 1px solid var(--primary-600);
        color: var(--primary-600);
        box-shadow: none;
    }

    .review-download-btn.btn-outline:hover {
        background-color: color-mix(in srgb, var(--primary-600) 8%, transparent);
    }

    .review-download-btn.btn-outline svg {
        color: var(--primary-600);
    }

    .dark .review-download-btn.btn-outline {
        border-color: var(--primary-500);
        color: var(--primary-400);
    }

    .dark .review-download-btn.btn-outline:hover {
        background-color: color-mix(in srgb, var(--primary-500) 12%, transparent);
    }

    .dark .review-download-btn.btn-outline svg {
        color: var(--primary-400);
    }
</style>

<div style="display: flex; flex-direction: column; gap: var(--spacing-gr-lg);">
    <!-- Document Metadata Card -->
    <div class="review-info-card">
        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Document Info</h4>
        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--spacing-gr-md); margin-top: var(--spacing-gr-sm);"
            class="text-sm">
            <div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Title:</span>
                <p class="font-semibold text-gray-800 dark:text-gray-200 truncate" title="{{ $document->title }}">
                    {{ $document->title }}</p>
            </div>
            <div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Code:</span>
                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $document->unique_code }}</p>
            </div>
            <div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Uploader:</span>
                <p class="font-medium text-gray-700 dark:text-gray-300">{{ $document->uploader?->name ?? 'System' }}</p>
            </div>
            @if ($document->limit_date)
                <div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Limit Date:</span>
                    <p class="font-medium text-gray-700 dark:text-gray-300">
                        {{ $document->limit_date->format('d M Y') }}
                        @if ($document->auto_approve)
                            <span
                                class="text-[10px] bg-primary-50 text-primary-700 dark:bg-primary-950/30 dark:text-primary-400 px-1.5 py-0.5 rounded font-semibold ml-1">Auto-Approve</span>
                        @endif
                    </p>
                </div>
            @endif
        </div>

        @if (filled($document->description))
            <div class="border-t border-gray-200 dark:border-gray-800"
                style="margin-top: var(--spacing-gr-md); padding-top: var(--spacing-gr-sm);">
                <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold block mb-2">Description:</span>
                <div
                    class="rich-text-content text-sm p-3.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300">
                    {!! $document->description !!}
                </div>
            </div>
        @endif
    </div>

    <!-- Version History -->
    <div style="display: flex; flex-direction: column; gap: var(--spacing-gr-sm);">
        <h3 class="text-sm font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-4 h-4 mr-1.5 text-gray-400 -mt-px" width="16" height="16" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                </path>
            </svg>
            Version History ({{ $versions->count() }})
        </h3>

        <div class="review-version-list">
            @foreach ($versions as $version)
                <div class="review-version-item">
                    <!-- Column 1: Version label -->
                    <div class="review-version-label-container">
                        <span class="review-version-label-text">
                            v{{ $version->version_number }}
                        </span>
                    </div>

                    <!-- Column 2: Title with uploader info -->
                    <div class="review-version-title-container">
                        <p class="review-version-filename" title="{{ $version->original_filename }}">
                            {{ $version->original_filename ?: 'Document' }}
                        </p>
                        <p class="review-version-meta">
                            Uploaded by {{ $version->uploader?->name ?? 'System' }}
                        </p>
                    </div>

                    <!-- Column 3: Download button(s) -->
                    @php
                        $hasSignature = \App\Models\DocumentSignature::where('document_id', $document->id)
                            ->where('document_version_id', $version->id)
                            ->exists();
                    @endphp

                    <div class="review-download-group">
                        @if ($hasSignature)
                            {{-- Original download --}}
                            <a href="{{ route('documents.preview', ['document' => $document, 'version' => $version->version_number, 'mode' => 'original']) }}"
                                target="_blank" rel="noopener noreferrer" class="review-download-btn btn-outline" title="Download Original Document">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Original
                            </a>

                            {{-- Signed download --}}
                            <a href="{{ route('documents.preview', ['document' => $document, 'version' => $version->version_number]) }}"
                                target="_blank" rel="noopener noreferrer" class="review-download-btn" title="Download Signed Document">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Signed
                            </a>
                        @else
                            {{-- Original download only --}}
                            <a href="{{ route('documents.preview', ['document' => $document, 'version' => $version->version_number]) }}"
                                target="_blank" rel="noopener noreferrer" class="review-download-btn">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
