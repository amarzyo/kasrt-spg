<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Tarikan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #d4d4d8;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f4f4f5;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Data Tarikan</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Member</th>
                <th>Nominal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarikans as $row)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $row->member->nama }}
                    </td>
                    <td>
                        Rp {{ number_format($row->nominal, 0, ',', '.') }}
                    </td>
                    <td>
                        {{ $row->created_at->format('d M Y H:i') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        Total:
        Rp {{ number_format($total, 0, ',', '.') }}
    </div>
</body>

</html>
