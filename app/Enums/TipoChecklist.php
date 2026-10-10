<?php

namespace App\Enums;

use App\Contracts\ChecklistBlocoContract;
use App\Models\OcorrenciaChecklistCivil;
use App\Models\OcorrenciaChecklistEletrica;
use Illuminate\Database\Eloquent\Model;

enum TipoChecklist: string
{
    case Civil = 'civil';
    case Eletrica = 'eletrica';

    public function label(): string
    {
        return match ($this) {
            self::Civil => 'Civil',
            self::Eletrica => 'Elétrica',
        };
    }

    /**
     * Título que aparece no PDF, em caixa alta.
     */
    public function titulo(): string
    {
        return match ($this) {
            self::Civil => 'CIVIL',
            self::Eletrica => 'ELÉTRICA',
        };
    }

    /**
     * Rótulo da coluna de resposta, grafado como em cada planilha.
     */
    public function rotuloNaoAplica(): string
    {
        return match ($this) {
            self::Civil => 'NÃO APLICA',
            self::Eletrica => 'NÃO SE APLICA',
        };
    }

    /**
     * @return list<ChecklistBlocoContract>
     */
    public function blocos(): array
    {
        return match ($this) {
            self::Civil => ChecklistCivilBloco::cases(),
            self::Eletrica => ChecklistEletricaBloco::cases(),
        };
    }

    /**
     * Resolve o bloco pelo valor gravado na URL ou no Livewire. Responde 404 se não existir neste tipo.
     */
    public function bloco(string $valor): ChecklistBlocoContract
    {
        $bloco = match ($this) {
            self::Civil => ChecklistCivilBloco::tryFrom($valor),
            self::Eletrica => ChecklistEletricaBloco::tryFrom($valor),
        };

        abort_if($bloco === null, 404);

        return $bloco;
    }

    /**
     * @return class-string<Model>
     */
    public function modelo(): string
    {
        return match ($this) {
            self::Civil => OcorrenciaChecklistCivil::class,
            self::Eletrica => OcorrenciaChecklistEletrica::class,
        };
    }

    /**
     * Nome da relação em Ocorrencia que aponta para o checklist deste tipo.
     */
    public function relacao(): string
    {
        return match ($this) {
            self::Civil => 'checklistCivil',
            self::Eletrica => 'checklistEletrica',
        };
    }
}
