<?php

namespace App\Imports;

use App\Enums\ContratoSolucionador;
use App\Enums\OcorrenciaStatus;
use App\Models\Endereco;
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

    /** @var Collection<string, int> */
    private Collection $enderecosCache;

    private int $importedCount = 0;

    private int $skippedCount = 0;

    /** @var array<int, bool> */
    private array $idsImportados = [];

    public function __construct()
    {
        $this->prazosCache = Prazo::pluck('id', 'nome');
        $this->enderecosCache = Endereco::pluck('id', 'nome')->mapWithKeys(
            fn ($id, $nome) => [mb_strtoupper($nome) => $id]
        );
    }

    /**
     * @param  array<string, mixed>  $row
     */
    public function model(array $row): ?Ocorrencia
    {
        $id = $this->parseOcorrenciaId($row['no_da_ocorrencia'] ?? null);

        if ($id === null) {
            return null;
        }

        if ($this->idJaImportado($id) || Ocorrencia::where('id', $id)->exists()) {
            $this->skippedCount++;

            return null;
        }

        $titulo = $this->cleanValue($row['resumo'] ?? null);
        $agencia = $this->cleanValue($row['usuario_final_afetado'] ?? $row['agencia'] ?? null);

        $this->importedCount++;
        $this->idsImportados[$id] = true;

        $ocorrencia = new Ocorrencia([
            'status' => $this->mapStatus($row['status'] ?? null),
            'titulo' => $titulo,
            'descricao' => $this->cleanValue($row['descricao'] ?? null),
            'abertura' => $this->parseExcelDate($row['data_de_abertura'] ?? null) ?? now()->format('Y-m-d'),
            'violacao_projetada' => $this->parseExcelDatetime($row['violacao_projetada'] ?? null),
            'contrato' => $this->resolveContrato($row['grupo_solucionador'] ?? null),
            'prioridade' => $this->cleanValue($row['prioridade'] ?? null),
            'agencia' => $agencia,
            'endereco_id' => $this->findEnderecoId($agencia),
            'prazo_id' => $this->findPrazoId($row['categoria'] ?? null),
        ]);

        $ocorrencia->id = $id;

        return $ocorrencia;
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
            'espera' => OcorrenciaStatus::Espera->value,
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

    private function parseExcelDatetime(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject((float) $value)->format('Y-m-d H:i:s');
        }

        $timestamp = strtotime((string) $value);

        return $timestamp !== false ? date('Y-m-d H:i:s', $timestamp) : null;
    }

    private function resolveContrato(mixed $grupo): ?string
    {
        $grupo = $this->cleanValue($grupo);

        if ($grupo === null) {
            return null;
        }

        $contrato = ContratoSolucionador::fromGrupoSolucionador($grupo);

        return $contrato?->value;
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

    private function parseOcorrenciaId(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_int($value)) {
            return $value > 0 ? $value : null;
        }

        if (is_float($value)) {
            if ($value <= 0 || floor($value) !== $value) {
                return null;
            }

            return (int) $value;
        }

        $id = $this->cleanValue($value);

        if ($id === null || ! ctype_digit($id)) {
            return null;
        }

        $parsed = (int) $id;

        return $parsed > 0 ? $parsed : null;
    }

    private function idJaImportado(int $id): bool
    {
        return $this->idsImportados[$id] ?? false;
    }

    private function findEnderecoId(?string $agencia): ?int
    {
        if (! $agencia) {
            return null;
        }

        return $this->enderecosCache[mb_strtoupper(trim($agencia))] ?? null;
    }
}
