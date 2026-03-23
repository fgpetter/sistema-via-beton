<?php

namespace App\Models;

use App\Enums\OcorrenciaStatus;
use App\Enums\TipoImagemOcorrencia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ocorrencia extends Model
{
    /** @use HasFactory<\Database\Factories\OcorrenciaFactory> */
    use HasFactory;

    protected $table = 'ocorrencias';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'titulo',
        'descricao',
        'abertura',
        'colaborador_id',
        'prazo_id',
        'agencia',
        'endereco_id',
        'endereco',
        'email_enviado',
        'email_rat',
        'email_rat_enviado',
        'datahora_chegada',
        'datahora_saida',
        'comentarios',
        'comentarios_prestador',
        'concluido_por',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => OcorrenciaStatus::class,
            'abertura' => 'date',
            'email_enviado' => 'datetime',
            'email_rat_enviado' => 'datetime',
            'datahora_chegada' => 'datetime',
            'datahora_saida' => 'datetime',
        ];
    }

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function prazo(): BelongsTo
    {
        return $this->belongsTo(Prazo::class);
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

    public function isEmergencial(): bool
    {
        return $this->prazo?->nome === Prazo::EMERGENCIAL;
    }

    public function scopeEmergenciaisFirst(Builder $query): Builder
    {
        return $query->orderByRaw(
            'EXISTS (SELECT 1 FROM prazos WHERE prazos.id = ocorrencias.prazo_id AND prazos.nome = ?) DESC',
            [Prazo::EMERGENCIAL]
        );
    }

    public function concluidoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'concluido_por');
    }

    public function imagens(): HasMany
    {
        return $this->hasMany(OcorrenciaImagem::class);
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
        return $this->datahora_chegada !== null;
    }

    public function podeConcluir(): bool
    {
        return $this->imagensAntes()->exists()
            && $this->imagensDepois()->exists()
            && $this->email_rat_enviado !== null;
    }

    /**
     * @return array<int, array{antes: OcorrenciaImagem|null, depois: OcorrenciaImagem|null}>
     */
    public function fotoPares(int $minPares = 1): array
    {
        $imagens = $this->imagens;
        $maxPar = max($minPares, (int) $imagens->max('par'), 1);
        $pares = [];

        for ($i = 1; $i <= $maxPar; $i++) {
            $parImagens = $imagens->where('par', $i);
            $pares[$i] = [
                'antes' => $parImagens->firstWhere('tipo', TipoImagemOcorrencia::Antes),
                'depois' => $parImagens->firstWhere('tipo', TipoImagemOcorrencia::Depois),
            ];
        }

        return $pares;
    }

    public function proximoPar(): int
    {
        return ((int) $this->imagens()->max('par')) + 1;
    }

    public function scopeStatus(Builder $query, OcorrenciaStatus $status): Builder
    {
        return $query->where('status', $status);
    }
}
