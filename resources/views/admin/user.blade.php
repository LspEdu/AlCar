<x-admin-layout>
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
                            <a href="mailto:{{ $user->email }}" class="text-muted mb-0">{{ $user->email }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Teléfono</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->tlf }} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Fecha de Nacimiento</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->fechNac }} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Dirección</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->direccion ?? 'Desconocida' }}</p>
                        </div>
                    </div>
                    <hr>
                    @if ($user->activo)
                    <div class="row">
                        <div class="col ">
                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                Borrar Usuario
                            </x-danger-button>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col text-danger">
                            <p>Este usuario ha sido eliminado</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.usuario-destroy', ['id' => $user->id ]) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    ¿Estás seguro de borrar este usuario?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                   Debes avisar antes al usuario. Una vez borres este usuario, todos sus coches serán desvalidados y desactivados. Sus facturas seguirán teniendo constancia.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Borrar Cuenta') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
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
                                            <a class="link link-secondary" :href="'/admin/coche/' + item.id"
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
                <div class="col-12">
                    @forelse ($user->facturas as $factura)
                            @php($facturasDueño[] = $factura)
                    @empty
                            @php($facturasDueño = [])
                    @endforelse
                    <div class="card mb-4 shadow mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-gray-900 fs-3 font-italic me-1">Últimas facturas</span>
                            </p>

                             @forelse ($facturasDueño as $factura)
                                @if ($loop->iteration <= 5)
                                    <a class="link link-secondary" target="_blank"
                                        href="{{ route('factura.show', ['id' => $factura->id]) }}">Factura
                                        {{ $factura->codigo }} | {{ $factura->coche->marca }}
                                        {{ $factura->coche->modelo }} | {{ $factura->FechaInicio }} </a>
                                    @if (!$loop->last )
                                        <hr>
                                    @endif
                                @endif
                                @empty
                                    <p>Este usuario no tiene facturas a su nombre</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
