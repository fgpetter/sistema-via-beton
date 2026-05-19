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
        }
        .cabecalho-logo {
            text-align: center;
            vertical-align: middle;
            padding: 6px 4px;
            border: none;
        }
        .cabecalho-titulo {
            text-align: center;
            vertical-align: middle;
            font-size: 12pt;
            font-weight: bold;
            border: none;
        }
        .th-foto {
            background-color: #b8b8b8;
            text-align: center;
            font-weight: bold;
            font-size: 8pt;
            padding: 6px !important;
            width: 50%;
        }
        .td-foto {
            vertical-align: top;
            padding: 4px !important;
            width: 50%;
        }
        .foto-img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        .foto-legenda {
            font-size: 6.5pt;
            padding-top: 2px;
            text-align: center;
        }
        .sem-foto {
            display: block;
            text-align: center;
            color: #999;
            font-size: 7pt;
            padding: 20px 0;
        }
        .col-20 { width: 20%; }
        .col-40 { width: 40%; }
    </style>
</head>
<body>
    {{-- Cabeçalho com logos --}}
    <table class="rat" cellspacing="0" style="margin-bottom: 4px;">
        <tr>
            <td class="cabecalho-logo col-20">
                @php $banrisulLogo = public_path('logo_banrisul.jpg'); @endphp
                @if (file_exists($banrisulLogo))
                    <img src="{{ $banrisulLogo }}" style="max-height:40px; max-width:100%;">
                @endif
            </td>
            <td class="cabecalho-titulo">
                RELATÓRIO TÉCNICO FOTOGRÁFICO
            </td>
            <td class="cabecalho-logo col-20">
                @php $vbLogo = public_path('images/viabeton_logo.png'); @endphp
                @if (file_exists($vbLogo))
                    <img src="{{ $vbLogo }}" style="max-height:40px; max-width:100%;">
                @endif
            </td>
        </tr>
    </table>

    {{-- Tabela de campos --}}
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
            <td class="lbl" colspan="2">Código – Nome do local</td>
            <td class="lbl" colspan="3">Endereço</td>
        </tr>
        <tr>
            <td class="val" colspan="2">{{ $dados['codigo_nome_local'] }}</td>
            <td class="val" colspan="3">{{ $dados['endereco'] }}</td>
        </tr>
    </table>

    {{-- Tabela de fotos ANTES/DEPOIS --}}
    @if (count($dados['pares']) > 0)
        <table class="rat" cellspacing="0" style="margin-top: 8px;">
            <tr>
                <th class="th-foto">ANTES</th>
                <th class="th-foto">DEPOIS</th>
            </tr>
            @foreach ($dados['pares'] as $par)
                <tr>
                    <td class="td-foto">
                        @if ($par['antes'] !== null)
                            <img class="foto-img" src="{{ $par['antes']['src'] }}">
                            @if ($par['antes']['legenda'] !== '')
                                <div class="foto-legenda">{{ $par['antes']['legenda'] }}</div>
                            @endif
                        @else
                            <span class="sem-foto">Sem foto</span>
                        @endif
                    </td>
                    <td class="td-foto">
                        @if ($par['depois'] !== null)
                            <img class="foto-img" src="{{ $par['depois']['src'] }}">
                            @if ($par['depois']['legenda'] !== '')
                                <div class="foto-legenda">{{ $par['depois']['legenda'] }}</div>
                            @endif
                        @else
                            <span class="sem-foto">Sem foto</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>
