<?php

namespace App\Enums;

enum OcorrenciaStatus: string
{
    /**
     * @var string
     * Importado da planilha ou cadastrado manualmente
     */
    case Aberto = 'aberto';
    /**
     * @var string
     * Quando o admin libera o atendimento para ficar visível para o prestador
     */
    case Andamento = 'andamento';
    /**
     * @var string
     * Quando o campo concluido_prestador estiver preenchido, para que o admin
     * possa revisar os dados do atendimento
     */
    case Revisar = 'revisar';
    /**
     * @var string
     * após o admin revisar e marcar como concluido, adicionar na tabela a coluna 
     * "concluido_por" com o ID do admin que marcou como concluido
     */
    case Concluido = 'concluido';

    public function label(): string
    {
        return match ($this) {
            self::Aberto => 'Aberto',
            self::Andamento => 'Em Andamento',
            self::Revisar => 'Revisar',
            self::Concluido => 'Concluído',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Aberto => 'danger',
            self::Andamento => 'warning',
            self::Revisar => 'info',
            self::Concluido => 'success',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $status) => [
            $status->value => $status->label(),
        ])->toArray();
    }
}
