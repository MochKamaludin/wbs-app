<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 0;
        }

        .header {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .header table {
            width: 100%;
            border: none;
        }

        .header td {
            border: none;
            vertical-align: middle;
        }

        .logo {
            width: 80px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
        }

        hr {
            border: 1px solid black;
            margin: 5px 0 15px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.data th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .text-wrap {
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 60%; text-align: center;">
                    <div class="title">LAPORAN WHISTLEBLOWING SYSTEM (WBS)</div>
                    <div class="subtitle">Rekapitulasi Data Pengaduan</div>
                </td>
            </tr>
        </table>
    </div>

    <hr>
    <table class="data">
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:15%">No WBS</th>
                <th style="width:12%">Tanggal</th>
                <th style="width:18%">Perihal</th>
                <th style="width:20%">Status Proses</th>
                <th style="width:30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row->i_wbls }}</td>
                <td>{{ \Carbon\Carbon::parse($row->d_wbls)->format('d M Y') }}</td>
                <td class="text-left text-wrap">
                    {{ $row->status->n_wbls_stat ?? '-' }}
                </td>
                <td class="text-left text-wrap">
                    {{ strip_tags($row->status->e_wbls_stat ?? '-') }}
                </td>
                <td class="text-left text-wrap">
                    {{ $row->e_wbls_stat ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>