<x-admin-layout>
    <div class="row justify-content-around">

        <div
            class="col-12 col-md-8 row row-cols-1 bg-white rounded mt-3 justify-content-center max-h-5/6 overflow-y-auto">
            <div class="col-12 text-center pt-2">
                <h2>Facturas</h2>
                <h4 class="text-muted">Aquí están todas las facturas de los usuarios</h4>

                <hr>
            </div>
            @if (session('success'))
                <div class="col-12 bg-success rounded text-center">
                    <h3 class="text-light">{{ session('success') }}</h3>
                </div>
            @endif
            @if (session('error'))
                <div class="col-12 bg-red">
                    <p class="text-light">{{ session('error') }}</p>
                </div>
            @endif
            <div class="col-11 max-h-[40rem] text-sm md:text-base mb-2 overflow-y-auto ">
                @forelse ($facturas as $factura)
                    <div class="row justify-between ">
                        <div class="col-4 ">
                            {{ $factura->coche->marca }}
                            {{ $factura->coche->modelo }}
                        </div>
                        <div class="col-3">
                            <a class="text-muted" href="{{ route('admin.coche', ['id' => $factura->coche->id]) }}">
                                {{ $factura->coche->matricula }}
                            </a>
                        </div>
                        <div class="col-5 ">
                            {{ $factura->codigo }}
                        </div>

                        <div class="col-8 mt-2 text-center  fs-5 align-middle bg-lime-100 rounded">
                            {{ $factura->importe }} €
                        </div>
                        <div class="col-4">
                            <a class="text-muted"
                                href="{{ route('admin.usuario', ['id' => $factura->coche->user->id]) }}">
                                {{ $factura->coche->user->email }}
                            </a>
                        </div>
                        <div class="col-5 text-center mt-2">
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                                href="{{ route('factura.show', ['id' => $factura->id]) }}"
                                target="_blank">Descargar</a>
                        </div>
                        <div class="col-5  text-center mt-2">
                            <form method="POST" action="{{ route('admin.refund', ['codigo' => $factura->codigo]) }}">
                                @method('delete')
                                @csrf
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 transition ease-in-out duration-150'">
                                    Reembolsar
                                </button>
                            </form>

                        </div>

                        @if (!$loop->last)
                            <hr class="mt-2 mb-2">
                        @endif
                    </div>
                @empty
                    <h3 class="text-center">No hay facturas</h3>
                @endforelse

            </div>

        </div>

    </div>


</x-admin-layout>
