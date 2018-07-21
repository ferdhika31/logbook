@extends('layouts.auth')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ route('register') }}"><b>Admin</b>{{ config('app.name', 'Larakuy') }}</a>
    </div>
    
    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            
            <div class="form-group has-feedback{{ $errors->has('nim') ? ' has-error' : '' }}">
                <input id="nim" type="text" class="form-control" name="nim" value="{{ old('nim') }}" placeholder="nim" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('nim'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nim') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="full name" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" placeholder="@polban.ac.id" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('prodi') ? ' has-error' : '' }}">
                <select name="prodi" class="form-control">
                    @foreach(\App\Models\Prodi::get() as $prodi)
                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                @if ($errors->has('prodi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('prodi') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('perusahaan') ? ' has-error' : '' }}">
                <select name="perusahaan" class="form-control">
                    @foreach(\App\Models\Perusahaan::get() as $perusahaan)
                    <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                    @endforeach
                </select>
                <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
                @if ($errors->has('perusahaan'))
                    <span class="help-block">
                        <strong>{{ $errors->first('perusahaan') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" placeholder="password" type="password" class="form-control" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" placeholder="Retype password" class="form-control" name="password_confirmation" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
        </div> --}}
        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection
