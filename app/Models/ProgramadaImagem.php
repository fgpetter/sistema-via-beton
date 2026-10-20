<?php

namespace App\Models;

use App\Enums\TipoImagemOcorrencia;
use Database\Factories\ProgramadaImagemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramadaImagem extends Model
{
    /** @use HasFactory<ProgramadaImagemFactory> */
    use HasFactory;

    protected $table = 'programada_imagens';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'programada_id',
        'path',
        'tipo',
        'par',
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

    public function programada(): BelongsTo
    {
        return $this->belongsTo(Programada::class);
    }
}
