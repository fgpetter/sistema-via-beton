<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramadaMedicaoImagem extends Model
{
    protected $table = 'programada_medicao_imagens';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'programada_imagem_id',
        'path',
    ];

    public function programadaImagem(): BelongsTo
    {
        return $this->belongsTo(ProgramadaImagem::class);
    }
}
