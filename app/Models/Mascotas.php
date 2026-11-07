<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
    public function raza()
    {
        return $this->belongsTo(Razas::class, 'raza_id');
    }

    public function especie()
    {
        return $this->belongsTo(Especies::class, 'especie_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
