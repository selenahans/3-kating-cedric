<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Pembaca Biblo' }}</title>
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

        ::selection {
            background: #9FAF9A;
            color: white;
        }
    </style>
</head>

<body class="text-biblo-charcoal antialiased">

    {{-- Tempat untuk Navbar Read --}}
    @if(isset($navbar))
        {{ $navbar }}
    @endif

    {{-- Isi Konten Buku --}}
    <main class="pt-32 pb-44 px-6 min-h-screen">
        <div class="max-w-4xl mx-auto">
            @yield('content')
        </div>
    </main>

    {{-- Tempat untuk Bottom Bar Read --}}
    @if(isset($bottomBar))
        {{ $bottomBar }}
    @endif

</body>

</html>