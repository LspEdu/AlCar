<section>
    <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Actualiza tu foto de perfil</h2>
        <input type="file" name="avatar" id="avatar" accept="image/*" onchange="visualizar(event)"
            class="mt-3 w-fit block  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        <x-input-error class="mt-2" :messages="$errors->get('avatar')"></x-input-error>
        <br>
        <img src="" alt="" id="preview">
        <x-primary-button class="mt-3" type="submit">
            {{ __('Actualizar') }}
        </x-primary-button>
    </form>
    <script defer>
        function visualizar(event) {
            const archivos = event.target.files;
            if (archivos.length > 0) {
                const imagenUrl = URL.createObjectURL(archivos[0]);
                const avatar = document.querySelector("#preview");
                avatar.src = imagenUrl;
                console.log(avatar);
                console.log(imagenUrl);
                avatar.style.objectFit = 'cover';
                avatar.style.height = '95px';
                avatar.style.width = '150px';
            }
        }
    </script>
</section>
