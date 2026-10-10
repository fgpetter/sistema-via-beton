<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 18px 22px; }
        * { box-sizing: border-box; }
        body {
            font-family: sans-serif;
            font-size: 7.5pt;
            color: #000;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        td, th {
            border: 1px solid #000;
            padding: 2px 4px;
            vertical-align: middle;
            word-wrap: break-word;
        }
        tr, table.bloco { page-break-inside: avoid; }
        table.bloco { margin-top: -1px; }

        .banner { width: 100%; display: block; }
        .titulo {
            text-align: center;
            font-size: 10.5pt;
            font-weight: bold;
            margin: 10px 0 8px 0;
        }

        table.cabecalho td { font-size: 8pt; padding: 6px 6px; }
        table.cabecalho .tipologia { width: 26%; }
        table.cabecalho .rotulo { font-weight: bold; }

        .faixa-cinza {
            background-color: #d9d9d9;
            font-weight: bold;
            font-size: 8pt;
            text-align: left;
            padding: 3px 6px;
            border: 1px solid #000;
        }
        .instrucoes td { border: none; padding: 1px 6px; font-size: 7.5pt; }

        .cabecalho-colunas th {
            background-color: #d9d9d9;
            font-weight: bold;
            text-align: center;
            font-size: 7pt;
            padding: 3px 2px;
        }

        .bloco-titulo td {
            background-color: #d9d9d9;
            font-weight: bold;
            font-size: 7.5pt;
            padding: 3px 4px;
        }

        td.grupo {
            background-color: #d9d9d9;
            text-align: center;
            padding: 0;
            font-weight: bold;
            font-size: 7pt;
        }
        .vertical {
            transform: rotate(-90deg);
            white-space: nowrap;
            letter-spacing: 2px;
            display: inline-block;
        }

        td.codigo {
            font-size: 6.5pt;
            white-space: nowrap;
            padding: 1px 3px;
        }
        td.label { font-size: 7.5pt; }
        td.resposta { text-align: center; }
        .caixa {
            display: inline-block;
            width: 9px;
            height: 9px;
            border: 1px solid #000;
            font-size: 7pt;
            font-weight: bold;
            line-height: 9px;
            text-align: center;
        }

        .caixa-observacoes {
            min-height: 90px;
            font-size: 8pt;
            vertical-align: top;
            padding: 6px;
        }
    </style>
</head>
<body>
    @php
        $comGrupos = $dados['com_grupos'];
        // Larguras das colunas: com grupo lateral (civil) ou sem ele (elétrica, que ganha a largura do grupo).
        $larguras = $comGrupos
            ? ['7%', '7%', '43%', '13.33%', '13.33%', '13.34%']
            : ['13.33%', '46.67%', '13.33%', '13.33%', '13.34%'];
    @endphp

    <img class="banner" src="{{ public_path('images/checklist/banrisul_topo.png') }}">

    <div class="titulo">CHECKLIST DE LEVANTAMENTO PARA MANUTENÇÕES PREVENTIVAS | {{ $dados['titulo'] }}</div>

    <table class="cabecalho" cellspacing="0">
        <colgroup>
            <col style="width: 45%">
            <col style="width: 29%">
            <col style="width: 26%">
        </colgroup>
        <tr>
            <td colspan="2"><span class="rotulo">AGÊNCIA:</span> {{ $dados['agencia'] }}</td>
            <td class="tipologia" rowspan="2">
                <span class="rotulo">TIPOLOGIA DO IMÓVEL:</span><br>
                ( ) PRÓPRIO<br>
                ( ) LOCADO
            </td>
        </tr>
        <tr>
            <td><span class="rotulo">RESP. TÉCNICO:</span> {{ $dados['responsavel_tecnico'] }}</td>
            <td><span class="rotulo">DATA:</span> {{ $dados['data'] }}</td>
        </tr>
    </table>

    <table class="instrucoes" cellspacing="0" style="margin-top: 8px;">
        <colgroup>
            <col style="width: 100%">
        </colgroup>
        <tr><td class="faixa-cinza" style="border: 1px solid #000;">INSTRUÇÕES DE USO</td></tr>
        <tr><td>Preencher o cabeçalho com as informações da agência</td></tr>
        <tr><td>Antes da vistoria, imprimir a aba do checklist e preencher fisicamente in loco.</td></tr>
        <tr><td>Marcar "SIM" se houver necessidade de intervenção e "NÃO" se não houver necessidade de intervenção</td></tr>
    </table>

    <table cellspacing="0" style="margin-top: 8px;">
        <colgroup>
            @foreach ($larguras as $largura)
                <col style="width: {{ $largura }}">
            @endforeach
        </colgroup>
        <tr class="cabecalho-colunas">
            @if ($comGrupos)
                <th style="width: 7%; border: none;"></th>
            @endif
            <th style="width: 7%; border: none;"></th>
            <th style="width: {{ $comGrupos ? '43%' : '46.67%' }};">ITEM</th>
            <th style="width: 13.33%;">SIM</th>
            <th style="width: 13.33%;">NÃO</th>
            <th style="width: 13.34%;">{{ $dados['rotulo_nao_aplica'] }}</th>
        </tr>
    </table>

    @foreach ($dados['grupos'] as $grupo)
        @foreach ($grupo['blocos'] as $bloco)
            <table class="bloco" cellspacing="0">
                <colgroup>
                    @foreach ($larguras as $largura)
                        <col style="width: {{ $largura }}">
                    @endforeach
                </colgroup>
                <tr style="height: 0; line-height: 0; font-size: 0;">
                    @foreach ($larguras as $largura)
                        <td style="width: {{ $largura }}; padding: 0; border: none;"></td>
                    @endforeach
                </tr>
                <tr class="bloco-titulo">
                    @if ($comGrupos)
                        <td class="grupo" rowspan="{{ 1 + count($bloco['itens']) }}"><div class="vertical">{{ $grupo['nome'] }}</div></td>
                    @endif
                    <td colspan="5">{{ $bloco['codigo'] }} {{ $bloco['titulo'] }}</td>
                </tr>
                @foreach ($bloco['itens'] as $item)
                    <tr>
                        <td class="codigo">{{ $item['codigo'] }}</td>
                        <td class="label">{{ $item['label'] }}</td>
                        <td class="resposta"><span class="caixa">{{ $item['resposta'] === 'S' ? 'X' : '' }}</span></td>
                        <td class="resposta"><span class="caixa">{{ $item['resposta'] === 'N' ? 'X' : '' }}</span></td>
                        <td class="resposta"><span class="caixa">{{ $item['resposta'] === 'NA' ? 'X' : '' }}</span></td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    @endforeach

    <table cellspacing="0" style="margin-top: 10px;">
        <colgroup>
            <col style="width: 100%">
        </colgroup>
        <tr><td class="faixa-cinza">OBSERVAÇÕES:</td></tr>
        <tr><td class="caixa-observacoes">{!! nl2br(e($dados['observacoes'])) !!}</td></tr>
    </table>
</body>
</html>
