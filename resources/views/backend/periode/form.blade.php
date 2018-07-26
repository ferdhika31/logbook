{{ csrf_field() }}

<div class="form-group">
    <label for="iNamaKategori" class="col-sm-2 control-label">No Periode</label>
    <div class="col-sm-10">
        <input type="number" name="no" class="form-control" value="{{ (!empty($data->no))? $data->no : $last->no+1 }}" id="iNamaKategori" placeholder="">
    </div>
</div>

<div class="form-group">
    <label for="iNamaKategori" class="col-sm-2 control-label">Periode</label>
    <div class="col-sm-10">
        <input type="text" name="periode" id="periode" class="form-control input-md" value="{{ (!empty($data->tanggal_awal_periode))? $data->tanggal_awal_periode.' - '.$data->tanggal_akhir_periode : '' }}" id="iNamaKategori" placeholder="">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
        <a href="{{ route('backend::periode.index') }}" class="btn btn-primary" role="button">Batal</a>
    </div>
</div>


@push('style')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css   ') }}">
@endpush

@push('script')
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
    $(function () {
        //Date range picker
        $('#periode').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        });
    })
    </script>
@endpush
