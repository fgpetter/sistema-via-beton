<?php

namespace App\Models;

use App\Enums\TipoEndereco;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /** @use HasFactory<\Database\Factories\EnderecoFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'tipo',
        'numero',
        'horario',
        'endereco',
        'cidade_estado',
        'fone',
        'ativo',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tipo' => TipoEndereco::class,
            'ativo' => 'boolean',
        ];
    }

    public function scopeAtivo(Builder $query): Builder
    {
        return $query->where('ativo', true);
    }

    public function scopeTipo(Builder $query, TipoEndereco $tipo): Builder
    {
        return $query->where('tipo', $tipo);
    }
}
