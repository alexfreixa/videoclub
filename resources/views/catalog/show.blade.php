@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">
    <a>
        <img src="{{$movie->poster}}" style="width:100%"/>
    </a>
    
    </div>

    <div class="col-sm-8">

        <h1>{{$movie->title}}</h1>

        <h5>Año: {{$movie->year}}</h5>
        <h5>Director: {{$movie->director}}</h5>
        <b><p>Resumen: </b>{{$movie->synopsis}}</p>

        @if (!empty($ratings))

            @php
                $a = array();
                $comptador = 0;
            @endphp

            @foreach ($ratings as $rating)
                @if ($rating !== null)
                    @php
                        array_push($a, $rating->rating);
                        $comptador++;
                    @endphp
                @endif
            @endforeach

            @if ($comptador > 0) 
                @php
                    $avg_rating = array_sum($a) / $comptador;
                @endphp
                    <b><p>Puntuación: </b>{{$avg_rating}} / 5</p>
            @endif

        @endif

        <div class="movie-rating">Rating: x/5</div>
        <div class="movie-rate">
            Rate this article:
                @foreach(range(1,5) as $rate)
                    <a href="rate.php?movie={{ $movie->id }}&rating={{ $rate }}"> {{ $rate }}</a>
                @endforeach



        </div>

        <b><p>Estado: </b>

        @if ($movie->rented === 0)
            Película actualmente alquilada
            </br></br>
            <form action="{{action('CatalogController@putReturn', $movie->id)}}" method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary" style="display:inline">
                Devolver película
            </button>
        @elseif ($movie->rented === 1)
            Película disponible
            </br></br>
            <form action="{{action('CatalogController@putRent', $movie->id)}}" method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success" style="display:inline">
                Alquilar película
            </button>
        @endif

        </form>
        

        <a class="btn btn-warning" href="{{ url('/catalog/edit/' . $movie->id ) }}"><span class="glyphicon glyphicon-pencil"></span>Editar película</a>
        <a class="btn btn-default" href="{{ url('/catalog/') }}"><span class="glyphicon glyphicon-chevron-left"></span>Volver al listado</a>

        <form action="{{action('CatalogController@deleteMovie', $movie->id)}}" method="POST" style="display:inline">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="display:inline">
                Eliminar película
            </button>
        </form>
        
        </p>

        

    </div>


</div>


<!--
<p>----</p>
<form action="" method="POST" style="display:inline">
{{ method_field('PUT') }}
{{ csrf_field() }}
@foreach(range(1,5) as $rate)
<a href="{{ route('voting', ['$movie->id', '$rate']) }}">{{ $rate }}</a>
@endforeach

</form>
-->
@stop