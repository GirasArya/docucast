<x-filament-panels::page>
    <style>
        .detail-preview-panel,
        .detail-non-pdf-panel {
            display: flex !important;
            flex-direction: column;
            border-radius: 0.75rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: rgb(255, 255, 255);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.06), 0 1px 2px -1px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .dark .detail-preview-panel,
        .dark .detail-non-pdf-panel {
            border-color: rgba(255, 255, 255, 0.08);
            background-color: var(--gray-900);
            box-shadow: none;
        }

        .detail-mobile-preview {
            display: none !important;
            text-align: center;
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: rgb(249, 250, 251);
        }

        .dark .detail-mobile-preview {
            border-color: rgba(255, 255, 255, 0.08);
            background-color: var(--gray-950);
        }

        .detail-mobile-preview>*+* {
            margin-top: 1rem;
        }

        @media (max-width: 767px) {
            .detail-preview-panel {
                display: none !important;
            }

            .detail-mobile-preview {
                display: flex !important;
                flex-direction: column;
                align-items: center;
            }
        }

        .detail-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: rgba(249, 250, 251, 0.8);
            padding: 0.625rem 1rem;
        }

        .dark .detail-preview-header {
            border-bottom-color: rgba(255, 255, 255, 0.08);
            background-color: rgba(24, 24, 27, 0.6);
        }

        .detail-non-pdf-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex: 1 1 0%;
            gap: 1rem;
            padding: 2rem;
            background-color: color-mix(in srgb, var(--primary-50) 8%, transparent);
        }

        .dark .detail-non-pdf-body {
            background-color: color-mix(in srgb, var(--primary-950) 5%, transparent);
        }

        /* Info card on the right */
        .detail-info-card {
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(229, 231, 235);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.06), 0 1px 2px -1px rgba(0, 0, 0, 0.04);
        }

        .dark .detail-info-card {
            background-color: var(--gray-900);
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: none;
        }

        .detail-info-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem 1.25rem;
        }

        .detail-info-label {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgb(156, 163, 175);
            margin-bottom: 0.2rem;
        }

        .dark .detail-info-label {
            color: rgb(107, 114, 128);
        }

        .detail-info-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
        }

        .dark .detail-info-value {
            color: rgb(243, 244, 246);
        }

        .detail-info-value.muted {
            font-weight: 500;
            color: rgb(75, 85, 99);
        }

        .dark .detail-info-value.muted {
            color: rgb(156, 163, 175);
        }

        .detail-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
        }

        .detail-divider {
            border: none;
            border-top: 1px solid rgb(229, 231, 235);
            margin: 1.25rem 0;
        }

        .dark .detail-divider {
            border-top-color: rgba(255, 255, 255, 0.08);
        }

        .detail-description-box {
            background-color: rgb(249, 250, 251);
            border: 1px solid rgb(229, 231, 235);
            border-radius: 0.5rem;
            padding: 0.875rem 1rem;
            font-size: 0.8125rem;
            color: rgb(55, 65, 81);
            line-height: 1.6;
        }

        .dark .detail-description-box {
            background-color: rgba(255, 255, 255, 0.03);
            border-color: rgba(156, 163, 175);
            color: rgb(209, 213, 219);
        }

        .btn-newtab {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 0.5rem;
            background-color: var(--primary-600) !important;
            color: #ffffff !important;
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            transition: background-color 0.15s;
            text-decoration: none;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .btn-newtab:hover {
            background-color: var(--primary-500) !important;
        }

        .btn-newtab-lg {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.5rem;
            background-color: var(--primary-600) !important;
            color: #ffffff !important;
            padding: 0.6rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 0.15s;
            text-decoration: none;
        }

        .btn-newtab-lg:hover {
            background-color: var(--primary-500) !important;
        }

        /* Text colors (Replacing inline text-gray-800 / dark:text-gray-200 and subtexts) */
        .detail-text-heading {
            color: rgb(31, 41, 55);
        }

        .dark .detail-text-heading {
            color: rgb(229, 231, 235);
        }

        .detail-text-subtext {
            color: rgb(156, 163, 175);
        }

        .dark .detail-text-subtext {
            color: rgb(107, 114, 128);
        }

        .detail-text-muted-desc {
            color: rgb(107, 114, 128);
        }

        .dark .detail-text-muted-desc {
            color: rgb(156, 163, 175);
        }

        /* Iframe preview container background */
        .detail-iframe-wrapper {
            background-color: rgb(249, 250, 251);
        }

        .dark .detail-iframe-wrapper {
            background-color: rgb(3, 7, 18);
        }

        /* Primary icon badge box */
        .detail-icon-primary-box {
            background-color: var(--primary-50);
            color: var(--primary-600);
        }

        .dark .detail-icon-primary-box {
            background-color: color-mix(in srgb, var(--primary-950) 40%, transparent);
            color: var(--primary-400);
        }

        /* Amber icon badge box */
        .detail-icon-amber-box {
            background-color: rgb(254, 243, 199);
            color: rgb(217, 119, 6);
        }

        .dark .detail-icon-amber-box {
            background-color: rgba(120, 53, 15, 0.3);
            color: rgb(251, 191, 36);
        }

        /* Generic muted icon badge box */
        .detail-icon-muted-box {
            background-color: rgb(243, 244, 246);
            color: rgb(156, 163, 175);
        }

        .dark .detail-icon-muted-box {
            background-color: rgba(255, 255, 255, 0.05);
            color: rgb(156, 163, 175);
        }

        /* Auto badge */
        .detail-auto-badge {
            background-color: var(--primary-50);
            color: var(--primary-700);
        }

        .dark .detail-auto-badge {
            background-color: color-mix(in srgb, var(--primary-950) 30%, transparent);
            color: var(--primary-400);
        }

        /* Version History Container & Rows */
        .version-history-container {
            border: 1px solid rgb(229, 231, 235);
            border-radius: 0.625rem;
            overflow: hidden;
        }

        .dark .version-history-container {
            border-color: rgba(255, 255, 255, 0.08);
        }

        .version-history-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.65rem 0.875rem;
            font-size: 0.8125rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: transparent;
        }

        .version-history-item:last-child {
            border-bottom: none;
        }

        .dark .version-history-item {
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }

        .version-history-item.is-latest {
            background-color: rgba(239, 246, 255, 0.7);
        }

        .dark .version-history-item.is-latest {
            background-color: rgba(30, 58, 138, 0.2);
        }

        .version-badge {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            padding: 0.2rem 0.4rem;
            border-radius: 0.375rem;
            font-size: 0.7rem;
            font-weight: 700;
            background-color: rgb(243, 244, 246);
            color: rgb(107, 114, 128);
        }

        .dark .version-badge {
            background-color: rgba(255, 255, 255, 0.08);
            color: rgb(156, 163, 175);
        }

        .version-badge.is-latest {
            background-color: rgb(219, 234, 254);
            color: rgb(29, 78, 216);
        }

        .dark .version-badge.is-latest {
            background-color: rgba(30, 58, 138, 0.5);
            color: rgb(147, 197, 253);
        }

        .version-filename {
            margin: 0;
            font-weight: 600;
            color: rgb(31, 41, 55);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 160px;
        }

        .dark .version-filename {
            color: rgb(229, 231, 235);
        }

        .version-meta {
            margin: 0.1rem 0 0;
            font-size: 0.7rem;
            color: rgb(107, 114, 128);
        }

        .dark .version-meta {
            color: rgb(156, 163, 175);
        }

        .btn-version-download {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.6rem;
            border-radius: 0.4rem;
            border: 1px solid rgb(209, 213, 219);
            background-color: #ffffff;
            color: rgb(55, 65, 81);
            font-size: 0.7rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-version-download:hover {
            background-color: rgb(249, 250, 251);
            color: rgb(17, 24, 39);
        }

        .dark .btn-version-download {
            border-color: rgba(255, 255, 255, 0.12);
            background-color: rgba(255, 255, 255, 0.05);
            color: rgb(209, 213, 219);
        }

        .dark .btn-version-download:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
    </style>

    <div class="flex flex-col gap-4 mt-4 mb-10">
        <div>
            @php $isPdf = str_ends_with(strtolower((string) ($record->file_name ?? $record->file_path)), '.pdf'); @endphp
            @if ($isPdf)
                {{-- Desktop PDF iframe --}}
                <div class="detail-preview-panel" style="height: 78vh;">
                    <div class="detail-preview-header">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold detail-text-heading truncate">
                                    {{ $record->file_name }}
                                </p>
                                <p class="text-[10px] detail-text-subtext">
                                    PDF · {{ $record->unique_code }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('documents.preview', ['document' => $record, 'v' => $record->updated_at?->timestamp]) }}"
                            target="_blank" rel="noopener noreferrer" class="btn-newtab shrink-0">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Open in New Tab
                        </a>
                    </div>
                    <div class="detail-iframe-wrapper" style="position: relative; flex: 1 1 0%;">
                        <iframe
                            src="{{ route('documents.preview', ['document' => $record, 'v' => $record->updated_at?->timestamp]) }}"
                            style="position: absolute; inset: 0; width: 100%; height: 100%; border: none;"></iframe>
                    </div>
                </div>

                {{-- Mobile fallback --}}
                <div class="detail-mobile-preview">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full detail-icon-primary-box">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold detail-text-heading">PDF preview not available on
                        mobile</p>
                    <a href="{{ route('documents.preview', ['document' => $record, 'v' => $record->updated_at?->timestamp]) }}"
                        target="_blank" rel="noopener noreferrer" class="btn-newtab-lg w-full">
                        Open PDF in New Tab
                    </a>
                </div>
            @else
                {{-- Non-PDF placeholder --}}
                <div class="detail-non-pdf-panel" style="height: 78vh;">
                    <div class="detail-preview-header">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div
                                class="shrink-0 flex h-7 w-7 items-center justify-center rounded-md detail-icon-amber-box">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold detail-text-heading truncate">
                                    {{ $record->file_name }}</p>
                                <p class="text-[10px] detail-text-subtext">File ·
                                    {{ $record->unique_code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-non-pdf-body">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full detail-icon-muted-box">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold detail-text-heading">No Preview Available</p>
                            <p class="text-xs detail-text-muted-desc mt-1 max-w-xs mx-auto">This file type
                                cannot be previewed in the browser.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-4">
            <div class="detail-info-card">
                {{-- Header --}}
                <div class="flex items-center" style="margin-bottom: 1rem;">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg detail-icon-primary-box shrink-0">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold detail-text-heading">Document Information</h2>
                </div>

                {{-- Metadata Grid --}}
                <div class="detail-info-row">
                    <div>
                        <p class="detail-info-label">Document Title</p>
                        <p class="detail-info-value" title="{{ $record->title }}">{{ $record->title }}</p>
                    </div>
                    <div>
                        <p class="detail-info-label">Unique Code</p>
                        <p class="detail-info-value font-mono text-xs tracking-wider">{{ $record->unique_code }}</p>
                    </div>
                    <div>
                        <p class="detail-info-label">Status</p>
                        @php
                            $statusStyles = [
                                'pending' => 'background-color: #b45309; color: #fffbeb;',
                                'in_review' => 'background-color: #1d4ed8; color: #eff6ff;',
                                'approved' => 'background-color: #047857; color: #ecfdf5;',
                            ];
                            $statusStyle =
                                $statusStyles[$record->status] ?? 'background-color: #f3f4f6; color: #4b5563;';
                        @endphp
                        <span class="detail-status-badge" style="{{ $statusStyle }}">
                            <span
                                style="display:inline-block;width:6px;height:6px;border-radius:9999px;background:currentColor;opacity:0.7;"></span>
                            {{ ucfirst(str_replace('_', ' ', $record->status)) }}
                        </span>
                    </div>
                    <div>
                        <p class="detail-info-label">Uploaded On</p>
                        <p class="detail-info-value muted">{{ $record->created_at->format('d M Y g:i A') }}</p>
                    </div>
                    @if ($record->limit_date)
                        <div>
                            <p class="detail-info-label">Limit Date</p>
                            <p class="detail-info-value muted">
                                {{ $record->limit_date->format('d M Y') }}
                                @if ($record->auto_approve)
                                    <span
                                        class="ml-1 text-[10px] font-semibold detail-auto-badge px-1.5 py-0.5 rounded">Auto</span>
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Uploader details --}}
                @if ($record->uploader)
                    <hr class="detail-divider">
                    <div>
                        <p class="detail-info-label mb-2">Uploader</p>
                        <div class="flex items-center gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold detail-text-heading truncate">
                                    {{ $record->uploader->name }}</p>
                                @if ($record->uploader->job_title)
                                    <p class="text-xs detail-text-muted-desc truncate">
                                        {{ $record->uploader->job_title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Description --}}
                @if (filled($record->description))
                    <hr class="detail-divider">
                    <div>
                        <p class="detail-info-label mb-2">Description</p>
                        <div class="detail-description-box rich-text-content">
                            {!! $record->description !!}
                        </div>
                    </div>
                @endif

                {{-- Past Versions --}}
                @php $versions = $record->versions()->with('uploader')->orderByDesc('version_number')->get(); @endphp
                @if ($versions->isNotEmpty())
                    <hr class="detail-divider">
                    <div>
                        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.75rem;">
                            <svg style="width:14px;height:14px;flex-shrink:0;" class="detail-text-subtext"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                            <p class="detail-info-label" style="margin-bottom:0;">Version History
                                ({{ $versions->count() }})</p>
                        </div>
                        <div class="version-history-container">
                            @foreach ($versions as $version)
                                <div class="version-history-item {{ $loop->first ? 'is-latest' : '' }}">
                                    {{-- Version badge + info --}}
                                    <div style="display:flex;align-items:center;gap:0.75rem;min-width:0;flex:1;">
                                        <span class="version-badge {{ $loop->first ? 'is-latest' : '' }}">
                                            v{{ $version->version_number }}
                                            @if ($loop->first)
                                                <span style="margin-left:3px;font-size:0.6rem;opacity:0.7;">★</span>
                                            @endif
                                        </span>
                                        <div style="min-width:0;">
                                            <p class="version-filename" title="{{ $version->original_filename }}">
                                                {{ $version->original_filename ?: 'Document v' . $version->version_number }}
                                            </p>
                                            <p class="version-meta">
                                                {{ $version->created_at->format('d M Y') }} ·
                                                {{ $version->uploader?->name ?? '—' }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- Download button --}}
                                    <a href="{{ route('documents.preview', ['document' => $record, 'version' => $version->version_number]) }}"
                                        target="_blank" rel="noopener noreferrer" class="btn-version-download">
                                        <svg style="width:11px;height:11px;" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-filament-panels::page>
