<?php

namespace App\Imports;

use App\Enums\OcorrenciaStatus;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OcorrenciasImport implements SkipsEmptyRows, ToModel, WithHeadingRow
{
    use Importable;

    /** @var list<int> */
    private array $seenInFile = [];

    /** @var array<string, int|null> */
    private array $prazoCache = [];

    private int $importedCount = 0;

    private int $skippedCount = 0;

    public function model(array $row): ?Ocorrencia
    {
        $raw = $row['no_da_ocorrencia'] ?? null;

        if ($raw === null || $raw === '') {
            $this->skippedCount++;

            return null;
        }

        $numeroOcorrencia = (int) $raw;

        if ($numeroOcorrencia <= 0) {
            $this->skippedCount++;

            return null;
        }

        if (in_array($numeroOcorrencia, $this->seenInFile, true)) {
            $this->skippedCount++;

            return null;
        }

        if (Ocorrencia::query()->where('numero_ocorrencia', $numeroOcorrencia)->exists()) {
            $this->skippedCount++;

            return null;
        }

        $this->seenInFile[] = $numeroOcorrencia;
        $this->importedCount++;

        return new Ocorrencia([
            'numero_ocorrencia' => $numeroOcorrencia,
            'titulo' => trim((string) ($row['resumo'] ?? $row['titulo'] ?? 'Sem título')),
            'prazo_id' => $this->resolvePrazoId($row['categoria'] ?? null),
            'agencia' => trim((string) ($row['usuario_final_afetado'] ?? $row['agencia'] ?? 'Não informado')),
            'abertura' => $this->parseDate($row['data_de_abertura'] ?? $row['abertura'] ?? null),
            'endereco' => trim((string) ($row['endereco'] ?? '')) ?: null,
            'descricao' => trim((string) ($row['descricao'] ?? '')) ?: null,
            'status' => OcorrenciaStatus::Aberto->value,
        ]);
    }

    public function isEmptyWhen(array $row): bool
    {
        return count(array_filter($row, fn ($v) => $v !== null && $v !== '')) === 0;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getSkippedCount(): int
    {
        return $this->skippedCount;
    }

    private function resolvePrazoId(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        $nome = trim((string) $value);

        if (! array_key_exists($nome, $this->prazoCache)) {
            $this->prazoCache[$nome] = Prazo::query()->where('nome', $nome)->value('id');
        }

        return $this->prazoCache[$nome];
    }

    private function parseDate(mixed $value): string
    {
        if ($value === null || $value === '') {
            return now()->format('Y-m-d');
        }

        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int) $value)->format('Y-m-d');
        }

        return date('Y-m-d', strtotime((string) $value)) ?: now()->format('Y-m-d');
    }
}
