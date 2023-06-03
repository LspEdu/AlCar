<x-admin-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Usuarios') }}
        </h2>


    </x-slot>
    <div class="w-100" x-data="{
        buscar: '',
        activo: true,
        usuarios: {{ $usuarios }},
        currentPage: 1,
        itemsPerPage: 9,
        get getFilteredUsers() {
            const buscarLower = this.buscar.toLowerCase();
            return this.usuarios.filter(user => {
                return (
                    (user.name.toLowerCase().includes(buscarLower) ||
                        user.ape1.toLowerCase().includes(buscarLower) ||
                        user.email.toLowerCase().includes(buscarLower)) &&
                        (this.activo ? user.activo : true )
                );
            });
        },
        get totalPages() {
            return Math.ceil(this.getFilteredUsers.length / this.itemsPerPage);
        },
        get paginatedUsuarios() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;

            return this.getFilteredUsers.slice(startIndex, endIndex);
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
    }">
        <div class="row bg-white rounded justify-content-center shadow m-3 pb-2 sticky-top">
            <div class="col-11 m-1 text-center">
                <label class="mt-1" for="buscador">
                    <h3>Buscador</h3>
                </label>
                <input x-model="buscar" id="buscador"
                    class="form-control mt-3 mb-2 p-1 border border-gray-400 rounded-md shadow"
                    placeholder="Buscar por nombre o apellido ">
            </div>
            <div class="col-11 col-md-3">
                <label class="mt-1 ms-1" for="activo">
                    Sólo los usuarios activos
                  </label>
                  <input  type="checkbox" name="activo" id="activo" x-model="activo">

            </div>
            <template x-if="paginatedUsuarios.length === 0">
                <div class="col-12 bg white text-center mt-3  ">
                    <h3>No existe ese usuario :(</h3>
                </div>
            </template>
            <div class="col-12 justify-content-center text-center mt-2">
                <button class="btn btn-secondary" @click="previousPage" x-show="totalPages > 0"
                    :disabled="currentPage === 1">Anterior</button>
                <button class="btn btn-secondary" @click="nextPage" x-show="totalPages > 0"
                    :disabled="currentPage === totalPages">Siguiente</button>
            </div>
            <x-auth-session-status :status="session('status')"
                class=" p-3 mt-3 shadow-sm bg-success rounded fs-4 text-white text-center col-5 justify-self-center" />
        </div>
        <div class="row row-cols-1 row-cols-md-4 mt-3 row-cols-lg-4 gap-4 justify-content-center">
            <template x-for="usuario in paginatedUsuarios" :key="usuario.id">
                <div class="col-11 card col-sm-5 col-lg-3  ms-md-6 shadow ">
                    <img x-bind:src="'{{ asset('') }}' + (usuario.avatar ?? 'storage/webo.jpg')"
                        class="card-img-top w-100 mt-1 rounded" style="height: 11em" alt="fotousuario" />
                    <div class="card-body">
                        <h5 class="card-title" x-text="usuario.name + ' ' + usuario.ape1 + ' '"></h5>
                        <div class="card-text">
                            <h6>Correo <small x-text="usuario.email">€</small></h6>
                            <p>Teléfono: <small x-text="usuario.tlf"></small></p>
                            <p>Estado <small x-show="usuario.activo == true" class="text-success" x-text="usuario.activo"></small>
                                      <small x-show="usuario.activo == false" class="text-danger" x-text="usuario.activo"></small>
                                    </p>
                        </div>
                        <a :href="'usuario/' + usuario.id" class="btn btn-outline-warning text-center">Ver</a>
                    </div>
                </div>
            </template>


        </div>
        <script></script>

</x-admin-layout>
