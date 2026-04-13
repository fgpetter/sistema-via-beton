<?php

namespace App\Models;

use App\Enums\TipoImagemOcorrencia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OcorrenciaImagem extends Model
{
    use HasFactory;

    protected $table = 'ocorrencia_imagens';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'ocorrencia_id',
        'tipo',
        'par',
        'path',
        'legenda',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tipo' => TipoImagemOcorrencia::class,
        ];
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class);
    }
}
