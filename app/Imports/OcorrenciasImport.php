<?php

namespace App\Imports;

use App\Enums\OcorrenciaStatus;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OcorrenciasImport implements SkipsEmptyRows, ToModel, WithHeadingRow
{
    use Importable;

    /** @var Collection<string, int> */
    private Collection $prazosCache;

    private int $importedCount = 0;

    private int $skippedCount = 0;

    public function __construct()
    {
        $this->prazosCache = Prazo::pluck('id', 'nome');
    }

    /**
     * @param  array<string, mixed>  $row
     */
    public function model(array $row): ?Ocorrencia
    {
        $titulo = $this->cleanValue($row['resumo'] ?? null);
        $agencia = $this->cleanValue($row['usuario_final_afetado'] ?? $row['agencia'] ?? null);

        if (! $titulo || ! $agencia) {
            $this->skippedCount++;

            return null;
        }

        $this->importedCount++;

        return new Ocorrencia([
            'numero_ocorrencia' => $this->cleanValue($row['no_da_ocorrencia'] ?? null),
            'status' => $this->mapStatus($row['status'] ?? null),
            'titulo' => $titulo,
            'descricao' => $this->cleanValue($row['descricao'] ?? null),
            'abertura' => $this->parseExcelDate($row['data_de_abertura'] ?? null) ?? now()->format('Y-m-d'),
            'agencia' => $agencia,
            'prazo_id' => $this->findPrazoId($row['categoria'] ?? null),
        ]);
    }

    public function isEmptyWhen(array $row): bool
    {
        $values = array_filter($row, fn ($value) => $value !== null && $value !== '');

        return count($values) === 0;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getSkippedCount(): int
    {
        return $this->skippedCount;
    }

    private function cleanValue(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        $cleaned = trim((string) $value);

        return $cleaned === '' ? null : $cleaned;
    }

    private function mapStatus(?string $status): string
    {
        if (! $status) {
            return OcorrenciaStatus::Aberto->value;
        }

        return match (mb_strtolower(trim($status))) {
            'em andamento' => OcorrenciaStatus::Andamento->value,
            'concluído', 'concluido' => OcorrenciaStatus::Concluido->value,
            'revisar' => OcorrenciaStatus::Revisar->value,
            default => OcorrenciaStatus::Aberto->value,
        };
    }

    private function parseExcelDate(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject((int) $value)->format('Y-m-d');
        }

        return date('Y-m-d', strtotime((string) $value)) ?: null;
    }

    private function findPrazoId(?string $categoria): ?int
    {
        if (! $categoria) {
            return null;
        }

        $categoria = trim($categoria);

        if ($this->prazosCache->has($categoria)) {
            return $this->prazosCache->get($categoria);
        }

        $match = $this->prazosCache->first(
            fn ($id, $nome) => mb_strtolower($nome) === mb_strtolower($categoria)
        );

        return $match;
    }
}
