<x-app-layout title="My Profile" active="profile">
    <div class="min-h-screen bg-gradient-to-br from-biblo-oat/30 via-transparent to-biblo-greige/10">
        <div class="max-w-3xl mx-auto space-y-6 md:space-y-8 pb-32 px-3 sm:px-4 md:px-0 pt-2">

            {{-- PROFILE HEADER SECTION --}}
            <section
                class="relative bg-white rounded-3xl sm:rounded-4xl md:rounded-5xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                {{-- Decorative Background --}}
                <div class="absolute inset-0 bg-gradient-to-br from-biblo-sage/5 to-biblo-moss/5"></div>
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-biblo-moss/8 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-biblo-sage/8 rounded-full blur-2xl"></div>

                <div class="relative z-10 p-6 sm:p-8 md:p-10">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
                        {{-- Avatar Section --}}
                        <div class="relative group flex-shrink-0">
                            <div
                                class="w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 rounded-3xl sm:rounded-4xl overflow-hidden border-4 border-biblo-oat bg-gradient-to-br from-biblo-oat/20 to-biblo-greige/20 flex items-center justify-center shadow-lg group-hover:shadow-2xl transition-all duration-500 group-hover:scale-105">
                                <img src="https://ui-avatars.com/api/?name=Selena+Hans&background=E8E4D9&color=4A4A4A&size=256"
                                    alt="Selena Hans" class="w-full h-full object-cover">
                            </div>

                            {{-- Edit Photo Badge --}}
                            <button
                                class="absolute -bottom-2 -right-2 bg-biblo-moss text-white w-11 h-11 sm:w-13 sm:h-13 flex items-center justify-center rounded-2xl shadow-lg border-4 border-white hover:bg-biblo-sage hover:scale-110 hover:shadow-2xl transition-all duration-300 z-20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M14.5 2H9.5L7 4.5H4a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-11a2 2 0 0 0-2-2h-3l-2.5-2.5Z" />
                                    <circle cx="12" cy="13" r="3" />
                                </svg>
                            </button>
                        </div>

                        {{-- User Info Section --}}
                        <div class="text-center md:text-left space-y-3 md:space-y-4 flex-1 mt-2 md:mt-1">
                            <div class="space-y-1">
                                <p class="text-xs font-bold uppercase tracking-widest text-biblo-moss/70">Profil Member</p>
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-biblo-charcoal">
                                    Selena
                                </h1>
                                <p class="text-2xl sm:text-3xl font-bold text-biblo-moss">Hans</p>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 pt-2">
                                <div class="flex items-center justify-center sm:justify-start gap-2 text-biblo-charcoal/70 font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="9" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span class="text-sm">Member sejak Maret 2026</span>
                                </div>
                                <span class="hidden sm:block w-1 h-1 bg-biblo-greige/40 rounded-full mx-2"></span>
                                <p class="text-biblo-charcoal/60 font-bold text-sm">@selena.h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            {{-- READING STATS SECTION --}}
            <section
                class="bg-white rounded-3xl sm:rounded-4xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 sm:p-8 md:p-10">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black text-biblo-charcoal">Statistik Membaca</h2>
                        <span class="text-xs font-bold text-biblo-moss bg-biblo-moss/10 px-3 py-1.5 rounded-full">Bulan Ini</span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5">
                        {{-- Books Read --}}
                        <div class="bg-gradient-to-br from-biblo-moss/10 to-biblo-sage/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-biblo-moss/20 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="text-3xl sm:text-4xl font-black text-biblo-charcoal group-hover:text-biblo-moss transition-colors">12</div>
                                <div class="text-2xl">📚</div>
                            </div>
                            <p class="text-xs font-bold text-biblo-charcoal/60 uppercase tracking-widest">Buku Dibaca</p>
                        </div>

                        {{-- Pages Today --}}
                        <div class="bg-gradient-to-br from-biblo-sage/10 to-biblo-oat/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-biblo-sage/20 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="text-3xl sm:text-4xl font-black text-biblo-charcoal group-hover:text-biblo-sage transition-colors">42</div>
                                <div class="text-2xl">📄</div>
                            </div>
                            <p class="text-xs font-bold text-biblo-charcoal/60 uppercase tracking-widest">Halaman Hari Ini</p>
                        </div>

                        {{-- Daily Streak --}}
                        <div class="bg-gradient-to-br from-biblo-clay/10 to-biblo-moss/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-biblo-clay/20 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="text-3xl sm:text-4xl font-black text-biblo-charcoal group-hover:text-biblo-clay transition-colors">5</div>
                                <div class="text-2xl">🔥</div>
                            </div>
                            <p class="text-xs font-bold text-biblo-charcoal/60 uppercase tracking-widest">Hari Berturut</p>
                        </div>

                        {{-- Hours Spent --}}
                        <div class="bg-gradient-to-br from-biblo-oat/10 to-biblo-greige/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-biblo-oat/30 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="text-3xl sm:text-4xl font-black text-biblo-charcoal group-hover:text-biblo-clay transition-colors">18.5</div>
                                <div class="text-2xl">⏱️</div>
                            </div>
                            <p class="text-xs font-bold text-biblo-charcoal/60 uppercase tracking-widest">Jam Membaca</p>
                        </div>
                    </div>
                </div>
            </section>


            {{-- ACCOUNT SETTINGS SECTION --}}
            <section class="space-y-4">
                <h3 class="text-xs font-bold text-biblo-charcoal/50 px-2 uppercase tracking-widest">Pengaturan Akun</h3>

                <div class="space-y-2.5">
                    {{-- Edit Profile --}}
                    <a href="#"
                        class="flex items-center justify-between p-5 sm:p-6 bg-white rounded-2xl sm:rounded-3xl border border-biblo-greige/20 hover:border-biblo-moss/50 hover:bg-biblo-moss/5 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-biblo-moss/10 rounded-2xl flex items-center justify-center group-hover:bg-biblo-moss/20 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    class="text-biblo-moss">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <span class="font-bold text-biblo-charcoal">Edit Profil</span>
                        </div>
                        <svg class="w-5 h-5 text-biblo-greige/40 group-hover:text-biblo-moss group-hover:translate-x-1 transition-all"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>

                    {{-- Change Password --}}
                    <a href="#"
                        class="flex items-center justify-between p-5 sm:p-6 bg-white rounded-2xl sm:rounded-3xl border border-biblo-greige/20 hover:border-biblo-sage/50 hover:bg-biblo-sage/5 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-biblo-sage/10 rounded-2xl flex items-center justify-center group-hover:bg-biblo-sage/20 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    class="text-biblo-sage">
                                    <rect width="18" height="18" x="3" y="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                            </div>
                            <span class="font-bold text-biblo-charcoal">Ubah Password</span>
                        </div>
                        <svg class="w-5 h-5 text-biblo-greige/40 group-hover:text-biblo-sage group-hover:translate-x-1 transition-all"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>

                    {{-- Reading Goal Settings --}}
                    <a href="#"
                        class="flex items-center justify-between p-5 sm:p-6 bg-white rounded-2xl sm:rounded-3xl border border-biblo-greige/20 hover:border-biblo-clay/50 hover:bg-biblo-clay/5 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-biblo-clay/10 rounded-2xl flex items-center justify-center group-hover:bg-biblo-clay/20 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    class="text-biblo-clay">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg>
                            </div>
                            <span class="font-bold text-biblo-charcoal">Target Membaca</span>
                        </div>
                        <svg class="w-5 h-5 text-biblo-greige/40 group-hover:text-biblo-clay group-hover:translate-x-1 transition-all"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>

                    {{-- Logout --}}
                    <a href="#"
                        class="flex items-center justify-between p-5 sm:p-6 bg-white rounded-2xl sm:rounded-3xl border border-red-200 hover:border-red-400 hover:bg-red-50 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-red-100 rounded-2xl flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                    class="text-red-600">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" x2="9" y1="12" y2="12" />
                                </svg>
                            </div>
                            <span class="font-bold text-red-600">Keluar</span>
                        </div>
                        <svg class="w-5 h-5 text-red-300 group-hover:text-red-500 group-hover:translate-x-1 transition-all"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>