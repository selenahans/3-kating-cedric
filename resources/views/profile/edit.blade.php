<x-app-layout title="Edit Profil" active="profile">
    <div class="min-h-screen bg-gradient-to-br from-biblo-oat/30 via-transparent to-biblo-greige/10">
        <div class="max-w-3xl mx-auto space-y-6 md:space-y-8 pb-32 px-3 sm:px-4 md:px-0 pt-2">
            
            {{-- Header Section --}}
            <div class="space-y-2">
                <h1 class="text-4xl md:text-5xl font-black text-biblo-charcoal">Edit Profil</h1>
                <p class="text-biblo-charcoal/60 font-medium">Kelola informasi akun dan keamanan Anda</p>
            </div>

            {{-- Profile Information Form --}}
            <div class="bg-white rounded-3xl sm:rounded-4xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 sm:p-8 md:p-10">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password Form --}}
            <div class="bg-white rounded-3xl sm:rounded-4xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 sm:p-8 md:p-10">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account Form --}}
            <div class="bg-white rounded-3xl sm:rounded-4xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 sm:p-8 md:p-10">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
