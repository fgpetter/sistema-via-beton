<?php

namespace App\Models;

use App\Enums\TipoChecklist;
use App\Models\Concerns\HasChecklistRespostas;
use Database\Factories\OcorrenciaChecklistEletricaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OcorrenciaChecklistEletrica extends Model
{
    /** @use HasFactory<OcorrenciaChecklistEletricaFactory> */
    use HasChecklistRespostas, HasFactory;

    protected $table = 'ocorrencia_checklists_eletrica';

    public static function tipo(): TipoChecklist
    {
        return TipoChecklist::Eletrica;
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class);
    }
}
