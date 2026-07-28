<div>
    @if ($showModal)
        {{-- Backdrop --}}
        <div x-data="{ open: true }" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="
                position: fixed;
                inset: 0;
                z-index: 99999;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                background-color: rgba(15, 23, 42, 0.65);
                backdrop-filter: blur(8px);
            ">
            {{-- Modal Card --}}
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                style="
                    position: relative;
                    width: 100%;
                    max-width: 540px;
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
                    background: #ffffff;
                    border: 1px solid rgba(226, 232, 240, 0.8);
                "
                class="dark:!bg-slate-900 dark:!border-slate-800">

                {{-- Banner Header Gradient based on Type --}}
                @php
                    $bannerGradient = match ($type) {
                        'warning' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                        'success' => 'linear-gradient(135deg, #10b981, #059669)',
                        'info' => 'linear-gradient(135deg, #64748b, #475569)',
                        default => 'linear-gradient(135deg, #3b82f6, #6366f1)', // update
                    };
                    $badgeText = match ($type) {
                        'warning' => 'Penting / Maintenance',
                        'success' => 'Fitur Baru',
                        'info' => 'Pengumuman',
                        default => 'Pembaruan Sistem',
                    };
                @endphp

                <div
                    style="
                    padding: 1.5rem 1.75rem;
                    background: {{ $bannerGradient }};
                    color: white;
                    position: relative;
                ">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.75rem;">
                        <span
                            style="
                            font-size: 0.75rem;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 0.05em;
                            padding: 0.25rem 0.75rem;
                            border-radius: 9999px;
                            background: rgba(255, 255, 255, 0.2);
                            backdrop-filter: blur(4px);
                        ">
                            📢 {{ $badgeText }}
                        </span>

                        @if ($createdAt)
                            <span style="font-size: 0.75rem; opacity: 0.85;">
                                {{ $createdAt }}
                            </span>
                        @endif
                    </div>

                    <h2
                        style="
                        margin: 0.875rem 0 0;
                        font-size: 1.25rem;
                        font-weight: 700;
                        line-height: 1.35;
                        color: #ffffff;
                    ">
                        {{ $title }}
                    </h2>
                </div>

                {{-- Body Content --}}
                <div style="padding: 1.5rem 1.75rem;" class="dark:text-slate-200">
                    <div class="prose dark:prose-invert max-w-none" style="font-size: 0.925rem; line-height: 1.6;">
                        {!! $content !!}
                    </div>

                    @if ($remainingCount > 0)
                        <p
                            style="
                            margin-top: 1rem;
                            font-size: 0.75rem;
                            color: #64748b;
                            font-style: italic;
                        ">
                            * Masih ada {{ $remainingCount }} pengumuman lain setelah ini.
                        </p>
                    @endif
                </div>

                {{-- Modal Footer --}}
                <div
                    style="
                    padding: 1rem 1.75rem 1.25rem;
                    border-top: 1px solid rgba(226, 232, 240, 0.6);
                    display: flex;
                    justify-content: flex-end;
                "
                    class="dark:border-slate-800">
                    <button wire:click="acknowledge({{ $announcementId }})"
                        style="
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 0.5rem;
                            padding: 0.75rem 1.5rem;
                            border-radius: 12px;
                            background: {{ $bannerGradient }};
                            color: white;
                            font-weight: 600;
                            font-size: 0.875rem;
                            border: none;
                            cursor: pointer;
                            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
                            transition: transform 0.15s ease, opacity 0.15s ease;
                        "
                        onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-1px)';"
                        onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)';">
                        ✓ Saya Mengerti
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
