<x-app-layout>
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            Editar Coche
        </h2>
    </x-slot>
    <form method="POST" action="{{route('coche.update', ['id' => $coche->id])}}" >
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger col-12">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="row gap-1 row-cols-3 justify-content-around bg-white rounded m-4 h-75">
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
                  <input type="text"
                    class="form-control" name="marca" id="marca"  value="{{$coche->marca}}">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('marca')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
                  <input type="text"
                    class="form-control" name="modelo" id="modelo" value="{{$coche->modelo}}">
                    <x-input-error class="mt-2" :messages="$errors->get('modelo')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="ano" class="form-label">Año Matriculación</label>
                  <input type="date"
                    class="form-control" name="ano" id="ano" value="{{$coche->ano}}">
                    <x-input-error class="mt-2" :messages="$errors->get('ano')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="cilindrada" class="form-label">Cilindrada</label>
                  <input type="text"
                    class="form-control" name="cilindrada" id="cilindrada" value="{{$coche->cilindrada}}">
                    <x-input-error class="mt-2" :messages="$errors->get('cilindrada')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="cambio" class="form-label">Cambio<span class="text-danger">*</span></label>
                    <select class="form-control shadow-sm" name="cambio" id="cambio" placeholder="">
                        @foreach ($cambio as $cambio)
                            <option @if ($cambio == $coche->cambio)
                                selected
                            @endif value="{{ $cambio }}">{{ $cambio }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('cambio')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="motor" class="form-label">Motor</label>
                  <input type="text"
                    class="form-control" name="motor" id="motor" value="{{$coche->motor}}">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('motor')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="combustible" class="form-label">Combustible</label>
                  <select class="form-control" name="combustible" id="combustible">
                    @foreach ($combustibles as $combustible)
                    <option value="{{$combustible}}">{{$combustible}}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('combustible')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="matricula" class="form-label">Matrícula</label>
                  <input type="text"
                    class="form-control" name="matricula" id="matricula" value="{{$coche->matricula}}">
                    <x-input-error class="mt-2" :messages="$errors->get('matricula')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
                  <select class="form-control" required name="tipo" id="tipo">
                    @foreach ($tipos as $tipo)
                    <option @if ($tipo == $coche->tipo) selected @endif value="{{$tipo}}">{{$tipo}}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="plazas" class="form-label">Plazas</label>
                    <select class="form-control" name="plazas" id="plazas">
                        @foreach (range(1,8) as $value)
                            <option @if ($coche->plazas == $value) selected @endif value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('plazas')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" id="color"
                        placeholder="">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('color')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio por día<span class="text-danger">*</span></label>
                    <input type="number" min="1" class="form-control text-end" name="precio" id="precio"
                        value="1">
                        <x-input-error class="mt-2" :messages="$errors->get('precio')" />
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Editar" class="btn">
            </form>
            <form method="POST" action="{{route('coche.delete', ['id' => $coche->id])}}">
                @csrf
                @method('delete')

                <input type="submit" value="Eliminar" class="btn btn-danger">
            </form>
            </div>
        </div>
</x-app-layout>