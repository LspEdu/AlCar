<x-app-layout>
    @csrf
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="row pt-2">
        <div class="col-lg-5">
            <div class="card mb-4 shadow">
                <div class="card-body text-center row">
                    <div class="row mb-2">
                        <img src="{{ asset($user->avatar ?? 'storage/webo.jpg') }}" alt="avatar" class="rounded col-6"
                            style="width: 150px;">
                        <h5 class="my-3 col-6">{{ $user->name }} <br> {{ $user->ape1 }}
                            {{ $user->ape2 }}</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <a href="mailto:{{ $user->email }}" class="text-muted mb-0">{{ $user->email }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Teléfono</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->tlf }} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Dirección</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->direccion ?? 'Desconocida' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="row gap-2">
                <div class="col-12">
                    <div class="card mb-4 shadow mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-gray-900 fs-3 font-italic me-1">Coches</span>
                                {{-- ESTO DEBE CONVERTIRSE EN <a> que mande a user->coches --}}
                            </p>
                            <ul>
                                @forelse ($user->coches as $coche)
                                    <li><a class="link link-secondary"
                                            href="{{ route('coche.show', ['id' => $coche->id]) }}">{{ $coche->marca }}
                                            {{ $coche->modelo }} - {{ $coche->matricula }}</a></li>
                                @empty
                                    <h4>Este usuario no tiene ningún coche</h4>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @foreach (Auth::user()->facturas as $factura)
                        @if ($user->id = $factura->coche->user->id)
                            @php($facturasDueño[] = $factura)
                        @endif
                    @endforeach
                    <div class="card mb-4 shadow mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-gray-900 fs-3 font-italic me-1">Últimas facturas</span>
                            </p>

                            @foreach ($facturasDueño as $factura)
                                @if ($loop->iteration <= 5)
                                    <a class="link link-secondary" target="_blank"
                                        href="{{ route('factura.show', ['id' => $factura->id]) }}">Factura
                                        {{ $factura->codigo }} | {{ $factura->coche->marca }}
                                        {{ $factura->coche->modelo }} | {{ $factura->FechaInicio }} </a>
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
