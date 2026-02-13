<h3 style="text-align:center;">BERITA ACARA</h3>
<h4 style="text-align:center;">HASIL VERIFIKASI ATAS PELAPORAN PELANGGARAN</h4>

<p>No BA: {{ $verifikasi->i_wbls_bavrf }}</p>
<p>Tanggal: {{ $verifikasi->d_wbls_vrf->format('d/m/Y') }}</p>

<hr>

<p>Nomor Laporan: {{ $wbs->i_wbls }}</p>

<p>Identitas Pelapor:
    @if($verifikasi->f_wbls_usrname == '1')
        ✓ Ada
    @else
        ✓ Tidak Ada / Anonim
    @endif
</p>

<p>Bukti Dokumen:
    @if($verifikasi->f_wbls_file == '1')
        ✓ Lengkap
    @elseif($verifikasi->f_wbls_file == '2')
        ✓ Tidak Lengkap
    @else
        ✓ Tidak Ada
    @endif
</p>

<br><br>

<p>Pengelola WBS,</p>
<p>{{ $verifikasi->i_wbls_adm }}</p>