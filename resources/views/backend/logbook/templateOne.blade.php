<html>
    <head>
        <title>Logbook</title>
    </head>
    <style>
        table {
            border-collapse: collapse;
        }
        table, tr, td {
            border: 1px solid black;
            padding:2px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
    <body>
        @php
        $pAwal = explode('-', $periode->tanggal_awal_periode);
        $pAkhir = explode('-', $periode->tanggal_akhir_periode);
        @endphp
        <h3 style="font-weight:bold; font-style: italic;">Log Book Periode {{ $pAwal[2].' '.ucwords(config('larakuy.bulan')[$pAwal[1]]) }} - {{ $pAkhir[2].' '.ucwords(config('larakuy.bulan')[$pAkhir[1]]) }} {{ $pAwal[0] }} (Per 2 Minggu )</h3>
        <center><h1 style="font-weight:bold;">Log Book PKL</h1></center>

        <table width="100%">
            <tr>
                <td>JURUSAN</td>
                <td>:</td>
                <td>TEKNIK KOMPUTER DAN INFORMATIKA</td>
                <td>PROGRAM STUDI</td>
                <td>:</td>
                <td>D4 TEKNIK INFORMATIKA</td>
            </tr>
        </table>
        <br>
        <table border="1" width="100%">
            <tr>
                <td>No. : {{ $logbook->periode->no }}</td>
                <td>Periode : {{ $pAwal[2].' '.ucwords(config('larakuy.bulan')[$pAwal[1]]) }} - {{ $pAkhir[2].' '.ucwords(config('larakuy.bulan')[$pAkhir[1]]) }} {{ $pAwal[0] }}</td>
            </tr>
            <tr>
                @php
                $tanggal = $logbook->tanggal;
                $tgl = explode('-', $tanggal);
                @endphp
                <td>Sub No. : {{ $logbook->periode->no }}.{{ $logbook->subno }}</td>
                <td>Hari/ Tanggal : {{ config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $logbook->tanggal, 'Asia/Jakarta')->dayOfWeek] }}, {{ $tgl[2].' '.ucwords(config('larakuy.bulan')[$tgl[1]]).' '.$tgl[0] }}</td>
            </tr>
            <tr>
                <td rowspan="3">Proyek</td>
                <td>{{ $logbook->project->nama_project }}</td>
            </tr>
            <tr>
                <td>Project Manajer : {{ $logbook->project->project_manager }}</td>
            </tr>
            <tr>
                <td>Technical Leader : {{ $logbook->project->technical_leader }}</td>
            </tr>
            <tr>
                <td>Tugas</td>
                <td valign="top">{!! $logbook->tugas !!}</td>
            </tr>
            <tr>
                <td>Waktu dan Kegiatan Harian</td>
                <td valign="top">{!! $logbook->kegiatan_harian !!}</td>
            </tr>
            <tr>
                <td>Tools yang digunakan</td>
                <td valign="top">{!! $logbook->tools !!}</td>
            </tr>
            <tr>
                <td>Hasil Kerja</td>
                <td valign="top">{!! $logbook->hasil_kerja !!}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td valign="top">{!! $logbook->keterangan !!}</td>
            </tr>
        </table>
    </body>
</html>