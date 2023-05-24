<x-app-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Coches') }}
        </h2>
        <x-nav-link class="cursor-pointer p-0" href="{{route('coche.create')}}">
            {{__('Registrar Coche')}}
        </x-nav-link>
    </x-slot>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 gap-1 justify-content-md-around justify-content-center ">

        @foreach ($coches as $coche)
        <x-card-coches  :coche="$coche" class="col-11 col-sm-5 col-lg-3 mt-1">
        </x-card-coches>
        @endforeach
    </div>


</x-app-layout>
