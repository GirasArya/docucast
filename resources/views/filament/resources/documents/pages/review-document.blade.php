<x-filament-panels::page>
    <style>
        :root {
            --spacing-gr-xs: 8px;
            --spacing-gr-sm: 13px;
            --spacing-gr-md: 21px;
            --spacing-gr-lg: 34px;
            --spacing-gr-xl: 55px;
        }

        /* ── Custom Grid Layout ─────────────────────── */
        .review-sig-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            align-items: start;
            width: 100%;
        }

        @media (min-width: 1024px) {
            .review-sig-layout {
                grid-template-columns: 7fr 5fr;
            }
        }

        .review-sig-left {
            min-width: 0;
            width: 100%;
        }

        .review-sig-right {
            min-width: 0;
            width: 100%;
        }

        /* ── Page card ──────────────────────────────── */
        .review-page-card {
            padding: var(--spacing-gr-md);
            margin-top: var(--spacing-gr-md);
            margin-bottom: var(--spacing-gr-lg);
            border-radius: 0.75rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: rgb(255, 255, 255);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .dark .review-page-card {
            border-color: rgba(255, 255, 255, 0.1);
            background-color: var(--gray-900);
            box-shadow: none;
        }

        @media (min-width: 1024px) {
            .review-page-card {
                padding: var(--spacing-gr-xl);
                margin-top: var(--spacing-gr-lg);
                margin-bottom: var(--spacing-gr-xl);
            }
        }

        /* ── Review form ────────────────────────────── */
        .review-page-card form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-gr-md);
        }

        .review-form-actions {
            display: flex;
            gap: var(--spacing-gr-sm);
            justify-content: flex-end;
            padding-top: var(--spacing-gr-md);
            margin-top: var(--spacing-gr-md);
            border-top: 1px solid rgb(229, 231, 235);
        }

        .dark .review-form-actions {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        /* ── Signature Preview Card ─────────────────── */
        .rsig-card {
            border-radius: 0.875rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05), 0 1px 2px rgba(0, 0, 0, .03);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 78vh;
        }

        .dark .rsig-card {
            border-color: rgba(255, 255, 255, .08);
            background-color: var(--gray-900);
            box-shadow: none;
        }

        /* ── Header ─────────────────────────────────── */
        .rsig-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: rgba(249, 250, 251, .8);
            flex-shrink: 0;
        }

        .dark .rsig-header {
            border-bottom-color: rgba(255, 255, 255, .08);
            background-color: rgba(24, 24, 27, .5);
        }

        .rsig-header-left {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            min-width: 0;
        }

        .rsig-header-icon {
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

        .dark .rsig-header-icon {
            background-color: color-mix(in srgb, var(--primary-500) 15%, transparent);
            color: var(--primary-400);
        }

        .rsig-file-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: rgb(31, 41, 55);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .rsig-file-name {
            color: rgb(229, 231, 235);
        }

        .rsig-file-sub {
            font-size: 0.625rem;
            color: rgb(156, 163, 175);
        }

        .dark .rsig-file-sub {
            color: rgb(107, 114, 128);
        }

        /* ── Toolbar (page nav, zoom, sign button) ──── */
        .rsig-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            padding: 0.375rem 0.75rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: rgba(249, 250, 251, .4);
            flex-shrink: 0;
            flex-wrap: wrap;
        }

        .dark .rsig-toolbar {
            border-bottom-color: rgba(255, 255, 255, .06);
            background-color: rgba(24, 24, 27, .3);
        }

        .rsig-toolbar-group {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .rsig-tb-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgb(209, 213, 219);
            background: #fff;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.6875rem;
            font-weight: 600;
            color: rgb(55, 65, 81);
            cursor: pointer;
            transition: background .15s, border-color .15s;
            gap: 0.25rem;
            line-height: 1;
        }

        .rsig-tb-btn:hover {
            background: rgb(243, 244, 246);
        }

        .rsig-tb-btn:disabled {
            opacity: .4;
            cursor: default;
        }

        .dark .rsig-tb-btn {
            border-color: rgba(255, 255, 255, .12);
            background: var(--gray-800);
            color: rgb(209, 213, 219);
        }

        .dark .rsig-tb-btn:hover {
            background: var(--gray-700);
        }

        .rsig-tb-label {
            font-size: 0.6875rem;
            font-weight: 600;
            color: rgb(107, 114, 128);
            padding: 0 0.25rem;
            user-select: none;
        }

        .dark .rsig-tb-label {
            color: rgb(156, 163, 175);
        }

        .rsig-sign-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            border: none;
            border-radius: 0.5rem;
            background: var(--primary-600);
            color: #fff;
            padding: 0.375rem 0.75rem;
            font-size: 0.6875rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s;
            line-height: 1;
        }

        .rsig-sign-btn:hover {
            background: var(--primary-500);
        }

        .rsig-sign-btn:disabled {
            opacity: .45;
            cursor: default;
        }

        .rsig-save-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            border: 2px solid var(--primary-600);
            border-radius: 0.5rem;
            background: transparent;
            color: var(--primary-600);
            padding: 0.325rem 0.75rem;
            font-size: 0.6875rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s, color .15s;
            line-height: 1;
        }

        .rsig-save-btn:hover {
            background: var(--primary-600);
            color: #fff;
        }

        .rsig-save-btn:disabled {
            opacity: .4;
            cursor: default;
        }

        .dark .rsig-save-btn {
            border-color: var(--primary-500);
            color: var(--primary-400);
        }

        .dark .rsig-save-btn:hover {
            background: var(--primary-500);
            color: #fff;
        }

        /* ── Canvas area ────────────────────────────── */
        .rsig-canvas-area {
            flex: 1 1 0%;
            position: relative;
            overflow: hidden;
            background: rgb(243, 244, 246);
        }

        .dark .rsig-canvas-area {
            background: rgb(24, 24, 27);
        }

        .rsig-canvas-wrapper {
            position: relative;
            overflow: auto;
            width: 100%;
            height: 100%;
        }

        .rsig-canvas-wrapper canvas {
            display: block;
        }

        /* ── Loading ────────────────────────────────── */
        .rsig-loading {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, .85);
            z-index: 20;
        }

        .dark .rsig-loading {
            background: rgba(0, 0, 0, .6);
        }

        .rsig-spinner {
            width: 28px;
            height: 28px;
            border: 3px solid rgba(0, 0, 0, .1);
            border-top-color: var(--primary-600);
            border-radius: 50%;
            animation: rsig-spin .7s linear infinite;
        }

        @keyframes rsig-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Draggable QR stamp ─────────────────────── */
        .rsig-qr-stamp {
            position: absolute;
            z-index: 10;
            cursor: grab;
            border: 2px dashed var(--primary-500);
            border-radius: 6px;
            background: rgba(255, 255, 255, .75);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .12);
            transition: box-shadow .15s;
            touch-action: none;
        }

        .rsig-qr-stamp.is-dragging {
            cursor: grabbing;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
            border-color: var(--primary-600);
        }

        .rsig-qr-drag-hint {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 9px;
            color: rgba(255, 255, 255, .9);
            background: rgba(0, 0, 0, .55);
            padding: 2px 6px;
            border-radius: 4px;
            white-space: nowrap;
            pointer-events: none;
            letter-spacing: .03em;
        }

        /* ── QR Resize Handle ───────────────────────── */
        .rsig-qr-resize-handle {
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

        .rsig-qr-resize-handle:hover {
            transform: scale(1.1);
            background-color: var(--primary-500);
        }

        /* ── QR Close / Remove Button ───────────────── */
        .rsig-qr-remove-btn {
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

        .rsig-qr-remove-btn:hover {
            transform: scale(1.1);
            background-color: rgb(220, 38, 38);
        }

        /* ── Hidden QR render target ────────────────── */
        #rsig-qr-rt {
            position: absolute;
            top: -9999px;
            left: -9999px;
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
    </style>

    {{-- Hidden QR render target --}}
    <div id="rsig-qr-rt"></div>

    <div class="review-page-card" x-data="reviewSignApp()" x-init="initLibs().then(() => loadDocumentPdf())"
        @mousemove.window="onGlobalMouseMove($event)" @mouseup.window="stopDrag()"
        @touchmove.window="onGlobalTouchMove($event)" @touchend.window="stopDrag()">

        {{-- ══ LEFT: PDF Preview with QR overlay ══════════════════════ --}}
        <form @submit.prevent="handleFormSubmit()">
            <div class="review-sig-layout">
                <div class="review-sig-left" wire:ignore>
                    <div class="rsig-card">

                        {{-- Header --}}
                        <div class="rsig-header">
                            <div class="rsig-header-left">
                                <div class="rsig-header-icon">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div style="min-width:0;">
                                    <p class="rsig-file-name" x-text="fileName">Dokumen</p>
                                    <p class="rsig-file-sub">PDF Document • {{ $this->record->unique_code }}</p>
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

                        {{-- Toolbar --}}
                        <div class="rsig-toolbar">
                            <div class="rsig-toolbar-group">
                                <button type="button" class="rsig-tb-btn" :disabled="pageNum <= 1"
                                    @click="prevPage()">‹</button>
                                <span class="rsig-tb-label" x-text="pageNum + ' / ' + pageCount">1 / 1</span>
                                <button type="button" class="rsig-tb-btn" :disabled="pageNum >= pageCount"
                                    @click="nextPage()">›</button>

                                <span
                                    style="width: 1px; height: 16px; background: rgb(209,213,219); margin: 0 0.25rem;"></span>

                                <button type="button" class="rsig-tb-btn" @click="zoomOut()"
                                    :disabled="zoomScale <= 0.5">−</button>
                                <span class="rsig-tb-label" x-text="Math.round(zoomScale * 100) + '%'">100%</span>
                                <button type="button" class="rsig-tb-btn" @click="zoomIn()"
                                    :disabled="zoomScale >= 3.0">+</button>
                            </div>
                            <div class="rsig-toolbar-group">
                                <button type="button" class="rsig-sign-btn" :disabled="loading"
                                    @click="generateSignature()">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tanda Tangan
                                </button>

                                {{-- <button type="button" class="rsig-save-btn" :disabled="!anyQrReady || saving" @click="saveSignedToServer()">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    <span x-text="saving ? 'Menyimpan...' : 'Simpan Tanda Tangan'">Simpan Tanda Tangan</span>
                                </button> --}}
                            </div>
                        </div>

                        {{-- Canvas area --}}
                        <div class="rsig-canvas-area">
                            {{-- Loading --}}
                            <div class="rsig-loading" x-show="loading">
                                <div class="rsig-spinner"></div>
                                <span style="font-size: .8125rem; color: rgb(107,114,128);">Memuat dokumen...</span>
                            </div>

                            {{-- Canvas wrapper --}}
                            <div class="rsig-canvas-wrapper" x-ref="canvasWrapper" x-show="!loading">
                                <canvas x-ref="pdfCanvas"></canvas>

                                {{-- Draggable QR stamp --}}
                                <div class="rsig-qr-stamp" x-show="qrReady" :class="{ 'is-dragging': isDragging }"
                                    :style="`left:${qrX}px;top:${qrY}px;width:${qrDisplaySize}px;height:${qrDisplaySize}px;`"
                                    @mousedown.prevent="startDrag($event)" @touchstart.prevent="startDragTouch($event)">
                                    <img :src="qrDataUrl" draggable="false"
                                        style="width:100%;height:100%;display:block;border-radius:4px;">
                                    <div class="rsig-qr-drag-hint">⠿ Seret ke posisi</div>

                                    {{-- Resize Handle --}}
                                    <div class="rsig-qr-resize-handle" @mousedown.prevent.stop="startResize($event)"
                                        @touchstart.prevent.stop="startResizeTouch($event)"></div>

                                    {{-- Close / Remove Button --}}
                                    <button type="button" class="rsig-qr-remove-btn" @mousedown.prevent.stop
                                        @touchstart.prevent.stop @click.prevent.stop="removePageQr()">✕</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ══ RIGHT: Review Form ════════════════════════════════ --}}
                <div class="review-sig-right">
                    {{ $this->form }}

                    <div class="review-form-actions">
                        <x-filament::button tag="a" href="{{ static::getResource()::getUrl('index') }}"
                            color="gray">
                            Cancel
                        </x-filament::button>
                        <x-filament::button type="submit" color="primary" ::disabled="saving">
                            <span x-show="!saving">Submit Review</span>
                            <span x-show="saving">Saving Signature...</span>
                        </x-filament::button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function reviewSignApp() {
            let _pdfDoc = null;

            return {
                fileName: @js($this->record->file_name ?? 'Document'),
                pdfUrl: @js($this->pdfUrl),
                pageNum: 1,
                pageCount: 0,
                loading: true,
                saving: false,
                error: '',

                /* QR placement per page */
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
                userName: @js(auth()->user()->name ?? ''),
                userId: @js(auth()->user()->id ?? ''),
                userNPK: @js(auth()->user()->nik ?? ''),
                userEmail: @js(auth()->user()->email ?? ''),

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

                async loadDocumentPdf() {
                    if (!window.pdfjsLib || !this.pdfUrl) return;
                    this.loading = true;
                    try {
                        const resp = await fetch(this.pdfUrl);
                        const buf = await resp.arrayBuffer();

                        // Compute hash
                        const hashBuf = await crypto.subtle.digest('SHA-256', buf);
                        this.fileHash = Array.from(new Uint8Array(hashBuf)).map(b => b.toString(16).padStart(2, '0'))
                            .join('');

                        _pdfDoc = await pdfjsLib.getDocument({
                            data: new Uint8Array(buf),
                            cMapUrl: 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.16.105/cmaps/',
                            cMapPacked: true
                        }).promise;
                        this.pageCount = _pdfDoc.numPages;
                        this.pageNum = 1;
                        await this.renderPage(1);
                        this.loadPageQrState();
                    } catch (err) {
                        this.error = 'Gagal memuat dokumen: ' + err.message;
                    } finally {
                        this.loading = false;
                    }
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

                    const displayScale = Math.min((wrapper.clientWidth || 640) / vp0.width, 4) * this.zoomScale;
                    const dpr = 3;
                    const scale = displayScale * dpr;
                    const vp = page.getViewport({
                        scale
                    });
                    canvas.width = vp.width;
                    canvas.height = vp.height;
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
                        const refW = config.refW || displayW;
                        const refH = config.refH || displayH;
                        this.qrX = (config.x / refW) * displayW;
                        this.qrY = (config.y / refH) * displayH;
                        this.qrDisplaySize = (config.size / refW) * displayW;
                        this.timestamp = config.timestamp;
                    } else if (config) {
                        this.qrReady = true;
                        this.qrDataUrl = config.dataUrl;
                        this.qrX = config.x;
                        this.qrY = config.y;
                        this.qrDisplaySize = config.size;
                        this.timestamp = config.timestamp;
                    } else {
                        this.qrReady = false;
                        this.qrDataUrl = '';
                        this.qrX = 20;
                        this.qrY = 20;
                        this.qrDisplaySize = 120;
                        this.timestamp = '';
                    }
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
                    if (this.loading) return;
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
                        Id: this.userId,
                        NPK: this.userNPK,
                        Signer: this.userName,
                        Email: this.userEmail,
                        Hash: this.fileHash.slice(0, 32),
                        timestamp: this.timestamp,
                    });
                    const target = document.getElementById('rsig-qr-rt');
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
                    const dataUrl = qrCanvas ? qrCanvas.toDataURL('image/png') : '';
                    const canvas = this.$refs.pdfCanvas;

                    this.pageQrs[this.pageNum] = {
                        dataUrl: dataUrl,
                        x: Math.max(0, canvas.clientWidth - 120 - 16),
                        y: 16,
                        size: 120,
                        timestamp: this.timestamp,
                        refW: canvas.clientWidth,
                        refH: canvas.clientHeight,
                    };

                    this.loadPageQrState();
                },

                /* ── Drag ──────────────────────────────── */
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
                    this.qrX = Math.max(0, Math.min(cx - r.left - this.dragOffsetX + w.scrollLeft, canvas.clientWidth - this
                        .qrDisplaySize));
                    this.qrY = Math.max(0, Math.min(cy - r.top - this.dragOffsetY + w.scrollTop, canvas.clientHeight - this
                        .qrDisplaySize));

                    if (this.pageQrs[this.pageNum]) {
                        this.pageQrs[this.pageNum].x = this.qrX;
                        this.pageQrs[this.pageNum].y = this.qrY;
                    }
                },
                _doResize(cx, cy) {
                    const deltaX = cx - this.resizeStartX;
                    const deltaY = cy - this.resizeStartY;
                    const delta = Math.max(deltaX, deltaY);
                    const newSize = Math.max(30, Math.min(300, this.resizeStartSize + delta));
                    const canvas = this.$refs.pdfCanvas;
                    if (canvas) {
                        const maxW = canvas.clientWidth - this.qrX;
                        const maxH = canvas.clientHeight - this.qrY;
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

                /* ── Save signed PDF to server ─────────── */
                async saveSignedToServer() {
                    if (!this.anyQrReady || !_pdfDoc || !window.jspdf) return;
                    this.saving = true;
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
                                const qrXPct = config.x / config.refW;
                                const qrYPct = config.y / config.refH;
                                const qrSizePctW = config.size / config.refW;

                                const qrImg = await new Promise((resolve, reject) => {
                                    const img = new Image();
                                    img.onload = () => resolve(img);
                                    img.onerror = () => reject(new Error('Gagal memuat QR halaman ' + i));
                                    img.src = config.dataUrl;
                                });

                                const qrCx = qrXPct * tempCanvas.width;
                                const qrCy = qrYPct * tempCanvas.height;
                                const qrSz = qrSizePctW * tempCanvas.width;
                                ctx.drawImage(qrImg, qrCx, qrCy, qrSz, qrSz);
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
                            // Get PDF as base64
                            const pdfBase64 = pdfDocInstance.output('datauristring').split(',')[1];

                            // Get first QR data URL as base64 (for saving the QR image)
                            const firstQrConfig = Object.values(this.pageQrs)[0];
                            const qrBase64 = firstQrConfig ? firstQrConfig.dataUrl.split(',')[1] : '';

                            // Compute a signature hash from timestamp + user + file hash
                            const hashInput = this.userId + '_' + this.fileHash + '_' + this.timestamp;
                            const encoder = new TextEncoder();
                            const hashBuf = await crypto.subtle.digest('SHA-256', encoder.encode(hashInput));
                            const signatureHash = Array.from(new Uint8Array(hashBuf)).map(b => b.toString(16).padStart(
                                2, '0')).join('');

                            // Send to Livewire
                            await @this.call('saveSignature', {
                                pdf: pdfBase64,
                                qr: qrBase64,
                                hash: signatureHash
                            });
                            return true;
                        }
                    } catch (err) {
                        this.error = 'Gagal menyimpan: ' + err.message;
                        throw err;
                    } finally {
                        this.saving = false;
                    }
                    return false;
                },

                async handleFormSubmit() {
                    if (this.anyQrReady) {
                        try {
                            const success = await this.saveSignedToServer();
                            if (!success) {
                                return;
                            }
                        } catch (err) {
                            return;
                        }
                    }
                    await this.$wire.submitReview();
                }
            };
        }
    </script>

</x-filament-panels::page>
