<section>
    <header>
        <h2 class="text-lg font-bold text-biblo-charcoal">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-biblo-charcoal/60">
            {{ __("Update your account's profile information and avatar.") }}
        </p>
    </header>

    {{-- 1. ADD enctype HERE --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- PROFILE PHOTO UPLOAD SECTION --}}
        <div class="flex items-center gap-6">
            <div class="user-avatar w-20 h-20 text-2xl">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" class="w-full h-full object-cover rounded-[24px]">
                @else
                    {{ substr($user->name, 0, 1) }}
                @endif
            </div>

            <div>
                <x-input-label for="photo" :value="__('Profile Photo')" />
                <input id="photo" name="photo" type="file" accept="image/png, image/jpeg, image/jpg, image/webp" class="mt-1 block w-full text-xs text-biblo-charcoal/60
              file:mr-4 file:py-2 file:px-4
              file:rounded-full file:border-0
              file:text-xs file:font-bold
              file:bg-biblo-oat file:text-biblo-moss
              hover:file:bg-biblo-greige transition-all" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- ... keep the email input as is ... --}}
        <div>
            <x-text-input readonly id="email" name="email" type="email" class="mt-1 block w-full text-gray-500" :value="old('email', $user->email)" required autofocus autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
            {{-- ... success status message ... --}}
        </div>
    </form>
</section>