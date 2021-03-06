@extends('layouts/app')
@section('header')
    <title>Nieuwe Oproep - Graag Gedaan</title>
    {{--<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>--}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ url('/js/manage.js') }}"></script>
    <script src="/js/tabController.js"></script>

@endsection

@section('content')
    <div class="container-fluid ">

        <div class="row">
            <div class="col-md-10 col-md-offset-1 add_form margin-top">
                <div class="row form-head">
                    <div class="col-md-12" id="inhoud">
                        <h1 class=""><span class="line-headers">V</span>ul deze form in en plaats een nieuwe oproep.</h1>
                        <p class="subHead">Nadat je oproep is geplaatst kunnen vrijwilligers jouw oproep bekijken en eventueel hulp aanbieden.</p>
                        {{--<a href="/projects/beheer" class="pull-right btn btn-primary focus">Berheer projecten</a>--}}
                    </div>
                </div>

                <div class="col-md-12 projectForm">


                    {{ Form::open(array('url' => '/projects/add/new', 'id'=>'form_project','files' => true)) }}

                    {{ csrf_field() }}

                    <div class="row">
                        <input name="id" class="id" type="text" value="" hidden>
                        <div class="form-group col-md-6">
                            <label for="title">Titel van je oproep(*)</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span>
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Je email</label>
                            <input type="text" name="email" class="form-control" value="{{ (old('email') ? old('email') : Auth()->user()->email) }}" >
                            @if ($errors->has('email'))
                                <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="description">Waar gaat je oproep over ?(*)</label>
                    <textarea name="description" cols="10" rows="5"
                              class="form-control ">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                                <span>
                                <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group project_file col-md-6">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control " name="foto">
                            @if ($errors->has('foto'))
                                <span>
                                        <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                            @endif
                            
                        </div>


                        <div class="form-group col-md-6">
                            <label for="telephoneNumber">Telefoon nummer</label>
                            <input type="number" name="telephoneNumber" class="form-control"
                                   value="{{ old('telephoneNumber') }}">
                            @if ($errors->has('telephoneNumber'))
                                <span>
                                        <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="address">Adres(*)</label>
                            <input type="text" name="address" class="form-control adress_fill" id="searchTextField"  value="{{old('address')}}">
                            <input type="text" name="lat" value="" hidden tabindex="-0">
                            <input type="text" name="lng" value="" hidden tabindex="-0">
                            <p class="alert alert-danger info_location col-md-12" hidden>Er ging iets mis,
                                probeer
                                het
                                later
                                nog
                                eens</p>
                            @if ($errors->has('address'))
                                <span>
                                        <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            @if ( ($errors->has('lat'))   ||  ($errors->has('lng')) )
                                <span>
                                        <strong>Er is iets mis met het adres. Voer het opnieuw in.</strong>
                                </span>
                            @endif

                        </div>
                        <div class="col-md-12">
                            <div id="map_form"></div>
                        </div>

                    </div>

                    <fieldset class="oproep-categorie">
                        <legend>Oproep categorien</legend>

                            <div class="checkbox ">
                                <label>
                                    <input type="checkbox" name="isPriority"> Deze oproep is zeer dringend.
                                </label>
                            </div>

                            <div class="checkbox ">
                                <label>
                                    <input type="checkbox" name="isCompany"> Deze oproep komt vanuit een bedrijf.
                                </label>
                            </div>


                            <div class="form-group pull-right mobileBtn">
                                <button class="btn btn-primary focus" id="manageBtn">Maak oproep aan</button>
                            </div>
                        
                    </fieldset>


                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


@endsection