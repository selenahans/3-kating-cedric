<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black text-biblo-charcoal mb-1">
            {{ __('Ubah Password') }}
        </h2>
        <p class="text-sm text-biblo-charcoal/60 font-medium">
            {{ __('Gunakan kata sandi yang kuat dan unik untuk keamanan akun Anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider block mb-2">Kata Sandi Saat Ini</label>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full border-biblo-greige/30 focus:border-biblo-moss focus:ring-biblo-moss/20 rounded-xl" autocomplete="current-password" placeholder="Masukkan kata sandi Anda" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider block mb-2">Kata Sandi Baru</label>
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full border-biblo-greige/30 focus:border-biblo-moss focus:ring-biblo-moss/20 rounded-xl" autocomplete="new-password" placeholder="Masukkan kata sandi baru" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider block mb-2">Konfirmasi Kata Sandi</label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full border-biblo-greige/30 focus:border-biblo-moss focus:ring-biblo-moss/20 rounded-xl" autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-3 bg-biblo-sage text-white font-bold rounded-xl hover:bg-biblo-moss transition-all hover:shadow-lg active:scale-95">
                {{ __('Perbarui Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-semibold text-biblo-sage"
                >{{ __('✓ Kata sandi berhasil diperbarui') }}</p>
            @endif
        </div>
    </form>
</section>
