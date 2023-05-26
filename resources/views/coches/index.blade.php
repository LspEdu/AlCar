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
        <div class="col-12 col-md-6 bg-white rounded shadow">
            <div class="card mt-2 border-0">
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
                                    <td class="text-end">{{ $coche->cambio }}</td>
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
        <form method="POST" class="col-12 col-md-4 bg-white rounded h-fit shadow"
            action="{{ route('coche.alquilar', ['id' => $coche->id]) }}">
            @csrf
            <div class="row mt-3 justify-content-around">
                <div class="col-12 col-md-5">
                    <label class="form-label fs-5 fw-bold" for="fechaInicio">Fecha Inicio </label>
                    <input class="form-control" type="date" name="fechaInicio" id="fechaInicio">
                    <x-input-error class="mt-2" :messages="$errors->get('fechaInicio')" />
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label fs-5 fw-bold" for="fechaFin">Fecha Fin </label>
                    <input class="form-control" type="date" name="fechaFin" id="fechaFin">
                    <x-input-error class="mt-2" :messages="$errors->get('fechaFin')" />
                </div>

            </div>
            <hr>
            <div class="row justify-around">
                <div class="col-12">
                    <h4>Coste total </h4>
                </div>
                @if (Auth::user()->id == $coche->user_id)
                    <a class="btn btn-outline-warning w-25 mt-2 fs-4"
                        href="{{ route('coche.edit', ['id' => $coche->id]) }}">Editar</a>
                @else
                    <input type="submit" value="Alquilar" class="btn btn-outline-success w-25 mb-5 mt-2">
                @endif
                <input type="text" id="precio"
                    class="form-input col-6 text-right m-2 border-2 mb-5  focus-outline-success rounded bg-slate-200 text-success fw-bolder fs-4"
                    value=" {{ $coche->precio }}€" readonly>
            </div>
        </form>
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
                    if(fechaInicioPicker.selectedDates[0])inputPrecio.value = precio * (Math.round((selectedDates[0] - fechaInicioPicker.selectedDates[0]) / (24 * 60 * 60 * 1000)) + 1) + "€"
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
