<?php

namespace App\Models;

use App\Enums\TipoChecklist;
use App\Models\Concerns\HasChecklistRespostas;
use Database\Factories\OcorrenciaChecklistCivilFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OcorrenciaChecklistCivil extends Model
{
    /** @use HasFactory<OcorrenciaChecklistCivilFactory> */
    use HasChecklistRespostas, HasFactory;

    protected $table = 'ocorrencia_checklists_civil';

    public static function tipo(): TipoChecklist
    {
        return TipoChecklist::Civil;
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class);
    }
}
