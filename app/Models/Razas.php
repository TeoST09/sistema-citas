<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Razas extends Model
{
    public function especie()
    {
        return $this->belongsTo(Especies::class, 'especie_id');
    }
}
