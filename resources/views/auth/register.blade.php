<x-guest-layout>
    <style>
        .fallo {
            border: 1px solid red;
            color: red;
        }
    </style>
    <form method="POST" action="{{ route('register') }}" id="registrar">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 error" id="name-error" />
        </div>

        <!-- Ape1 -->
        <div class="mt-4">
            <x-input-label for="ape1" :value="__('Primer Apellido')" />
            <x-text-input id="ape1" class="block mt-1 w-full" type="text" name="ape1" :value="old('ape1')"
                required autofocus autocomplete="ape1" />
            <x-input-error :messages="$errors->get('ape1')" class="mt-2 error" id="ape1-error" />
        </div>

        <!-- Ape2 -->
        <div class="mt-4">
            <x-input-label for="ape2" :value="__('Segundo Apellido')" />
            <x-text-input id="ape2" class="block mt-1 w-full" type="text" name="ape2" :value="old('ape2')"
                autofocus autocomplete="ape2" />
            <x-input-error :messages="$errors->get('ape2')" class="mt-2 error" id="ape2-error" />
        </div>
        <!--DNI-->
        <div class="mt-4">
            <x-input-label for="dni" :value="__('DNI')" />
            <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')"
                autofocus autocomplete="dni" placeholder="12345678X" />
            <x-input-error :messages="$errors->get('dni')" class="mt-2 error" id="dni-error" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="tlf" :value="__('Teléfono')" />
            <x-text-input id="tlf" class="block mt-1 w-full" type="text" pattern="^\d{9}$" name="tlf"
                :value="old('tlf')" required autofocus autocomplete="tlf" placeholder="123123123" />
            <x-input-error :messages="$errors->get('tlf')" class="mt-2 error" id="tlf-error" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="dir" :value="__('Dirección')" />
            <x-text-input id="dir" class="block mt-1 w-full" type="text" name="dir" :value="old('dir')"
                autofocus autocomplete="dir" placeholder="Calle Larga 12 3B" />
            <x-input-error :messages="$errors->get('dir')" class="mt-2 error" id="dir-error" />
        </div>

        <!-- Año Nacimiento -->
        <div class="mt-4">
            <x-input-label for="fechNac" :value="__('Fecha Nacimiento')" />
            <x-text-input id="fechNac" class="block mt-1 w-full" type="date" name="fechNac" :value="old('fechNac')"
                required autofocus autocomplete="fechNac" />
            <x-input-error :messages="$errors->get('fechNac')" class="mt-2 error" id="fechNac-error" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="correo@correo.es"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 error" id="email-error" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 error"-error  />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error"-error  />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('¿Ya tienes cuenta?') }}
            </a>
            <x-primary-button class="ml-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>

    <script defer>
        var form = document.getElementById('registrar');
        var inputs = document.querySelectorAll('input'),
                errores = false,
                errorInputs = document.querySelectorAll('.error');
        var inputMap = new Map();
        inputMap.set('name', /^[A-ZÁÉÍÓÚ][a-záéíóú]{2,255}$/);
        inputMap.set('ape1', /^[A-ZÁÉÍÓÚ][a-záéíóú]{2,255}$/);
        inputMap.set('ape2',/^[A-ZÁÉÍÓÚ][a-záéíóú]{2,255}$/);
        inputMap.set('dni', /^[0-9]{8}[A-Z]$/);
        inputMap.set('tlf', /^[0-9]{9}$/);

        var errorMap = new Map();
        errorMap.set('name', 'El nombre debe tener la Primera letra mayúscula y tener al menos 3 caracteres');
        errorMap.set('ape1', 'El primer apellido debe tener la Primera letra mayúscula y tener al menos 3 caracteres');
        errorMap.set('ape2', 'El segundo apellido debe tener la Primera letra mayúscula y tener al menos 3 caracteres o estar vacío');
        errorMap.set('dni',  'El campo DNI debe estar formado por 8 números y una letra en MAYÚSCULAS. Ej: 12345678X');
        errorMap.set('tlf',  'El campo tlf debe estar formado por 9 números');



        inputs.forEach((input) => {
            input.addEventListener('change', () => {
                if(!inputMap.get(input.id).test(input.value)){
                    errores = true;
                    document.getElementById(input.id+'-error').textContent = errorMap.get(input.id);
                    input.classList.add('fallo');
                }else{
                    input.classList.remove('fallo');
                    document.getElementById(input.id+'-error').textContent = '';
                    errores = false;
                }
            })
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            checkMayorEdad(inputs[6].value, errorInputs[5], errores);
            if (!errores) form.submit();
        });

        function checkMayorEdad(edad, campo, errores) {
            var fechaNacimiento = edad;
            var fechaActual = new Date().toISOString().split('T')[0];

            var edad = new Date(fechaActual) - new Date(fechaNacimiento);
            edad = Math.floor(edad / (365.25 * 24 * 60 * 60 * 1000));

            if (edad < 18) {
                campo.textContent =
                    'Esta fecha significa que eres menor de Edad, por lo tanto no puedes conducir. Vuelve cuando cumplas 18 y obtengas tu carnet';
                errores = true;
            } else campo.textContent = ''


        }
    </script>
</x-guest-layout>
