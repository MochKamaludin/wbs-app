<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BA Investigasi</title>
    
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        table {
            border-collapse: collapse;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .header-right {
            font-size: 11px;
        }

        .content {
            text-align: justify;
        }
    </style>
</head>
<body>

<table width="100%"
       style="border:1px solid #000; border-collapse:collapse; height:270mm;">
<tr>
<td valign="top" style="padding:20px; position:relative;">

    <table width="100%" class="header-table">
        <tr>
            <td width="15%" align="center">
                <img src="{{ public_path('images/logo/logo-blue.png') }}" width="70">
            </td>

            <td width="55%" class="header-title">
                BERITA ACARA <br>
                HASIL INVESTIGASI ATAS PELAPORAN PELANGGARAN
            </td>

            <td width="30%" class="header-right">
                NO. BA : {{ $data->i_wbls_bainvest }}<br><br>
                TANGGAL : {{ \Carbon\Carbon::parse($data->d_wbls_bainvest)->format('d-m-Y') }}
            </td>
        </tr>
    </table>

    <br><br>

    <p class="content">
        Pada hari ini {{ $hari }}, 
        Tanggal {{ $tanggal }}, 
        Bulan {{ $bulan }}, 
        Tahun {{ $tahun }}, 
        telah dilakukan investigasi atas pelaporan pelanggaran yang diterima,
        Nomor Pelaporan {{ $data->i_wbls }} 
        Tertanggal {{ \Carbon\Carbon::parse($data->wbls->d_wbls)->format('d M Y') }}.
    </p>

    <p class="content">
        Mengenai:
    </p>

    <p class="content">
        {!! nl2br(e($data->wbls->e_wbls)) !!}
    </p>

    <br>

    <p class="content">
        Berdasarkan hasil investigasi, maka atas pelaporan pelanggaran tersebut
        <b>Terbukti/Tidak terbukti*</b>.{{ $data->i_wbls_bainvestseq}}
    </p>

    <br><br><br>

    <table width="100%" style="margin-top:60px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">
                Pengelola WBS,<br>
                Sub-unit Investigasi
                <br><br><br><br>
                (Tim Investigasi)
            </td>
        </tr>
    </table>

    <div style="position:absolute; bottom:15px; left:20px; font-size:10px;">
        <i>*coret yang tidak sesuai</i>
    </div>

    <div style="position:absolute; bottom:15px; right:20px; font-size:10px;">
        ba-wbs-{{ $data->i_wbls_bainvestseq }}
    </div>

</td>
</tr>
</table>

</body>
</html> 