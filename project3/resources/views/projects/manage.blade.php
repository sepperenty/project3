@extends('layouts/app')
@section('header')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug&libraries=places"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ url('/js/manage.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">

            <ul class="list-group">
                @foreach($projects as $project)
                    <li class="list-group-item project_list" data-project_id="{{$project->id}}">
                        {{$project->title}}
                    </li>
                @endforeach
                <li class="list-group-item project_list" data-project_id="new_project">
                    creeër nieuw project
                </li>
                <p class="alert alert-info info col-md-12">Vul de gegevens in om je zoekertje te plaatsen</p>


                @if(count($errors))


                    @foreach($errors->all() as $error)

                        <li class="alert alert-danger col-md-12 list-group-item">{{$error}}</li>

                    @endforeach



                @endif


            </ul>

        </div>


        <div class="col-md-8">


            {{ Form::open(array('url' => '/projects/manage/add', 'id'=>'form_project','files' => true)) }}

            {{ csrf_field() }}
            <div class="row">


                <input name="id" class="id" type="text" value="" hidden>

                <div class="form-group col-md-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="form-control ">{{old('description')}}</textarea>
                </div>


                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>


                <div class="form-group col-md-12">
                    <label for="telephoneNumber">Telephone Number</label>
                    <input type="text" name="telephoneNumber" class="form-control" value="{{ old('telephoneNumber') }}">
                </div>


            </div>


            <div class="row">

                <div class="form-group col-md-6">

                    <label for="address">Address</label>

                    <input type="text" name="address" class="form-control" id="searchTextField">
                    <input type="text" name="lat" value="" hidden>
                    <input type="text" name="lng" value="" hidden>
                    <p class="alert alert-danger info_location col-md-12" hidden>Er ging iets mis, probeer het later nog
                        eens</p>
                </div>
                <div class="col-md-6">
                    <div id="map_form"></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group project_file col-md-12">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" name="foto">
                </div>

                <div class="form-group col-md-12">
                    <button class="btn btn-primary" id="manageBtn">Create Project</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>

    </div>

@endsection