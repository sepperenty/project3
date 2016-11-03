@extends('layouts.app')

    @section('header')
    <title>Wachtwoord vergeten - Graag Gedaan</title>
    @endsection


@section('content')
    <div class="container-fluid">
        <div class="row margin_bottom">
            <div class="col-md-8 col-md-offset-2 margin-top">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-md-8">
                            <form class="form-horizontal margin-top" method="POST"
                                  action="{{ url('/password/email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email adres(*)</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Stuur link voor nieuw wachtwoord
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <div class="col-md-4 margin-top login_facebook margin_bottom">
                                <div class="col-md-12">
                                    <a href="redirect"><img class="social_midia_icon"
                                                            src="{{ url('/images/social_midia/f.png') }}" alt="Icoon Facebook">
                                        Aanmelden via Facebook</a>
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ url('/register') }}"><img class="social_midia_icon"
                                                                          src="{{ url('/images/social_midia/l.png') }}" alt="Icoon Registreren">
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
