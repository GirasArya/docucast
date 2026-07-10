<x-filament-panels::page>
    <style>
        /* ── Layout & Cards ─────────────────────────── */
        .draw-sig-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 1024px) {
            .draw-sig-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .draw-card {
            border-radius: 1rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .03);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .dark .draw-card {
            border-color: rgba(255, 255, 255, .08);
            background-color: var(--gray-900);
            box-shadow: none;
        }

        .draw-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem;
            border-bottom: 1px solid rgb(229, 231, 235);
            background-color: rgba(249, 250, 251, .8);
        }

        .dark .draw-card-header {
            border-bottom-color: rgba(255, 255, 255, .08);
            background-color: rgba(24, 24, 27, .5);
        }

        .draw-header-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
            color: var(--primary-600);
            flex-shrink: 0;
        }

        .dark .draw-header-icon {
            background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
            color: var(--primary-400);
        }

        .draw-header-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
        }

        .dark .draw-header-title {
            color: rgb(243, 244, 246);
        }

        .draw-card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            flex: 1;
        }

        /* ── Canvas Panel ───────────────────────────── */
        .canvas-container {
            position: relative;
            width: 100%;
            height: 280px;
            background-color: #fff;
            border-radius: 0.75rem;
            border: 2px dashed rgb(209, 213, 219);
            overflow: hidden;
            touch-action: none;
        }

        .dark .canvas-container {
            background-color: #fff;
            border-color: rgba(255, 255, 255, .3);
        }

        .draw-canvas {
            display: block;
            width: 100%;
            height: 100%;
            cursor: crosshair;
        }

        /* ── Canvas Toolbar ─────────────────────────── */
        .canvas-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .tool-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .color-dot {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            border: 2px solid transparent;
            cursor: pointer;
            transition: transform 0.15s, border-color 0.15s;
        }

        .color-dot:hover {
            transform: scale(1.1);
        }

        .color-dot.active {
            border-color: var(--primary-600);
            transform: scale(1.1);
        }

        .dark .color-dot.active {
            border-color: var(--primary-400);
        }

        /* ── Buttons ────────────────────────────────── */
        .draw-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: background-color .15s, border-color .15s, opacity .15s;
            line-height: 1.25;
        }

        .draw-btn:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        .draw-btn-primary {
            background-color: var(--primary-600);
            color: #fff;
        }

        .draw-btn-primary:hover:not(:disabled) {
            background-color: var(--primary-500);
        }

        .draw-btn-outline {
            background-color: #fff;
            border-color: rgb(209, 213, 219);
            color: rgb(55, 65, 81);
        }

        .draw-btn-outline:hover:not(:disabled) {
            background-color: rgb(249, 250, 251);
        }

        .dark .draw-btn-outline {
            background-color: var(--gray-800);
            border-color: rgba(255, 255, 255, .1);
            color: rgb(209, 213, 219);
        }

        .dark .draw-btn-outline:hover:not(:disabled) {
            background-color: var(--gray-700);
        }

        .draw-btn-danger-outline {
            background-color: transparent;
            border-color: rgb(254, 202, 202);
            color: rgb(220, 38, 38);
        }

        .draw-btn-danger-outline:hover:not(:disabled) {
            background-color: rgb(254, 242, 242);
        }

        .dark .draw-btn-danger-outline {
            border-color: rgba(220, 38, 38, .3);
            color: rgb(248, 113, 113);
        }

        .dark .draw-btn-danger-outline:hover:not(:disabled) {
            background-color: rgba(220, 38, 38, .1);
        }

        /* ── File Drop Zone ────────────────────────── */
        .upload-dropzone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            height: 280px;
            border: 2px dashed rgb(209, 213, 219);
            border-radius: 0.75rem;
            background-color: rgba(249, 250, 251, .5);
            cursor: pointer;
            text-align: center;
            padding: 1.5rem;
            transition: border-color .2s, background-color .2s;
        }

        .upload-dropzone:hover,
        .upload-dropzone.active {
            border-color: var(--primary-500);
            background-color: color-mix(in srgb, var(--primary-500) 4%, transparent);
        }

        .dark .upload-dropzone {
            border-color: rgba(255, 255, 255, .15);
            background-color: rgba(255, 255, 255, .02);
        }

        .dark .upload-dropzone:hover,
        .dark .upload-dropzone.active {
            border-color: var(--primary-400);
            background-color: color-mix(in srgb, var(--primary-400) 6%, transparent);
        }

        .upload-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-color: color-mix(in srgb, var(--primary-500) 10%, transparent);
            color: var(--primary-600);
        }

        .dark .upload-icon {
            background-color: color-mix(in srgb, var(--primary-400) 12%, transparent);
            color: var(--primary-400);
        }

        /* ── Transparency Checkerboard ──────────────── */
        .checkerboard-bg {
            background-color: #f8fafc;
            background-image: linear-gradient(45deg, #e2e8f0 25%, transparent 25%),
                linear-gradient(-45deg, #e2e8f0 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #e2e8f0 75%),
                linear-gradient(-45deg, transparent 75%, #e2e8f0 75%);
            background-size: 16px 16px;
            background-position: 0 0, 0 8px, 8px -8px, -8px 0px;
        }



        .preview-container {
            position: relative;
            width: 100%;
            height: 280px;
            border-radius: 0.75rem;
            border: 1px solid rgb(229, 231, 235);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .dark .preview-container {
            border-color: rgba(255, 255, 255, .08);
        }

        .upload-preview-img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .preview-remove-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 1.75rem;
            height: 1.75rem;
            background-color: rgb(239, 68, 68);
            border: 2px solid #fff;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.15s;
        }

        .preview-remove-btn:hover {
            transform: scale(1.1);
        }

        /* ── Saved Grid Section ─────────────────────── */
        .saved-section {
            margin-top: 1.5rem;
        }

        .saved-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }

        @media (min-width: 640px) {
            .saved-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .saved-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .saved-card {
            border-radius: 0.75rem;
            border: 1px solid rgb(229, 231, 235);
            background-color: #fff;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .dark .saved-card {
            border-color: rgba(255, 255, 255, .08);
            background-color: var(--gray-900);
        }

        .saved-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .05);
        }

        .saved-preview-wrapper {
            height: 120px;
            width: 100%;
            border-bottom: 1px solid rgb(229, 231, 235);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .dark .saved-preview-wrapper {
            border-bottom-color: rgba(255, 255, 255, .08);
        }

        .saved-preview-img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        .saved-meta {
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .saved-filename {
            font-size: 0.75rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .saved-filename {
            color: rgb(243, 244, 246);
        }

        .saved-date {
            font-size: 0.65rem;
            color: rgb(107, 114, 128);
        }

        .dark .saved-date {
            color: rgb(156, 163, 175);
        }

        .saved-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: auto;
            border-top: 1px solid rgb(243, 244, 246);
            padding-top: 0.5rem;
        }

        .dark .saved-actions {
            border-top-color: rgba(255, 255, 255, .05);
        }

        .saved-act-btn {
            font-size: 0.7rem;
            padding: 0.375rem 0.625rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .saved-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: rgb(17, 24, 39);
        }

        .dark .saved-title {
            color: rgb(243, 244, 246);
        }

        .saved-subtitle {
            font-size: 0.725rem;
            color: rgb(107, 114, 128);
            margin-top: 2px;
        }

        .dark .saved-subtitle {
            color: rgb(156, 163, 175);
        }

        .badge-png {
            display: inline-flex;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            background-color: rgba(229, 231, 235, 0.4);
            color: rgb(75, 85, 99);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }

        .dark .badge-png {
            background-color: rgba(255, 255, 255, 0.08);
            color: rgb(209, 213, 219);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .upload-text-title {
            font-size: 0.8125rem;
            font-weight: 600;
            color: rgb(17, 24, 39);
            display: block;
        }

        .dark .upload-text-title {
            color: rgb(243, 244, 246);
        }

        .upload-text-sub {
            font-size: 0.7rem;
            color: rgb(107, 114, 128);
            display: block;
            margin-top: 2px;
        }

        .dark .upload-text-sub {
            color: rgb(156, 163, 175);
        }

        .empty-state {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            text-align: center;
            border: 1px dashed rgb(209, 213, 219);
            border-radius: 0.75rem;
            background-color: rgba(249, 250, 251, .5);
        }

        .dark .empty-state {
            border-color: rgba(255, 255, 255, 0.15);
            background-color: rgba(255, 255, 255, 0.02);
        }

        .empty-icon {
            color: rgb(156, 163, 175);
        }

        .dark .empty-icon {
            color: rgb(107, 114, 128);
        }

        .empty-title {
            font-size: 0.8125rem;
            font-weight: 600;
            color: rgb(107, 114, 128);
            margin-top: 0.5rem;
        }

        .dark .empty-title {
            color: rgb(209, 213, 219);
        }
    </style>

    <div x-data="drawSigPage()" x-init="initApp()" class="draw-sig-layout">

        <div class="draw-sig-grid">

            {{-- ══ LEFT COLUMN: Draw Canvas ═══════════════════════════ --}}
            <div class="draw-card">
                <div class="draw-card-header">
                    <div class="draw-header-icon">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <span class="draw-header-title">Gambar Tanda Tangan</span>
                </div>
                <div class="draw-card-body">

                    {{-- Drawing Bounding Box --}}
                    <div class="canvas-container" x-ref="canvasContainer">
                        <canvas x-ref="sigCanvas" class="draw-canvas" @mousedown="startDrawing($event)"
                            @mousemove="draw($event)" @mouseup="stopDrawing()" @mouseleave="stopDrawing()"
                            @touchstart="startDrawingTouch($event)" @touchmove="drawTouch($event)"
                            @touchend="stopDrawing()">
                        </canvas>
                    </div>

                    {{-- Tool bar --}}
                    <div class="canvas-toolbar">
                        {{-- Stroke Colors --}}
                        <div class="tool-group">
                            <span
                                style="font-size: 0.725rem; font-weight: 500; color: rgb(107, 114, 128); margin-right: 0.25rem;">Warna:</span>
                            <div class="color-dot active" style="background-color: #000000;"
                                :class="{ 'active': activeColor === '#000000' }" @click="setColor('#000000')"></div>
                            {{-- <div class="color-dot" style="background-color: #2563eb;" :class="{ 'active': activeColor === '#2563eb' }" @click="setColor('#2563eb')"></div> --}}
                            {{-- <div class="color-dot" style="background-color: #dc2626;" :class="{ 'active': activeColor === '#dc2626' }" @click="setColor('#dc2626')"></div> --}}
                        </div>

                        {{-- Action Buttons --}}
                        <div class="tool-group">
                            <button type="button" class="draw-btn draw-btn-outline" :disabled="history.length === 0"
                                @click="undo()" title="Undo">
                                ↺ Batal
                            </button>
                            <button type="button" class="draw-btn draw-btn-danger-outline" :disabled="!hasDrawing"
                                @click="clearCanvas()">
                                Bersihkan
                            </button>
                        </div>
                    </div>

                    <div style="display: flex; gap: 0.5rem; margin-top: auto;">
                        <button type="button" class="draw-btn draw-btn-outline" style="flex: 1;"
                            :disabled="!hasDrawing" @click="downloadDrawn()">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh PNG
                        </button>
                        <button type="button" class="draw-btn draw-btn-primary" style="flex: 1.2;"
                            :disabled="!hasDrawing || saving" @click="saveDrawn()">
                            <span x-show="!saving">Simpan ke Sistem</span>
                            <span x-show="saving" class="draw-spinner"></span>
                        </button>
                    </div>

                </div>
            </div>

            {{-- ══ RIGHT COLUMN: Upload Signature ════════════════════ --}}
            <div class="draw-card">
                <div class="draw-card-header">
                    <div class="draw-header-icon">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <span class="draw-header-title">Unggah Tanda Tangan</span>
                </div>
                <div class="draw-card-body">

                    {{-- Drop zone when empty --}}
                    <label class="upload-dropzone" x-show="!uploadedImage"
                        @dragenter.prevent="$el.classList.add('active')"
                        @dragleave.prevent="$el.classList.remove('active')" @dragover.prevent
                        @drop.prevent="$el.classList.remove('active'); handleFileSelect($event.dataTransfer.files[0])">
                        <input type="file" accept="image/png" @change="handleFileSelect($event.target.files[0])"
                            style="display:none">
                        <div class="upload-icon">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="upload-text-title">
                                Tarik & lepas gambar tanda tangan
                            </span>
                            <span class="upload-text-sub">
                                atau klik untuk memilih dari penyimpanan lokal
                            </span>
                        </div>
                        <span class="badge-png">
                            filetype/png
                        </span>
                    </label>

                    {{-- Image Preview with Checkboard Pattern --}}
                    <div class="preview-container checkerboard-bg" x-show="uploadedImage">
                        <img :src="uploadedImage" class="upload-preview-img">
                        <div class="preview-remove-btn" @click="clearUploaded()">✕</div>
                    </div>

                    <div style="display: flex; gap: 0.5rem; margin-top: auto;">
                        <button type="button" class="draw-btn draw-btn-outline" style="flex: 1;"
                            :disabled="!uploadedImage" @click="clearUploaded()">
                            Batal
                        </button>
                        <button type="button" class="draw-btn draw-btn-primary" style="flex: 1.2;"
                            :disabled="!uploadedImage || saving" @click="saveUploaded()">
                            <span x-show="!saving">Simpan ke Sistem</span>
                            <span x-show="saving" class="draw-spinner"></span>
                        </button>
                    </div>

                </div>
            </div>

        </div>

        {{-- ══ BOTTOM: Saved Signatures Gallery ═════════════════ --}}
        <div class="saved-section">
            <h3 class="saved-title">
                Daftar Tanda Tangan Tersimpan
            </h3>
            {{-- <p class="saved-subtitle">
                Semua tanda tangan yang tersimpan dapat Anda gunakan untuk menandatangani dokumen internal.
            </p> --}}

            <div class="saved-grid">
                @forelse($this->signatures as $signature)
                    <div class="saved-card">
                        <div class="saved-preview-wrapper checkerboard-bg">
                            <img src="{{ Storage::disk('public')->url($signature->file_path) }}"
                                class="saved-preview-img" alt="Tanda Tangan">
                        </div>
                        <div class="saved-meta">
                            <span class="saved-filename"
                                title="{{ $signature->file_name }}">{{ $signature->file_name }}</span>
                            <span class="draw-btn draw-btn-outline" style="display:none;"
                                id="raw-link-{{ $signature->id }}">{{ Storage::disk('public')->url($signature->file_path) }}</span>
                            <span class="saved-date">Dibuat pada:
                                {{ $signature->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                WIB</span>

                            <div class="saved-actions">
                                <a href="{{ Storage::disk('public')->url($signature->file_path) }}"
                                    download="{{ $signature->file_name }}"
                                    class="saved-act-btn draw-btn-outline draw-btn"
                                    style="flex: 1; padding: 0.35rem 0.5rem; justify-content: center; height: auto;">
                                    Unduh
                                </a>
                                <button type="button" wire:click="deleteSignature({{ $signature->id }})"
                                    wire:loading.attr="disabled"
                                    class="saved-act-btn draw-btn-danger-outline draw-btn"
                                    style="flex: 1; padding: 0.35rem 0.5rem; justify-content: center; height: auto;">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5" class="empty-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span class="empty-title">
                            Belum ada tanda tangan tersimpan
                        </span>
                        <span style="font-size: 0.7rem; color: rgb(156, 163, 175); margin-top: 2px;">
                            Gambar atau unggah tanda tangan di atas untuk menyimpannya di sini.
                        </span>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <script>
        function drawSigPage() {
            return {
                canvas: null,
                ctx: null,
                isDrawing: false,
                hasDrawing: false,
                activeColor: '#000000',
                lineWidth: 3,
                history: [],
                saving: false,
                uploadedImage: '',
                uploadedFileName: '',

                initApp() {
                    this.$nextTick(() => {
                        this.initCanvas();
                    });

                    // React to Livewire component triggers
                    window.addEventListener('signature-saved', () => {
                        this.clearCanvas();
                        this.clearUploaded();
                    });
                },

                initCanvas() {
                    const el = this.$refs.sigCanvas;
                    const container = this.$refs.canvasContainer;
                    if (!el || !container) return;

                    this.canvas = el;
                    this.canvas.width = container.clientWidth;
                    this.canvas.height = container.clientHeight;

                    this.ctx = this.canvas.getContext('2d');
                    this.ctx.strokeStyle = this.activeColor;
                    this.ctx.lineWidth = this.lineWidth;
                    this.ctx.lineCap = 'round';
                    this.ctx.lineJoin = 'round';

                    // Pre-fill transparent background
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

                    // Add dynamic resize check
                    window.addEventListener('resize', () => {
                        // Store current canvas drawing before resize clears it
                        const tempImg = new Image();
                        tempImg.onload = () => {
                            this.canvas.width = container.clientWidth;
                            this.canvas.height = container.clientHeight;
                            this.ctx.strokeStyle = this.activeColor;
                            this.ctx.lineWidth = this.lineWidth;
                            this.ctx.lineCap = 'round';
                            this.ctx.lineJoin = 'round';
                            this.ctx.drawImage(tempImg, 0, 0, this.canvas.width, this.canvas.height);
                        };
                        tempImg.src = this.canvas.toDataURL();
                    });
                },

                setColor(color) {
                    this.activeColor = color;
                    if (this.ctx) {
                        this.ctx.strokeStyle = color;
                    }
                },

                // Canvas coordinates normalization
                getCoordinates(e) {
                    const rect = this.canvas.getBoundingClientRect();
                    const clientX = e.clientX || (e.touches && e.touches[0].clientX);
                    const clientY = e.clientY || (e.touches && e.touches[0].clientY);
                    return {
                        x: clientX - rect.left,
                        y: clientY - rect.top
                    };
                },

                startDrawing(e) {
                    this.isDrawing = true;
                    const coords = this.getCoordinates(e);

                    // Save canvas state to history before drawing new line
                    const imgData = this.ctx.getImageData(0, 0, this.canvas.width, this.canvas.height);
                    this.history.push(imgData);
                    if (this.history.length > 25) {
                        this.history.shift(); // limit history size to 25 items
                    }

                    this.ctx.beginPath();
                    this.ctx.moveTo(coords.x, coords.y);
                },

                draw(e) {
                    if (!this.isDrawing) return;
                    const coords = this.getCoordinates(e);
                    this.ctx.lineTo(coords.x, coords.y);
                    this.ctx.stroke();
                    this.hasDrawing = true;
                },

                startDrawingTouch(e) {
                    e.preventDefault();
                    this.startDrawing(e);
                },

                drawTouch(e) {
                    e.preventDefault();
                    this.draw(e);
                },

                stopDrawing() {
                    if (this.isDrawing) {
                        this.ctx.closePath();
                        this.isDrawing = false;
                    }
                },

                undo() {
                    if (this.history.length > 0) {
                        const previousState = this.history.pop();
                        this.ctx.putImageData(previousState, 0, 0);

                        // Check if canvas is completely blank now
                        const buffer = new Uint32Array(this.ctx.getImageData(0, 0, this.canvas.width, this.canvas.height)
                            .data.buffer);
                        this.hasDrawing = buffer.some(color => color !== 0);
                    }
                },

                clearCanvas() {
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                    this.history = [];
                    this.hasDrawing = false;
                },

                // Download locally as PNG
                downloadDrawn() {
                    if (!this.hasDrawing) return;
                    const dataUrl = this.canvas.toDataURL('image/png');
                    const link = document.createElement('a');
                    link.download = 'tanda_tangan.png';
                    link.href = dataUrl;
                    link.click();
                },

                // Save to system storage via Livewire call
                async saveDrawn() {
                    if (!this.hasDrawing || this.saving) return;
                    this.saving = true;
                    try {
                        const dataUrl = this.canvas.toDataURL('image/png');
                        await this.$wire.saveSignature(dataUrl, 'signature_canvas.png');
                    } catch (err) {
                        console.error('Error saving signature:', err);
                    } finally {
                        this.saving = false;
                    }
                },

                // File Upload Select handler
                handleFileSelect(file) {
                    if (!file) return;
                    if (file.type !== 'image/png') {
                        // Display notification inside Filament
                        new FilamentNotification()
                            .title('Hanya format file PNG yang didukung.')
                            .danger()
                            .send();
                        return;
                    }

                    this.uploadedFileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.uploadedImage = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                clearUploaded() {
                    this.uploadedImage = '';
                    this.uploadedFileName = '';
                },

                // Save uploaded signature to database
                async saveUploaded() {
                    if (!this.uploadedImage || this.saving) return;
                    this.saving = true;
                    try {
                        await this.$wire.saveSignature(this.uploadedImage, this.uploadedFileName);
                    } catch (err) {
                        console.error('Error saving uploaded signature:', err);
                    } finally {
                        this.saving = false;
                    }
                }
            };
        }
    </script>
</x-filament-panels::page>
