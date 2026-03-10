<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Biblo - Semangat Membaca!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'biblo-sage': '#9FAF9A',
                        'biblo-greige': '#CFC8BE',
                        'biblo-oat': '#F2EFEA',
                        'biblo-charcoal': '#3F453F',
                        'biblo-moss': '#7E8F7A',
                        'biblo-purple': '#A688CC',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.4); }
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CFC8BE; border-radius: 10px; }
    </style>
</head>
<body class="bg-biblo-oat text-biblo-charcoal min-h-screen p-6 md:p-10">

    <div class="max-w-7xl mx-auto space-y-8">
        
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-biblo-charcoal rounded-[40px] p-8 text-white relative overflow-hidden flex flex-col justify-between min-h-[240px]">
                <div class="relative z-10">
                    <h1 class="text-3xl font-extrabold mb-2">Selamat Pagi, Kak! 👋</h1>
                    <p class="text-biblo-greige/60 text-sm">Barnaby sedang menunggumu untuk membacakan cerita baru.</p>
                </div>
                
                <div class="relative z-10 flex items-center gap-6 mt-6">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center gap-3">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">Day Streak</p>
                            <p class="text-xl font-bold">12 Hari</p>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center gap-3">
                        <span class="text-2xl">🦉</span>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">Pet Status</p>
                            <p class="text-xl font-bold">Barnaby (Lv. 4)</p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-8 bottom-[-20px] text-[160px] opacity-20 md:opacity-100 select-none">🦉</div>
            </div>

            <div class="bg-white rounded-[40px] p-8 shadow-xl shadow-biblo-greige/20 flex flex-col justify-between border border-white">
                <div>
                    <h3 class="font-bold text-lg mb-4 text-biblo-charcoal">Target Hari Ini</h3>
                    <div class="flex items-end gap-2 mb-2">
                        <span class="text-4xl font-extrabold text-biblo-moss">12</span>
                        <span class="text-biblo-charcoal/40 font-bold mb-1">/ 15 Lembar</span>
                    </div>
                    <div class="w-full bg-biblo-oat rounded-full h-2.5">
                        <div class="bg-biblo-moss h-2.5 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <p class="text-[11px] font-bold text-biblo-charcoal/40 italic">3 lembar lagi untuk memberi makan Barnaby!</p>
            </div>
        </div>

        <div class="grid md:grid-cols-12 gap-6">
            
            <div class="md:col-span-4 bg-white rounded-[40px] p-8 shadow-xl border border-white">
                <h3 class="font-bold text-lg mb-6">Recap Februari</h3>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-purple/10 rounded-xl flex items-center justify-center text-biblo-purple">📚</div>
                            <p class="text-sm font-bold">Buku Selesai</p>
                        </div>
                        <span class="font-extrabold text-lg">4</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-sage/10 rounded-xl flex items-center justify-center text-biblo-sage">📄</div>
                            <p class="text-sm font-bold">Total Halaman</p>
                        </div>
                        <span class="font-extrabold text-lg">482</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-clay/10 rounded-xl flex items-center justify-center text-biblo-clay">✨</div>
                            <p class="text-sm font-bold">Poin Didapat</p>
                        </div>
                        <span class="font-extrabold text-lg">1.250</span>
                    </div>
                </div>
                
                <div class="mt-8 h-32 w-full bg-biblo-oat/50 rounded-2xl flex items-end justify-between p-4 gap-2">
                    <div class="w-full bg-biblo-greige/30 h-[40%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[70%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-moss h-[90%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[50%] rounded-t-lg"></div>
                </div>
            </div>

            <div class="md:col-span-8 space-y-6">
                <div class="flex justify-between items-center px-2">
                    <h3 class="font-bold text-lg">Lanjutkan Membaca</h3>
                    <a href="#" class="text-xs font-bold text-biblo-moss hover:underline">Lihat Semua</a>
                </div>
                
                <div class="bg-white rounded-[40px] p-6 shadow-xl border border-white flex flex-col md:flex-row gap-6 items-center">
                    <div class="w-32 h-44 bg-biblo-greige rounded-2xl shadow-lg flex-shrink-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover" alt="Cover">
                    </div>
                    <div class="flex-1 w-full">
                        <span class="text-[10px] font-black text-biblo-moss uppercase tracking-widest">Self Improvement</span>
                        <h4 class="text-xl font-extrabold text-biblo-charcoal mt-1">Atomic Habits</h4>
                        <p class="text-sm text-biblo-charcoal/50 mb-4">James Clear</p>
                        
                        <div class="space-y-2 mb-6">
                            <div class="flex justify-between text-[11px] font-bold">
                                <span>Progress Baca</span>
                                <span>65%</span>
                            </div>
                            <div class="w-full bg-biblo-oat rounded-full h-1.5">
                                <div class="bg-biblo-charcoal h-1.5 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        
                        <button class="bg-biblo-moss text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-biblo-charcoal transition-all">
                            Baca Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="font-bold text-lg px-2">Rekomendasi Untukmu</h3>
            <div class="flex overflow-x-auto gap-6 pb-6 custom-scrollbar">
                <div class="w-48 flex-shrink-0 group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-biblo-greige rounded-[30px] mb-4 overflow-hidden relative shadow-md group-hover:shadow-xl transition-all">
                        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2112&auto=format&fit=crop" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
                    </div>
                    <h5 class="font-bold text-sm text-biblo-charcoal truncate">The Psychology of Money</h5>
                    <p class="text-xs text-biblo-charcoal/40">Morgan Housel</p>
                </div>

                <div class="w-48 flex-shrink-0 group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-biblo-greige rounded-[30px] mb-4 overflow-hidden relative shadow-md group-hover:shadow-xl transition-all">
                        <img src="https://images.unsplash.com/photo-1543004218-ee141104308e?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
                    </div>
                    <h5 class="font-bold text-sm text-biblo-charcoal truncate">Deep Work</h5>
                    <p class="text-xs text-biblo-charcoal/40">Cal Newport</p>
                </div>

                <div class="w-48 flex-shrink-0 group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-biblo-greige rounded-[30px] mb-4 overflow-hidden relative shadow-md group-hover:shadow-xl transition-all">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=1948&auto=format&fit=crop" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
                    </div>
                    <h5 class="font-bold text-sm text-biblo-charcoal truncate">The Alchemist</h5>
                    <p class="text-xs text-biblo-charcoal/40">Paulo Coelho</p>
                </div>

                <div class="w-48 flex-shrink-0 group cursor-pointer">
                    <div class="w-full aspect-[3/4] bg-biblo-greige rounded-[30px] mb-4 overflow-hidden relative shadow-md group-hover:shadow-xl transition-all">
                        <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
                    </div>
                    <h5 class="font-bold text-sm text-biblo-charcoal truncate">Ikigai</h5>
                    <p class="text-xs text-biblo-charcoal/40">Hector Garcia</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>