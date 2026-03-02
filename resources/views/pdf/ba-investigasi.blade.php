<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BA Investigasi</title>
    
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table {
            width: calc(100% + 40px);
            margin: -20px -20px 20px -20px; 
            border-collapse: collapse;
        }

        .header-table td {
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .header-table tr:first-child td {
            border-top: none;
        }

        .header-table td:first-child {
            border-left: none;
        }

        .header-table td:last-child {
            border-right: none;
        }

        .ttd-table td {
            border: none;
        }

        .bordered {
            border: 1px solid black;
            padding: 20px;
            box-sizing: border-box;
            height: 250mm;
            position: relative;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .small {
            font-size: 10px;
        }

        .box {
            border: 1px solid black;
            padding: 8px;
        }

        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid black;
            text-align: center;
            line-height: 12px;
            font-size: 10px;
            margin-right: 5px;
            font-family: DejaVu Sans, sans-serif;
        }

        .note {
            position: absolute;
            bottom: 15px;
            left: 20px;
            font-size: 10px;
        }

        .footer {
            font-size: 10px;
            margin-top: 5px;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="bordered">

    <table class="header-table">
        <tr>
            <td width="20%" class="center" style="padding:5px;">
                <img src="{{ public_path('images/logo/logo-blue.png') }}" width="80">
            </td>

            <td width="50%" class="center bold">
                <div style="font-size:20px; padding: 3px;">BERITA ACARA</div>
                <div style="padding:6px;">HASIL INVESTIGASI ATAS PELAPORAN PELANGGARAN</div>
            </td>

             <td width="30%" style="padding:0;">
                <div style="padding:6px 8px; border-bottom:1px solid black;">
                     NO. BA : {{ $data->i_wbls_bainvest }}
                </div>
                <div style="padding:6px 8px;">
                     TANGGAL : {{ \Carbon\Carbon::parse($data->d_wbls_bainvest)->format('d-m-Y') }}
                </div>
             </td>
        </tr>
    </table>

    <br>

    <p>
        Pada hari ini, <b>{{ $hari }}</b> 
        Tanggal <b>{{ $tanggal }}</b>
        Bulan <b>{{ $bulan }}</b> 
        Tahun <b>{{ $tahun }}</b> 
        telah dilakukan investigasi atas pelaporan pelanggaran yang diterima,
        Nomor Pelaporan <b>{{ $data->i_wbls }}</b> 
        Tertanggal <b>{{ \Carbon\Carbon::parse($data->wbls->d_wbls)->format('d M Y') }}</b>
        mengenai:
    </p>

    <p>
        {!! nl2br(e($data->wbls->e_wbls)) !!}
    </p>

    <p>
        Berdasarkan hasil investigasi, maka atas pelaporan pelanggaran tersebut
        <b>terbukti/tidak terbukti*</b>.
    </p>

    <br><br><br>
    
    <table class="ttd-table" width="100%">
        <tr>
            <td width="75%"></td>
            <td width="25%" style="text-align:center;">
                Pengelola WBS,<br>
                Sub-unit Ivestigasi
                <br><br><br><br>
                <b>Tim Investigasi</b>
            </td>
        </tr>
    </table>

    <div class="note">
        <b><i>*coret yang tidak sesuai</i></b>
    </div>

</div>

<div class="footer">
    ba-wbs-{{ $data->i_wbls_bainvestseq }}
</div>


</body>
</html> 