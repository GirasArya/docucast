<x-filament-panels::page>

    <style>
        /* ── Layout ─────────────────────────────────── */
        .own-sig-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            margin-top: 0.25rem;
            margin-bottom: 2rem;
            align-items: start;
        }

        @media (min-width: 1024px) {
            .own-sig-layout {
                grid-template-columns: 1fr 380px;
            }
        }

        /* ── Card ───────────────────────────────────── */
        .own-sig-card {
            border-radius: 0.875rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05), 0 1px 2px rgba(0, 0, 0, .03);
            overflow: hidden;
        }

        .dark .own-sig-card {
            border-color: rgba(255, 255, 255, .08);
            background-color: var(--gray-900);
            box-shadow: none;
        }

        /* ── Card header ─────────────────────────────── */
        .own-sig-card-header {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.75rem 1.125rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: rgba(249, 250, 251, .8);
            min-height: 3.25rem;
        }

        .dark .own-sig-card-header {
            border-bottom-color: rgba(255, 255, 255, .08);
            background-color: rgba(24, 24, 27, .5);
        }

        .own-sig-header-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 0.5rem;
            background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
            color: var(--primary-600);
            flex-shrink: 0;
        }

        .dark .own-sig-header-icon {
            background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
            color: var(--primary-400);
        }

        .own-sig-header-text {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .own-sig-header-title {
            font-size: 0.8125rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .own-sig-header-title {
            color: rgb(243, 244, 246);
        }

        .own-sig-header-sub {
            font-size: 0.6875rem;
            color: rgb(107, 114, 128);
            margin-top: 1px;
        }

        .dark .own-sig-header-sub {
            color: rgb(156, 163, 175);
        }

        /* ── Page nav in header ──────────────────────── */
        .own-sig-page-nav {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            margin-left: auto;
            flex-shrink: 0;
        }

        .own-sig-page-nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.625rem;
            height: 1.625rem;
            border-radius: 0.375rem;
            border: 1px solid rgb(209, 213, 219);
            background: #fff;
            cursor: pointer;
            font-size: 0.875rem;
            color: rgb(55, 65, 81);
            transition: background .15s;
            line-height: 1;
        }

        .own-sig-page-nav-btn:hover:not(:disabled) {
            background: rgb(249, 250, 251);
        }

        .own-sig-page-nav-btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .dark .own-sig-page-nav-btn {
            background: var(--gray-800);
            border-color: rgba(255, 255, 255, .1);
            color: rgb(209, 213, 219);
        }

        .own-sig-page-counter {
            font-size: 0.7rem;
            color: rgb(107, 114, 128);
            white-space: nowrap;
            padding: 0 0.125rem;
        }

        /* ── Card body ───────────────────────────────── */
        .own-sig-card-body {
            padding: 1.125rem;
        }

        .own-sig-preview-body {
            padding: 0;
        }

        /* ── Drop zone ───────────────────────────────── */
        .own-sig-dropzone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            min-height: 18rem;
            border: 2px dashed rgb(209, 213, 219);
            border-radius: 0;
            background-color: rgba(249, 250, 251, .5);
            cursor: pointer;
            text-align: center;
            padding: 2rem 1.5rem;
            transition: border-color .2s, background-color .2s;
        }

        .own-sig-dropzone:hover,
        .own-sig-dropzone.dz-active {
            border-color: var(--primary-400);
            background-color: color-mix(in srgb, var(--primary-500) 4%, transparent);
        }

        .dark .own-sig-dropzone {
            border-color: rgba(255, 255, 255, .12);
            background-color: rgba(255, 255, 255, .02);
        }

        .dark .own-sig-dropzone:hover,
        .dark .own-sig-dropzone.dz-active {
            border-color: var(--primary-400);
            background-color: color-mix(in srgb, var(--primary-400) 6%, transparent);
        }

        .own-sig-dz-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 50%;
            background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
            color: var(--primary-600);
        }

        .dark .own-sig-dz-icon {
            background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
            color: var(--primary-400);
        }

        .own-sig-dz-title {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
        }

        .dark .own-sig-dz-title {
            color: rgb(243, 244, 246);
        }

        .own-sig-dz-sub {
            display: block;
            font-size: 0.75rem;
            color: rgb(107, 114, 128);
            margin-top: 2px;
        }

        .own-sig-dz-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
            font-size: 0.6875rem;
            font-weight: 600;
            color: var(--primary-700);
            border: 1px solid color-mix(in srgb, var(--primary-500) 20%, transparent);
        }

        .dark .own-sig-dz-badge {
            background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
            color: var(--primary-300);
            border-color: color-mix(in srgb, var(--primary-400) 25%, transparent);
        }

        /* ── Error ───────────────────────────────────── */
        .own-sig-error {
            font-size: 0.75rem;
            color: rgb(220, 38, 38);
            padding: 0.5rem 1.125rem;
            display: none;
        }

        .own-sig-error.visible {
            display: block;
        }

        /* ── PDF Canvas area ─────────────────────────── */
        .own-sig-canvas-area {
            position: relative;
        }

        .own-sig-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            min-height: 16rem;
            padding: 2rem;
            color: rgb(107, 114, 128);
            font-size: 0.8125rem;
        }

        .own-sig-spinner {
            width: 2rem;
            height: 2rem;
            border: 2px solid rgb(229, 231, 235);
            border-top-color: var(--primary-500);
            border-radius: 50%;
            animation: own-sig-spin .7s linear infinite;
        }

        @keyframes own-sig-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .own-sig-canvas-wrapper {
            position: relative;
            overflow: auto;
            max-height: 72vh;
            background-color: rgb(243, 244, 246);
        }

        .dark .own-sig-canvas-wrapper {
            background-color: rgba(0, 0, 0, .2);
        }

        .own-sig-pdf-canvas {
            display: block;
            width: 100%;
            height: auto;
        }

        /* ── QR stamp (draggable overlay) ────────────── */
        .own-sig-qr-stamp {
            position: absolute;
            cursor: grab;
            user-select: none;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
            border: 1px dashed var(--primary-600);
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2px;
            box-sizing: border-box;
            transition: border-color .15s, box-shadow .15s;
            touch-action: none;
            z-index: 10;
        }

        .own-sig-qr-stamp:hover {
            border-color: var(--primary-500);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .22);
        }

        .own-sig-qr-stamp.is-dragging {
            cursor: grabbing;
            border-style: solid;
            border-color: var(--primary-700);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .28);
        }

        /* ── QR Resize Handle ───────────────────────── */
        .own-sig-qr-resize-handle {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background-color: var(--primary-600);
            border: 2px solid #fff;
            border-radius: 50%;
            cursor: se-resize;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            z-index: 12;
            touch-action: none;
        }

        .own-sig-qr-resize-handle:hover {
            transform: scale(1.1);
            background-color: var(--primary-500);
        }

        /* ── QR Close / Remove Button ───────────────── */
        .own-sig-qr-remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            background-color: rgb(239, 68, 68);
            border: 2px solid #fff;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            z-index: 12;
            color: #fff;
            font-size: 8px;
            font-weight: bold;
            line-height: 1;
            transition: transform 0.15s, background-color 0.15s;
            touch-action: none;
        }

        .own-sig-qr-remove-btn:hover {
            transform: scale(1.1);
            background-color: rgb(220, 38, 38);
        }

        /* ── Controls column ─────────────────────────── */
        .own-sig-controls {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* ── File pill ───────────────────────────────── */
        .own-sig-file-pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.625rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: rgb(249, 250, 251);
            font-size: 0.8rem;
            margin-bottom: 0.75rem;
        }

        .dark .own-sig-file-pill {
            border-color: rgba(255, 255, 255, .08);
            background-color: rgba(255, 255, 255, .04);
        }

        .own-sig-pill-name {
            flex: 1;
            font-weight: 500;
            color: rgb(17, 24, 39);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dark .own-sig-pill-name {
            color: rgb(243, 244, 246);
        }

        .own-sig-pill-size {
            font-size: 0.7rem;
            color: rgb(107, 114, 128);
            flex-shrink: 0;
        }

        .own-sig-pill-rm {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background: none;
            border: none;
            cursor: pointer;
            color: rgb(156, 163, 175);
            font-size: 0.9rem;
            transition: color .15s;
            line-height: 1;
        }

        .own-sig-pill-rm:hover {
            color: rgb(239, 68, 68);
        }

        /* ── Credentials grid ────────────────────────── */
        .own-sig-cred-grid {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
            margin-bottom: 1rem;
        }

        .own-sig-cred-item {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .own-sig-cred-label {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: rgb(107, 114, 128);
        }

        .dark .own-sig-cred-label {
            color: rgb(156, 163, 175);
        }

        .own-sig-cred-val {
            font-size: 0.775rem;
            color: rgb(17, 24, 39);
            background-color: rgb(249, 250, 251);
            border: 1px solid rgb(229, 231, 235);
            border-radius: 0.5rem;
            padding: 0.4rem 0.625rem;
            word-break: break-all;
            line-height: 1.4;
        }

        .dark .own-sig-cred-val {
            color: rgb(229, 231, 235);
            background-color: rgba(255, 255, 255, .04);
            border-color: rgba(255, 255, 255, .08);
        }

        .own-sig-cred-val.mono {
            font-family: ui-monospace, monospace;
            font-size: 0.7rem;
        }

        .own-sig-cred-val.muted {
            color: rgb(156, 163, 175);
            font-style: italic;
        }

        /* ── QR mini preview ─────────────────────────── */
        .own-sig-qr-mini {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 0.625rem;
            border: 1px solid color-mix(in srgb, var(--primary-500) 20%, transparent);
            background-color: color-mix(in srgb, var(--primary-500) 5%, transparent);
            margin-bottom: 1rem;
        }

        .dark .own-sig-qr-mini {
            border-color: color-mix(in srgb, var(--primary-400) 25%, transparent);
            background-color: color-mix(in srgb, var(--primary-400) 6%, transparent);
        }

        .own-sig-qr-mini-title {
            font-size: 0.775rem;
            font-weight: 600;
            color: var(--primary-700);
            margin: 0 0 2px;
        }

        .dark .own-sig-qr-mini-title {
            color: var(--primary-300);
        }

        .own-sig-qr-mini-sub {
            font-size: 0.7rem;
            color: rgb(107, 114, 128);
            margin: 0;
        }

        /* ── Actions ─────────────────────────────────── */
        .own-sig-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .own-sig-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.5625rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: background-color .15s, border-color .15s, opacity .15s;
            text-decoration: none;
            width: 100%;
        }

        .own-sig-btn:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        .own-sig-btn-primary {
            background-color: var(--primary-600);
            color: #fff;
        }

        .own-sig-btn-primary:hover:not(:disabled) {
            background-color: var(--primary-500);
        }

        .own-sig-btn-outline {
            background-color: #fff;
            border-color: rgb(209, 213, 219);
            color: rgb(55, 65, 81);
        }

        .own-sig-btn-outline:hover:not(:disabled) {
            background-color: rgb(249, 250, 251);
        }

        .dark .own-sig-btn-outline {
            background-color: var(--gray-800);
            border-color: rgba(255, 255, 255, .1);
            color: rgb(209, 213, 219);
        }

        .dark .own-sig-btn-outline:hover:not(:disabled) {
            background-color: var(--gray-700);
        }

        .own-sig-select-wrapper {
            position: relative;
            width: 100%;
            margin-top: 0.375rem;
            margin-bottom: 0.5rem;
        }

        .own-sig-select-input {
            width: 100%;
            font-size: 0.775rem;
            color: rgb(17, 24, 39);
            background-color: rgb(249, 250, 251);
            border: 1px solid rgb(229, 231, 235);
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1rem 1rem;
            padding-right: 2rem;
        }

        .own-sig-select-input:focus {
            border-color: var(--primary-500);
            box-shadow: 0 0 0 2px color-mix(in srgb, var(--primary-500) 20%, transparent);
        }

        .dark .own-sig-select-input {
            color: rgb(229, 231, 235);
            background-color: rgba(255, 255, 255, .04);
            border-color: rgba(255, 255, 255, .08);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }

        .dark .own-sig-select-input option {
            background-color: var(--gray-900);
            color: rgb(229, 231, 235);
        }

        .own-sig-select-input option:disabled {
            color: rgb(156, 163, 175);
            opacity: 0.5;
        }

        .dark .own-sig-select-input option:disabled {
            color: rgb(75, 85, 99);
        }
    </style>

    {{-- Hidden QR render target --}}
    <div id="own-qr-rt" aria-hidden="true"
        style="position:fixed;top:-9999px;left:-9999px;visibility:hidden;pointer-events:none;"></div>

    <div class="own-sig-layout" x-data="ownSigApp()" x-init="initLibs()"
        @mousemove.window="onGlobalMouseMove($event)" @mouseup.window="stopDrag()"
        @touchmove.window.prevent="onGlobalTouchMove($event)" @touchend.window="stopDrag()">

        {{-- ══ LEFT: PDF Preview ════════════════════════════════════ --}}
        <div class="own-sig-card" style="overflow:hidden;">
            <div class="own-sig-card-header">
                <div class="own-sig-header-icon">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="own-sig-header-text">
                    <span class="own-sig-header-title" x-text="hasFile ? fileName : 'Pratinjau Dokumen'"></span>
                    <span class="own-sig-header-sub"
                        x-text="hasFile ? (pageCount + ' halaman · ' + fileSize) : 'Unggah PDF untuk melihat pratinjau'"></span>
                </div>
                <div class="own-sig-page-nav" x-show="hasFile">
                    {{-- Zoom Out --}}
                    <button type="button" class="own-sig-page-nav-btn" @click="zoomOut()" :disabled="zoomScale <= 0.5"
                        title="Perkecil">
                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                        </svg>
                    </button>
                    <span class="own-sig-page-counter" x-text="Math.round(zoomScale * 100) + '%'"></span>
                    {{-- Zoom In --}}
                    <button type="button" class="own-sig-page-nav-btn" @click="zoomIn()" :disabled="zoomScale >= 3.0"
                        title="Perbesar">
                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>

                    <span style="border-left: 1px solid rgb(229,231,235); height: 16px; margin: 0 4px;"
                        x-show="pageCount > 1"></span>

                    {{-- Page Prev/Next --}}
                    <button type="button" class="own-sig-page-nav-btn" @click="prevPage()" :disabled="pageNum <= 1"
                        x-show="pageCount > 1">‹</button>
                    <span class="own-sig-page-counter" x-text="pageNum + ' / ' + pageCount"
                        x-show="pageCount > 1"></span>
                    <button type="button" class="own-sig-page-nav-btn" @click="nextPage()"
                        :disabled="pageNum >= pageCount" x-show="pageCount > 1">›</button>
                </div>
            </div>

            <div class="own-sig-preview-body">

                {{-- Drop zone (no file) --}}
                <label class="own-sig-dropzone" x-show="!hasFile" @dragenter.prevent="$el.classList.add('dz-active')"
                    @dragleave.prevent="$el.classList.remove('dz-active')" @dragover.prevent
                    @drop.prevent="$el.classList.remove('dz-active'); handleFile($event.dataTransfer.files[0])">
                    <input type="file" x-ref="dzInput" accept="application/pdf"
                        @change="handleFile($event.target.files[0])" style="display:none">
                    <div class="own-sig-dz-icon">
                        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <div>
                        <span class="own-sig-dz-title">Seret & Lepas dokumen PDF</span>
                        <span class="own-sig-dz-sub">atau klik area ini untuk memilih file</span>
                    </div>
                    <span class="own-sig-dz-badge">PDF · Maks. 10 MB</span>
                </label>

                {{-- Error (below dropzone) --}}
                <p class="own-sig-error" :class="{ visible: error && !hasFile }" x-text="error"></p>

                {{-- PDF Canvas area (file loaded) --}}
                <div class="own-sig-canvas-area" x-show="hasFile">

                    {{-- Loading spinner --}}
                    <div class="own-sig-loading" x-show="loading">
                        <div class="own-sig-spinner"></div>
                        <span>Memuat dokumen...</span>
                    </div>

                    {{-- Canvas wrapper with draggable QR overlay --}}
                    <div class="own-sig-canvas-wrapper" x-ref="canvasWrapper" x-show="!loading">
                        <canvas x-ref="pdfCanvas" class="own-sig-pdf-canvas"></canvas>

                        {{-- Draggable QR stamp with Resize Handle --}}
                        <div class="own-sig-qr-stamp" x-show="qrReady" :class="{ 'is-dragging': isDragging }"
                            :style="`left:${qrX}px;top:${qrY}px;width:${qrDisplaySize}px;height:${qrDisplaySize * qrHeightRatio}px;`"
                            @mousedown.prevent="startDrag($event)" @touchstart.prevent="startDragTouch($event)">
                            <img :src="qrDataUrl" draggable="false"
                                style="width:100%;height:100%;display:block;border-radius:4px;">

                            {{-- Resize Handle --}}
                            <div class="own-sig-qr-resize-handle" @mousedown.prevent.stop="startResize($event)"
                                @touchstart.prevent.stop="startResizeTouch($event)"></div>

                            {{-- Close / Remove Button --}}
                            <button type="button" class="own-sig-qr-remove-btn" @mousedown.prevent.stop
                                @touchstart.prevent.stop @click.prevent.stop="removePageQr()">✕</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ══ RIGHT: Controls ═══════════════════════════════════════ --}}
        <div class="own-sig-controls">

            {{-- File card --}}
            <div class="own-sig-card">
                <div class="own-sig-card-header">
                    <div class="own-sig-header-icon">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="own-sig-header-text">
                        <span class="own-sig-header-title"
                            x-text="hasFile ? 'Dokumen Terpilih' : 'Pilih Dokumen'"></span>
                        <span class="own-sig-header-sub">Format PDF · Maks. 10 MB</span>
                    </div>
                </div>
                <div class="own-sig-card-body">

                    {{-- File pill (has file) --}}
                    <div class="own-sig-file-pill" x-show="hasFile">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2" style="color:var(--primary-600);flex-shrink:0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="own-sig-pill-name" x-text="fileName"></span>
                        <span class="own-sig-pill-size" x-text="fileSize"></span>
                        <button type="button" class="own-sig-pill-rm" @click="clearFile()"
                            title="Hapus">✕</button>
                    </div>

                    {{-- Error (controls panel, when file is loaded) --}}
                    <p class="own-sig-error" :class="{ visible: error && hasFile }" x-text="error"></p>

                    {{-- Upload / change button --}}
                    <label class="own-sig-btn own-sig-btn-outline" style="cursor:pointer;">
                        <input type="file" accept="application/pdf" @change="handleFile($event.target.files[0])"
                            style="display:none">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span x-text="hasFile ? 'Ganti Dokumen' : 'Pilih Dokumen'"></span>
                    </label>

                </div>
            </div>

            {{-- Signature card --}}
            <div class="own-sig-card">
                <div class="own-sig-card-header">
                    <div class="own-sig-header-icon">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>
                    </div>
                    <div class="own-sig-header-text">
                        <span class="own-sig-header-title">Tanda Tangan Digital</span>
                        <span class="own-sig-header-sub">QR hanya berlaku untuk dokumen internal saja</span>
                    </div>
                </div>
                <div class="own-sig-card-body">

                    {{-- Credential fields --}}
                    <div class="own-sig-cred-grid">
                        <div class="own-sig-cred-item">
                            <span class="own-sig-cred-label">NPK</span>
                            <div class="own-sig-cred-val">
                                {{ auth()->user()->nik }}
                            </div>
                        </div>
                        <div class="own-sig-cred-item">
                            <span class="own-sig-cred-label">Penandatangan</span>
                            <div class="own-sig-cred-val">
                                {{ auth()->user()->name }}
                            </div>
                        </div>
                        {{-- <div class="own-sig-cred-item">
                            <span class="own-sig-cred-label">Hash Dokumen (SHA-256)</span>
                            <div class="own-sig-cred-val mono"
                                x-text="fileHash || '— unggah dokumen terlebih dahulu —'"
                                :class="{ muted: !fileHash }"></div>
                        </div> --}}
                        <div class="own-sig-cred-item">
                            <span class="own-sig-cred-label">Timestamp</span>
                            <div class="own-sig-cred-val" x-text="timestamp || '— belum ditandatangani —'"
                                :class="{ muted: !timestamp }"></div>
                        </div>
                    </div>

                    {{-- QR Style Selection --}}
                    <div class="own-sig-cred-item" style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
                        <span class="own-sig-cred-label">Gaya Tanda Tangan / QR</span>
                        <div class="own-sig-select-wrapper">
                            <select x-model="qrStyle" @change="if (hasFile && qrReady) generateSignature()"
                                class="own-sig-select-input">
                                <option value="raw">QR Code</option>
                                <option value="bordered">QR Code dengan Nama</option>
                                <option value="signature_only" :disabled="!userSignatureUrl">Tanda Tangan Digital
                                </option>
                                <option value="signature_qr" :disabled="!userSignatureUrl">Tanda Tangan dengan QR
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- QR mini preview (after generation) --}}
                    <div class="own-sig-qr-mini" x-show="qrReady">
                        <img :src="qrDataUrl"
                            style="width:72px;height:72px;border-radius:0.5rem;border:1px solid rgba(0,0,0,.06);flex-shrink:0;">
                        <div>
                            <p class="own-sig-qr-mini-title">QR berhasil dibuat</p>
                            <p class="own-sig-qr-mini-sub">Seret kode QR di pratinjau ke posisi yang diinginkan lalu
                                unduh</p>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="own-sig-actions">
                        <button type="button" class="own-sig-btn own-sig-btn-primary"
                            :disabled="!hasFile || loading" @click="generateSignature()">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Tanda Tangan
                        </button>

                        <button type="button" class="own-sig-btn own-sig-btn-outline" :disabled="!anyQrReady"
                            @click="downloadSigned()">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Unduh PDF Bertanda Tangan
                        </button>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        function ownSigApp() {
            let _pdfDoc = null; // ← plain JS variable, never touched by Alpine's Proxy


            return {
                fileName: '',
                fileSize: '',
                hasFile: false,
                fileObj: null,
                error: '',
                pageNum: 1,
                pageCount: 0,
                loading: false,

                /* QR placement per page: { pageNum: { dataUrl, x, y, size, timestamp } } */
                pageQrs: {},
                get anyQrReady() {
                    return Object.keys(this.pageQrs).length > 0;
                },
                zoomScale: 1.0,

                qrReady: false,
                qrDataUrl: '',
                qrX: 20,
                qrY: 20,
                qrDisplaySize: 120,
                isDragging: false,
                isResizing: false,
                dragOffsetX: 0,
                dragOffsetY: 0,
                resizeStartX: 0,
                resizeStartY: 0,
                resizeStartSize: 0,
                fileHash: '',
                timestamp: '',
                qrStyle: 'raw',
                qrHeightRatio: 1.0,
                userName: @js(auth()->user()->name ?? ''),
                userId: @js(auth()->user()->id ?? ''),
                userNPK: @js(auth()->user()->nik ?? ''),
                userEmail: @js(auth()->user()->email ?? ''),
                userSignatureUrl: @js(
    \App\Models\DrawSignature::where('user_id', auth()->id())
        ->latest()
        ->first()?->file_path
        ? Storage::disk('public')->url(
            \App\Models\DrawSignature::where('user_id', auth()->id())
                ->latest()
                ->first()->file_path,
        )
        : null,
),

                async initLibs() {
                    await this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js');
                    if (window.pdfjsLib) {
                        pdfjsLib.GlobalWorkerOptions.workerSrc =
                            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
                    }
                    await Promise.all([
                        this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js'),
                        this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js')
                    ]);
                },

                loadScript(src) {
                    return new Promise(resolve => {
                        if (document.querySelector(`script[src="${src}"]`)) {
                            resolve();
                            return;
                        }
                        const s = document.createElement('script');
                        s.src = src;
                        s.onload = resolve;
                        s.onerror = resolve;
                        document.head.appendChild(s);
                    });
                },

                async handleFile(file) {
                    this.error = '';
                    if (!file) return;
                    if (file.type !== 'application/pdf') {
                        this.error = 'Hanya file PDF yang diperbolehkan.';
                        return;
                    }
                    if (file.size > 10 * 1024 * 1024) {
                        this.error = 'Ukuran file tidak boleh melebihi 10 MB.';
                        return;
                    }

                    this.fileName = file.name;
                    this.fileSize = (file.size / 1048576).toFixed(2) + ' MB';
                    this.fileObj = file;
                    this.hasFile = true;
                    this.pageQrs = {};
                    this.qrReady = false;
                    this.fileHash = '';
                    this.timestamp = '';
                    this.loading = true;

                    const buf = await file.arrayBuffer();
                    const hashBuf = await crypto.subtle.digest('SHA-256', buf);
                    this.fileHash = Array.from(new Uint8Array(hashBuf)).map(b => b.toString(16).padStart(2, '0')).join(
                        '');

                    await this.$nextTick();
                    await this.renderPdf(buf.slice(0));
                    this.loading = false;
                },

                async renderPdf(buffer) {
                    if (!window.pdfjsLib) return;
                    _pdfDoc = await pdfjsLib.getDocument({
                        data: new Uint8Array(buffer),
                        cMapUrl: 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.16.105/cmaps/',
                        cMapPacked: true
                    }).promise;
                    this.pageCount = _pdfDoc.numPages;
                    this.pageNum = 1;
                    await this.renderPage(1);
                    this.loadPageQrState();
                },

                async renderPage(num) {
                    if (!_pdfDoc) return;
                    await this.$nextTick();
                    const canvas = this.$refs.pdfCanvas;
                    const wrapper = this.$refs.canvasWrapper;
                    const page = await _pdfDoc.getPage(num);
                    const vp0 = page.getViewport({
                        scale: 1
                    });

                    // Compute display scale fitting the wrapper, scaled by the zoom level
                    const displayScale = Math.min((wrapper.clientWidth || 640) / vp0.width, 4) * this.zoomScale;

                    // Render with high-resolution multiplier (DPR) to make PDF crisp on all displays
                    const dpr = 3;
                    const scale = displayScale * dpr;
                    const vp = page.getViewport({
                        scale
                    });
                    canvas.width = vp.width;
                    canvas.height = vp.height;

                    // Size the canvas container to trigger overflow scrollbars on zoom
                    canvas.style.width = (vp0.width * displayScale) + 'px';
                    canvas.style.height = (vp0.height * displayScale) + 'px';

                    await page.render({
                        canvasContext: canvas.getContext('2d'),
                        viewport: vp
                    }).promise;
                },

                loadPageQrState() {
                    const config = this.pageQrs[this.pageNum];
                    const canvas = this.$refs.pdfCanvas;
                    if (config && canvas) {
                        const displayW = canvas.clientWidth;
                        const displayH = canvas.clientHeight;

                        this.qrReady = true;
                        this.qrDataUrl = config.dataUrl;

                        // Map the reference position proportionally to current display size (handles zoom scaling)
                        const refW = config.refW || displayW;
                        const refH = config.refH || displayH;
                        this.qrX = (config.x / refW) * displayW;
                        this.qrY = (config.y / refH) * displayH;
                        this.qrDisplaySize = (config.size / refW) * displayW;
                        this.qrHeightRatio = config.heightRatio || 1.0;

                        this.timestamp = config.timestamp;
                    } else if (config) {
                        this.qrReady = true;
                        this.qrDataUrl = config.dataUrl;
                        this.qrX = config.x;
                        this.qrY = config.y;
                        this.qrDisplaySize = config.size;
                        this.qrHeightRatio = config.heightRatio || 1.0;
                        this.timestamp = config.timestamp;
                    } else {
                        this.qrReady = false;
                        this.qrDataUrl = '';
                        this.qrX = 20;
                        this.qrY = 20;
                        this.qrDisplaySize = 120;
                        this.qrHeightRatio = (this.qrStyle === 'bordered' || this.qrStyle === 'signature_only' || this
                            .qrStyle === 'signature_qr') ? (170 / 380) : 1.0;
                        this.timestamp = '';
                    }
                },

                clearFile() {
                    this.fileName = '';
                    this.fileSize = '';
                    this.hasFile = false;
                    this.fileObj = null;
                    this.fileHash = '';
                    this.qrReady = false;
                    this.pageQrs = {};
                    this.zoomScale = 1.0;
                    _pdfDoc = null;
                    this.pageCount = 0;
                    this.error = '';
                    this.timestamp = '';
                    this.qrHeightRatio = (this.qrStyle === 'bordered' || this.qrStyle === 'signature_only' || this
                        .qrStyle === 'signature_qr') ? (170 / 380) : 1.0;
                },

                async prevPage() {
                    if (this.pageNum > 1) {
                        this.pageNum--;
                        await this.renderPage(this.pageNum);
                        this.loadPageQrState();
                    }
                },
                async nextPage() {
                    if (this.pageNum < this.pageCount) {
                        this.pageNum++;
                        await this.renderPage(this.pageNum);
                        this.loadPageQrState();
                    }
                },

                async zoomIn() {
                    if (this.zoomScale < 3.0) {
                        this.zoomScale = Math.min(3.0, this.zoomScale + 0.25);
                        await this.renderPage(this.pageNum);
                        this.loadPageQrState();
                    }
                },

                async zoomOut() {
                    if (this.zoomScale > 0.5) {
                        this.zoomScale = Math.max(0.5, this.zoomScale - 0.25);
                        await this.renderPage(this.pageNum);
                        this.loadPageQrState();
                    }
                },

                async generateSignature() {
                    if (!this.hasFile || this.loading) return;

                    // Load user signature image if needed
                    let sigImg = null;
                    if ((this.qrStyle === 'signature_only' || this.qrStyle === 'signature_qr') && this
                        .userSignatureUrl) {
                        sigImg = new Image();
                        sigImg.src = this.userSignatureUrl;
                        await new Promise((resolve) => {
                            sigImg.onload = resolve;
                            sigImg.onerror = resolve; // proceed anyway
                        });
                    }

                    this.timestamp = new Date().toLocaleString('id-ID', {
                        timeZone: 'Asia/Jakarta',
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    });
                    const payload = JSON.stringify({
                        NPK: this.userNpk,
                        Signer: this.userName,
                        Email: this.userEmail,
                        HashCode: this.fileHash.slice(0, 32),
                        timestamp: this.timestamp,
                    });
                    const target = document.getElementById('own-qr-rt');
                    target.innerHTML = '';
                    await new Promise(resolve => {
                        new QRCode(target, {
                            text: payload,
                            width: 256,
                            height: 256,
                            correctLevel: QRCode.CorrectLevel.M
                        });
                        setTimeout(resolve, 160);
                    });
                    const qrCanvas = target.querySelector('canvas');
                    let dataUrl = '';
                    if (qrCanvas) {
                        if (this.qrStyle === 'bordered' || this.qrStyle === 'signature_qr') {
                            this.qrHeightRatio = 170 / 380;

                            // Render custom bordered canvas (380x170)
                            const finalCanvas = document.createElement('canvas');
                            finalCanvas.width = 380;
                            finalCanvas.height = 170;
                            const ctx = finalCanvas.getContext('2d');

                            // Fill white background
                            ctx.fillStyle = '#ffffff';
                            ctx.fillRect(0, 0, 380, 170);

                            // Setup text fonts & styling
                            const textLeft = 42;
                            const paddingX = 8; // padding around text for the gap

                            // 1. Measure "Signed By"
                            ctx.font = '500 18px "Inter", "Segoe UI", sans-serif';
                            const signedByText = 'Signed By';
                            const signedByWidth = ctx.measureText(signedByText).width;
                            const gap1Start = textLeft - paddingX;
                            const gap1End = textLeft + signedByWidth + paddingX;

                            // 2. Measure userName
                            // Handle font scaling if the user's name is too long
                            let nameFontSize = 22;
                            ctx.font = `bold ${nameFontSize}px "Inter", "Segoe UI", sans-serif`;
                            let nameWidth = ctx.measureText(this.userName).width;
                            // Ensure it does not exceed the QR code starting x
                            while (nameWidth > 160 && nameFontSize > 12) {
                                nameFontSize--;
                                ctx.font = `bold ${nameFontSize}px "Inter", "Segoe UI", sans-serif`;
                                nameWidth = ctx.measureText(this.userName).width;
                            }
                            const gap2Start = textLeft - paddingX;
                            const gap2End = textLeft + nameWidth + paddingX;

                            // Setup border styling
                            ctx.strokeStyle = '#0f172a';
                            ctx.lineWidth = 3;
                            ctx.lineCap = 'square';

                            const left = 10;
                            const right = 370;
                            const top = 10;
                            const bottom = 160;

                            // Draw Left vertical line
                            ctx.beginPath();
                            ctx.moveTo(left, top);
                            ctx.lineTo(left, bottom);
                            ctx.stroke();

                            // Draw Right vertical line
                            ctx.beginPath();
                            ctx.moveTo(right, top);
                            ctx.lineTo(right, bottom);
                            ctx.stroke();

                            // Draw Top horizontal lines with gap
                            ctx.beginPath();
                            ctx.moveTo(left, top);
                            ctx.lineTo(gap1Start, top);
                            ctx.stroke();

                            ctx.beginPath();
                            ctx.moveTo(gap1End, top);
                            ctx.lineTo(right, top);
                            ctx.stroke();

                            // Draw Bottom horizontal lines with gap
                            ctx.beginPath();
                            ctx.moveTo(left, bottom);
                            ctx.lineTo(gap2Start, bottom);
                            ctx.stroke();

                            ctx.beginPath();
                            ctx.moveTo(gap2End, bottom);
                            ctx.lineTo(right, bottom);
                            ctx.stroke();

                            // Render texts
                            ctx.textBaseline = 'middle';
                            ctx.textAlign = 'left';

                            // Top Text: "Signed By"
                            ctx.fillStyle = '#0f172a';
                            ctx.font = '500 18px "Inter", "Segoe UI", sans-serif';
                            ctx.fillText(signedByText, textLeft, top);

                            // Bottom Text: User Name
                            ctx.fillStyle = '#0f172a';
                            ctx.font = `bold ${nameFontSize}px "Inter", "Segoe UI", sans-serif`;
                            ctx.fillText(this.userName, textLeft, bottom);

                            // Draw QR canvas centered on the right
                            // QR size: 130x130. Vertically centered inside [10, 160]
                            const qrSize = 130;
                            const qrXPos = right - qrSize - 16;
                            const qrYPos = top + (bottom - top - qrSize) / 2;
                            ctx.drawImage(qrCanvas, qrXPos, qrYPos, qrSize, qrSize);

                            // Draw user signature on the left if using signature_qr style
                            if (this.qrStyle === 'signature_qr' && sigImg && sigImg.naturalWidth) {
                                const sigMaxW = 180;
                                const sigMaxH = 110;
                                const scale = Math.min(sigMaxW / sigImg.naturalWidth, sigMaxH / sigImg.naturalHeight);
                                const w = sigImg.naturalWidth * scale;
                                const h = sigImg.naturalHeight * scale;
                                const x = 10 + (200 - w) / 2;
                                const y = 10 + (150 - h) / 2;
                                ctx.drawImage(sigImg, x, y, w, h);
                            }

                            dataUrl = finalCanvas.toDataURL('image/png');
                        } else if (this.qrStyle === 'signature_only') {
                            this.qrHeightRatio = 170 / 380;
                            const finalCanvas = document.createElement('canvas');
                            finalCanvas.width = 380;
                            finalCanvas.height = 170;
                            const ctx = finalCanvas.getContext('2d');
                            ctx.clearRect(0, 0, 380, 170); // transparent background
                            if (sigImg && sigImg.naturalWidth) {
                                const scale = Math.min(380 / sigImg.naturalWidth, 170 / sigImg.naturalHeight);
                                const w = sigImg.naturalWidth * scale;
                                const h = sigImg.naturalHeight * scale;
                                const x = (380 - w) / 2;
                                const y = (170 - h) / 2;
                                ctx.drawImage(sigImg, x, y, w, h);
                            }
                            dataUrl = finalCanvas.toDataURL('image/png');
                        } else {
                            this.qrHeightRatio = 1.0;
                            dataUrl = qrCanvas.toDataURL('image/png');
                        }
                    }
                    const canvas = this.$refs.pdfCanvas;

                    this.pageQrs[this.pageNum] = {
                        dataUrl: dataUrl,
                        x: Math.max(0, canvas.clientWidth - 120 - 16),
                        y: 16,
                        size: 120,
                        heightRatio: this.qrHeightRatio,
                        timestamp: this.timestamp,
                        refW: canvas.clientWidth, // ← reference frame this placement was drawn against
                        refH: canvas.clientHeight, // ←
                    };

                    this.loadPageQrState();
                },

                startDrag(e) {
                    this.isDragging = true;
                    const r = e.currentTarget.getBoundingClientRect();
                    this.dragOffsetX = e.clientX - r.left;
                    this.dragOffsetY = e.clientY - r.top;
                },
                startDragTouch(e) {
                    this.isDragging = true;
                    const t = e.touches[0];
                    const r = e.currentTarget.getBoundingClientRect();
                    this.dragOffsetX = t.clientX - r.left;
                    this.dragOffsetY = t.clientY - r.top;
                },
                startResize(e) {
                    this.isResizing = true;
                    this.resizeStartSize = this.qrDisplaySize;
                    this.resizeStartX = e.clientX;
                    this.resizeStartY = e.clientY;
                },
                startResizeTouch(e) {
                    this.isResizing = true;
                    const t = e.touches[0];
                    this.resizeStartSize = this.qrDisplaySize;
                    this.resizeStartX = t.clientX;
                    this.resizeStartY = t.clientY;
                },
                onGlobalMouseMove(e) {
                    if (this.isResizing) this._doResize(e.clientX, e.clientY);
                    else if (this.isDragging) this._moveTo(e.clientX, e.clientY);
                },
                onGlobalTouchMove(e) {
                    if (this.isResizing) {
                        const t = e.touches[0];
                        this._doResize(t.clientX, t.clientY);
                    } else if (this.isDragging) {
                        const t = e.touches[0];
                        this._moveTo(t.clientX, t.clientY);
                    }
                },
                _moveTo(cx, cy) {
                    const w = this.$refs.canvasWrapper;
                    const canvas = this.$refs.pdfCanvas;
                    if (!w || !canvas) return;
                    const r = w.getBoundingClientRect();
                    const qrHeight = this.qrDisplaySize * this.qrHeightRatio;
                    this.qrX = Math.max(0, Math.min(cx - r.left - this.dragOffsetX + w.scrollLeft, canvas.clientWidth - this
                        .qrDisplaySize));
                    this.qrY = Math.max(0, Math.min(cy - r.top - this.dragOffsetY + w.scrollTop, canvas.clientHeight -
                        qrHeight));

                    if (this.pageQrs[this.pageNum]) {
                        this.pageQrs[this.pageNum].x = this.qrX;
                        this.pageQrs[this.pageNum].y = this.qrY;
                        // keep refW/refH as originally recorded — do not overwrite
                    }
                },
                _doResize(cx, cy) {
                    const deltaX = cx - this.resizeStartX;
                    const deltaY = cy - this.resizeStartY;
                    const delta = Math.max(deltaX, deltaY);
                    const newSize = Math.max(60, Math.min(300, this.resizeStartSize + delta));
                    const canvas = this.$refs.pdfCanvas;
                    if (canvas) {
                        const maxW = canvas.clientWidth - this.qrX;
                        const maxH = (canvas.clientHeight - this.qrY) / this.qrHeightRatio;
                        this.qrDisplaySize = Math.min(newSize, maxW, maxH);
                    } else {
                        this.qrDisplaySize = newSize;
                    }
                    if (this.pageQrs[this.pageNum]) {
                        this.pageQrs[this.pageNum].size = this.qrDisplaySize;
                    }
                },
                stopDrag() {
                    this.isDragging = false;
                    this.isResizing = false;
                },

                removePageQr() {
                    delete this.pageQrs[this.pageNum];
                    this.loadPageQrState();
                },

                async downloadSigned() {
                    if (!this.anyQrReady || !_pdfDoc || !window.jspdf) return;
                    this.loading = true;
                    this.error = '';
                    try {
                        const {
                            jsPDF
                        } = window.jspdf;
                        let pdfDocInstance = null;

                        for (let i = 1; i <= this.pageCount; i++) {
                            const page = await _pdfDoc.getPage(i);
                            const viewport = page.getViewport({
                                scale: 2.0
                            });
                            const tempCanvas = document.createElement('canvas');
                            tempCanvas.width = viewport.width;
                            tempCanvas.height = viewport.height;
                            const ctx = tempCanvas.getContext('2d');
                            await page.render({
                                canvasContext: ctx,
                                viewport: viewport
                            }).promise;

                            const config = this.pageQrs[i];
                            if (config && config.dataUrl && config.refW && config.refH) {
                                const qrXPct = config.x / config.refW; // ← use THIS placement's own reference
                                const qrYPct = config.y / config.refH;
                                const qrSizePctW = config.size / config.refW;

                                const qrImg = await new Promise((resolve, reject) => {
                                    const img = new Image();
                                    img.onload = () => resolve(img);
                                    img.onerror = () => reject(new Error('Gagal memuat gambar QR halaman ' +
                                        i));
                                    img.src = config.dataUrl;
                                });

                                const qrCx = qrXPct * tempCanvas.width;
                                const qrCy = qrYPct * tempCanvas.height;
                                const qrSz = qrSizePctW * tempCanvas.width;
                                const qrHeightRatio = config.heightRatio || 1.0;

                                ctx.drawImage(qrImg, qrCx, qrCy, qrSz, qrSz * qrHeightRatio);
                            }

                            const imgData = tempCanvas.toDataURL('image/jpeg', 0.95);
                            if (i === 1) {
                                pdfDocInstance = new jsPDF({
                                    orientation: tempCanvas.width > tempCanvas.height ? 'l' : 'p',
                                    unit: 'px',
                                    format: [tempCanvas.width, tempCanvas.height],
                                    compress: true
                                });
                            } else {
                                pdfDocInstance.addPage([tempCanvas.width, tempCanvas.height], tempCanvas.width >
                                    tempCanvas.height ? 'l' : 'p');
                            }
                            pdfDocInstance.addImage(imgData, 'JPEG', 0, 0, tempCanvas.width, tempCanvas.height);
                        }

                        if (pdfDocInstance) {
                            pdfDocInstance.save(this.fileName.replace(/\.pdf$/i, '') + '_signed.pdf');
                        }
                    } catch (err) {
                        this.error = 'Gagal mengunduh: ' + err.message;
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }
    </script>

</x-filament-panels::page>
