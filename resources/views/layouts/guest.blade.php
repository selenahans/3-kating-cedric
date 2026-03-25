<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Biblo - Sahabat Membacamu' }}</title>
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
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .organic-shape {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }

        .navbar-glass {
            background: rgba(242, 239, 234, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(159, 175, 154, 0.2);
        }
    </style>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .organic-shape {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }

        /* Tambahkan CSS Keyframes untuk animasi melayang */
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }

            /* Naik 20px & miring dikit */
            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        /* Buat class utilitas untuk animasi tersebut */
        .animate-float-slow {
            animation: float 6s ease-in-out infinite;
            /* 6 detik per siklus, halus */
        }
    </style>
</head>

<body class="bg-biblo-oat text-biblo-charcoal">

    <x-guest-navbar />

    <main>
        {{ $slot }}
    </main>
    <x-guest-footer />

</body>

</html>