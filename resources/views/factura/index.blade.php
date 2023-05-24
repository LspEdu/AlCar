<x-app-layout>
    <div class="row row-cols-1 bg-white rounded mt-3 justify-content-center max-h-5/6 overflow-y-auto">
        <div class="col-12 text-center">
            <h2>Facturas</h2>
            <h4 class="text-muted">Aquí están todas tus facturas</h4>
            <hr>
        </div>
        <div class="col-11 text-sm md:text-base mb-2">
            @forelse ($facturas as $factura)
                <div class="row">
                    <div class="col ">
                        {{ $factura->coche->marca }}
                        {{ $factura->coche->modelo }}
                    </div>
                    <div class="col">
                        <a class="text-muted" href="{{route('coche.show',['id' => $factura->coche->id])}}">
                            {{ $factura->coche->matricula }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-muted" href="{{route('profile.show', ['id' => $factura->coche->user->id])}}">
                            {{ $factura->coche->user->email }}
                        </a>
                    </div>
                    <div class="col text-center fs-5 align-middle bg-lime-100 rounded">
                        {{ $factura->importe }} €
                    </div>
                    <div class="col text-center">
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                            href="{{ route('factura.show', ['id' => $factura->id]) }}">Descargar</a>
                    </div>
                    @if (!$loop->last)
                        <hr class="mt-2 mb-2">
                    @endif
                </div>
            @empty
                <h3 class="text-center">No tienes niguna factura. ¡Empieza a alquilar ya!</h3>
            @endforelse

        </div>
    </div>
</x-app-layout>
