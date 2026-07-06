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
        }
        .th-antes {
            background-color: #d0d0d0;
            text-align: center;
            font-weight: bold;
            font-size: 7pt;
            padding: 4px !important;
        }
        .th-depois {
            background-color: #d0d0d0;
            text-align: center;
            font-weight: bold;
            font-size: 7pt;
            padding: 4px !important;
            width: 33.333%;
        }
        .td-antes {
            vertical-align: top;
            padding: 4px !important;
            text-align: center;
        }
        .td-depois {
            vertical-align: top;
            padding: 4px !important;
            width: 33.333%;
            text-align: center;
        }
        .foto-area {
            min-height: 130px;
            vertical-align: top;
        }
        .foto-img {
            max-width: 100%;
            max-height: 130px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .foto-img-antes {
            max-width: 33.333%;
            max-height: 130px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .foto-legenda {
            font-size: 6.5pt;
            padding-top: 2px;
            text-align: center;
        }
        .col-20 { width: 20%; }
        .col-33 { width: 33.333%; }
        .descricao-val {
            white-space: pre-wrap;
            min-height: 40px;
        }
        .bloco-par {
            margin-top: 4px;
        }
        .bloco-par + .bloco-par {
            margin-top: 8px;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }
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
                {{ $dados['titulo_relatorio'] }}
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
            <td class="lbl">Número da preventiva</td>
            <td class="lbl">Número do Contrato</td>
            <td class="lbl">Responsável Engenharia Banrisul</td>
        </tr>
        <tr>
            <td class="val">{{ $dados['numero_preventiva'] }}</td>
            <td class="val">{{ $dados['numero_contrato'] }}</td>
            <td class="val">{{ $dados['responsavel_engenharia_banrisul'] }}</td>
        </tr>
        <tr>
            <td class="lbl" colspan="2">Código – Nome do local</td>
            <td class="lbl" colspan="1">Endereço</td>
        </tr>
        <tr>
            <td class="val" colspan="2">{{ $dados['codigo_nome_local'] }}</td>
            <td class="val" colspan="1">{{ $dados['endereco'] }}</td>
        </tr>
        <tr>
            <td class="lbl" colspan="3">Descrição</td>
        </tr>
        <tr>
            <td class="val descricao-val" colspan="3">{{ $dados['descricao'] }}</td>
        </tr>
    </table>

    {{-- Seção de fotografias antes/depois --}}
    @if (count($dados['pares']) > 0)
        <table class="rat" cellspacing="0" style="margin-top: 8px;">
            <tr>
                <th class="th-foto" colspan="3">FOTOGRAFIAS</th>
            </tr>
        </table>

        @foreach ($dados['pares'] as $par)
            <table class="rat bloco-par" cellspacing="0">
                <tr>
                    <th class="th-antes" colspan="3">IMAGEM ANTES</th>
                </tr>
                <tr>
                    <td class="td-antes foto-area" colspan="3">
                        @if ($par['antes'] !== null)
                            <img class="foto-img-antes" src="{{ $par['antes']['src'] }}">
                            @if ($par['antes']['legenda'] !== '')
                                <div class="foto-legenda">{{ $par['antes']['legenda'] }}</div>
                            @endif
                        @endif
                    </td>
                </tr>

                @php
                    $linhasDepois = count($par['depois']) > 0
                        ? array_chunk($par['depois'], 3)
                        : [[]];
                @endphp

                @foreach ($linhasDepois as $linhaDepois)
                    <tr>
                        <th class="th-depois">IMAGEM DEPOIS</th>
                        <th class="th-depois">IMAGEM DEPOIS</th>
                        <th class="th-depois">IMAGEM DEPOIS</th>
                    </tr>
                    <tr>
                        @foreach ($linhaDepois as $imagemDepois)
                            <td class="td-depois foto-area">
                                <img class="foto-img" src="{{ $imagemDepois['src'] }}">
                            </td>
                        @endforeach
                        @for ($i = count($linhaDepois); $i < 3; $i++)
                            <td class="td-depois">&nbsp;</td>
                        @endfor
                    </tr>
                @endforeach
            </table>
        @endforeach
    @endif
</body>
</html>
