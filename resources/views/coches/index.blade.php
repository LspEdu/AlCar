<x-app-layout>
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
                    valide tu coche!</p>
                </div>
            @endif
        @endif


    </x-slot>
    <div class="mt-4 mt-md-2 row gap-2 justify-content-around ms-1 me-1">
        <div class="col-12 col-md-6 bg-white rounded ">
            <div class="card mt-2 border-0">
                <h2 class="card-title m-2 fw-bold ">{{ $coche->marca }} {{ $coche->modelo }} </h2>
                <img class="card-img-top" src="{{ asset('build/assets/img/audiA7.png') }}" alt="Title">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
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
        <form class="col-12 col-md-4 bg-white rounded">
            @csrf
            <div class="row ">
                Aquí va el calendario con JS
                <img src="{{ asset('build/assets/img/calendario.png') }}" alt="">
            </div>
            <hr>
            <div class="row justify-around">
                <div class="col-12">
                    <h4>Coste total por día</h4>
                </div>
                @if (Auth::user()->id == $coche->user_id)
                    <a class="btn btn-outline-warning w-25 mt-2 fs-4"
                        href="{{ route('coche.edit', ['id' => $coche->id]) }}">Editar</a>
                @else
                    <input type="submit" value="Alquilar" class="btn btn-outline-success w-25 mt-2">
                @endif
                <input id="precio"
                    class="form-input col-6 text-right m-2 border-2  focus-outline-success rounded bg-slate-200 text-success fw-bolder fs-4"
                    value=" {{ $coche->precio }}€" readonly>
            </div>
        </form>
    </div>

</x-app-layout>
