<?php

namespace App\Models;

use App\Enums\PreventivaStatus;
use Database\Factories\PreventivaFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Preventiva extends Model
{
    /** @use HasFactory<PreventivaFactory> */
    use HasFactory;

    protected $table = 'preventivas';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'titulo',
        'descricao',
        'abertura',
        'contrato',
        'responsavel_engenharia_id',
        'colaborador_id',
        'agencia',
        'endereco_id',
        'endereco',
        'datahora_chegada',
        'datahora_saida',
        'comentarios',
        'concluido_por',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => PreventivaStatus::class,
            'abertura' => 'date',
            'datahora_chegada' => 'datetime',
            'datahora_saida' => 'datetime',
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
        return $this->hasMany(PreventivaImagem::class)
            ->orderBy('position')
            ->orderBy('id');
    }

    public function imagensAceitas(): HasMany
    {
        return $this->hasMany(PreventivaImagem::class)->where('recusada', false);
    }

    public function imagensRecusadas(): HasMany
    {
        return $this->hasMany(PreventivaImagem::class)->where('recusada', true);
    }

    public function imagensAceitasComMedicao(): HasMany
    {
        return $this->hasMany(PreventivaImagem::class)
            ->where('recusada', false)
            ->orderBy('position')
            ->orderBy('id')
            ->with('medicaoImagens');
    }

    public function atendimentoIniciado(): bool
    {
        return $this->datahora_chegada !== null;
    }

    public function relatoriosDisponiveis(): bool
    {
        return filled(trim((string) $this->descricao))
            && $this->imagens()->exists();
    }

    public function relatorioMedicaoDisponivel(): bool
    {
        return $this->relatoriosDisponiveis()
            && $this->imagensAceitas()
                ->whereHas('medicaoImagens')
                ->exists();
    }

    public function scopeStatus(Builder $query, PreventivaStatus $status): Builder
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
