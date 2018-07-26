@extends('layouts.backend.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('list_logbook') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> {{ session('success') }}
        </div>
        @endif
        <a class="btn btn-primary btn-md" href="{{ route('backend::logbook.create') }}">
			<i class="fa fa-plus"></i> Tambah
		</a>
        
        <div class="box" style="margin-top: 5px;">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar {{ @$page_name }}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 20px">#</th>
                        <th>Sub No</th>
                        <th>Hari, Tanggal</th>
                        <th>Proyek</th>
                        <th>Periode</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                    <?php $no=1;?>
                    @forelse($data as $res)
                    <tr>
                        <td>
                            {{ $no }}
                        </td>
                        <td>
                            {{ $res->periode->no }}.{{ $res->subno }}
                        </td>
                        <td>
                            {{ config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $res->tanggal, 'Asia/Jakarta')->dayOfWeek] }}, {{ $res->tanggal }}
                        </td>
                        <td>
                            {{ $res->project->nama_project }} (Tech Leader : {{ $res->project->technical_leader }})
                        </td>
                        <td>
                            {{ $res->periode->tanggal_awal_periode }} s/d {{ $res->periode->tanggal_akhir_periode }}
                        </td>
                        <td>
                            <a class="btn btn-default btn-xs" title="Ubah" href="{{ route('backend::logbook.edit', ['id' => $res->id]) }}"> Ubah
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button class="btn btn-danger btn-xs" title="Hapus" onclick="deleteData('{{ substr($res->id,0,5) }}')"> Hapus
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php $no++;?>
                    @empty
                    <tr>
                        <td colspan="3">
                            Tidak ada data.
                        </td>
                    </tr>
                    @endforelse
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix text-right">
                {{ $data->links() }}
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@push('script')
<script type="text/javascript">
    function deleteData(id){
        console.log(id);
		$('#mdlHapus'+id).modal('show'); // show bootstrap modal
	}
</script>

@foreach($data as $res)
<div id="mdlHapus{{substr($res->id, 0, 5)}}" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Konfirmasi</h3>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						Apakah benar data {{$res->tanggal_awal_periode}} s/d {{$res->tanggal_akhir_periode}} akan di hapus?
					</div>
				</div>
			</div>

			<div class="modal-footer">
                <form method="POST" action="{{ route('backend::logbook.destroy', ['id'=>$res->id]) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>

                    <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
@endforeach

@endpush