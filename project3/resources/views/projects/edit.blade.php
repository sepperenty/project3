@extends('layouts/app')
@section('header')
    <title>Nieuwe Oproep - GRaag Gedaan</title>
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
                    <div class="col-md-12 ">
                        <h1 class="">Vul deze form in en plaats een nieuwe oproep.</h1>
                        {{--<a href="/projects/beheer" class="pull-right btn btn-primary focus">Berheer projecten</a>--}}
                    </div>
                </div>

                <div class="col-md-12">


                    {{ Form::open(array('url' => '/projects/'.$project->id.'/update', 'id'=>'form_project','files' => true)) }}

                    {{ csrf_field() }}

                    <div class="row">
                        <input name="id" class="id" type="text" value="" hidden>
                        <div class="form-group col-md-6">
                            <label for="title">Title(*)</label>
                            <input type="text" name="title" class="form-control" value="{{ $project->title }}">
                            @if ($errors->has('title'))
                                <span>
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $project->email }}">
                            @if ($errors->has('email'))
                                <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="description">Description(*)</label>
                     <textarea name="description" cols="30" rows="10"
                               class="form-control ">{{$project->description}}</textarea>
                            @if ($errors->has('description'))
                                <span>
                                <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group project_file col-md-6">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control " name="foto" >

                            @if ($errors->has('foto'))
                                <span>
                                        <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                            @endif

                        </div>


                        <div class="form-group col-md-6">
                            <label for="telephoneNumber">Telephone Number</label>
                            <input type="number" name="telephoneNumber" class="form-control"
                                   value="{{ $project->telephoneNumber }}">
                            @if ($errors->has('telephoneNumber'))
                                <span>
                                        <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="address">Address(*)</label>
                            <input type="text" name="address" class="form-control" id="searchTextField">
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
                                <input type="checkbox" name="isPriority" checked="{{$project->isPriority}}"> Het is
                                dringend!
                            </label>
                        </div>

                        <div class="checkbox ">
                            <label>
                                <input type="checkbox" name="isCompany"> Ik ben een bedrijf.
                            </label>
                        </div>


                        <div class="form-group pull-right">
                            <button class="btn btn-primary focus" id="manageBtn">Maak project aan</button>
                        </div>

                    </fieldset>


                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


@endsection





@extends('layouts/app')


@section('content')

    <div class="container-fluid ">

        <div class="row ">
            <div class="col-md-10 col-md-offset-1 add_form">
                <div class="row form-head">
                    <div class="col-md-12">
                        <h1 class="">Projecten beheren</h1>
                        {{--<a href="/projects/beheer" class="pull-right btn btn-primary focus">Berheer projecten</a>--}}
                    </div>
                </div>
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>


    <h1>project</h1>


    <div class="row">


        <div class="col-md-12">
            <h1 class="pull-left">Hier kan je de oproep wijzigen.</h1>
            <a href="/projects/beheer" class="pull-right btn btn-primary">Terug naar projecten</a>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12">

            {{ Form::open(array('url' => '/projects/'.$project->id.'/update', 'id'=>'form_project','files' => true)) }}

            {{ csrf_field() }}
            <div class="row">


                <input name="id" class="id" type="text" value="" hidden>

                <div class="form-group col-md-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $project->title }}">
                    @if ($errors->has('title'))
                        <span>
                                        <strong>{{ $errors->first('title') }}</strong>
                                <span>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="form-control ">{{$project->description}}</textarea>
                    @if ($errors->has('description'))
                        <span>
                                        <strong>{{ $errors->first('description') }}</strong>
                                <span>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$project->email}}">
                    @if ($errors->has('email'))
                        <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                <span>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="telephoneNumber">Telephone Number</label>
                    <input type="number" name="telephoneNumber" class="form-control"
                           value="{{ $project->telephoneNumber }}">
                    @if ($errors->has('telephoneNumber'))
                        <span>
                                        <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                <span>
                    @endif

                </div>


            </div>


            <div class="row">

                <div class="form-group col-md-6">

                    <label for="address">Address</label>

                    <input type="text" name="address" class="form-control" id="searchTextField"
                           value="{{$project->address}}">
                    <input type="text" name="lat" value="{{$project->lat}}" hidden>
                    <input type="text" name="lng" value="{{$project->lng}}" hidden>
                    <p class="alert alert-danger info_location col-md-12" hidden>Er ging iets mis, probeer
                        het later nog
                        eens</p>
                    @if ($errors->has('address'))
                        <span>
                                        <strong>{{ $errors->first('address') }}</strong>
                                <span>
                    @endif
                                    @if ( ($errors->has('lat'))   ||  ($errors->has('lng')) )
                                        <span>
                                        <strong>Er is iets mis met het adres. Voer het opnieuw in.</strong>
                                </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <div id="map_form"></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group project_file col-md-12">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" name="foto">
                    @if ($errors->has('foto'))
                        <span>
                                        <strong>{{ $errors->first('foto') }}</strong>
                                <span>
                    @endif
                </div>
                <img src="/images/small/{{$project->foto}}.jpg" alt="">
                <img src="" alt="" class="project_foto" id="currentPicture" hidden>

                <div class="checkbox col-md-12">
                    <label>
                        <input type="checkbox" name="isPriority" checked="{{$project->isPriority}}"> Het is
                        dringend!
                    </label>
                </div>

                <div class="checkbox col-md-12">
                    <label>
                        <input type="checkbox" name="isCompany" checked="{{$project->isCompany}}"> Ik ben
                        een bedrijf.
                    </label>
                </div>


                <div class="form-group col-md-12">
                    <button class="btn btn-primary" id="manageBtn">Update project</button>
                </div>
            </div>

            {{ Form::close() }}

        </div>

    </div>

@endsection