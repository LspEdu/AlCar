<x-app-layout>
    @csrf
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi Perfil') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="avatar">
                            <img src="{{ asset('images/avatar.png') }}" alt="Foto de perfil">
                        </div>
                    </div>

                    <h5 class="text-center">{{ __('Información Personal') }}</h5>
                    <hr>
                    <p><strong>{{ __('Nombre:') }}</strong> {{ $user->name }}</p>
                    <p><strong>{{ __('Email:') }}</strong> {{ $user->email }}</p>

                    <h5 class="text-center">{{ __('Mis Coches') }}</h5>
                    <hr>
                    <ul class="list-group">
                        @foreach($user->cars as $car)
                            <li class="list-group-item">{{ $car->make }} {{ $car->model }}</li>
                        @endforeach
                    </ul>

                    <h5 class="text-center">{{ __('Mis Comentarios') }}</h5>
                    <hr>
                    <ul class="list-group">
                        @foreach($user->comments as $comment)
                            <li class="list-group-item">{{ $comment->body }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
</x-app-layout>
