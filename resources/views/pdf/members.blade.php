<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Member</title>
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

        text-center {
            text-align: center
        }
    </style>
</head>

<body>
    <h1>Data Member</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Nama</th>
                <th>WhatsApp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ ucwords($member->nama) }}</td>
                    <td>{{ '+' . $member->whatsapp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
