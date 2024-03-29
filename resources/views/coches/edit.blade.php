<x-app-layout>
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            Editar Coche
        </h2>
    </x-slot>
    <form method="POST" id="edit" action="{{ route('coche.update', ['id' => $coche->id]) }}" enctype="multipart/form-data">
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
            <h3 class="col-12 text-center mt-3 mb-3 ">
                Datos del coche
                <hr>
            </h3>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-sm" name="marca" id="marca"
                        value="{{ $coche->marca }}">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('marca')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-sm" name="modelo" id="modelo"
                        value="{{ $coche->modelo }}">
                    <x-input-error class="mt-2" :messages="$errors->get('modelo')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="ano" class="form-label">Año Matriculación</label>
                    <input type="date" class="form-control shadow-sm" name="ano" id="ano"
                        value="{{ $coche->ano }}">
                    <x-input-error class="mt-2" :messages="$errors->get('ano')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="cilindrada" class="form-label">Cilindrada</label>
                    <input type="text" class="form-control shadow-sm" name="cilindrada" id="cilindrada"
                        value="{{ $coche->cilindrada }}">
                    <x-input-error class="mt-2" :messages="$errors->get('cilindrada')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="cambio" class="form-label">Cambio<span class="text-danger">*</span></label>
                    <select class="form-control shadow-sm " name="cambio" id="cambio" placeholder="">
                        @foreach ($cambio as $cambio)
                            <option @if ($cambio == $coche->cambio) selected @endif value="{{ $cambio }}">
                                {{ $cambio }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('cambio')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="motor" class="form-label">Motor</label>
                    <input type="text" class="form-control shadow-sm" name="motor" id="motor"
                        value="{{ $coche->motor }}">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('motor')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="combustible" class="form-label">Combustible</label>
                    <select class="form-control shadow-sm" name="combustible" id="combustible">
                        @foreach ($combustibles as $combustible)
                            <option value="{{ $combustible }}">{{ $combustible }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('combustible')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" class="form-control shadow-sm" name="matricula" id="matricula"
                        value="{{ $coche->matricula }}">
                    <x-input-error class="mt-2" :messages="$errors->get('matricula')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
                    <select class="form-control shadow-sm" required name="tipo" id="tipo">
                        @foreach ($tipos as $tipo)
                            <option @if ($tipo == $coche->tipo) selected @endif value="{{ $tipo }}">
                                {{ $tipo }}</option>
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
                            <option @if ($coche->plazas == $value) selected @endif value="{{ $value }}">
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('plazas')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control shadow-sm" name="color" id="color"
                        value="{{ $coche->color }}" placeholder="">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('color')" />
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio por día<span class="text-danger">*</span></label>
                    <input type="number" min="1" class="form-control shadow-sm text-end" name="precio"
                        id="precio" value="1" value="{{ $coche->precio }}">
                    <x-input-error class="mt-2" :messages="$errors->get('precio')" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="km" class="form-label">Kilometraje</label>
                    <input type="number" min="1" class="form-control shadow-sm  text-end" name="km"
                        id="km" value="{{ $coche->km }}">
                    <x-input-error class="mt-2" :messages="$errors->get('km')" />
                </div>
            </div>
            <div class="col-12 col-md-3 text-center mt-2 mb-2">
                <label class="form-label fs-5 " for="foto">Nueva Foto del Coche<span
                        class="text-danger">*</span></label><br>
                <input class="text-center w-full border rounded shadow-sm" accept="image/*" type="file"
                    name="foto" id="foto">
                <x-input-error class="mt-2" :messages="$errors->get('foto')"></x-input-error>
            </div>
            <div class="col-12 col-md-3">
                <div class="mb-3">
                    <label for="activo" class="form-label">Mostrar el coche en la web</label>
                    <input type="checkbox" min="1"  class=" w-10 shadow-sm " name="activo"
                        id="activo" checked />
                    <x-input-error class="mt-2" :messages="$errors->get('activo')" />
                </div>
            </div>
            <div class="col-12 gap-1 justify-content-center flex-row-reverse row">
                <hr>
                <x-primary-button class="col-12 col-md-3  m-2 mb-3" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'maps')">
                    {{ __('Editar') }}
                </x-primary-button>
            </div>
        </div>
            <x-modal name="maps" class="">
                <h1 class="text-center">Lugar de Recogida</h1>
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
                <label for="site" class="form-label ms-2">Introduce la dirección del lugar de recogida y mira el
                    mapa para
                    saber si es correcto</label>
                <input id="pac-input" class="controls" name="search" type="text" placeholder="Search Box" />
                <div id="map"></div>
                <x-primary-button class="col-12 col-md-3  m-2 mb-3">
                    {{ __('Editar') }}
                </x-primary-button>
            </x-modal>
    </form>



    <script defer>
        let lat = 36.78837,
            lng = -6.34085;


        function initAutocomplete() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 36.78837,
                    lng: -6.34085
                },
                zoom: 13,
                mapTypeId: "roadmap",
                mapTypeControl: false,
            });
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            let markers = [];

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };

                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );
                    lat = place.geometry.location.lat();
                    lng = place.geometry.location.lng();
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        document.getElementById('edit').addEventListener('submit', () => {
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        });

        window.initAutocomplete = initAutocomplete;
    </script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initAutocomplete&libraries=places&v=weekly">
    </script>
</x-app-layout>
