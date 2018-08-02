{{ csrf_field() }}

<div class="form-group">
    <label class="col-sm-2 control-label">Periode</label>
    <div class="col-sm-10">
        <select name="periode" class="form-control">
        @foreach($periode as $p)
        <option value="{{ $p->id }}"{{ (!empty($data->periode_id)) ? ($data->periode_id==$p->id) ? ' selected' : '' : '' }}>{{ $p->no }}. {{ $p->tanggal_awal_periode }} s/d {{ $p->tanggal_akhir_periode }}</option>
        @endforeach
        </select>
    </div>
</div>

@if((!empty($data)))
<div class="form-group">
    <label class="col-sm-2 control-label">Sub No</label>
    <div class="col-sm-10">
    <input type="number" name="subno" value="{{ (!empty($data->subno))? $data->subno : 1 }}" class="form-control">
    </div>
</div>
@endif

<div class="form-group">
    <label class="col-sm-2 control-label">Project</label>
    <div class="col-sm-10">
        <select name="project" class="form-control">
        @foreach($project as $p)
        <option value="{{ $p->id }}">{{ $p->nama_project }} (Tech Leader : {{ $p->technical_leader }})</option>
        @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-10">
    <input type="text" name="tgl" data-date-format='yyyy-mm-dd' value="{{ (!empty($data->tanggal))? $data->tanggal : date('Y-m-d') }}" class="form-control pull-right" id="datepicker">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Tugas</label>
    <div class="col-sm-10">
        <textarea name="tugas" rows="20" class="form-control">{{ (!empty($data->tugas))? $data->tugas : '' }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Kegiatan Harian</label>
    <div class="col-sm-10">
        <textarea name="kegiatan" rows="20" class="form-control">{{ (!empty($data->kegiatan_harian))? $data->kegiatan_harian : '' }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Tools yang digunakan</label>
    <div class="col-sm-10">
        <textarea name="tools" rows="20" class="form-control">{{ (!empty($data->tools))? $data->tools : '' }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Hasil Kerja</label>
    <div class="col-sm-10">
        <textarea name="hasil" rows="20" class="form-control">{{ (!empty($data->hasil_kerja))? $data->hasil_kerja : '' }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-10">
        <textarea name="keterangan" rows="20" class="form-control">{{ (!empty($data->keterangan))? $data->keterangan : '' }}</textarea>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
        <a href="{{ route('backend::logbook.index') }}" class="btn btn-primary" role="button">Batal</a>
    </div>
</div>

@push('script')
    <script src="{{ asset('bower_components/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
    tinymce.init({ 
        selector:'textarea',
        plugins: 'image code pagebreak wordcount table link media searchreplace preview paste lists',
        toolbar1: "image code pagebreak wordcount table link media searchreplace preview paste lists",
        toolbar2: "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify fontselect fontsizeselect | bullist numlist | forecolor backcolor | charmap nonbreaking",

        contextmenu: "cut copy paste",
        menubar: false,
        statusbar: false,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/backend/logbook/upload');
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.data != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                console.log(json);
                if(json.status){
                    success(json.data); 
                }else{
                    failure('Foto belum ke unggah..');
                }
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
       }
    });
    </script>
@endpush

@push('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    })
    </script>
@endpush
