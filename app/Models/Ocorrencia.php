<?php

namespace App\Models;

use App\Enums\OcorrenciaStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ocorrencia extends Model
{
    /** @use HasFactory<\Database\Factories\OcorrenciaFactory> */
    use HasFactory;

    protected $table = 'ocorrencias';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'titulo',
        'descricao',
        'abertura',
        'colaborador_id',
        'agencia',
        'email_enviado',
        'comentarios',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => OcorrenciaStatus::class,
            'abertura' => 'date',
            'email_enviado' => 'datetime',
        ];
    }

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function scopeStatus(Builder $query, OcorrenciaStatus $status): Builder
    {
        return $query->where('status', $status);
    }
}
