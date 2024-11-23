<section>
    <header>
        <h2 class="text-lg font-medium text-white dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-white/80 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="flex flex-wrap -mx-2">
            <div class="input-group w-full px-2">
                <x-input-label for="update_password_current_password" class="block text-white/60 text-xl mt-5" :value="__('Current Password')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" autocomplete="current-password" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="update_password_password" class="block text-white/60 text-xl mt-5" :value="__('New Password')" />
                <x-text-input id="update_password_password" name="password" type="password" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" autocomplete="new-password" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="update_password_password_confirmation" class="block text-white/60 text-xl mt-5" :value="__('Confirm Password')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" autocomplete="new-password" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-red-500" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
