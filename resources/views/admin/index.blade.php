<x-admin-layout>
    <div class="bg-white mt-4 rounded max-h-full">
        <div class="row text-center">
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
            <h4 class="col-12 text-center">Quedan {{ $numCoches }} coches por validar</h4>
        </div>
        <hr>
        <div class="row justify-center mh-25">
            <div class="col-12 col-md-8 h-25 mb-5">
                <div class="table-responsive max-h-96 text-xs md:text-base overflow-y-auto border rounded shadow">
                    <table class="table overflow-y-auto table-hover">
                        <thead>
                            <tr valign="top">
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Matrícula</th>
                                <th scope="col">Dueño</th>
                                {{--     TODO:: mailto:correo con motivos
                                <th scope="col" class="text-center">Cancelar</th> --}}
                                <th scope="col" class="text-center">Validar</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($cochesInvalidados as $coche)
                                <tr>
                                    <td>{{ $coche->marca }}</td>
                                    <td>{{ $coche->modelo }}</td>
                                    <td>{{ $coche->matricula }}</td>
                                    <td>{{ $coche->user->email }}</td>
                                    {{--  <td align="middle" class="justify-items-center"><button class="btn btn-danger">X</button></td> --}}
                                    <td align="middle"><a href="{{route('admin.validar', [
                                        'id' => $coche->id,
                                    ])}}" class="btn btn-success"><span
                                                class="material-symbols-outlined">
                                                done
                                            </span></a></td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
