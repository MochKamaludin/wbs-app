<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BA Verifikasi</title>

    <style>
        @page {
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .bordered {
            border: 1px solid black;
            padding: 20px;
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

        .footer-left {
            position: absolute;
            bottom: 15px;
            left: 20px;
            font-size: 10px;
        }

        .footer-right {
            position: absolute;
            bottom: 15px;
            right: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>

<div class="bordered">

    <table border="1">
        <tr>
            <td width="20%" class="center">
                <img src="{{ public_path('images/logo/logo-blue.png') }}" width="60">
            </td>

            <td width="50%" class="center bold">
                <div style="font-size:14px;">BERITA ACARA</div>
                <div>HASIL VERIFIKASI ATAS PELAPORAN</div>
                <div>PELANGGARAN</div>
            </td>

            <td width="30%" style="font-size:11px;">
                NO. BA : {{ $data->i_wbls_bavrf }}
                TANGGAL : {{ \Carbon\Carbon::parse($data->d_wbls_vrf)->format('d-m-Y') }}
            </td>
        </tr>
    </table>

    <br>

    <p>
        Pada hari <b>{{ $hari }}</b>
        tanggal <b>{{ $tanggal }} {{ $bulan }} {{ $tahun }}</b>
        telah dilakukan verifikasi atas pelaporan pelanggaran yang diterima,
        Nomor Pelaporan <b>{{ $data->wbs->i_wbls }}</b>
        tertanggal <b>{{ \Carbon\Carbon::parse($data->wbs->d_wbls)->translatedFormat('d F Y') }}</b>
        mengenai:
    </p>

    <div class="box">
        {{ $data->wbls->e_wbls ?? '-' }}
    </div>

    <br>

    <p><b>Hasil verifikasi atas pelaporan pelanggaran:</b></p>

    <table>
        <tr>
            <td width="5%">a.</td>
            <td width="40%">Identitas Pelapor</td>
            <td>
                @if($data->f_wbls_usrname == '1')
                    <span class="checkbox">✓</span> Ada
                    &nbsp;&nbsp;&nbsp;
                    <span class="checkbox"></span> Tidak Ada/Anonim
                @else
                    <span class="checkbox"></span> Ada
                    &nbsp;&nbsp;&nbsp;
                    <span class="checkbox">✓</span> Tidak Ada/Anonim
                @endif
            </td>
        </tr>

        <tr>
            <td>b.</td>
            <td>Bukti Dokumen</td>
            <td>
                @if($data->f_wbls_file == '1')
                    <span class="checkbox">✓</span> Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox"></span> Tidak Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox"></span> Tidak Ada
                @elseif($data->f_wbls_file == '2')
                    <span class="checkbox"></span> Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox">✓</span> Tidak Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox"></span> Tidak Ada
                @else
                    <span class="checkbox"></span> Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox"></span> Tidak Lengkap
                    &nbsp;&nbsp;
                    <span class="checkbox">✓</span> Tidak Ada
                @endif
            </td>
        </tr>
    </table>

    <br>

    <p>
        Berdasarkan hasil verifikasi, maka atas pelaporan pelanggaran tersebut
        telah/tidak* sesuai dengan persyaratan, sehingga dapat/tidak dapat*
        ditindaklanjuti dengan proses investigasi.
    </p>

    <br><br>

    <table>
        <tr>
            <td width="60%"></td>
            <td>
                Pengelola WBS,<br>
                Sub-unit Verifikasi
                <br><br><br><br>
                <b>{{ $data->wbs->user->n_wbls_adm }}</b>
            </td>
        </tr>
    </table>

    <div class="footer-left">
        <i>*coret yang tidak sesuai</i>
    </div>

    <div class="footer-right">
        ba-wbs-01
    </div>

</div>

</body>
</html>