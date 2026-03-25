<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black text-biblo-charcoal mb-1">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="text-sm text-biblo-charcoal/60 font-medium">
            {{ __("Perbarui informasi profil dan avatar akun Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- PROFILE PHOTO UPLOAD SECTION --}}
        <div class="space-y-4">
            <label class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider">Foto Profil</label>
            <div class="flex items-center gap-6 p-5 bg-biblo-oat/20 rounded-2xl border border-biblo-oat/40">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border-3 border-biblo-oat bg-biblo-oat/50 flex items-center justify-center font-bold text-2xl text-biblo-charcoal/40">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="w-full h-full object-cover" alt="Profil">
                    @else
                        {{ substr($user->name, 0, 1) }}
                    @endif
                </div>

                <div class="flex-1">
                    <label for="photo" class="inline-flex cursor-pointer">
                        <span class="px-4 py-2 bg-biblo-moss text-white font-bold rounded-xl hover:bg-biblo-sage transition-colors text-sm">Pilih Foto</span>
                    </label>
                    <input id="photo" name="photo" type="file" accept="image/png, image/jpeg, image/jpg, image/webp" class="hidden" />
                    <p class="text-xs text-biblo-charcoal/50 mt-2">PNG, JPG, JPEG atau WebP (Maks. 2MB)</p>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>
            </div>
        </div>

        <div>
            <label for="name" class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider block mb-2">Nama</label>
            <x-text-input id="name" name="name" type="text" class="block w-full border-biblo-greige/30 focus:border-biblo-moss focus:ring-biblo-moss/20 rounded-xl" :value="old('name', $user->name)"
                required autofocus autocomplete="name" placeholder="Nama lengkap" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="text-sm font-bold text-biblo-charcoal/50 uppercase tracking-wider block mb-2">Email (Tidak bisa diubah)</label>
            <x-text-input readonly id="email" name="email" type="email" class="block w-full bg-biblo-oat/20 text-biblo-charcoal/60 border-biblo-greige/20 rounded-xl cursor-not-allowed" :value="old('email', $user->email)" />
        </div>

        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-3 bg-biblo-moss text-white font-bold rounded-xl hover:bg-biblo-sage transition-all hover:shadow-lg active:scale-95">
                {{ __('Simpan Perubahan') }}
            </button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm font-semibold text-biblo-moss animate-pulse">
                    {{ __('✓ Berhasil disimpan') }}
                </p>
            @endif
        </div>
    </form>
</section>