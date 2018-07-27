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

        @foreach($logbook as $res)
        <table border="1" width="100%">
            <tr>
                <td width="25%">No. : {{ $res->periode->no }}</td>
                <td>Periode : {{ $pAwal[2].' '.ucwords(config('larakuy.bulan')[$pAwal[1]]) }} - {{ $pAkhir[2].' '.ucwords(config('larakuy.bulan')[$pAkhir[1]]) }} {{ $pAwal[0] }}</td>
            </tr>
            <tr>
                @php
                $tanggal = $res->tanggal;
                $tgl = explode('-', $tanggal);
                @endphp
                <td>Sub No. : {{ $res->periode->no }}.{{ $res->subno }}</td>
                <td>Hari/ Tanggal : {{ config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $res->tanggal, 'Asia/Jakarta')->dayOfWeek] }}, {{ $tgl[2].' '.ucwords(config('larakuy.bulan')[$tgl[1]]).' '.$tgl[0] }}</td>
            </tr>
            <tr>
                <td rowspan="3">Proyek</td>
                <td>{{ $res->project->nama_project }}</td>
            </tr>
            <tr>
                <td>Project Manajer : {{ $res->project->project_manager }}</td>
            </tr>
            <tr>
                <td>Technical Leader : {{ $res->project->technical_leader }}</td>
            </tr>
            <tr>
                <td>Tugas</td>
                <td valign="top">{!! $res->tugas !!}</td>
            </tr>
            <tr>
                <td>Waktu dan Kegiatan Harian</td>
                <td valign="top">{!! $res->kegiatan_harian !!}</td>
            </tr>
            <tr>
                <td>Tools yang digunakan</td>
                <td valign="top">{!! $res->tools !!}</td>
            </tr>
            <tr>
                <td>Hasil Kerja</td>
                <td valign="top">{!! $res->hasil_kerja !!}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td valign="top">{!! $res->keterangan !!}</td>
            </tr>
        </table>
            @if(!$loop->last)
            <div class="page-break"></div>
            @endif
        @endforeach
    </body>
</html>