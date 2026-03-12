@extends('layouts.read')

@section('title', 'Reading: Atomic Habits')

@section('content')


    {{-- Navbar --}}
    <x-read.navbar 
        title="Atomic Habits" 
        currentPage="34" 
        totalPages="120" 
    />

    {{-- Content --}}
    <main class="pt-40 pb-44 px-6">
        <div class="max-w-2xl mx-auto">
            <article class="font-serif text-2xl md:text-3xl leading-[1.8] text-biblo-charcoal/90 space-y-12">
                
                <div class="relative py-4">
                    <p class="italic border-l-4 border-biblo-sage pl-8">
                        You do not rise to the level of your goals. <br>
                        You fall to the level of your systems.
                    </p>
                </div>

                <p class="font-sans text-lg md:text-xl font-medium tracking-tight opacity-80">
                    Your habits shape identity.
                </p>

                <div class="space-y-8 text-xl leading-relaxed opacity-70">
                    <p>
                        Every action you take is a vote for the type of person you wish to become. 
                        No single instance will transform your beliefs, but as the votes build up, 
                        so does the evidence of your new identity.
                    </p>
                </div>

            </article>
        </div>
    </main>

    {{-- Bottom Bar --}}
    <x-read.bottom-bar 
        prevUrl="#" 
        nextUrl="#" 
        progress="28" 
    />

@endsection