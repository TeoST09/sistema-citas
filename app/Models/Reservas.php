<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservas extends Model
{
    protected $fillable = [
        'user_id',
        'mascota_id',
        'veterinario_id',
        'servicio_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'precio',
        'estado',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mascota(): BelongsTo
    {
        return $this->belongsTo(Mascotas::class, 'mascota_id');
    }

    public function veterinario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicios::class, 'servicio_id');
    }
}
