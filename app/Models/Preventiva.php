<?php

namespace App\Models;

use App\Enums\PreventivaStatus;
use App\Enums\ResponsavelEngenhariaBanrisul;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Preventiva extends Model
{
    /** @use HasFactory<\Database\Factories\PreventivaFactory> */
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
        'responsavel_engenharia_banrisul',
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
            'responsavel_engenharia_banrisul' => ResponsavelEngenhariaBanrisul::class,
            'abertura' => 'date',
            'datahora_chegada' => 'datetime',
            'datahora_saida' => 'datetime',
        ];
    }

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
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

    public function scopeStatus(\Illuminate\Database\Eloquent\Builder $query, PreventivaStatus $status): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('status', $status);
    }

    public function scopeSemRascunho(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereNot(function (\Illuminate\Database\Eloquent\Builder $subQuery): void {
            $subQuery->where('titulo', 'Rascunho')->where('agencia', 'A definir');
        });
    }
}
