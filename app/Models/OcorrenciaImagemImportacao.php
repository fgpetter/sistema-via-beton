<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OcorrenciaImagemImportacao extends Model
{
    public const STATUS_PROCESSANDO = 'processando';

    public const STATUS_CONCLUIDA = 'concluida';

    public const STATUS_FALHOU = 'falhou';

    protected $table = 'ocorrencia_imagem_importacoes';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'ocorrencia_id',
        'status',
        'batch_id',
        'iniciada_em',
        'concluida_em',
        'falhou_em',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'iniciada_em' => 'datetime',
            'concluida_em' => 'datetime',
            'falhou_em' => 'datetime',
        ];
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class);
    }

    public function imagens(): HasMany
    {
        return $this->hasMany(OcorrenciaImagem::class);
    }
}
