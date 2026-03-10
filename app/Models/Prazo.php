<?php

namespace App\Models;

use App\Enums\PrazoUnidade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Prazo extends Model
{
    const EMERGENCIAL = 'Engenharia.Emergencial';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'prazo_valor',
        'prazo_unidade',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'prazo_valor' => 'integer',
            'prazo_unidade' => PrazoUnidade::class,
        ];
    }

    public function getPrazoFormatadoAttribute(): string
    {
        return $this->prazo_valor.' '.$this->prazo_unidade->label($this->prazo_valor);
    }

    public function isEmergencial(): bool
    {
        return $this->nome === self::EMERGENCIAL;
    }

    public function calcularDataLimite(Carbon $dataBase): Carbon
    {
        return match ($this->prazo_unidade) {
            PrazoUnidade::Hora => $dataBase->copy()->addHours($this->prazo_valor),
            PrazoUnidade::Dia => $dataBase->copy()->addDays($this->prazo_valor),
        };
    }
}
