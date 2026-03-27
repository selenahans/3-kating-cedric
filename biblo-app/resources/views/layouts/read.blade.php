<!DOCTYPE html>
<html lang="id" class="transition-colors duration-300">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Pembaca Biblo' }}</title>

    <!-- Dark mode init (same as app layout) -->
    <script>
        function applyTheme(theme) {
            const html = document.documentElement;

            if (theme === 'dark') {
                html.classList.add('theme-dark');
            } else {
                html.classList.remove('theme-dark');
            }
        }

        // 🔥 Sync on load
        (function () {
            const stored = localStorage.getItem('biblo-theme');
            const preferred = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            applyTheme(stored || preferred);
        })();

        // 🔥 Sync when changed (important)
        window.addEventListener('storage', (e) => {
            if (e.key === 'biblo-theme') {
                applyTheme(e.newValue);
            }
        });

        // 🔥 Optional: expose toggle globally
        window.toggleTheme = function () {
            const current = document.documentElement.classList.contains('theme-dark') ? 'dark' : 'light';
            const next = current === 'dark' ? 'light' : 'dark';

            localStorage.setItem('biblo-theme', next);
            applyTheme(next);
        };
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: ['class', '.theme-dark'], // IMPORTANT
            theme: {
                extend: {
                    colors: {
                        'biblo-sage': '#9FAF9A',
                        'biblo-greige': '#CFC8BE',
                        'biblo-oat': '#F2EFEA',
                        'biblo-charcoal': '#3F453F',
                        'biblo-moss': '#7E8F7A',
                        'biblo-clay': '#B09D85',

                        // Dark palette
                        'biblo-dark-bg': '#1E2321',
                        'biblo-dark-surface': '#2A2F2D',
                        'biblo-dark-text': '#E5E7EB',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Crimson Pro', 'serif'],
                    }
                }
            }
        }
    </script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Crimson+Pro:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            background-color: #FDFBF8;
        }

        .theme-dark body {
            background-color: #1E2321;
        }

        ::selection {
            background: #9FAF9A;
            color: white;
        }

        .theme-dark ::selection {
            background: #7E8F7A;
            color: white;
        }
    </style>
</head>

<body class="text-biblo-charcoal theme-dark:text-biblo-dark-text antialiased transition-colors duration-300">

    {!! $navbar ?? '' !!}

    <main class="pt-20 pb-44 px-6 min-h-screen">
        <div class="mx-auto">
            @yield('content')
        </div>
    </main>

    {!! $bottomBar ?? '' !!}

</body>

</html>