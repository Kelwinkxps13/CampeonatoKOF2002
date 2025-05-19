<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'em_andamento', 'name_slug'];

    public function times()
    {
        return $this->hasMany(Time::class);
    }

    public function rodadas()
    {
        return $this->hasMany(Rodada::class);
    }
}
