<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreventivaMedicaoImagem extends Model
{
    protected $table = 'preventiva_medicao_imagens';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'preventiva_imagem_id',
        'path',
    ];

    public function preventivaImagem(): BelongsTo
    {
        return $this->belongsTo(PreventivaImagem::class);
    }
}
