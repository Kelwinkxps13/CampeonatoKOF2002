<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'campeonato_id',
        'name',
        'pts', 'j', 'v', 'e', 'd',
        'rv', 'rp', 'sr'
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }
}
