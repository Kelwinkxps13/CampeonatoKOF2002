<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{
    use HasFactory;

    protected $fillable = [
        'campeonato_id',
        'rodada',
        'time_a',
        'placar_a',
        'placar_b',
        'time_b'
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }
}
