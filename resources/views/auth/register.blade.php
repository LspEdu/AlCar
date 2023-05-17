<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Ape1 -->
        <div class="mt-4">
            <x-input-label for="ape1" :value="__('Primer Apellido')" />
            <x-text-input id="ape1" class="block mt-1 w-full" type="text" name="ape1" :value="old('ape1')" required autofocus autocomplete="ape1" />
            <x-input-error :messages="$errors->get('ape1')" class="mt-2" />
        </div>

        <!-- Ape2 -->
        <div class="mt-4">
            <x-input-label for="ape2" :value="__('Segundo Apellido')" />
            <x-text-input id="ape2" class="block mt-1 w-full" type="text" name="ape2" :value="old('ape2')"  autofocus autocomplete="ape2" />
            <x-input-error :messages="$errors->get('ape2')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="tlf" :value="__('Teléfono')" />
            <x-text-input id="tlf" class="block mt-1 w-full" type="text" pattern="^\d{9}$" name="tlf" :value="old('tlf')" required autofocus autocomplete="tlf" />
            <x-input-error :messages="$errors->get('tlf')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="dir" :value="__('Dirección')" />
            <x-text-input id="dir" class="block mt-1 w-full" type="text" name="dir" :value="old('dir')"  autofocus autocomplete="dir" />
            <x-input-error :messages="$errors->get('dir')" class="mt-2" />
        </div>

        <!-- Año Nacimiento -->
        <div class="mt-4">
            <x-input-label for="fechNac" :value="__('Fecha Nacimiento')" />
            <x-text-input id="fechNac" class="block mt-1 w-full" type="date" name="fechNac" :value="old('fechNac')" required autofocus autocomplete="fechNac" />
            <x-input-error :messages="$errors->get('fechNac')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya tienes cuenta?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
