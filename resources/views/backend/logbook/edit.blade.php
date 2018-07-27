@extends('layouts.backend.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit_logbook') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#profil" data-toggle="tab">Info</a></li>
            </ul>

            <div class="tab-content">

                <div class="active tab-pane" id="profil">
                    <form class="form-horizontal" action="{{ route('backend::logbook.update', ['id'=>Request::segment(3)]) }}" method="post" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                    @include('backend.logbook.form')
                    </form>
                </div><!-- /.tab-pane -->

            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->

    </div><!-- /.col -->
</div>
@endsection
