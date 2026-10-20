<?php

namespace App\Models;

use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
use App\Enums\TipoImagemOcorrencia;
use Database\Factories\ProgramadaFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Programada extends Model
{
    /** @use HasFactory<ProgramadaFactory> */
    use HasFactory;

    protected $table = 'programadas';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'tipo',
        'titulo',
        'descricao',
        'abertura',
        'contrato',
        'responsavel_engenharia_id',
        'colaborador_id',
        'agencia',
        'endereco_id',
        'endereco',
        'comentarios',
        'concluido_por',
        'prestador_nome',
        'data_chegada',
        'data_saida',
        'comentarios_prestador',
        'email_rat',
        'email_rat_enviado',
        'rat_pdf_path',
        'disciplina_id',
        'subdisciplina_1_id',
        'subdisciplina_2_id',
        'subdisciplina_3_id',
        'subdisciplina_4_id',
        'subdisciplina_5_id',
        'subdisciplina_6_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => ProgramadaStatus::class,
            'tipo' => ProgramadaTipo::class,
            'abertura' => 'date',
            'data_chegada' => 'date',
            'data_saida' => 'date',
            'email_rat_enviado' => 'datetime',
        ];
    }

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function responsavelEngenharia(): BelongsTo
    {
        return $this->belongsTo(ResponsavelEngenharia::class)->withTrashed();
    }

    public function disciplina(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class)->where('subdisciplina', false);
    }

    public function subdisciplina1(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_1_id')->where('subdisciplina', true);
    }

    public function subdisciplina2(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_2_id')->where('subdisciplina', true);
    }

    public function subdisciplina3(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_3_id')->where('subdisciplina', true);
    }

    public function subdisciplina4(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_4_id')->where('subdisciplina', true);
    }

    public function subdisciplina5(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_5_id')->where('subdisciplina', true);
    }

    public function subdisciplina6(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class, 'subdisciplina_6_id')->where('subdisciplina', true);
    }

    public function enderecoVinculado(): BelongsTo
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    public static function resolverEnderecoId(?string $agencia): ?int
    {
        if (! $agencia) {
            return null;
        }

        $nome = Str::upper(trim($agencia));

        return Endereco::query()
            ->whereRaw('UPPER(nome) = ?', [$nome])
            ->value('id');
    }

    public function concluidoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'concluido_por');
    }

    public function imagens(): HasMany
    {
        return $this->hasMany(ProgramadaImagem::class)
            ->orderBy('par')
            ->orderBy('id');
    }

    public function imagensAntes(): HasMany
    {
        return $this->imagens()->where('tipo', TipoImagemOcorrencia::Antes);
    }

    public function imagensDepois(): HasMany
    {
        return $this->imagens()->where('tipo', TipoImagemOcorrencia::Depois);
    }

    public function atendimentoIniciado(): bool
    {
        return $this->data_chegada !== null;
    }

    public function podeConcluir(): bool
    {
        return $this->imagensAntes()->exists()
            && $this->imagensDepois()->exists()
            && $this->email_rat_enviado !== null;
    }

    /** @return array<int, array{antes: ProgramadaImagem|null, depois: ProgramadaImagem|null}> */
    public function fotoPares(int $minPares = 1): array
    {
        $imagens = $this->imagens;
        $maxPar = max($minPares, (int) $imagens->max('par'));
        $pares = [];

        for ($numero = 1; $numero <= $maxPar; $numero++) {
            $doPar = $imagens->where('par', $numero);
            $pares[$numero] = [
                'antes' => $doPar->firstWhere('tipo', TipoImagemOcorrencia::Antes),
                'depois' => $doPar->firstWhere('tipo', TipoImagemOcorrencia::Depois),
            ];
        }

        return $pares;
    }

    public function proximoPar(): int
    {
        return (int) $this->imagens()->max('par') + 1;
    }

    public function relatoriosDisponiveis(): bool
    {
        return filled(trim((string) $this->descricao)) && $this->imagens()->exists();
    }

    public function scopeStatus(Builder $query, ProgramadaStatus $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeSemRascunho(Builder $query): Builder
    {
        return $query->whereNot(function (Builder $subQuery): void {
            $subQuery->where('titulo', 'Rascunho')->where('agencia', 'A definir');
        });
    }
}
