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
        }
        table img{
            width: 100%;
            height: auto;
        }

        table th{
            width: 150px;
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
                <th>JURUSAN</th>
                <td>:</td>
                <td>TEKNIK KOMPUTER DAN INFORMATIKA</td>
                <th>PROGRAM STUDI</th>
                <td>:</td>
                <td>D4 TEKNIK INFORMATIKA</td>
            </tr>
        </table>
        <br>
        <table border="1" width="100%">
            <tr>
                <th>No. : {{ $logbook->periode->no }}</th>
                <td>Periode : {{ $pAwal[2].' '.ucwords(config('larakuy.bulan')[$pAwal[1]]) }} - {{ $pAkhir[2].' '.ucwords(config('larakuy.bulan')[$pAkhir[1]]) }} {{ $pAwal[0] }}</td>
            </tr>
            <tr>
                @php
                $tanggal = $logbook->tanggal;
                $tgl = explode('-', $tanggal);
                @endphp
                <th>Sub No. : {{ $logbook->periode->no }}.{{ $logbook->subno }}</th>
                <td>Hari/ Tanggal : {{ config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $logbook->tanggal, 'Asia/Jakarta')->dayOfWeek] }}, {{ $tgl[2].' '.ucwords(config('larakuy.bulan')[$tgl[1]]).' '.$tgl[0] }}</td>
            </tr>
            <tr>
                <th rowspan="3">Proyek</th>
                <td>{{ $logbook->project->nama_project }}</td>
            </tr>
            <tr>
                <td>Project Manajer : {{ $logbook->project->project_manager }}</td>
            </tr>
            <tr>
                <td>Technical Leader : {{ $logbook->project->technical_leader }}</td>
            </tr>
            <tr>
                <th>Tugas</th>
                <td valign="top">{!! $logbook->tugas !!}</td>
            </tr>
            <tr>
                <th>Waktu dan Kegiatan Harian</th>
                <td valign="top">{!! $logbook->kegiatan_harian !!}</td>
            </tr>
            <tr>
                <th>Tools yang digunakan</th>
                <td valign="top">{!! $logbook->tools !!}</td>
            </tr>
            <tr>
                <th>Hasil Kerja</th>
                <td valign="top">{!! $logbook->hasil_kerja !!}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td valign="top">{!! $logbook->keterangan !!}</td>
            </tr>
        </table>
    </body>
</html>