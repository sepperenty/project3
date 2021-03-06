@extends('layouts.app')

@section('header')
    
        <title>Login - Graag Gedaan</title>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row margin_bottom">
            <div class="col-md-8 col-md-offset-2 margin-top">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="line-headers">A</span>anmelden</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <form class="form-horizontal margin-top" method="POST"
                                  action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email adres(*)</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Wachtwoord(*)</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Onthoud mij
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Aanmelden
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
                                <a href="{{ url('/password/reset') }}"><img class="social_midia_icon"
                                                                            src="{{ url('/images/social_midia/s.png') }}" alt="Icoon Wachtwoord vergeten">
                                    Jouw wachtwoord vergeten?
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('/register') }}"><img class="social_midia_icon"
                                                                   src="{{ url('/images/social_midia/l.png') }}" alt="Icoon Registeren">
                                    Registreren
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
