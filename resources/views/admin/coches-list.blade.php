<x-admin-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Coches') }}
        </h2>


    </x-slot>
    <div x-data="{
        buscar: '',
        tipoCoche: '',
        plazasCoche: '',
        combustibleCoche: '',
        cambioCoche: '',
        tipos: ['deportivo', 'superdeportivo', 'biplaza', 'offroad', 'utilitario'],
        plazas: [ '1', '2', '3', '4', '5', '6', '7'],
        combustibles: ['hibrido', 'electrico', 'diesel', 'gasolina'],
        cambios: ['automatico', 'manual'],
        coches: {{ $coches }},
        usuario: {{ Auth::user() }},
        currentPage: 1,
        itemsPerPage: 9,
        get filteredCoches() {
          const buscarLower = this.buscar.toLowerCase();
          return this.coches.filter(coche => {
            return (
              (coche.marca.toLowerCase().includes(buscarLower) ||
                coche.modelo.toLowerCase().includes(buscarLower) ||
                coche.matricula.toLowerCase().includes(buscarLower)) &&
              (this.tipoCoche === '' || coche.tipo === this.tipoCoche) &&
              (this.plazasCoche === '' || coche.plazas >= parseInt(this.plazasCoche)) &&
              (this.combustibleCoche === '' || coche.combustible === this.combustibleCoche) &&
              (this.cambioCoche === '' || coche.cambio === this.cambioCoche)
            );
          });
        },
        get totalPages() {
          return Math.ceil(this.filteredCoches.length / this.itemsPerPage);
        },
        get paginatedCoches() {
          const startIndex = (this.currentPage - 1) * this.itemsPerPage;
          const endIndex = startIndex + this.itemsPerPage;

          return this.filteredCoches.slice(startIndex, endIndex);
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
        }
      }" >
      <div class="row bg-white rounded justify-content-center shadow m-3 pb-2">
          <div class="col-11 m-1 text-center">
              <label class="mt-1" for="buscador">
                  <h3>Buscador</h3>
                </label>
              <input x-model="buscar" id="buscador" class="form-control mt-3 mb-2 p-1 border border-gray-400 rounded-md shadow" placeholder="Busca por marca, modelo o matrícula">
            </div>
        <div class="col-11 col-md-3">
            <label class="mt-1 ms-1" for="tipo">
                Tipo de coche
              </label>
            <select id="tipo" x-model="tipoCoche" class="form-control mt-1 mb-2 p-1 border border-gray-400 rounded-md shadow">
                <option value="">Cualquiera</option>
                <template x-for="tipo in tipos" :key="tipo">
                    <option x-text="tipo"></option>
                </template>
            </select>
        </div>
        <div class="col-11 col-md-2">
            <label class="mt-1 ms-1" for="plazas">
                Nº de plazas
              </label>
            <select id="plazas" x-model="plazasCoche" class=" form-control mt-1 mb-2 p-1 border border-gray-400 rounded-md shadow">
                <option value="">0+</option>
                <template x-for="plaza in plazas" :key="plaza">
                    <option x-text="plaza"></option>
                </template>
            </select>
        </div>
        <div class="col-11 col-md-3">
            <label class="mt-1 ms-1" for="combustible">
                Combustible
              </label>
            <select id="combustible" x-model="combustibleCoche" class="form-control mt-1 mb-2 p-1 border border-gray-400 rounded-md shadow">
                <option value="">Cualquiera</option>
                <template x-for="combustible in combustibles" :key="combustible">
                    <option x-text="combustible"></option>
                </template>
            </select>
        </div>
          <div class="col-11 col-md-3">
            <label class="mt-1 ms-1" for="cambio">
                Cambio
              </label>
              <select x-model="cambioCoche" class="form-control mt-1 mb-2 p-1 border border-gray-400 rounded-md shadow">
                  <option value="">Cualquiera</option>
                  <template x-for="cambio in cambios" :key="cambio">
                    <option x-text="cambio"></option>
                </template>
            </select>
        </div>
        <template x-if="paginatedCoches.length === 0">
            <div class="col-12 bg white text-center mt-3  ">
                <h3>No hay coches disponibles con esas características :(</h3>
            </div>
        </template>
        <div class="col-12 justify-content-center text-center mt-2">
            <button class="btn btn-secondary" @click="previousPage" x-show="totalPages > 0" :disabled="currentPage === 1">Anterior</button>
            <button class="btn btn-secondary" @click="nextPage" x-show="totalPages > 0" :disabled="currentPage === totalPages">Siguiente</button>
          </div>
      </div>
        <div class="row row-cols-1 row-cols-md-3 mt-3 row-cols-lg-4 gap-1 justify-content-md-around justify-content-center">
          <template x-for="coche in paginatedCoches" :key="coche.id">
            <div class="col-11 card col-sm-5 col-lg-3 mt-1" >
              <img :src="'{{ asset('') }}' + coche.foto" class="card-img-top w-100 mt-1 rounded" style="height: 11em" alt="fotoCoche" />
              <div class="card-body">
                <h5 class="card-title" x-text="coche.marca + ' ' + coche.modelo"></h5>
                <div class="card-text">
                  <h6>Precio por día: <small x-text="coche.precio + '€'">€</small></h6>
                  <p>Matrícula: <small x-text="coche.matricula"></small></p>
                </div>
                <a :href="'coche/'+coche.id"  class="btn btn-outline-warning text-center">Ver</a>

              </div>
            </div>
          </template>


      </div>
<script>

</script>

</x-admin-layout>
