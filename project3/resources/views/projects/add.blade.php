@extends('layouts/app')
@section('header')
    {{--<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>--}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ url('/js/manage.js') }}"></script>
    <script src="/js/tabController.js"></script>

@endsection

@section('content')
    <div class="row">
     

       <div class="col-md-12">
           <h1 class="pull-left">Vul deze form in en plaats een nieuwe oproep.</h1>
            <a href="/projects/beheer" class="pull-right btn btn-primary focus" >Berheer projecten</a>
       </div>

        
    </div>
    <div class="row">
        <div class="col-md-12">

            {{ Form::open(array('url' => '/projects/add/new', 'id'=>'form_project','files' => true)) }}

            {{ csrf_field() }}
            <div class="row">


                <input name="id" class="id" type="text" value="" hidden>

                <div class="form-group col-md-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                     @if ($errors->has('title'))
                                    <span>
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="form-control ">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                                    <span
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                     @if ($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="telephoneNumber">Telephone Number</label>
                    <input type="number" name="telephoneNumber" class="form-control" value="{{ old('telephoneNumber') }}">
                    @if ($errors->has('telephoneNumber'))
                                    <span>
                                        <strong>{{ $errors->first('telephoneNumber') }}</strong>
                                    </span>
                    @endif
                </div>


            </div>


            <div class="row">

                <div class="form-group col-md-6">

                    <label for="address">Address</label>

                    <input type="text" name="address" class="form-control" id="searchTextField">
                    <input type="text" name="lat" value="" hidden tabindex="-0">
                    <input type="text" name="lng" value="" hidden tabindex="-0">
                    <p class="alert alert-danger info_location col-md-12" hidden>Er ging iets mis, probeer het later nog
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
                <div class="col-md-6 map">
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
                                </span>
                    @endif
                </div>
                <img src="" alt="" class="project_foto" id="currentPicture" hidden>

                <div class="checkbox col-md-12">
                    <label>
                        <input type="checkbox" name="isPriority" id="checkFocus"> Het is dringend!
                    </label>
                </div>

                <div class="checkbox col-md-12 corm-control">
                    <label>
                        <input type="checkbox" name="isCompany" id="checkFocus"> Ik ben een bedrijf.
                    </label>
                </div>


                <div class="form-group col-md-12">
                    <button class="btn btn-primary focus" id="manageBtn">Create Project</button>
                </div>
            </div>

            {{ Form::close() }}

        </div>

    </div>

@endsection