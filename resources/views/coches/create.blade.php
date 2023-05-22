<x-app-layout>
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            Registrar Coche
        </h2>
    </x-slot>
    <form action="">

        <div class="row gap-1 row-cols-3 justify-content-around bg-white rounded m-4">
            <h3 class="col-12 text-center mt-3 mb-3 ">
                ¡Hora de Alquilar
            </h3>
            <div class="col-12 col-md-5">
                <div class="mb-3">
                  <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
                  <input type="text"
                    class="form-control" name="marca" id=""marca placeholder="">
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="mb-3">
                  <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
                  <input type="text"
                    class="form-control" name="modelo" id="modelo" placeholder="">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="ano" class="form-label">Año Matriculación</label>
                  <input type="date"
                    class="form-control" name="ano" id="ano" placeholder="">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="cilindrada" class="form-label">Cilindrada</label>
                  <input type="text"
                    class="form-control" name="cilindrada" id="cilindrada" placeholder="">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="motor" class="form-label">Motor</label>
                  <input type="text"
                    class="form-control" name="motor" id="motor" placeholder="1.9TDI, 2.0 etc...">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="combustible" class="form-label">Combustible</label>
                  <select class="form-control" name="combustible" id="combustible" placeholder="">
                    @foreach ($combustibles as $combustible)
                    <option value="{{$combustible}}">{{$combustible}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="cilindrada" class="form-label">Cilindrada</label>
                  <input type="text"
                    class="form-control" name="cilindrada" id="cilindrada" placeholder="">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                  <label for="motor" class="form-label">Motor</label>
                  <input type="text"
                    class="form-control" name="motor" id="motor" placeholder="1.9TDI, 2.0 etc...">
                </div>
            </div>
        </div>

    </form>
</x-app-layout>
