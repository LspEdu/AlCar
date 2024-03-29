<x-admin-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ $coche->marca }} {{ $coche->modelo }} || Estado de validación
            <a href="{{ route('admin.validar', ['id' => $coche->id]) }}"
                @if ($coche->validado) class="bg-success btn text-light">Activado
                @else
                class="bg-danger btn text-light" >Desactivado @endif
                </a>
        </h2>
    </x-slot>
    <div class="mt-4 mt-md-2 row gap-2 justify-content-around ms-1 me-1">
        <div class="col-12 col-md-6 bg-white rounded shadow">
            <div class="card mt-2 border-0 align-middle">
                <h2 class="card-title m-2 fw-bold ">{{ $coche->marca }} {{ $coche->modelo }} </h2>
                <div class="card-body">
                    <img class="card-img-top img-fluid shadow" src="{{ asset($coche->foto) }}" style=" height: 20em"
                        alt="Title">
                    <div class="table-responsive mt-2">
                        <table class="table table-light table-hover fs-5">
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Marca</td>
                                    <td class="text-end">{{ $coche->marca }}</td> {{-- TODO:: PONER LINK PARA BUSQUEDA CON FILTRO --}}
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Modelo</td>
                                    <td class="text-end">{{ $coche->modelo }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Motor</td>
                                    <td class="text-end">{{ $coche->motor ?? 'Desconocido' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Cambio</td>
                                    <td class="text-end">{{ ucfirst($coche->cambio) }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Año de Matriculación</td>
                                    <td class="text-end">{{ $coche->ano }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Matrícula</td>
                                    <td class="text-end">{{ $coche->matricula }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Combustible</td>
                                    <td class="text-end">{{ ucfirst($coche->combustible) ?? 'Desconocido' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Cilindrada</td>
                                    <td class="text-end">{{ $coche->cilindrada ?? 'Desconocida' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Tipo</td>
                                    <td class="text-end">{{ ucfirst($coche->tipo) }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Kilómetros</td>
                                    <td class="text-end">{{ $coche->km ?? 'Desconocidos' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Plazas</td>
                                    <td class="text-end">{{ $coche->plazas ?? 'Desconocidas' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Color</td>
                                    <td class="text-end">{{ $coche->color ?? 'Desconocido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-top-0 text-center">
                        <x-danger-button x-data=""  x-on:click.prevent="$dispatch('open-modal', 'confirm-coche-deletion')">Eliminar Coche</x-danger-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4  rounded h-fit ">
            <div class="card text-start">
                <h3 class="card-title  mt-2 text-center"><a
                        href="{{ route('admin.usuario', ['id' => $coche->user->id]) }}"
                        class="link link-secondary">Dueño del Coche</a></h3>
                <div class="card-body row">
                    <img src="/{{ $coche->user->avatar ?? 'storage/webo.jpg' }}" alt="No tiene foto"
                        class="img-fluid h-25 col-3">
                    <div class="col-9">
                        <p>Nombre : {{ $coche->user->name }}</p>
                        <p>Apellidos : {{ $coche->user->ape1 }} {{ $coche->user->ape2 }}</p>
                        <p><a href="mailto:{{ $coche->user->email }}"> Correo : {{ $coche->user->email }}</a></p>
                        <p>Teléfono : {{ $coche->user->tlf }}</p>
                        <p>Estado : {{ $coche->user->activo ? 'Activo' : 'Desactivado' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 bg-white rounded mt-2 p-2 h-fit shadow">
                <h3 class="text-center pt-2">Ubicación de recogida del coche</h3>
                <hr>
                <div id="map" class="shadow pb-2 rounded"></div>
            </div>
        </div>
    </div>

    <script defer>
        let fin,
            precio = {{ $coche->precio }};
        const inputPrecio = document.getElementById('precio');



        document.addEventListener('DOMContentLoaded', function() {
            const fechaInicioPicker = flatpickr('#fechaInicio', {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates) {
                    fin = new Date(selectedDates[0].setDate(selectedDates[0].getDate() + 1));
                    fechaFinPicker.set('minDate', fin);

                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                disable: [
                    @foreach ($coche->facturas as $factura)
                        {
                            from: "{{ $factura->FechaInicio }}",
                            to: "{{ $factura->FechaFin }}"
                        },
                    @endforeach

                ],
            });
            const fechaFinPicker = flatpickr('#fechaFin', {
                dateFormat: "Y-m-d",
                minDate: 'today',
                onChange: function(selectedDates) {
                    if (fechaInicioPicker.selectedDates[0]) inputPrecio.value = precio * (Math.round((
                        selectedDates[0] - fechaInicioPicker.selectedDates[0]) / (24 * 60 *
                        60 * 1000)) + 1) + "€"
                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                disable: [
                    @foreach ($coche->facturas as $factura)
                        {
                            from: "{{ $factura->FechaInicio }}",
                            to: "{{ $factura->FechaFin }}"
                        },
                    @endforeach

                ],
            });
        });
    </script>
        <script>
            function initMap() {
                const myLatLng = {
                    lat: {{ $coche->lat }},
                    lng: {{ $coche->lng }}
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: myLatLng,
                });

                new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: "Aquí se encuentra el coche",
                });
            }

            window.initMap = initMap;
        </script>
        <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&v=weekly"></script>

    <x-modal name="confirm-coche-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.coche-destroy', ['id' => $coche->id]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                ¿Estás seguro de borrar este coche?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Debes avisar antes al usuario. Una vez borres este coche estará desactivado, dejándo de estar disponible para su alquiler. Sus facturas seguirán teniendo constancia.
            </p>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Confirmar') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-admin-layout>
