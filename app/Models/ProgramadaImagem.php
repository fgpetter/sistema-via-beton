<?php

namespace App\Models;

use Database\Factories\ProgramadaImagemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'legenda',
        'recusada',
        'position',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'recusada' => 'boolean',
        ];
    }

    public function programada(): BelongsTo
    {
        return $this->belongsTo(Programada::class);
    }

    public function medicaoImagens(): HasMany
    {
        return $this->hasMany(ProgramadaMedicaoImagem::class)->orderBy('id');
    }
}
