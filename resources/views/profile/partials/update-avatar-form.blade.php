<section>
    TODO::VALIDAR TAMAÑO IMAGEN CON JAVASCRIPT
    <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Actualiza tu foto de perfil</h2>
        <input type="file" name="avatar" id="avatar" accept="image/*" class="mt-3 w-fit block  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        <x-input-error class="mt-2" :messages="$errors->get('avatar')"></x-input-error>
        <br>
        <x-primary-button class="mt-3" type="submit">
            {{__('Actualizar')}}
        </x-primary-button>
    </form>
</section>
