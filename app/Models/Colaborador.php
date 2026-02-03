<?php

namespace App\Models;

use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Colaborador extends Model
{
    /** @use HasFactory<\Database\Factories\ColaboradorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'tipo',
        'contrato',
        'user_id',
    ];

    protected $table = 'colaboradores';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tipo' => TipoColaborador::class,
            'contrato' => TipoContrato::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTipo(Builder $query, TipoColaborador $tipo): Builder
    {
        return $query->where('tipo', $tipo);
    }
}
