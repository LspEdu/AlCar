<x-app-layout>
    <div class="row justify-content-around">

        <div
            class="col-12 col-md-5 row row-cols-1 bg-white rounded mt-3 justify-content-center max-h-5/6 overflow-y-auto">
            <div class="col-12 text-center pt-2">
                <h2>Facturas</h2>
                <h4 class="text-muted">Aquí están todas tus facturas</h4>
                <h6 class="text-muted">Si quedan más de 5 días para el alquiler, puedes reembolsar el dinero que has pagado a la tarjeta que usaste.</h6>
                <hr>
            </div>
            @if (session('success'))
                <div class="col-12 bg-success rounded text-center">
                    <h3 class="text-light">{{session('success')}}</h3>
                </div>
            @endif
            @if (session('error'))
            <div class="col-12 bg-red">
                <p class="text-light">{{session('error')}}</p>
            </div>
        @endif
            <div class="col-11 max-h-[40rem] text-sm md:text-base mb-2 overflow-y-auto">
                @forelse ($facturas as $factura)
                    <div class="row">
                        <div class="col-4 ">
                            {{ $factura->coche->marca }}
                            {{ $factura->coche->modelo }}
                        </div>
                        <div class="col-4">
                            <a class="text-muted" href="{{ route('coche.show', ['id' => $factura->coche->id]) }}">
                                {{ $factura->coche->matricula }}
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="text-muted"
                                href="{{ route('profile.show', ['id' => $factura->coche->user->id]) }}">
                                {{ $factura->coche->user->email }}
                            </a>
                        </div>
                        <div class="col-4 mt-2 text-center  fs-5 align-middle bg-lime-100 rounded">
                            {{ $factura->importe }} €
                        </div>
                        <div class="col-4 text-center mt-2">
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                                href="{{ route('factura.show', ['id' => $factura->id]) }}" target="_blank">Descargar</a>
                        </div>
                        @if ($factura->FechaInicio >= now()->addDays(5))
                            <div class="col-4 text-center mt-2">
                                <form method="POST" action="{{route('factura.refund', ['codigo' => $factura->codigo])}}">
                                    @method('delete')
                                @csrf
                                <button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 transition ease-in-out duration-150'">
                                    Reembolsar
                                </button>
                                </form>
                            </div>
                        @endif
                        @if (!$loop->last)
                            <hr class="mt-2 mb-2">
                        @endif
                    </div>
                @empty
                    <h3 class="text-center">No tienes niguna factura. ¡Empieza a alquilar ya!</h3>
                @endforelse

            </div>

        </div>
        <div
            class="col-12 col-md-5 row row-cols-1 bg-white rounded mt-3 justify-content-center max-h-5/6 overflow-y-auto">
            <div class="col-12 text-center pt-2">
                <h2>Facturas de Coches</h2>
                <h4 class="text-muted">Aquí están todas las facturas de tus coches</h4>
                <hr>
            </div>
            <div class="col-11 text-sm mh-50 max-h-[40rem] md:text-base mb-2 overflow-y-auto justify-around">

                @forelse (Auth::user()->coches as $coche) {{-- Cada coche del usuario --}}
                    @foreach ($coche->facturas->whereNotNull('user_id') as $factura)
                        @php
                            $hasFactura = true;
                        @endphp
                        <div class="row mt-3 mb-3 justify-around">
                            <div class="col ">
                                {{ $factura->coche->marca }}
                                {{ $factura->coche->modelo }}
                            </div>
                            <div class="col">
                                <a class="text-muted" href="{{ route('coche.show', ['id' => $factura->coche->id]) }}">
                                    {{ $factura->coche->matricula }}
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-muted" href="{{ route('profile.show', ['id' => $factura->user->id]) }}">
                                    {{ $factura->user->email }}
                                </a>
                            </div>
                            <div class="col text-center fs-5 align-middle bg-lime-100 rounded">
                                {{ $factura->importe }} €
                            </div>
                            <div class="col text-center mt-2">
                                <a class="inline-flex  items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                                    href="{{ route('factura.show', ['id' => $factura->id]) }}"
                                    target="_blank">Descargar</a>
                            </div>
                            @if (!$loop->last)
                                <hr class="mt-2 mb-2">
                            @endif
                        </div>
                    @endforeach

                @empty
                    <h4 class="text-center">No tienes nigún coche. <br>Prueba a registrar uno <a
                            class="cursor-pointer p-0 link link-secondary" href="{{ route('coche.create') }}">aquí</a>
                    </h4>
                @endforelse
                @if ($hasFactura)
                    <h3 class="text-center">Parece ser que tus coches aún no han sido alquilados</h3>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
