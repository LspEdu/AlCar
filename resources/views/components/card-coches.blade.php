@props(['coche'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    <img src="{{asset($coche->foto)}}" class="card-img-top w-100 mt-1 rounded" alt="Fissure in Sandstone" />
    <div class="card-body">
        <h5 class="card-title">{{$coche->marca}} {{$coche->modelo}}</h5>
        <div class="card-text">
            <h6>Precio: <small>{{$coche->precio}}€</small></h6>
            <p>Tipo: <small>{{ucfirst($coche->tipo)}}</small></p>
        </div>
        @if (Auth::user() == $coche->user)
            <a href="{{route('coche.show',['id' => $coche->id])}}" class="btn btn-outline-warning text-center">Ver</a>
        @else
            <a href="{{route('coche.show',['id' => $coche->id])}}" class="btn btn-outline-success text-center">Alquilar</a>
        @endif
    </div>
</div>
