@extends('layouts.app')
@section('header')
    
    <title>Registreer - Graag Gedaan</title>
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row margin_bottom_registreer">
            <div class="col-md-8 col-md-offset-2 margin-top">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="line-headers">R</span>egistreren</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <form class="form-horizontal margin-top" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-5 control-label">Naam(*)</label>

                                    <div class="col-md-7">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-5 control-label">Email adres(*)</label>

                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-5 control-label">wachtwoord(*)</label>

                                    <div class="col-md-7">
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-5 control-label">Herhaal Wachtwoord(*)</label>

                                    <div class="col-md-7">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-5">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Registreren
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 margin-top login_facebook">
                            <div class="col-md-12">
                                <a href="redirect"><img class="social_midia_icon"
                                                        src="{{ url('/images/social_midia/f.png') }}" alt="Icoon Facebook">
                                    Aanmelden via Facebook</a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('/login') }}"><img class="social_midia_icon"
                                                                            src="{{ url('/images/social_midia/l.png') }}" alt="Icoon Aanmelden">
                                    Aanmelden
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
