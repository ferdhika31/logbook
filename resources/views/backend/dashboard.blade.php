@extends('layouts.backend.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
    Welcome {{ Auth::user()->name }}
@endsection