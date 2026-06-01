<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    /** @use HasFactory<\Database\Factories\DisciplinaFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'disciplina',
        'subdisciplina',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subdisciplina' => 'boolean',
        ];
    }

    public function scopeDisciplinas(Builder $query): Builder
    {
        return $query->where('subdisciplina', false);
    }

    public function scopeSubdisciplinas(Builder $query): Builder
    {
        return $query->where('subdisciplina', true);
    }
}
