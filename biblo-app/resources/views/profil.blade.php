<x-app-layout title="My Profile" active="profile">
    {{-- Menambahkan padding horizontal (px-4) agar responsif di mobile --}}
    <div class="max-w-3xl mx-auto space-y-8 md:space-y-12 pb-20 px-2 sm:px-4 md:px-0">

        <section
            class="relative bg-white border border-biblo-greige/20 rounded-[30px] sm:rounded-[44px] md:rounded-[60px] p-5 sm:p-8 md:p-12 shadow-sm overflow-hidden mt-4 sm:mt-6">
            {{-- Decorative Accent --}}
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-biblo-sage/10 rounded-full blur-3xl opacity-60"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 sm:gap-10">

                <div class="relative group">
                    <div
                        class="w-28 h-28 sm:w-36 sm:h-36 md:w-44 md:h-44 rounded-[30px] sm:rounded-[45px] overflow-hidden border-4 border-biblo-oat shadow-inner bg-biblo-oat/50 flex items-center justify-center transition-transform duration-500 group-hover:scale-[1.02]">
                        <img src="https://ui-avatars.com/api/?name=Selena+Hans&background=E8E4D9&color=4A4A4A&size=256"
                            alt="Selena Hans" class="w-full h-full object-cover">
                    </div>

                    {{-- Badge Edit Foto: Dibuat lebih kontras dan jelas --}}
                    <button
                        class="absolute -bottom-1 -right-1 bg-biblo-clay text-white w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-[18px] sm:rounded-[22px] shadow-[0_8px_20px_-4px_rgba(196,114,101,0.4)] border-[3px] border-white hover:bg-biblo-charcoal hover:scale-110 transition-all duration-300 z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="drop-shadow-sm">
                            <path
                                d="M14.5 2H9.5L7 4.5H4a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-11a2 2 0 0 0-2-2h-3l-2.5-2.5Z" />
                            <circle cx="12" cy="13" r="3" />
                        </svg>
                    </button>
                </div>

                <div class="text-center md:text-left space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-biblo-moss mb-2">Member Profile</p>
                    <h1 class="text-3xl sm:text-5xl font-extrabold text-biblo-charcoal tracking-tighter leading-none">
                        Selena <span class="text-biblo-clay">Hans</span>
                    </h1>
                    <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 pt-4">
                        <p class="text-biblo-charcoal/60 font-bold text-sm tracking-widest uppercase">@selena.h</p>
                        <span class="hidden md:block w-1.5 h-1.5 bg-biblo-greige/30 rounded-full"></span>
                        <div class="flex items-center justify-center md:justify-start gap-2 text-biblo-charcoal/40">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <span class="text-[11px] font-black uppercase tracking-widest">Since March 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="border-biblo-greige/20 mx-4">

        {{-- SECTION 1: READING STATS DENGAN WADAH DAN CORNER ROUNDED --}}
        <section
            class="p-5 sm:p-8 md:p-10 border border-biblo-greige/20 rounded-[28px] sm:rounded-[40px] shadow-sm bg-white overflow-hidden group hover:shadow-2xl hover:shadow-biblo-sage/5 transition-all">
            <div class="flex flex-wrap justify-between items-end gap-2 mb-8 sm:mb-10 px-0 sm:px-4">
                <h3 class="text-xl font-extrabold text-biblo-charcoal uppercase tracking-tighter">Reading Stats</h3>
                <span
                    class="text-[11px] font-black text-biblo-moss uppercase tracking-[0.2em] group-hover:text-biblo-clay">This
                    Month</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 px-0 sm:px-4 md:px-0">
                @php
                    $stats = [
                        ['label' => 'Books Read', 'val' => '12', 'icon' => '📚'],
                        ['label' => 'Pages Today', 'val' => '42', 'icon' => '📄'],
                        ['label' => 'Daily Streak', 'val' => '5d', 'icon' => '🔥'],
                        ['label' => 'Hours Spent', 'val' => '18.5', 'icon' => '⏱️'],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div
                        class="bg-biblo-oat border border-biblo-greige/10 p-4 sm:p-6 rounded-2xl sm:rounded-3xl text-center group-hover:scale-105 transition-transform duration-500 hover:shadow-md">
                        <p class="text-[28px] mb-3 group-hover:scale-125 transition-transform">{{ $stat['icon'] }}</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-biblo-charcoal leading-none tracking-tighter">
                            {{ $stat['val'] }}</p>
                        <p class="text-[9px] font-black text-biblo-charcoal/40 uppercase tracking-[0.2em] mt-3">
                            {{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>


        <section class="space-y-6 pb-20">
            <h3 class="text-[10px] font-black text-biblo-moss/60 px-4 uppercase tracking-[0.2em] leading-none mb-1">
                Account Settings</h3>

            <div class="bg-white border border-biblo-greige/20 rounded-[28px] sm:rounded-[45px] p-2 overflow-hidden space-y-1">
                @php
                    $settings = [
                        ['label' => 'Edit Profile', 'icon' => 'user-3', 'color' => 'text-biblo-charcoal'],
                        ['label' => 'Change Password', 'icon' => 'lock', 'color' => 'text-biblo-charcoal'],
                        ['label' => 'Reading Goal Settings', 'icon' => 'target', 'color' => 'text-biblo-charcoal'],
                        ['label' => 'Logout', 'icon' => 'log-out', 'color' => 'text-red-500'],
                    ];
                @endphp

                @foreach($settings as $setting)
                    <a href="#"
                        class="flex items-center justify-between p-4 sm:p-6 hover:bg-biblo-oat/40 rounded-[20px] sm:rounded-[30px] transition-all group">
                        <div class="flex items-center gap-5">
                            {{-- Ikon SVG Modern --}}
                            <div
                                class="w-10 h-10 bg-biblo-greige/10 rounded-2xl flex items-center justify-center {{ $setting['color'] }} group-hover:scale-105 transition-transform">
                                @if($setting['icon'] == 'user-3') <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                @elseif($setting['icon'] == 'lock') <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="11" rx="2" ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                @elseif($setting['icon'] == 'target') <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <circle cx="12" cy="12" r="6" />
                                        <circle cx="12" cy="12" r="2" />
                                    </svg>
                                @elseif($setting['icon'] == 'log-out') <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" x2="9" y1="12" y2="12" />
                                    </svg>
                                @endif
                            </div>
                            <span
                                class="text-sm font-bold {{ $setting['color'] }} tracking-tight">{{ $setting['label'] }}</span>
                        </div>
                        {{-- Panah Modern yang Halus --}}
                        <svg class="w-4 h-4 text-biblo-greige/30 group-hover:text-biblo-charcoal group-hover:translate-x-1.5 transition-all duration-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </section>

    </div>
</x-app-layout>