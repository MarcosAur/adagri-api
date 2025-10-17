<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Rebanhos por Produtor</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 20px;
            font-size: 16px;
            text-align: left;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 8px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .total {
            font-weight: bold;
            text-align: right;
            background-color: #f5f5f5;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <h1>Relatório de Rebanhos por Produtor</h1>

    @foreach ($herdsPerProducer as $producerName => $speciess)
        <h2>{{ $producerName }}</h2>

        <table>
            <thead>
                <tr>
                    <th>Rebanho</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp

                @foreach ($speciess as $species)
                    <tr>
                        <td>{{ $species['name'] }}</td>
                        <td>{{ $species['quantity'] }}</td>
                    </tr>
                    @php
                        $subtotal += $species['quantity'];
                    @endphp
                @endforeach

                <tr>
                    <td class="total">Total do Produtor</td>
                    <td class="total">{{ $subtotal }}</td>
                </tr>
            </tbody>
        </table>

        @if (!$loop->last)
            <div style="margin-top: 5px;"></div>
        @endif
    @endforeach

    <p style="text-align:center; margin-top:15px;">
        <small>Gerado em {{ now()->format('d/m/Y H:i') }}</small>
    </p>

</body>
</html>
