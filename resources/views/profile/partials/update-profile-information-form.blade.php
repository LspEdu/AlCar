<section>
    <header>
        <h1 class="text-xlg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información Personal') }}
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="ape1" :value="__('Apellido 1')" />
            <x-text-input id="ape1" name="ape1" type="text" class="mt-1 block w-full" :value="old('ape1', $user->ape1)" required autofocus autocomplete="ape1" />
            <x-input-error class="mt-2" :messages="$errors->get('ape1')" />
        </div>

        <div>
            <x-input-label for="ape2" :value="__('Apellido 2')" />
            <x-text-input id="ape2" name="ape2" type="text" class="mt-1 block w-full" :value="old('ape2', $user->ape2)"  autofocus autocomplete="ape2" />
            <x-input-error class="mt-2" :messages="$errors->get('ape2')" />
        </div>

        <div>
            <x-input-label for="dni" :value="__('DNI')" />
            <x-text-input id="dni" disabled name="dni" type="text" class="mt-1 block w-full text-muted" :value="old('dni', $user->dni)"  autofocus autocomplete="dni" />
            <x-input-error class="mt-2" :messages="$errors->get('dni')" />
        </div>

        <div>
            <x-input-label for="fechNac" :value="__('Fecha Nacimiento')" />
            <x-text-input id="fechNac" name="fechNac" type="date" class="mt-1 block w-full" :value="old('fechNac', $user->fechNac)" required autofocus autocomplete="fechNac" />
            <x-input-error class="mt-2" :messages="$errors->get('fechNac')" />
        </div>

        <div>
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" :value="old('direccion', $user->direccion)"  autofocus autocomplete="direccion" />
            <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
        </div>

        <div>
            <x-input-label for="tlf" :value="__('Teléfono')" />
            <x-text-input id="tlf" name="tlf" type="text" class="mt-1 block w-full" :value="old('tlf', $user->tlf)" required autofocus autocomplete="tlf" />
            <x-input-error class="mt-2" :messages="$errors->get('tlf')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

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

        <div class="flex items-end gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
