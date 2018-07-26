{{ csrf_field() }}

<div class="form-group">
    <label for="iNamaKategori" class="col-sm-2 control-label">Nama Project</label>
    <div class="col-sm-10">
        <input type="text" name="nama" class="form-control" value="{{ (!empty($data->nama_project))? $data->nama_project : '' }}" placeholder="">
    </div>
</div>

<div class="form-group">
    <label for="iNamaKategori" class="col-sm-2 control-label">Project Manager</label>
    <div class="col-sm-10">
        <input type="text" name="project_manager" class="form-control" value="{{ (!empty($data->project_manager))? $data->project_manager : '' }}" placeholder="">
    </div>
</div>

<div class="form-group">
    <label for="iNamaKategori" class="col-sm-2 control-label">Technical Leader</label>
    <div class="col-sm-10">
        <input type="text" name="technical_leader" class="form-control" value="{{ (!empty($data->technical_leader))? $data->technical_leader : '' }}" placeholder="">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
        <a href="{{ route('backend::project.index') }}" class="btn btn-primary" role="button">Batal</a>
    </div>
</div>