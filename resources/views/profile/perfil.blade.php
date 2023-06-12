<x-app-layout>
    @csrf
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="row pt-2">
        <div class="col-lg-5">
            <div class="card mb-4 shadow">
                <div class="card-body text-center row">
                    <div class="row mb-2">
                        <img src="{{ asset($user->avatar ?? 'storage/webo.jpg') }}" alt="avatar" class="rounded col-6"
                            style="width: 150px;">
                        <h5 class="my-3 col-6">{{ $user->name }} <br> {{ $user->ape1 }}
                            {{ $user->ape2 }}</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            @if ($facturado)
                            <a href="mailto:{{ $user->email }}" class="text-muted mb-0">{{ $user->email }}</a>
                            @else
                            <p class="text-muted">Oculto</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Teléfono</p>
                        </div>
                        <div class="col-sm-9">
                            @if ($facturado)
                            <p class="text-muted mb-0">{{ $user->tlf }} </p>
                            @else
                            <p class="text-muted">Oculto</p>
                            @endif

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Dirección</p>
                        </div>
                        <div class="col-sm-9">
                            @if ($facturado)
                            <p class="text-muted mb-0">{{ $user->direccion ?? 'Desconocida' }}</p>
                            @else
                            <p class="text-muted">Oculto</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="row gap-2">
                <div class="col-12">
                    <div class="card mb-4 shadow mb-md-0">
                        <div class="card-body">
                            <div x-data="{
                                items: {{ $user->coches }},
                                currentPage: 1,
                                pageSize: 5,
                                getItems: function() {
                                    var start = (this.currentPage - 1) * this.pageSize;
                                    var end = start + this.pageSize;
                                    return this.items.slice(start, end);
                                },
                                totalPages: function() {
                                    return Math.ceil(this.items.length / this.pageSize);
                                },
                                goToPage: function(page) {
                                    if (page >= 1 && page <= this.totalPages()) {
                                        this.currentPage = page;
                                    }
                                },
                                previousPage: function() {
                                    this.goToPage(this.currentPage - 1);
                                },
                                nextPage: function() {
                                    this.goToPage(this.currentPage + 1);
                                }
                            }">
                                <h1 class="text-center text-3xl font-bold my-6">Lista de Coches</h1>
                                <ul>
                                    <template x-for="item in getItems()" :key="item.id">
                                        <li class="py-2">
                                            <a class="link link-secondary" :href="'/coche/' + item.id"
                                                x-text="item.marca + ' ' + item.modelo + ' - ' + item.matricula"></a>
                                        </li>
                                    </template>
                                    <li x-show="totalPages() === 0"> No hay ningún coche </li>
                                </ul>
                                <div class="flex justify-center items-center mt-6">
                                    <button x-on:click="previousPage()" x-show="totalPages() !== 0"
                                        :disabled="currentPage === 1" class="px-4   text-gray-700 rounded-l">
                                        <span class="material-symbols-outlined">
                                            navigate_before
                                        </span>
                                    </button>
                                    <div class="px-4 py-1  text-gray-700" x-show="totalPages() !== 0">
                                        <span x-text="currentPage"></span> de <span x-text="totalPages()"></span>
                                    </div>
                                    <button x-on:click="nextPage()" x-show="totalPages() !== 0"
                                        :disabled="currentPage === totalPages()"
                                        class="px-4 py-1  text-gray-700 rounded-r">
                                        <span class="material-symbols-outlined">
                                            navigate_next
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
