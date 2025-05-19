@extends('components.main')
@section('title', 'Adicionar Campeonato')
@section('content')

        <h1>Adicionar Times</h1>
        <form action="{{ route('store_camp') }}" method="POST">
            @csrf
            <label for=""> Nome do Campeonato</label>
            <input type="text" name="name" class="form-control mb-4" placeholder="Nome do Campeonato">
            <!-- <label for=""> ID do Campeonato</label>
            <input type="text" name="id_camp" class="form-control mb-4" placeholder="Nome do Campeonato"> -->
            <div id="times-container">
                <div class="mb-3">
                    <input type="text" name="times[]" class="form-control" placeholder="Nome do Time">
                </div>
            </div>
            <button type="button" class="btn btn-secondary mb-3" onclick="adicionarTime()">Adicionar outro time</button>
            <br>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>

    <script>
        function adicionarTime() {
            const container = document.getElementById('times-container');
            const input = document.createElement('div');
            input.className = 'mb-3';
            input.innerHTML = '<input type="text" name="times[]" class="form-control" placeholder="Nome do Time">';
            container.appendChild(input);
        }
    </script>


<a href="/" class=" mt-5 btn btn-success">Voltar</a>

@endsection