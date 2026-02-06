<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            border-collapse: collapse;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .no-ba {
            font-size: 11px;
            text-align: right;
        }

        .line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 150px;
            text-align: center;
        }

        .content {
            text-align: justify;
        }

        .signature {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<table width="100%">
    <tr>
        <!-- LOGO -->
        <td width="15%" valign="top">
            <img src="{{ public_path('images/logo/logo-blue.png') }}" width="70">
        </td>

        <!-- TITLE -->
        <td width="55%" class="header-title">
            BERITA ACARA<br>
            HASIL INVESTIGASI ATAS PELAPORAN PELANGGARAN
        </td>

        <!-- NO & DATE -->
        <td width="30%" class="no-ba" valign="top">
            NO. BA : {{ $data->i_wbls_bainvest }}<br>
            TANGGAL : {{ \Carbon\Carbon::parse($data->d_wbls_bainvest)->format('d/m/Y') }}
        </td>
    </tr>
</table>

<hr>

<br>

<!-- ISI -->
<p class="content">
    Pada hari ini,
    <span class="line">{{ $hari }}</span>,
    Tanggal <span class="line">{{ $tanggal }}</span>,
    Bulan <span class="line">{{ $bulan }}</span>,
    Tahun <span class="line">{{ $tahun }}</span>,
    telah dilakukan investigasi atas pelaporan pelanggaran yang diterima dengan:
</p>

<p class="content">
    Nomor Pelaporan :
    <span class="line">{{ $data->i_wbls }}</span><br>
    Tanggal Pelaporan :
    <span class="line">{{ \Carbon\Carbon::parse($data->d_wbls_resume)->format('d/m/Y') }}</span>
</p>

<p class="content">Mengenai:</p>

<p class="content">
    {!! nl2br(e($data->e_wbls_resume)) !!}
</p>

<br>

<p class="content">
    Berdasarkan hasil investigasi yang telah dilakukan, maka atas pelaporan
    pelanggaran tersebut dinyatakan:
</p>

<p class="content"><b>Terbukti / Tidak Terbukti*</b></p>

<br>

<!-- TTD -->
<table width="100%" class="signature">
    <tr>
        <td width="60%"></td>
        <td width="40%" align="center">
            Pengelola WBS<br>
            Sub-unit Investigasi
            <br><br><br><br>
            <u>{{ $data->user->n_wbls_adm }}</u>
        </td>
    </tr>
</table>

<p><i>*Coret yang tidak sesuai</i></p>

</body>
</html>
