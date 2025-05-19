@extends('components.main')
@section('title', 'Ola Word')
@section('content')

<h2 class="mb-4 text-center">Tabela FT5 - KOF 2002</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Pts</th>
                <th>J</th>
                <th>V</th>
                <th>E</th>
                <th>D</th>
                <th>RV</th>
                <th>RP</th>
                <th>SR</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($times as $time)
            <tr>
                <td>{{ $time }}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Rodadas Dinâmicas -->
@php $num = 1; @endphp
@foreach ($rodadas as $jogos)
<div class="container mt-5" id="rodada{{ $num }}">
    <h2 class="mb-4 text-center">Rodada {{ $num }}</h2>
    <ul class="list-group">
        @foreach ($jogos as $jogo)
        <li class="list-group-item">
            <strong>{{ $jogo['casa'] }}</strong> vs <strong>{{ $jogo['fora'] }}</strong>
        </li>
        @endforeach
    </ul>
</div>
@php $num++; @endphp
@endforeach

@endsection
