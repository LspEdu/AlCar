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
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                        ¡Está todo correcto! Si cambias algún dato, deberás esperar de nuevo una validación.
                    </p>
                </div>
            @else
                <div class="bg-warning rounded">
                    <p class="ms-2 text-white fs-4  rounded  align-middle">
                        <span class="material-symbols-outlined fs-1">report</span>
                        ¡Perfecto!, Ahora toca esperar a que un administrador
                        valide tu coche!
                    </p>
                </div>
            @endif
        @endif
    </x-slot>
    <div class="mt-4 mt-md-2 row gap-2 justify-content-around ms-1 me-1">
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
                                    <td class="text-end">{{ $coche->ano }}</td>
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

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 row flex-col gap-1">

            <div class="col-12  bg-white rounded h-fit shadow">


                <form method="POST" x-data="{ pago: 'efectivo' }"
                    action="{{ route('coche.alquilar', ['id' => $coche->id]) }}">
                    @csrf
                    <div class="row mt-3 justify-content-around">
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
                        <label for="pago" class="col-12 fs-4">¿Cómo deseas pagar?</label>
                        <select x-model="pago" name="pago" id="pago" class="form-select  m-2 w-50  ">
                            <option selected value="efectivo">Efectivo</option>
                            @foreach (Auth::user()->paymentMethods() as $metodo)
                                <option value="{{ $metodo->card->last4 }}">Tarjeta - {{ $metodo->card->last4 }}
                                </option>
                            @endforeach
                        </select>



                        <div class="col-12 pt-1 justify-content-around">
                            <h4>Coste total </h4>
                            <input type="submit" @if (Auth::user()->id == $coche->user_id) disabled @endif value="Alquilar"
                                class="btn btn-outline-success w-25 h-50 mb-2 mt-2">
                            <input type="text" id="precio"
                                class="form-input col-6 text-right m-2 border-2 mb-2  focus-outline-success rounded bg-slate-200 text-success fw-bolder fs-4"
                                value=" {{ $coche->precio }}€" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 bg-white rounded h-fit shadow">
                <h3 class="text-center pt-2">Ubicación de recogida del coche</h3>
                <div id="map" class="shadow pb-2"></div>
            </div>

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
            localStorage.setItem('UltimoCoche', "{{ $coche->id }}")

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



</x-app-layout>
