<?php

namespace App\Enums;

use App\Contracts\ChecklistItemContract;
use App\Enums\Concerns\ChecklistItemConcern;

enum ChecklistEletricaItem: string implements ChecklistItemContract
{
    use ChecklistItemConcern;

    case ItensGeraisTrocaIluminacao = '1.1';
    case ItensGeraisTrocaTomadasInterruptores = '1.2';
    case ItensGeraisCabeamentoEstruturado = '1.3';
    case ItensGeraisRetirarCabosRackCftv = '1.4';

    case EntradaTelecomNovaTubulacao = '2.1';
    case EntradaTelecomRetirarDg = '2.2';

    case InfraestruturaExternaLampadasLogomarca = '3.1';
    case InfraestruturaExternaLampadasPortico = '3.2';
    case InfraestruturaExternaLampadasTotem = '3.3';
    case InfraestruturaExternaLuminariasFachada = '3.4';
    case InfraestruturaExternaLampadasFachada = '3.5';
    case InfraestruturaExternaSubstituicaoPortico = '3.6';

    case SalaAutoatendimentoLampadasMascaraCashes = '4.1';
    case SalaAutoatendimentoGeradorNevoa = '4.2';
    case SalaAutoatendimentoReposicionarLuminarias = '4.3';
    case SalaAutoatendimentoEmergenciaSaa = '4.4';
    case SalaAutoatendimentoEmergenciaRetaguarda = '4.5';
    case SalaAutoatendimentoCircuitoEstabilizadoCash = '4.6';
    case SalaAutoatendimentoInfraCortinaMetalica = '4.7';
    case SalaAutoatendimentoTrocaCdTimer = '4.8';
    case SalaAutoatendimentoTimerAc = '4.9';
    case SalaAutoatendimentoIdentificacaoTimers = '4.10';
    case SalaAutoatendimentoFluxoLuminosoRetaguarda = '4.11';
    case SalaAutoatendimentoCabosSoltosMascara = '4.12';
    case SalaAutoatendimentoTomadasNovoPadrao = '4.13';

    case CaixasFluxoLuminoso = '5.1';
    case CaixasPontoContadorCedulas = '5.2';
    case CaixasPontoTelefonico = '5.3';
    case CaixasEmergencia = '5.4';
    case CaixasTomadasNovoPadrao = '5.5';

    case NoBreakTestarExaustor = '6.1';
    case NoBreakInfraPl = '6.2';
    case NoBreakInfraNovoModelo = '6.3';
    case NoBreakRetirarDoChao = '6.4';
    case NoBreakTrocaCdbk = '6.5';

    case AtendimentoEmergenciaSaguao = '7.1';
    case AtendimentoPontosTvCorporativa = '7.2';
    case AtendimentoCabosComputadoresMesas = '7.3';
    case AtendimentoCabosComputadoresCaixas = '7.4';
    case AtendimentoCanaletasRd70Slim = '7.5';
    case AtendimentoTomadasMesas = '7.6';
    case AtendimentoIdentificacaoAnilhas = '7.7';
    case AtendimentoTomadasVermelhasImpressoras = '7.8';
    case AtendimentoPlacaSaidaPgdm = '7.9';
    case AtendimentoInterruptoresSeletividade = '7.10';
    case AtendimentoFluxoLuminosoEstacoes = '7.11';
    case AtendimentoPontoLogicoTgf = '7.12';
    case AtendimentoRetirarEletrodutos = '7.13';
    case AtendimentoPontoLogicoWifi = '7.14';
    case AtendimentoPgdmRedeEstabilizada = '7.15';
    case AtendimentoTgaTvRedeEstabilizada = '7.16';

    case SalaAutomacaoRetirarDgTelefonico = '8.1';
    case SalaAutomacaoEmergencia = '8.2';
    case SalaAutomacaoFluxoLuminoso = '8.3';
    case SalaAutomacaoRetirarInfraCftv = '8.4';
    case SalaAutomacaoRetirarRackCftv = '8.5';
    case SalaAutomacaoRetirarCaixasPvc = '8.6';
    case SalaAutomacaoRemanejarRackAtivos = '8.7';
    case SalaAutomacaoTrocarRackAtivos = '8.8';
    case SalaAutomacaoRemanejarRackOperadoras = '8.9';
    case SalaAutomacaoInstalarRackOperadoras = '8.10';
    case SalaAutomacaoRemanejarCdEletrico = '8.11';
    case SalaAutomacaoRemanejarWifi = '8.12';
    case SalaAutomacaoPatchPanelDescarregado = '8.13';
    case SalaAutomacaoTrocaPatchCord = '8.14';
    case SalaAutomacaoReguaPadraoOp = '8.15';
    case SalaAutomacaoCircuitosRacks = '8.16';
    case SalaAutomacaoRetirarCaixaPassagemCftv = '8.17';

    case SalaCofreAntessalaEmergencia = '9.1';
    case SalaCofreAntessalaPontoLogico = '9.2';
    case SalaCofreAntessalaFluxoLuminoso = '9.3';

    case BanheirosPlafonLed = '10.1';
    case BanheirosSensorPresenca = '10.2';
    case BanheirosRetirarLuminarias = '10.3';
    case BanheirosRetirarInterruptores = '10.4';
    case BanheirosTrocarExaustor = '10.5';
    case BanheirosBotaoPanico = '10.6';

    case QuadrosEletricosDpsQgbt = '11.1';
    case QuadrosEletricosIdentificacaoAnilhas = '11.2';
    case QuadrosEletricosPlacasDisjuntores = '11.3';
    case QuadrosEletricosReapertarParafusos = '11.4';
    case QuadrosEletricosDiagramaCargas = '11.5';
    case QuadrosEletricosPlacaPvc5x3 = '11.6';
    case QuadrosEletricosIdentificacaoIdrs = '11.7';
    case QuadrosEletricosCamuflagemEspacosVagos = '11.8';
    case QuadrosEletricosPlacaNaoDesligue = '11.9';
    case QuadrosEletricosCircuitoCopa = '11.10';
    case QuadrosEletricosFragmentadora = '11.11';
    case QuadrosEletricosIdrs25A = '11.12';
    case QuadrosEletricosTermografia = '11.13';
    case QuadrosEletricosTrocaQgbt = '11.14';
    case QuadrosEletricosTrocaCdbk = '11.15';
    case QuadrosEletricosTrocaCd1 = '11.16';
    case QuadrosEletricosTrocaCd2 = '11.17';
    case QuadrosEletricosTrocaCdEstabilizado = '11.18';
    case QuadrosEletricosRevisarArCondicionado = '11.19';
    case QuadrosEletricosCortinaRedeEstabilizada = '11.20';
    case QuadrosEletricosMedirAterramento = '11.21';

    public function label(): string
    {
        return match ($this) {
            self::ItensGeraisTrocaIluminacao => 'Troca do sistema de iluminação',
            self::ItensGeraisTrocaTomadasInterruptores => 'Trocar tomadas e interruptores embutidos antigos',
            self::ItensGeraisCabeamentoEstruturado => 'Instalação de cabeamento estruturado',
            self::ItensGeraisRetirarCabosRackCftv => 'Retirar cabos e rack cftv em desuso',

            self::EntradaTelecomNovaTubulacao => 'Instalar nova tubulação para entrada telecom',
            self::EntradaTelecomRetirarDg => 'Retirar DG de entrada',

            self::InfraestruturaExternaLampadasLogomarca => 'Trocar lâmpadas da logomarca',
            self::InfraestruturaExternaLampadasPortico => 'Trocar lâmpadas do pórtico',
            self::InfraestruturaExternaLampadasTotem => 'Trocar lâmpadas do totem',
            self::InfraestruturaExternaLuminariasFachada => 'Instalar luminárias na fachada',
            self::InfraestruturaExternaLampadasFachada => 'Trocar lâmpadas da fachada',
            self::InfraestruturaExternaSubstituicaoPortico => 'Substituição do pórtico',

            self::SalaAutoatendimentoLampadasMascaraCashes => 'Trocar lâmpadas na máscara dos cashes',
            self::SalaAutoatendimentoGeradorNevoa => 'Será necessário mov. gerador de névoa devido à mov. dos cashes',
            self::SalaAutoatendimentoReposicionarLuminarias => 'Reposicionar luminárias devido à mov. dos cashes',
            self::SalaAutoatendimentoEmergenciaSaa => 'Prever instalação de luminária de emergência na SAA',
            self::SalaAutoatendimentoEmergenciaRetaguarda => 'Prever instalação de luminária de emergência na retaguarda',
            self::SalaAutoatendimentoCircuitoEstabilizadoCash => 'Instalar circuito estabilizado para cash superfull',
            self::SalaAutoatendimentoInfraCortinaMetalica => 'Prever infraestrutura para cortina metálica',
            self::SalaAutoatendimentoTrocaCdTimer => 'Troca de CD timer',
            self::SalaAutoatendimentoTimerAc => 'Precisa de timer para AC',
            self::SalaAutoatendimentoIdentificacaoTimers => 'Prever identificação dos timers no CD Timer',
            self::SalaAutoatendimentoFluxoLuminosoRetaguarda => 'Precisa corrigir fluxo luminoso de no mínimo 600 lux na retag.',
            self::SalaAutoatendimentoCabosSoltosMascara => 'Cabos soltos na máscara - organizar',
            self::SalaAutoatendimentoTomadasNovoPadrao => 'Tomadas novo padrão',

            self::CaixasFluxoLuminoso => 'Precisa corrigir fluxo luminosos de no mínimo 600 lux nos caixas',
            self::CaixasPontoContadorCedulas => 'Ponto para contador de cédulas na rede estabilizada',
            self::CaixasPontoTelefonico => 'Ponto telefônico',
            self::CaixasEmergencia => 'Luminária de emergência',
            self::CaixasTomadasNovoPadrao => 'Tomadas novo padrão',

            self::NoBreakTestarExaustor => 'Testar exaustor (termostato)',
            self::NoBreakInfraPl => 'Tem infra para PL do NoBreak',
            self::NoBreakInfraNovoModelo => 'Tem infra novo modelo (noBreak na prateleira de baterias, cd para disjuntor, etc...)',
            self::NoBreakRetirarDoChao => 'Retirar nobreak do chão',
            self::NoBreakTrocaCdbk => 'Troca do CDBK do nobreak',

            self::AtendimentoEmergenciaSaguao => 'Prever instalação de luminária de emergência no saguão',
            self::AtendimentoPontosTvCorporativa => 'Prever instalação de pontos para TV Corporativa',
            self::AtendimentoCabosComputadoresMesas => 'Verificar se precisa trocar os cabos dos computadores das mesas',
            self::AtendimentoCabosComputadoresCaixas => 'Verificar se precisa trocar os cabos dos computadores nos caixas',
            self::AtendimentoCanaletasRd70Slim => 'Verificar se precisa trocar canaletas RD70 por SLIM nas mesas',
            self::AtendimentoTomadasMesas => 'Verificar se precisa trocar tomadas para novo padrão nas mesas',
            self::AtendimentoIdentificacaoAnilhas => 'Falta identificação com anilhas Oval Grip nos cabos de rede estruturada de fonia e lógica dos pontos da plataforma',
            self::AtendimentoTomadasVermelhasImpressoras => 'Falta a instalação das tomadas vermelhas dos pontos elétricos comum das impressoras laser',
            self::AtendimentoPlacaSaidaPgdm => 'Retirar placa "SAÍDA" da PGDM e colocar na porta auxiliar',
            self::AtendimentoInterruptoresSeletividade => 'Falta a instalação de interruptores para seletividade das luminárias do saguão e plataforma',
            self::AtendimentoFluxoLuminosoEstacoes => 'Precisa corrigir fluxo luminoso para ter no mínimo 600 lux nas estações de trabalho',
            self::AtendimentoPontoLogicoTgf => 'Ponto lógico TGF',
            self::AtendimentoRetirarEletrodutos => 'Retirar eletrodutos dos interruptores, ponto lógicos e instalar canaletas',
            self::AtendimentoPontoLogicoWifi => 'Ponto lógico WiFi',
            self::AtendimentoPgdmRedeEstabilizada => 'PGDM deverá estar na rede estabilizada',
            self::AtendimentoTgaTvRedeEstabilizada => 'TGA TV deverá estar na rede estabilizada',

            self::SalaAutomacaoRetirarDgTelefonico => 'Retirar DG telefônico da Automação',
            self::SalaAutomacaoEmergencia => 'Prever instalação de luminária de emergência',
            self::SalaAutomacaoFluxoLuminoso => 'Precisa corrigir fluxo luminoso, mínimo de 600 lux',
            self::SalaAutomacaoRetirarInfraCftv => 'Retirar infra CFTV junto da automação',
            self::SalaAutomacaoRetirarRackCftv => 'Retirar rack do CFTV em desuso',
            self::SalaAutomacaoRetirarCaixasPvc => 'Retirar caixas em PVC em desuso',
            self::SalaAutomacaoRemanejarRackAtivos => 'Remanejar rack dos ativos',
            self::SalaAutomacaoTrocarRackAtivos => 'Trocar rack existente dos ativos',
            self::SalaAutomacaoRemanejarRackOperadoras => 'Remanejar rack das operadoras',
            self::SalaAutomacaoInstalarRackOperadoras => 'Instalar rack das operadoras',
            self::SalaAutomacaoRemanejarCdEletrico => 'Remanejar CD elétrico',
            self::SalaAutomacaoRemanejarWifi => 'Remanejar Wifi para o atendimento',
            self::SalaAutomacaoPatchPanelDescarregado => 'Precisa patch panel descarregado',
            self::SalaAutomacaoTrocaPatchCord => 'Troca de patch cord',
            self::SalaAutomacaoReguaPadraoOp => 'Instalar régua elétrica padrão novo OP',
            self::SalaAutomacaoCircuitosRacks => 'Instalar circuitos elétricos para os racks',
            self::SalaAutomacaoRetirarCaixaPassagemCftv => 'Retirar caixa de passagem CFTV',

            self::SalaCofreAntessalaEmergencia => 'Prever instalação de luminária de emergência na sala cofre',
            self::SalaCofreAntessalaPontoLogico => 'Prever instalação de ponto lógico para cofre',
            self::SalaCofreAntessalaFluxoLuminoso => 'Precisa corrigir fluxo luminoso, mínimo de 600 lux',

            self::BanheirosPlafonLed => 'Trocar luminárias por plafon LED',
            self::BanheirosSensorPresenca => 'Instalar sensor de presença',
            self::BanheirosRetirarLuminarias => 'Retirar luminárias',
            self::BanheirosRetirarInterruptores => 'Retirar interruptores',
            self::BanheirosTrocarExaustor => 'Trocar exaustor',
            self::BanheirosBotaoPanico => 'Testar botão de pânico no banheiro acessível',

            self::QuadrosEletricosDpsQgbt => "Instalar DPS's de fase e neutro no QGBT",
            self::QuadrosEletricosIdentificacaoAnilhas => 'Falta a identificação com anilhas Oval Grip dos circuitos elétr.',
            self::QuadrosEletricosPlacasDisjuntores => 'Identificar disjuntores com placas de PVC 3x1cm dos circuitos',
            self::QuadrosEletricosReapertarParafusos => 'Reapertar parafusos dos disjuntores e demais barramentos',
            self::QuadrosEletricosDiagramaCargas => 'Diagrama do Quadro de Cargas em tamanho A4 dentro de display',
            self::QuadrosEletricosPlacaPvc5x3 => 'Identificação com placa de PVC 5x3cm (QGBT, CD01, CD ESTAB...)',
            self::QuadrosEletricosIdentificacaoIdrs => 'Identificação dos circuitos dos IDRs',
            self::QuadrosEletricosCamuflagemEspacosVagos => 'Colocação de camuflagem nos espaços vagos',
            self::QuadrosEletricosPlacaNaoDesligue => 'Placa de PVC 5x3cm fundo branco e letras vermelhas ("NÃO DESLIGUE AUTOMAÇÃO"), junto ao QDBK no QGBT',
            self::QuadrosEletricosCircuitoCopa => 'Instalação de circuito exclusivo e tomadas para bebedouro, geladeira, maq. café, microondas e chaleira elétrica, fora da rede estabilizada',
            self::QuadrosEletricosFragmentadora => 'Instalação de infra e tomada comum para fragmentadora de papéis fora da rede estabilizada',
            self::QuadrosEletricosIdrs25A => 'Instalação de IDRs 25A/30mA para circuitos elétricos parciais',
            self::QuadrosEletricosTermografia => 'Termografia com relatório (Casas A, B, C)',
            self::QuadrosEletricosTrocaQgbt => 'Troca do QGBT para novo modelo',
            self::QuadrosEletricosTrocaCdbk => 'Troca do CDBK para novo modelo',
            self::QuadrosEletricosTrocaCd1 => 'Troca do CD1',
            self::QuadrosEletricosTrocaCd2 => 'Troca do CD2',
            self::QuadrosEletricosTrocaCdEstabilizado => 'Troca do CD Estabilizado',
            self::QuadrosEletricosRevisarArCondicionado => 'Revisar circuitos de ar condicionado (os mesmos deverão estar na rede comum)',
            self::QuadrosEletricosCortinaRedeEstabilizada => 'Cortina metálica deverá estar na rede estabilizada',
            self::QuadrosEletricosMedirAterramento => 'Medir aterramento',
        };
    }

    public function bloco(): ChecklistEletricaBloco
    {
        return ChecklistEletricaBloco::porNumero((int) strstr($this->value, '.', true));
    }
}
