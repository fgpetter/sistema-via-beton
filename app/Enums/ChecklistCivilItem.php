<?php

namespace App\Enums;

use App\Contracts\ChecklistItemContract;
use App\Enums\Concerns\ChecklistItemConcern;

enum ChecklistCivilItem: string implements ChecklistItemContract
{
    use ChecklistItemConcern;

    case ArquiteturaExternaPasseioPublico = '1.1';
    case ArquiteturaExternaVagasEstacionamento = '1.2';
    case ArquiteturaExternaPintura = '1.3';
    case ArquiteturaExternaAlvenariaRevestida = '1.4';
    case ArquiteturaExternaTesteira = '1.5';
    case ArquiteturaExternaBandeira = '1.6';
    case ArquiteturaExternaPortico = '1.7';
    case ArquiteturaExternaPortaAcesso = '1.8';
    case ArquiteturaExternaEsquadrias = '1.9';
    case ArquiteturaExternaCortinaMetalica = '1.10';
    case ArquiteturaExternaLogoPadrao = '1.11';
    case ArquiteturaExternaAdesivoPromocional = '1.12';
    case ArquiteturaExternaAdesivoHorarioAgencia = '1.13';
    case ArquiteturaExternaAdesivoHorarioSaa = '1.14';
    case ArquiteturaExternaAdesivosCaoGuia = '1.15';
    case ArquiteturaExternaLavagemHidrojato = '1.16';

    case AcessibilidadeExternaPisoPodotatil = '2.1';
    case AcessibilidadeExternaCorrimaoRampa = '2.2';
    case AcessibilidadeExternaCorrimaoEscada = '2.3';
    case AcessibilidadeExternaPlacaBraile = '2.4';
    case AcessibilidadeExternaRampa = '2.5';
    case AcessibilidadeExternaEscada = '2.6';

    case AutoatendimentoPortaAcesso = '3.1';
    case AutoatendimentoEsquadriaAntessala = '3.2';
    case AutoatendimentoPeliculaReflexiva = '3.3';
    case AutoatendimentoPgdm = '3.4';
    case AutoatendimentoPortaCartazes = '3.5';
    case AutoatendimentoPersianas = '3.6';
    case AutoatendimentoMascaras = '3.7';
    case AutoatendimentoPlacasCashDisp = '3.8';
    case AutoatendimentoPassaObjetos = '3.9';
    case AutoatendimentoForro = '3.10';
    case AutoatendimentoPiso = '3.11';
    case AutoatendimentoPeliculaAntivandalismo = '3.12';
    case AutoatendimentoAdesivoPassaObjetos = '3.13';
    case AutoatendimentoAdesivos = '3.14';
    case AutoatendimentoAdesivosPadraoLp = '3.15';
    case AutoatendimentoAdesivosPgdm = '3.16';

    case AtendimentoForro = '4.1';
    case AtendimentoPintura = '4.2';
    case AtendimentoPiso = '4.3';
    case AtendimentoPisoTatil = '4.4';
    case AtendimentoBiombos = '4.5';
    case AtendimentoDivisorAmbientes = '4.6';
    case AtendimentoDivisorSigilo = '4.7';
    case AtendimentoAjusteLeiaute = '4.8';
    case AtendimentoPlacasSuspensas = '4.9';
    case AtendimentoPersianas = '4.10';
    case AtendimentoDivisoriaRetaguarda = '4.11';
    case AtendimentoPortaRetaguarda = '4.12';
    case AtendimentoPortaCartazes = '4.13';
    case AtendimentoInfiltracoes = '4.14';
    case AtendimentoEsquadrias = '4.15';

    case CopaPiso = '5.1';
    case CopaForro = '5.2';
    case CopaPintura = '5.3';
    case CopaRevestimentoCeramico = '5.4';
    case CopaTorneiraRegistro = '5.5';
    case CopaCaixaGordura = '5.6';
    case CopaInfiltracoes = '5.7';
    case CopaPortaFerragens = '5.8';

    case ElevadoresEscadariasGuardaCorpo = '6.1';
    case ElevadoresEscadariasCorrimao = '6.2';
    case ElevadoresEscadariasFaixasAntiderrapantes = '6.3';
    case ElevadoresEscadariasSinalizadorDegraus = '6.4';
    case ElevadoresEscadariasPisoTatil = '6.5';

    case CofrePortasMetalicas = '7.1';
    case CofreVentilacaoSala = '7.2';
    case CofrePintura = '7.3';
    case CofreFechaduras = '7.4';
    case CofreInfiltracoes = '7.5';

    case SanitarioFemininoPiso = '8.1';
    case SanitarioFemininoForro = '8.2';
    case SanitarioFemininoRevestimentos = '8.3';
    case SanitarioFemininoLoucas = '8.4';
    case SanitarioFemininoLavatorio = '8.5';
    case SanitarioFemininoDivisorias = '8.6';
    case SanitarioFemininoPortasDivisorias = '8.7';
    case SanitarioFemininoEspelhos = '8.8';
    case SanitarioFemininoEsquadrias = '8.9';
    case SanitarioFemininoInfiltracoes = '8.10';
    case SanitarioFemininoPortaPapelToalha = '8.11';
    case SanitarioFemininoPortaPapelHigienico = '8.12';

    case SanitarioMasculinoPiso = '9.1';
    case SanitarioMasculinoForro = '9.2';
    case SanitarioMasculinoRevestimentos = '9.3';
    case SanitarioMasculinoLoucas = '9.4';
    case SanitarioMasculinoLavatorio = '9.5';
    case SanitarioMasculinoDivisorias = '9.6';
    case SanitarioMasculinoPortasDivisorias = '9.7';
    case SanitarioMasculinoEspelhos = '9.8';
    case SanitarioMasculinoEsquadrias = '9.9';
    case SanitarioMasculinoInfiltracoes = '9.10';
    case SanitarioMasculinoPortaPapelToalha = '9.11';
    case SanitarioMasculinoPortaPapelHigienico = '9.12';

    case SanitarioPcdPiso = '10.1';
    case SanitarioPcdForro = '10.2';
    case SanitarioPcdRevestimentos = '10.3';
    case SanitarioPcdBacia = '10.4';
    case SanitarioPcdLavatorio = '10.5';
    case SanitarioPcdBarrasApoio = '10.6';
    case SanitarioPcdChapaInoxPortas = '10.7';
    case SanitarioPcdEspelhos = '10.8';
    case SanitarioPcdEsquadrias = '10.9';
    case SanitarioPcdInfiltracoes = '10.10';
    case SanitarioPcdPortaPapelToalha = '10.11';
    case SanitarioPcdPortaPapelHigienico = '10.12';

    case CoberturaTelhas = '11.1';
    case CoberturaCalhas = '11.2';
    case CoberturaTubosQueda = '11.3';
    case CoberturaRufosCumeeiras = '11.4';
    case CoberturaParafusosFixacao = '11.5';
    case CoberturaImpermeabilizacaoAreaTecnica = '11.6';
    case CoberturaLimpezaGeral = '11.7';
    case CoberturaReservatorios = '11.8';
    case CoberturaInstalacoesHidraulicas = '11.9';

    public function label(): string
    {
        return match ($this) {
            self::ArquiteturaExternaPasseioPublico => 'Passeio público',
            self::ArquiteturaExternaVagasEstacionamento => 'Vagas de estacionamento',
            self::ArquiteturaExternaPintura => 'Pintura',
            self::ArquiteturaExternaAlvenariaRevestida => 'Alvenaria revestida',
            self::ArquiteturaExternaTesteira => 'Testeira',
            self::ArquiteturaExternaBandeira => 'Bandeira',
            self::ArquiteturaExternaPortico => 'Pórtico',
            self::ArquiteturaExternaPortaAcesso => 'Porta de acesso',
            self::ArquiteturaExternaEsquadrias => 'Esquadrias',
            self::ArquiteturaExternaCortinaMetalica => 'Cortina metálica',
            self::ArquiteturaExternaLogoPadrao => 'Logo padrão / hexágonos',
            self::ArquiteturaExternaAdesivoPromocional => 'Adesivo promocional',
            self::ArquiteturaExternaAdesivoHorarioAgencia => 'Adesivo horário de func. Agência',
            self::ArquiteturaExternaAdesivoHorarioSaa => 'Adesivo horário de func. SAA',
            self::ArquiteturaExternaAdesivosCaoGuia => 'Adesivos cão guia / SIA / puxe empurre',
            self::ArquiteturaExternaLavagemHidrojato => 'Lavagem hidrojato',

            self::AcessibilidadeExternaPisoPodotatil => 'Piso podotátil',
            self::AcessibilidadeExternaCorrimaoRampa => 'Corrimão rampa',
            self::AcessibilidadeExternaCorrimaoEscada => 'Corrimão escada',
            self::AcessibilidadeExternaPlacaBraile => 'Placa braile',
            self::AcessibilidadeExternaRampa => 'Rampa',
            self::AcessibilidadeExternaEscada => 'Escada',

            self::AutoatendimentoPortaAcesso => 'Porta acesso',
            self::AutoatendimentoEsquadriaAntessala => 'Esquadria antessala',
            self::AutoatendimentoPeliculaReflexiva => 'Película reflexiva',
            self::AutoatendimentoPgdm => 'PGDM',
            self::AutoatendimentoPortaCartazes => 'Porta cartazes',
            self::AutoatendimentoPersianas => 'Persianas',
            self::AutoatendimentoMascaras => 'Máscaras',
            self::AutoatendimentoPlacasCashDisp => 'Placas cash/disp',
            self::AutoatendimentoPassaObjetos => 'Passa objetos',
            self::AutoatendimentoForro => 'Forro',
            self::AutoatendimentoPiso => 'Piso',
            self::AutoatendimentoPeliculaAntivandalismo => 'Película antivandalismo',
            self::AutoatendimentoAdesivoPassaObjetos => 'Adesivo passa objetos',
            self::AutoatendimentoAdesivos => 'Adesivos',
            self::AutoatendimentoAdesivosPadraoLp => 'Adesivos padrão (LP)',
            self::AutoatendimentoAdesivosPgdm => 'Adesivos PGDM',

            self::AtendimentoForro => 'Forro',
            self::AtendimentoPintura => 'Pintura',
            self::AtendimentoPiso => 'Piso',
            self::AtendimentoPisoTatil => 'Piso tátil',
            self::AtendimentoBiombos => 'Biombos',
            self::AtendimentoDivisorAmbientes => 'Divisor de ambientes',
            self::AtendimentoDivisorSigilo => 'Divisor de sigilo',
            self::AtendimentoAjusteLeiaute => 'Necessidade de ajuste de leiaute',
            self::AtendimentoPlacasSuspensas => 'Placas suspensas',
            self::AtendimentoPersianas => 'Persianas',
            self::AtendimentoDivisoriaRetaguarda => 'Divisória retaguarda',
            self::AtendimentoPortaRetaguarda => 'Porta retaguarda',
            self::AtendimentoPortaCartazes => 'Porta cartazes',
            self::AtendimentoInfiltracoes => 'Infiltrações',
            self::AtendimentoEsquadrias => 'Esquadrias',

            self::CopaPiso => 'Piso',
            self::CopaForro => 'Forro',
            self::CopaPintura => 'Pintura',
            self::CopaRevestimentoCeramico => 'Revestimento cerâmico',
            self::CopaTorneiraRegistro => 'Torneira/registro',
            self::CopaCaixaGordura => 'Caixa de gordura',
            self::CopaInfiltracoes => 'Infiltrações',
            self::CopaPortaFerragens => 'Porta/ferragens',

            self::ElevadoresEscadariasGuardaCorpo => 'Guarda corpo',
            self::ElevadoresEscadariasCorrimao => 'Corrimão',
            self::ElevadoresEscadariasFaixasAntiderrapantes => 'Faixas antiderrapantes',
            self::ElevadoresEscadariasSinalizadorDegraus => 'Sinalizador degraus',
            self::ElevadoresEscadariasPisoTatil => 'Piso tátil',

            self::CofrePortasMetalicas => 'Portas metálicas',
            self::CofreVentilacaoSala => 'Ventilação sala cofre',
            self::CofrePintura => 'Pintura',
            self::CofreFechaduras => 'Fechaduras',
            self::CofreInfiltracoes => 'Infiltrações',

            self::SanitarioFemininoPiso => 'Piso',
            self::SanitarioFemininoForro => 'Forro',
            self::SanitarioFemininoRevestimentos => 'Revestimentos',
            self::SanitarioFemininoLoucas => 'Louças',
            self::SanitarioFemininoLavatorio => 'Lavatório',
            self::SanitarioFemininoDivisorias => 'Divisórias',
            self::SanitarioFemininoPortasDivisorias => 'Portas divisórias',
            self::SanitarioFemininoEspelhos => 'Espelhos',
            self::SanitarioFemininoEsquadrias => 'Esquadrias',
            self::SanitarioFemininoInfiltracoes => 'Infiltrações',
            self::SanitarioFemininoPortaPapelToalha => 'Porta papel toalha',
            self::SanitarioFemininoPortaPapelHigienico => 'Porta papel higiênico',

            self::SanitarioMasculinoPiso => 'Piso',
            self::SanitarioMasculinoForro => 'Forro',
            self::SanitarioMasculinoRevestimentos => 'Revestimentos',
            self::SanitarioMasculinoLoucas => 'Louças',
            self::SanitarioMasculinoLavatorio => 'Lavatório',
            self::SanitarioMasculinoDivisorias => 'Divisórias',
            self::SanitarioMasculinoPortasDivisorias => 'Portas divisórias',
            self::SanitarioMasculinoEspelhos => 'Espelhos',
            self::SanitarioMasculinoEsquadrias => 'Esquadrias',
            self::SanitarioMasculinoInfiltracoes => 'Infiltrações',
            self::SanitarioMasculinoPortaPapelToalha => 'Porta papel toalha',
            self::SanitarioMasculinoPortaPapelHigienico => 'Porta papel higiênico',

            self::SanitarioPcdPiso => 'Piso',
            self::SanitarioPcdForro => 'Forro',
            self::SanitarioPcdRevestimentos => 'Revestimentos',
            self::SanitarioPcdBacia => 'Bacia sanitária com caixa de descarga',
            self::SanitarioPcdLavatorio => 'Lavatório com torneira',
            self::SanitarioPcdBarrasApoio => 'Barras de apoio',
            self::SanitarioPcdChapaInoxPortas => 'Chapa em inox portas',
            self::SanitarioPcdEspelhos => 'Espelhos',
            self::SanitarioPcdEsquadrias => 'Esquadrias',
            self::SanitarioPcdInfiltracoes => 'Infiltrações',
            self::SanitarioPcdPortaPapelToalha => 'Porta papel toalha',
            self::SanitarioPcdPortaPapelHigienico => 'Porta papel higiênico',

            self::CoberturaTelhas => 'Telhas',
            self::CoberturaCalhas => 'Calhas',
            self::CoberturaTubosQueda => 'Tubos de queda',
            self::CoberturaRufosCumeeiras => 'Rufos/cumeeiras',
            self::CoberturaParafusosFixacao => 'Parafusos de fixação',
            self::CoberturaImpermeabilizacaoAreaTecnica => 'Impermeabilização de área técnica',
            self::CoberturaLimpezaGeral => 'Limpeza geral',
            self::CoberturaReservatorios => "Reservatórios d'água",
            self::CoberturaInstalacoesHidraulicas => 'Instalações hidráulicas complementares',
        };
    }

    public function bloco(): ChecklistCivilBloco
    {
        return ChecklistCivilBloco::porNumero((int) strstr($this->value, '.', true));
    }
}
