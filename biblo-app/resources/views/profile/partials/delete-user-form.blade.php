<section class="space-y-6">
    <header class="mb-8">
        <h2 class="text-2xl font-black text-red-600 mb-1">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="text-sm text-biblo-charcoal/60 font-medium">
            {{ __('Tindakan ini tidak bisa dibatalkan. Semua data Anda akan dihapus secara permanen.') }}
        </p>
    </header>

    <div class="p-5 bg-red-50 border-2 border-red-200 rounded-2xl">
        <p class="text-sm text-red-700 font-semibold">
            ⚠️ {{ __('Perhatian: Semua data, buku, catatan, dan progres membaca Anda akan dihapus selamanya dan tidak bisa dipulihkan.') }}
        </p>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all hover:shadow-lg active:scale-95"
    >
        {{ __('Hapus Akun Saya') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6 sm:p-8">
            <h2 class="text-2xl font-black text-biblo-charcoal mb-3">
                {{ __('Yakin ingin menghapus akun?') }}
            </h2>

            <div class="space-y-4 mb-8 text-biblo-charcoal/70 text-sm">
                <p>
                    {{ __('Tindakan ini akan:') }}
                </p>
                <ul class="list-disc list-inside space-y-2 ml-2">
                    <li>{{ __('Menghapus profil dan semua data pribadi Anda') }}</li>
                    <li>{{ __('Menghapus semua catatan membaca dan highlight') }}</li>
                    <li>{{ __('Menghapus pet dan inventaris Anda') }}</li>
                    <li>{{ __('Tidak bisa dipulihkan lagi') }}</li>
                </ul>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="text-sm font-bold text-biblo-charcoal/70 uppercase tracking-wider block mb-2">Masukkan Password untuk Konfirmasi</label>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full border-biblo-greige/30 focus:border-red-500 focus:ring-red-500/20 rounded-xl"
                        placeholder="{{ __('Password Anda') }}"
                        required
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="px-6 py-3 bg-biblo-oat text-biblo-charcoal font-bold rounded-xl hover:bg-biblo-greige transition-all"
                    >
                        {{ __('Batal') }}
                    </button>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all hover:shadow-lg active:scale-95"
                    >
                        {{ __('Ya, Hapus Akun Saya') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
