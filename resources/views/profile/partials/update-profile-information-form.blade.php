<section>
    <header>
        <h2 class="text-lg font-medium text-white dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-white/80 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="flex flex-wrap -mx-2">
            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="name" class="block text-white/60 text-xl mt-5" :value="__('Nombre')" />
                <x-text-input id="name" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('name')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="last_name" class="block text-white/60 text-xl mt-5" :value="__('Apellido')" />
                <x-text-input id="last_name" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autocomplete="family-name" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('last_name')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="id_number" class="block text-white/60 text-xl mt-5" :value="__('Cedula')" />
                <x-text-input id="id_number" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="text" name="id_number" :value="old('id_number', $user->id_number)" required autocomplete="id-number" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('id_number')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="nationality" class="block text-white/60 text-xl mt-5" :value="__('Nacionalidad')" />
                <x-text-input id="nationality" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="text" name="nationality" :value="old('nationality', $user->nationality)" required autocomplete="nationality" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('nationality')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="email" class="block text-white/60 text-xl mt-5" :value="__('Correo Electrónico')" />
                <x-text-input id="email" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('email')" class="text-red-500" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="date_of_birth" class="block text-white/60 text-xl mt-5" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="date_of_birth" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="date" name="date_of_birth" :value="old('date_of_birth', $user->date_of_birth)" required autocomplete="bday" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('date_of_birth')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="facebook" class="block text-white/60 text-xl mt-5" :value="__('Facebook')" />
                <x-text-input id="facebook" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="facebook" :value="old('facebook', $user->facebook)" autocomplete="facebook" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('facebook')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="instagram" class="block text-white/60 text-xl mt-5" :value="__('Instagram')" />
                <x-text-input id="instagram" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="instagram" :value="old('instagram', $user->instagram)" autocomplete="instagram" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('instagram')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="twitter" class="block text-white/60 text-xl mt-5" :value="__('X')" />
                <x-text-input id="twitter" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="twitter" :value="old('twitter', $user->twitter)" autocomplete="twitter" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('twitter')" class="text-red-500" />
            </div>

            <div class="input-group w-full md:w-1/2 px-2">
                <x-input-label for="tiktok" class="block text-white/60 text-xl mt-5" :value="__('Tiktok')" />
                <x-text-input id="tiktok" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="tiktok" :value="old('tiktok', $user->tiktok)" autocomplete="tiktok" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('tiktok')" class="text-red-500" />
            </div>

            <div class="input-group w-full px-2" id='personal_page_container'>
                <x-input-label for="personal_page" class="block text-white/60 text-xl mt-5" :value="__('Pagina personal')" />
                <x-text-input id="personal_page" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="personal_page" :value="old('personal_page', $user->personal_page)" autocomplete="personal_page" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;" />
                <x-input-error :messages="$errors->get('personal_page')" class="text-red-500" />

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById('personal_page').addEventListener('change', function() {
                            let personalPageUrl = this.value;

                            fetch('{{ route('personal_page_check') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ url: personalPageUrl })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                if (data.correct) {
                                    let img = document.createElement('img');
                                    img.src = "{{ public_path('screenshots/') }}";
                                    img.alt = "Descripción de la imagen";
                                    img.className = "mt-5 w-full rounded-md";
                                    document.getElementById('personal_page_container').appendChild(img);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        });
                    });
                </script>
            </div>

            <div class="input-group w-full px-2">
                <x-input-label for="description" class="block text-white/60 text-xl mt-5" :value="__('Breve Descripción')" />
                <textarea id="description" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" name="description" autocomplete="description" style="border: 1px solid rgba(255, 255, 255, 0.254); resize: none;">{{ old('description', $user->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="text-red-500" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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
