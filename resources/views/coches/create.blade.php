<x-app-layout>
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            Registrar Coche
        </h2>
    </x-slot>
    <form method="post" action="{{ route('coche.store') }}">
        @csrf
        <div class="row gap-1 row-cols-3 justify-content-around bg-white rounded m-4">
            <h3 class="col-12 text-center mt-3 mb-3 ">
                ¡Hora de Alquilar!
                <hr>
            </h3>

            @if ($errors->any())
                <div class="alert alert-danger col-12">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-sm" name="marca" required id="marca"
                        placeholder="">
                    <x-input-error class="mt-2" :messages="$errors->get('marca')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-sm" name="modelo" required id="modelo"
                        placeholder="">
                    <x-input-error class="mt-2" :messages="$errors->get('modelo')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="ano" class="form-label">Año Matriculación</label>
                    <input type="date" class="form-control shadow-sm" name="ano" id="ano" placeholder="">
                    <x-input-error class="mt-2" :messages="$errors->get('ano')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="cilindrada" class="form-label">Cilindrada</label>
                    <input type="text" class="form-control shadow-sm" name="cilindrada" id="cilindrada"
                        placeholder="">
                    <x-input-error class="mt-2" :messages="$errors->get('cilindrada')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="cambio" class="form-label">Cambio<span class="text-danger">*</span></label>
                    <select class="form-control shadow-sm" name="cambio" id="cambio" placeholder="">
                        @foreach ($cambio as $cambio)
                            <option value="{{ $cambio }}">{{ $cambio }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('cambio')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="motor" class="form-label">Motor</label>
                    <input type="text" class="form-control shadow-sm" name="motor" id="motor"
                        placeholder="1.9TDI, 2.0 etc...">
                    <x-input-error class="mt-2" :messages="$errors->get('motor')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="combustible" class="form-label">Combustible</label>
                    <select class="form-control shadow-sm" name="combustible" id="combustible" placeholder="">
                        @foreach ($combustibles as $combustible)
                            <option value="{{ $combustible }}">{{ $combustible }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('combustible')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula<span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-sm" required name="matricula" id="matricula">
                    <x-input-error class="mt-2" :messages="$errors->get('matricula')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
                    <select class="form-control shadow-sm" required name="tipo" id="tipo">
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="plazas" class="form-label">Plazas</label>
                    <select class="form-control shadow-sm" name="plazas" id="plazas">
                        @foreach (range(1, 8) as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('plazas')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control shadow-sm" name="color" id="color"
                        placeholder="">
                    <x-input-error class="mt-2" :messages="$errors->get('color')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio por día<span class="text-danger">*</span></label>
                    <input type="number" min="1" class="form-control shadow-sm text-end" name="precio"
                        id="precio" value="1">
                    <x-input-error class="mt-2" :messages="$errors->get('precio')" />
                </div>
            </div>
            <div class="col-12 gap-1 justify-content-center flex-row-reverse row">
                <hr>
                <x-primary-button class="col-12 col-md-3  m-2 mb-3">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </div>

    </form>
</x-app-layout>
