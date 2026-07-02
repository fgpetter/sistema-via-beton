<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PreventivaImagem extends Model
{
    /** @use HasFactory<\Database\Factories\PreventivaImagemFactory> */
    use HasFactory;

    protected $table = 'preventiva_imagens';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'preventiva_id',
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

    public function preventiva(): BelongsTo
    {
        return $this->belongsTo(Preventiva::class);
    }

    public function medicaoImagens(): HasMany
    {
        return $this->hasMany(PreventivaMedicaoImagem::class)->orderBy('id');
    }
}
