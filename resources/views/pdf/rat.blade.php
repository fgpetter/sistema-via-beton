<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: sans-serif;
            font-size: 8pt;
            color: #000;
            margin: 0;
            padding: 12px;
        }
        .titulo-principal {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            margin: 0 0 14px 0;
        }
        table.rat {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        table.rat td, table.rat th {
            border: 1px solid #000;
            vertical-align: top;
            padding: 3px 4px;
            word-wrap: break-word;
        }
        .lbl {
            background-color: #e8e8e8;
            font-size: 6.5pt;
            font-weight: bold;
            line-height: 1.2;
        }
        .val {
            min-height: 22px;
            font-size: 8pt;
            white-space: pre-wrap;
        }
        .secao-servicos {
            background-color: #b8b8b8;
            text-align: center;
            font-weight: bold;
            font-size: 8pt;
            padding: 6px !important;
        }
        .nota-codigos {
            font-size: 6pt;
            line-height: 1.35;
            padding: 6px 4px !important;
            border: 1px solid #000;
            border-top: none;
        }
        .obs-box {
            border: 1px solid #000;
            border-top: none;
            padding: 6px;
            vertical-align: top;
        }
        .obs-box--empty {
            line-height: 1.15em;
            min-height: 1.15em;
        }
        .celula-servico-item {
            vertical-align: top;
            white-space: pre-wrap;
        }
        .celula-servico-situacao {
            vertical-align: top;
        }
        .rodape-notas {
            font-size: 6.5pt;
            margin-top: 10px;
            line-height: 1.4;
        }
        .col-20 { width: 20%; }
        .col-40 { width: 40%; }
        .col-60 { width: 60%; }
        .col-80 { width: 80%; }
        .col-15 { width: 15%; }
    </style>
</head>
<body>
    <h1 class="titulo-principal">RELATÓRIO DE ATENDIMENTO</h1>

    <table class="rat" cellspacing="0">
        <tr>
            <td class="lbl">Número da ocorrência</td>
            <td class="lbl">Emergencial (Sim/Não)</td>
            <td class="lbl">Prazo de Atendimento</td>
            <td class="lbl">Número do Contrato</td>
            <td class="lbl">Responsável Engenharia Banrisul</td>
        </tr>
        <tr>
            <td class="val">{{ $dados['numero_ocorrencia'] }}</td>
            <td class="val">{{ $dados['emergencial'] }}</td>
            <td class="val">{{ $dados['prazo_atendimento'] }}</td>
            <td class="val">{{ $dados['numero_contrato'] }}</td>
            <td class="val">{{ $dados['responsavel_engenharia_banrisul'] }}</td>
        </tr>
        <tr>
            <td class="lbl">Usuário final afetado</td>
            <td class="lbl">Data da Abertura</td>
            <td class="lbl">Violação projetada</td>
            <td class="lbl">Prioridade</td>
            <td class="lbl">Usuário final afetado</td>
        </tr>
        <tr>
            <td class="val">{{ $dados['usuario_final_afetado'] }}</td>
            <td class="val">{{ $dados['data_abertura'] }}</td>
            <td class="val">{{ $dados['violacao_projetada'] }}</td>
            <td class="val">{{ $dados['prioridade'] }}</td>
            <td class="val">{{ $dados['usuario_final_afetado_col5'] }}</td>
        </tr>
        <tr>
            <td class="lbl" colspan="2">Código – Nome do local</td>
            <td class="lbl" colspan="3">Endereço</td>
        </tr>
        <tr>
            <td class="val" colspan="2">{{ $dados['codigo_nome_local'] }}</td>
            <td class="val" colspan="3">{{ $dados['endereco'] }}</td>
        </tr>
        <tr>
            <td class="secao-servicos" colspan="5">SERVIÇOS SOLICITADOS NO LOCAL</td>
        </tr>
        <tr>
            <td class="lbl col-80" colspan="4">Item e descrição do serviço</td>
            <td class="lbl col-15">Situação (Código****)</td>
        </tr>
        <tr>
            <td class="val celula-servico-item" colspan="4">{{ $dados['item_descricao_servico'] }}</td>
            <td class="val celula-servico-situacao">{{ $dados['situacao_codigo'] }}</td>
        </tr>
    </table>

    <div class="nota-codigos">
        * Preencher o campo situação com os códigos a seguir: 001. Serviço concluído sem pendências; 002. Serviço cancelado pelo demandante; 003. Confecção de orçamento
        para execução do serviço - demanda autorização da fiscalização; 004. Mitigação de Riscos ou primeiro atendimento
    </div>

    <table class="rat" cellspacing="0" style="margin-top: 0; border-top: none;">
        <tr>
            <td class="lbl" colspan="5">Observações:</td>
        </tr>
        <tr>
            <td class="obs-box val {{ trim((string) ($dados['observacoes'] ?? '')) === '' ? 'obs-box--empty' : '' }}" colspan="5">
                @if (trim((string) ($dados['observacoes'] ?? '')) !== '')
                    {{ $dados['observacoes'] }}
                @else
                    &nbsp;
                @endif
            </td>
        </tr>
    </table>

    <table class="rat" cellspacing="0" style="margin-top: 8px;">
        <tr>
            <td class="lbl">Data e hora CHEGADA</td>
            <td class="lbl">Data e hora SAÍDA</td>
            <td class="lbl">Prazo de Atendimento</td>
            <td class="lbl">Identificação do representante da contratada</td>
            <td class="lbl">Assinatura do representante da contratada</td>
        </tr>
        <tr>
            <td class="val">{{ $dados['datahora_chegada'] }}</td>
            <td class="val">{{ $dados['datahora_saida'] }}</td>
            <td class="val">{{ $dados['prazo_atendimento_rodape'] }}</td>
            <td class="val">{{ $dados['identificacao_representante'] }}</td>
            <td class="val">{{ $dados['assinatura_representante'] }}</td>
        </tr>
        <tr>
            <td class="val" colspan="5" style="text-align: center; min-height: 56px; padding-top: 28px;">
                _________________________________________________<br>
                Carimbo e assinatura da administração do Banrisul
            </td>
        </tr>
    </table>

    <div class="rodape-notas">
        <p>O RAT deverá ser emitido em 3 vias, sendo: a 1ª Dependência beneficiária, 2ª Empresa contratada e 3ª Fiscalização.</p>
        <p>A Contratada deverá anexar o orçamento atualizado conforme serviços relacionados no RAT.</p>
    </div>
</body>
</html>
