<?php

namespace App\Models;

use Database\Factories\ResponsavelEngenhariaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponsavelEngenharia extends Model
{
    /** @use HasFactory<ResponsavelEngenhariaFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'responsavel_engenharia';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nome',
    ];

    /**
     * @return array<int, string>
     */
    public static function optionsForSelect(?int $includeId = null): array
    {
        return static::query()
            ->withTrashed()
            ->where(function ($query) use ($includeId): void {
                $query->whereNull('deleted_at');

                if ($includeId !== null) {
                    $query->orWhere('id', $includeId);
                }
            })
            ->orderBy('nome')
            ->pluck('nome', 'id')
            ->all();
    }
}
