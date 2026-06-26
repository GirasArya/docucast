<div x-data="{
    storageKey: 'docucast_notice_agreed_{{ auth()->id() }}',
    show: false,
    init() {
        this.show = !localStorage.getItem(this.storageKey);
    },
    agree() {
        localStorage.setItem(this.storageKey, '1');
        this.show = false;
    }
}" x-show="show" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-6 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-6 scale-95"
    style="
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 9999;
        width: 360px;
        max-width: calc(100vw - 2rem);
    ">
    <style>
        .login-notice-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.02);
            backdrop-filter: blur(12px);
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .dark .login-notice-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05) inset;
        }

        .login-notice-title {
            margin: 0 0 0.25rem;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .dark .login-notice-title {
            color: #f1f5f9;
        }

        .login-notice-body {
            margin: 0 0 1.25rem;
            font-size: 0.8125rem;
            color: #475569;
            line-height: 1.6;
            transition: color 0.3s ease;
        }

        .dark .login-notice-body {
            color: #94a3b8;
        }

        .login-notice-highlight {
            color: #0f172a;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .dark .login-notice-highlight {
            color: #cbd5e1;
        }

        .login-notice-subtitle {
            margin: 0;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }
    </style>
    <div class="login-notice-card">
        {{-- Header --}}
        <div style="display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem;">
            <div
                style="
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: linear-gradient(135deg, #3b82f6, #6366f1);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            ">
                <svg style="width: 20px; height: 20px; color: white;" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="login-notice-title">Selamat Datang di DocuCast 👋</h3>
                <p class="login-notice-subtitle">Pemberitahuan Penggunaan Sistem</p>
            </div>
        </div>

        {{-- Divider --}}
        <div
            style="
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(148,163,184,0.2), transparent);
            margin-bottom: 1rem;
        ">
        </div>

        {{-- Body --}}
        <p class="login-notice-body">
            Dengan menggunakan sistem DocuCast, Anda menyetujui
            <strong class="login-notice-highlight">kebijakan penggunaan</strong> yang berlaku.
            Seluruh aktivitas dalam sistem ini akan tercatat.
        </p>

        {{-- Action Button --}}
        <button @click="agree()" id="login-notice-agree-btn"
            style="
                width: 100%;
                padding: 0.6875rem 1rem;
                background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
                border: none;
                border-radius: 10px;
                color: white;
                font-size: 0.875rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
                letter-spacing: 0.01em;
            "
            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(99,102,241,0.5)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(99,102,241,0.35)';"
            onmousedown="this.style.transform='scale(0.98)';" onmouseup="this.style.transform='translateY(-1px)';">
            ✓ &nbsp;Saya Setuju
        </button>
    </div>
</div>
