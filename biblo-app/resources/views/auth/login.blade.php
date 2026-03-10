<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Biblo - Hello Again!</title>
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
                        'biblo-clay': '#B09D85',
                        'biblo-purple': '#A688CC', // Tambahkan warna ungu dari ilustrasi asli
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-biblo-oat min-h-screen flex items-center justify-center p-4 md:p-10">

    <div class="bg-white w-full max-w-7xl min-h-[80vh] rounded-[3rem] overflow-hidden flex flex-col md:flex-row shadow-2xl transition-all duration-300">
        
        <div class="hidden md:flex md:w-[45%] bg-biblo-purple p-10 flex-col items-center justify-center text-center relative overflow-hidden">
            <div class="absolute -top-16 -left-16 w-64 h-64 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-16 -right-16 w-80 h-80 bg-white/10 rounded-full"></div>

            <div class="w-full h-full flex items-center justify-center relative z-10">
                <div class="w-[80%] aspect-square bg-biblo-sage/20 rounded-[2.5rem] flex items-center justify-center border-4 border-dashed border-white/20">
                    <span class="text-white text-9xl">🦉</span>
                </div>
            </div>
            <div class="absolute bottom-10 left-10 text-white/50 text-3xl font-bold tracking-tighter">
                BIBLO.
            </div>
        </div>

        <div class="w-full md:w-[55%] p-8 md:p-16 flex flex-col justify-center items-center">
            <div class="w-full max-w-sm">
                
                <div class="flex justify-center md:justify-end mb-16 text-xs font-semibold">
                    <p class="text-biblo-charcoal/50">Not a member?</p>
                    <a href="#" class="text-biblo-moss font-bold hover:underline ml-1">Register now</a>
                </div>

                <div class="text-center mb-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-biblo-charcoal mb-3">Hello Again!</h1>
                    <p class="text-biblo-charcoal/60 text-sm md:text-base px-6">Wellcome back you've been missed!</p>
                </div>

                <form class="space-y-4">
                    <div class="relative">
                        <input type="text" placeholder="Enter username" 
                            class="w-full bg-biblo-oat/50 border border-biblo-greige/40 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:border-biblo-moss focus:ring-1 focus:ring-biblo-moss/30 transition-all font-semibold">
                    </div>
                    <div class="relative">
                        <input type="password" placeholder="Password" 
                            class="w-full bg-biblo-oat/50 border border-biblo-greige/40 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:border-biblo-moss focus:ring-1 focus:ring-biblo-moss/30 transition-all font-semibold">
                        <span class="absolute right-6 top-4 text-biblo-charcoal/30 cursor-pointer hover:text-biblo-moss">
                            👁️
                        </span>
                    </div>

                    <div class="flex justify-end px-2 text-xs font-bold mt-1">
                        <a href="#" class="text-biblo-charcoal/40 hover:text-biblo-moss">Recovery Password</a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-biblo-charcoal hover:bg-black text-white py-4 rounded-2xl font-extrabold shadow-lg shadow-biblo-charcoal/10 transition-all transform hover:scale-[1.02] active:scale-[0.98] mt-6">
                        Sign In
                    </button>
                </form>

                <div class="relative my-10">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-biblo-greige/20"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-bold uppercase tracking-widest">
                        <span class="bg-white px-4 text-biblo-charcoal/20">or continue with</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <button class="flex items-center justify-center py-3 border border-biblo-greige/30 rounded-xl hover:bg-biblo-oat transition-colors group">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-6 w-6" alt="Google">
                    </button>
                    <button class="flex items-center justify-center py-3 border-2 border-biblo-greige rounded-xl hover:bg-biblo-oat transition-colors shadow-inner shadow-black/5">
                        <img src="https://www.svgrepo.com/show/330030/apple.svg" class="h-6 w-6" alt="Apple">
                    </button>
                    <button class="flex items-center justify-center py-3 border border-biblo-greige/30 rounded-xl hover:bg-biblo-oat transition-colors group">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-6 w-6" alt="Facebook">
                    </button>
                </div>

            </div>
        </div>
    </div>

</body>
</html>