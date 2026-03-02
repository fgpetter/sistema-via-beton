<?php

namespace App\Models;

use App\Enums\PrazoUnidade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Prazo extends Model
{
    /** @use HasFactory<\Database\Factories\PrazoFactory> */
    use HasFactory;

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

    public function calcularDataLimite(Carbon $dataBase): Carbon
    {
        return match ($this->prazo_unidade) {
            PrazoUnidade::Hora => $dataBase->copy()->addHours($this->prazo_valor),
            PrazoUnidade::Dia => $dataBase->copy()->addDays($this->prazo_valor),
        };
    }
}
