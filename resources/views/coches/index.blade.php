<x-app-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ $coche->marca }} {{ $coche->modelo }}
        </h2>

        @if (Auth::user()->id == $coche->user_id)
            @if ($coche->validado)
                <div class="bg-success rounded">

                    <p class=" text-white fs-4 bg-success rounded  align-middle">

                        ¡Está todo correcto! Si cambias algún dato, deberás esperar de nuevo una validación.
                    </p>
                </div>
            @else
                <div class="bg-warning rounded">
                    <p class="ms-2 text-white fs-4  rounded  align-middle">
                        ¡Perfecto!, Ahora toca esperar a que un administrador
                        valide tu coche!
                    </p>
                </div>
            @endif
        @endif

    </x-slot>
    <div class="mt-4 mt-md-2 row gap-3 justify-content-evenly ">
        <div class="col-12 col-lg-6 bg-white rounded shadow">
            <div class="card mt-2 border-0">
                <h2 class="card-title m-2 fw-bold ">{{ $coche->marca }} {{ $coche->modelo }}@if (Auth::user()->id == $coche->user_id)
                        <a class="align-middle mb-5 mt-2 fs-4"
                            href="{{ route('coche.edit', ['id' => $coche->id]) }}"><span
                                class="material-symbols-outlined">
                                edit
                            </span></a>
                    @endif
                </h2>
                <div class="card-body">
                    <img class="card-img-top img-fluid shadow" src="{{ asset($coche->foto) }}" style=" height: 20em"
                        alt="Title">
                    <div class="table-responsive mt-2">
                        <table class="table table-light table-hover fs-5">
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Marca</td>
                                    <td class="text-end">{{ $coche->marca }}</td>
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
                                    <td class="text-end">{{ $coche->cambio }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Año de Matriculación</td>
                                    <td class="text-end">{{ $coche->ano ?? 'Desconocido' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Matrícula</td>
                                    <td class="text-end">{{ $coche->matricula }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Combustible</td>
                                    <td class="text-end">{{ $coche->combustible ?? 'Desconocido' }}</td>
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
        <div class="col-12 col-lg-4 row flex-col p-0 gap-3">

            <div class="col-12  bg-white rounded h-fit shadow">


                <form method="POST" x-data="{ pago: 'efectivo' }"
                    action=" @if (Auth::user()->id == $coche->user_id) {{ route('coche.reservar', ['id' => $coche->id]) }} @else {{ route('coche.alquilar', ['id' => $coche->id]) }} @endif">
                    @csrf

                    <div class="row mt-3 justify-content-center p-2">
                        <div class="col-12 col-lg-5">
                            <label class="form-label fs-5 fw-bold" for="fechaInicio">Fecha Inicio </label>
                            <input class="form-control" required type="date" name="fechaInicio" id="fechaInicio">
                            <x-input-error class="mt-2" :messages="$errors->get('fechaInicio')" />
                        </div>
                        <div class="col-12 col-lg-5">
                            <label class="form-label fs-5 fw-bold" for="fechaFin">Fecha Fin </label>
                            <input class="form-control" required type="date" name="fechaFin" id="fechaFin">
                            <x-input-error class="mt-2" :messages="$errors->get('fechaFin')" />
                        </div>

                    </div>
                    <hr>
                    <div class="row p-2">
                        @if (Auth::user()->id != $coche->user_id)
                            <label for="pago" class="col-12 fs-4">¿Cómo deseas pagar?</label>
                            <select x-model="pago" name="pago" id="pago" class="form-select c m-2 w-50  ">
                                <option selected value="efectivo">Efectivo</option>
                                @foreach (Auth::user()->paymentMethods() as $metodo)
                                    <option value="{{ $metodo->card->last4 }}">Tarjeta - {{ $metodo->card->last4 }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                        <div class="col-12 pt-1 justify-content-around">
                            @if (Auth::user()->id != $coche->user_id)
                                <h4>Coste total </h4>
                            @endif
                            <input type="submit"
                                value="@if (Auth::user()->id == $coche->user_id) Bloquear fechas @else Alquilar @endif "
                                class="btn btn-outline-success  ">
                            @if (Auth::user()->id != $coche->user_id)
                                <input type="text" id="precio"
                                    class="form-input col-6 text-right m-2 border-2 mb-2  focus-outline-success rounded bg-slate-200 text-success fw-bolder fs-4"
                                    value=" {{ $coche->precio }}€" readonly>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 bg-white rounded p-2 h-fit shadow">
                <h3 class="text-center pt-2">Ubicación de recogida del coche</h3>
                <hr>
                <div id="map" class="shadow pb-2 rounded"></div>
            </div>
            @if (Auth::user()->id == $coche->user_id)
            <div class="col-12 card bg-white rounded p-2 overflow-y-auto h-fit shadow">
                <h3 class="card-title text-center pt-2">Días reservados para ti</h3>
                <div class="card-body overflow-y-auto max-h-72">
                    <table class="table table-responsive table-hover overflow-y-auto text-center">
                        <thead class="sticky">
                            <tr>
                                <th>Día Inicio</th>
                                <th>Día Fin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coche->facturas()->whereNull('user_id')->get() as $factura)
                                <tr>
                                    <td>{{$factura->FechaInicio}}</td>
                                    <td>{{$factura->FechaFin}}</td>
                                    <form method="POST" action="{{route('factura.cancelar', ['codigo' => $factura->codigo])}}" >
                                        @csrf
                                        <td><x-danger-button>Cancelar</x-danger-button></td>
                                    </form>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="font-bold">No has reservado ningún día</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

    </div>
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

    <script defer>
        let fin,
            precio = {{ $coche->precio }};
        const inputPrecio = document.getElementById('precio');



        document.addEventListener('DOMContentLoaded', function() {
            localStorage.setItem('UltimoCoche', "{{ $coche->id }}");
            document.cookie = 'UltimoCoche=' + {{ $coche->id }} + ';path=/';

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
    <x-modal name="confirm-coche-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.coche-destroy', ['id' => $coche->id]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                ¿Estás seguro de borrar este coche?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Las facturas que estén vigentes deben de haber sido canceladas antes. Si solo quieres dejar de alquilarlo más, edita tu coche para que deje de mostrarse a otros usuarios. Esta opción no es reversible.
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


</x-app-layout>
