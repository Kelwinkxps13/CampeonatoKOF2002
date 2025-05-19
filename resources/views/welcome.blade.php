@extends('components.main')
@section('title', 'Ola Word')
@section('content')
<h2 class="mb-4 text-center">Campeonatos</h2>

@if (isset($camps))
   @foreach ($camps as $f)
    <a href="{{route('camp', ['camp' => $f->id_camp])}}">{{$f->name}}</a> // {{$f->em_andamento}}<br>
    @endforeach 
@else
não existem campeonatos!!
@endif


<a href="{{route('create_camp')}}" class=" mt-5 btn btn-success">Adicionar campeonato</a>

@endsection