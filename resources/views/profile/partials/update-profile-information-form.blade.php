<section>
    <header>
        @if (session('status') === 'profile-updated')
            <p style="margin-bottom: 20px; color: aqua;">{{ __('Profil modifié !') }}</p>
        @endif

        <h2 class="font-medium text-gray-900 mb-3">
            {{ $user->prenoms }} {{ $user->nom }}
        </h2>

        <div class="profile_picture">
            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenoms }} {{ $user->nom }}" width="60">
        </div>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Mettez à jour les informations de profil et l\'adresse électronique de votre compte.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $user->nom)" required autofocus autocomplete="nom" />
            <x-input-error class="mt-2" :messages="$errors->get('nom')" />
        </div>

        <div>
            <x-input-label for="prenoms" :value="__('Prénoms')" />
            <x-text-input id="prenoms" name="prenoms" type="text" class="mt-1 block w-full" :value="old('prenoms', $user->prenoms)" required autofocus autocomplete="prenoms" />
            <x-input-error class="mt-2" :messages="$errors->get('prenoms')" />
        </div>

        <div>
            <x-input-label for="adresse" :value="__('adresse')" />
            <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full" :value="old('adresse', $user->adresse)" required autofocus autocomplete="adresse" />
            <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
        </div>

        <div>
            <x-input-label for="photo" :value="__('Photo de profil')" />
            <input id="photo" type="file" name="photo" accept="image/*">
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <div style="display: none;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="unmodified-mail mt-1 block w-full" value="{{ $user->email }}sss" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse électronique n\'est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse électronique.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Profil modifié !') }}</p>
            @endif
        </div>
    </form>
</section>
