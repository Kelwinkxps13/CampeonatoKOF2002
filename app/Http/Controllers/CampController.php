<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use App\Models\Rodada;
use App\Models\Time;

use Illuminate\Http\Request;

class CampController extends Controller
{
    public function index()
    {
        $camps = Campeonato::all();
        return view('welcome', ['camps' => $camps]);
    }
    public function camp()
    {
        $camps = Campeonato::all();
        return view('welcome', ['camps' => $camps]);
    }
    public function create()
    {
        return view('store_camp');
    }



    private function gerarJogosIdaVolta(array $times)
    {
        // 🔀 Embaralha os times para gerar jogos aleatórios
        shuffle($times);

        // Se for ímpar, adiciona um "bye" (folga)
        if (count($times) % 2 !== 0) {
            $times[] = 'FOLGA';
        }

        $numTimes = count($times);
        $numRodadas = $numTimes - 1;
        $meio = (int)($numTimes / 2);

        $jogosPorRodada = [];

        // Geração da ida
        for ($rodada = 0; $rodada < $numRodadas; $rodada++) {
            $rodadaJogos = [];

            for ($i = 0; $i < $meio; $i++) {
                $timeA = $times[$i];
                $timeB = $times[$numTimes - 1 - $i];

                if ($timeA !== 'FOLGA' && $timeB !== 'FOLGA') {
                    $rodadaJogos[] = ['casa' => $timeA, 'fora' => $timeB];
                }
            }

            $jogosPorRodada[] = $rodadaJogos;

            // Rotação dos times
            $timesTemp = $times;
            array_splice($times, 1, $numTimes - 2, array_merge(
                array_slice($timesTemp, $numTimes - 1, 1),
                array_slice($timesTemp, 1, $numTimes - 2)
            ));
        }

        // Geração da volta (inverte mandos de campo)
        $jogosVolta = [];
        foreach ($jogosPorRodada as $rodadaJogos) {
            $rodadaVolta = [];
            foreach ($rodadaJogos as $jogo) {
                $rodadaVolta[] = ['casa' => $jogo['fora'], 'fora' => $jogo['casa']];
            }
            $jogosVolta[] = $rodadaVolta;
        }

        // Junta ida e volta com rótulo das rodadas
        $rodadas = [];
        $n = 1;
        foreach ($jogosPorRodada as $r) {
            $rodadas["Rodada $n"] = $r;
            $n++;
        }
        foreach ($jogosVolta as $r) {
            $rodadas["Rodada $n"] = $r;
            $n++;
        }

        return $rodadas;
    }



    public function store(Request $request)
    {
        // criacao do campeonato
        Campeonato::create([
            'name' => $request->name,
            'name_slug' => str($request->name)->slug(),
            'em_andamento' => 1
        ]);

        $camp = Campeonato::where('name_slug', str($request->name)->slug())->first();

        // Filtra os times não vazios
        $times = array_filter($request->input('times'), fn($t) => !empty($t));

        // Gera os jogos de ida e volta
        $rodadas = $this->gerarJogosIdaVolta($times);

        // Salva a tabela zerada
        foreach (array_unique($times) as $time) {
            // Criação de times
            Time::updateOrInsert(
                [
                    'campeonato_id' => $camp->id,
                    'pts' => 0,
                    'j' => 0,
                    'v' => 0,
                    'e' => 0,
                    'd' => 0,
                    'rv' => 0,
                    'rp' => 0,
                    'sr' => 0,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        // Salva as rodadas com placares vazios
        $numRodada = 1;
        foreach ($rodadas as $jogos) {
            foreach ($jogos as $jogo) {
                // Recupere os ids dos times a partir do nome
                $timeA = Time::where('name', $jogo['casa'])->first();
                $timeB = Time::where('name', $jogo['fora'])->first();

                // Criação das rodadas
                Rodada::create([
                    'campeonato_id' => $camp->id,
                    'rodada' => $numRodada,  // Agora estamos usando 'campeonato_id' direto
                    'time_a' => $timeA->id,    // Usamos o ID do time A
                    'time_b' => $timeB->id,    // Usamos o ID do time B
                    'placar_a' => null,           // Placar A (inicialmente nulo)
                    'placar_b' => null,           // Placar B (inicialmente nulo)
                ]);
            }
            $numRodada++;
        }

        dd('success');
        // Retorna a visualização da página com os times e rodadas
        return view('camp', [
            'times' => $times,
            'rodadas' => $rodadas,
        ]);
    }
}
