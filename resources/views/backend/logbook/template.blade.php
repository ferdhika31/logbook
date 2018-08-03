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
                <td align="center">:</td>
                <td>TEKNIK KOMPUTER DAN INFORMATIKA</td>
                <th>PROGRAM STUDI</th>
                <td align="center">:</td>
                <td>D4 TEKNIK INFORMATIKA</td>
            </tr>
        </table>
        <br>

        @forelse($logbook as $res)
        <table border="1" width="100%">
            <tr>
                <th>No. : {{ $res->periode->no }}</th>
                <td>Periode : {{ $pAwal[2].' '.ucwords(config('larakuy.bulan')[$pAwal[1]]) }} - {{ $pAkhir[2].' '.ucwords(config('larakuy.bulan')[$pAkhir[1]]) }} {{ $pAwal[0] }}</td>
            </tr>
            <tr>
                @php
                $tanggal = $res->tanggal;
                $tgl = explode('-', $tanggal);
                @endphp
                <th>Sub No. : {{ $res->periode->no }}.{{ $res->subno }}</th>
                <td>Hari/ Tanggal : {{ config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $res->tanggal, 'Asia/Jakarta')->dayOfWeek] }}, {{ $tgl[2].' '.ucwords(config('larakuy.bulan')[$tgl[1]]).' '.$tgl[0] }}</td>
            </tr>
            <tr>
                <th rowspan="3">Proyek</th>
                <td>{{ $res->project->nama_project }}</td>
            </tr>
            <tr>
                <td>Project Manajer : {{ $res->project->project_manager }}</td>
            </tr>
            <tr>
                <td>Technical Leader : {{ $res->project->technical_leader }}</td>
            </tr>
            <tr>
                <th>Tugas</th>
                <td valign="top">{!! $res->tugas !!}</td>
            </tr>
            <tr>
                <th>Waktu dan Kegiatan Harian</th>
                <td valign="top">{!! $res->kegiatan_harian !!}</td>
            </tr>
            <tr>
                <th>Tools yang digunakan</th>
                <td valign="top">{!! $res->tools !!}</td>
            </tr>
            <tr>
                <th>Hasil Kerja</th>
                <td valign="top">{!! $res->hasil_kerja !!}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td valign="top">{!! $res->keterangan !!}</td>
            </tr>
        </table>
            @if(!$loop->last)
            <div class="page-break"></div>
            @endif  
        @endforelse
    </body>
</html>