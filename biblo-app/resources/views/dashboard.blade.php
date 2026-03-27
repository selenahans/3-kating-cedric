<x-app-layout title="Beranda" active="home">

    <div class="dashboard-page dashboard-home
w-full max-w-screen-xl mx-auto
px-4 sm:px-6 lg:px-8
space-y-8 md:space-y-10 lg:space-y-12
overflow-x-hidden">

        {{-- HEADER STATS --}}
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- GREETING CARD --}}
            <div class="lg:col-span-2 bg-biblo-charcoal
rounded-3xl sm:rounded-[2.25rem] lg:rounded-[2.75rem]
p-5 sm:p-6 lg:p-8
text-white relative overflow-hidden
flex flex-col justify-between
min-h-[14rem] sm:min-h-[16rem] lg:min-h-[18rem]">

                <div class="relative z-10">
                    <h1 class="text-2xl sm:text-3xl font-extrabold mb-2">
                        Selamat Pagi, {{ Auth::user()->name ?? 'sel' }}! 👋
                    </h1>

                    <p class="text-biblo-greige/60 text-sm">
                        {{ $currentPetName ?? 'Barnaby' }} sedang menunggumu untuk membacakan cerita baru.
                    </p>
                </div>

                <div class="relative z-10 flex flex-wrap gap-4 mt-6">

                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 flex items-center gap-3 border border-white/5">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-white/40 leading-none">
                                Streak Harian
                            </p>
                            <p class="text-xl font-bold">{{ $dayStreak }} Hari</p>
                        </div>
                    </div>

                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 flex items-center gap-3 border border-white/5">

                        <div class="w-8 h-8 flex-shrink-0">
                            <img src="{{ $petImage ?? asset('images/boo-pet.webp') }}"
                                class="w-full h-full object-contain">
                        </div>

                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-white/40 leading-none">
                                Status Pet
                            </p>

                            <p class="text-xl font-bold">
                                {{ $currentPetName ?? 'Barnaby' }} (Lv. {{ $petLevel ?? 1 }})
                            </p>
                        </div>
                    </div>

                </div>

                <div class="absolute right-0 bottom-[-20px] w-40 md:w-60 opacity-20 select-none pointer-events-none">
                    <img src="{{ $petImage ?? asset('images/boo-pet.webp') }}" class="w-full h-auto object-contain">
                </div>

            </div>


            {{-- DAILY GOAL --}}
            <div class="bg-white
rounded-3xl sm:rounded-[2.25rem] lg:rounded-[2.75rem]
p-5 sm:p-6 lg:p-8
shadow-sm
border border-biblo-greige/30
flex flex-col justify-between">

                <div>

                    <h3 class="font-bold text-lg mb-4 text-biblo-charcoal">
                        Target Hari Ini
                    </h3>

                    <div class="flex items-end gap-2 mb-2">
                        <span class="text-4xl font-extrabold text-biblo-moss">
                            {{ number_format($todayPagesRead, 0, ',', '.') }}
                        </span>

                        <span class="text-biblo-charcoal/40 font-bold mb-1">
                            / {{ number_format($goalPages, 0, ',', '.') }} Lembar
                        </span>
                    </div>

                    <div class="w-full bg-biblo-oat rounded-full h-2.5">
                        <div class="bg-biblo-moss h-2.5 rounded-full" style="width: {{ $goalProgressPercent }}%">
                        </div>
                    </div>

                </div>

                <p class="text-[11px] font-bold text-biblo-charcoal/40 italic mt-4">
                    {{ $dailyGoalMessage }}
                </p>

            </div>

        </section>


        {{-- TASKS --}}
        <section>

            <h3 class="text-lg font-bold mb-6 text-biblo-charcoal">
                Tugas untuk Mencapai Level {{ $activeLevelGate ?? 3 }}
            </h3>

            <div class="flex flex-col lg:flex-row lg:overflow-x-auto gap-6 pb-4">

                @foreach($tasks as $task)

                    <div class="w-full lg:w-80
bg-white
rounded-2xl sm:rounded-3xl
p-5
shadow-sm
border border-biblo-greige/30
flex flex-col justify-between
lg:flex-shrink-0">

                        <div>

                            <h4 class="font-bold text-biblo-charcoal">
                                {{ $task->title }}
                            </h4>

                            <p class="text-xs text-biblo-charcoal/40 mt-2 line-clamp-2">
                                {{ $task->description }}
                            </p>

                        </div>

                        <div>

                            <div class="w-full bg-biblo-oat rounded-full h-1.5 mt-3">
                                <div class="bg-biblo-moss h-full rounded-full"
                                    style="width: {{ ($task->percentage ?? 0) . '%' }}">
                                </div>
                            </div>

                            <div class="flex justify-between text-[10px] font-bold mt-2 uppercase tracking-widest">
                                <span class="text-biblo-charcoal/40">Progres</span>
                                <span class="text-biblo-moss">{{ round($task->percentage) }}%</span>
                            </div>

                            <p class="text-[10px] font-bold text-biblo-charcoal/30 mt-1 uppercase">
                                +{{ $task->coin_reward }} koin • +{{ $task->xp_reward }} XP
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </section>


        {{-- MAIN GRID --}}
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- RECAP --}}
            <div class="lg:col-span-4 bg-white rounded-[28px] sm:rounded-[36px] lg:rounded-[45px]
p-5 sm:p-6 lg:p-8 shadow-sm border border-biblo-greige/30">

                <h3 class="font-bold text-lg mb-6">
                    Recap {{ $recapMonthLabel }}
                </h3>

                {{-- recap items remain unchanged --}}

            </div>


            {{-- CONTINUE READING --}}
            <div class="lg:col-span-8 bg-white rounded-[28px] sm:rounded-[36px] lg:rounded-[45px]
p-5 sm:p-6 lg:p-8 shadow-sm border border-biblo-greige/30">

                {{-- continue reading content unchanged --}}

            </div>

        </section>


        {{-- RECOMMENDATIONS --}}
        <section>

            <div class="grid
grid-cols-2
sm:grid-cols-3
lg:grid-cols-4
xl:grid-cols-5
gap-4 sm:gap-6 lg:gap-10">

                <h3 class="font-bold text-xl text-biblo-charcoal">
                    Rekomendasi Untukmu
                </h3>

                <a href="{{ route('explore') }}"
                    class="text-xs font-black text-biblo-moss uppercase tracking-widest hover:underline">
                    Lihat Semua
                </a>

            </div>


            {{-- SAME GRID SYSTEM AS LIBRARY --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5
gap-4 sm:gap-6 lg:gap-10">

                @foreach($books as $book)

                    @if($loop->iteration > 5)
                        @break
                    @endif

                    <a href="{{ route('book.detail', $book) }}" class="group cursor-pointer block">

                        <div class="aspect-[3/4]
                        bg-biblo-greige
                        rounded-xl sm:rounded-2xl
                        mb-3 sm:mb-5
                        overflow-hidden
                        shadow-md
                        group-hover:shadow-2xl
                        transition-all duration-500">

                            <img src="{{ asset($book->cover_image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform">

                        </div>

                        <div class="px-2">

                            <span class="text-[9px] font-black text-biblo-moss uppercase tracking-tighter block mb-1">
                                {{ $book->category->name ?? 'Pilihan Biblo' }}
                            </span>

                            <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">
                                {{ $book->title }}
                            </h5>

                            <p class="text-[11px] font-bold text-biblo-clay mt-1">
                                {{ $book->author }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>

    </div>

</x-app-layout>