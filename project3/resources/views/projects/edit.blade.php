
@extends('layouts/app')


@section('content')
	
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
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="form-control ">{{$project->description}}</textarea>
                </div>


                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$project->email}}">
                </div>


                <div class="form-group col-md-12">
                    <label for="telephoneNumber">Telephone Number</label>
                    <input type="text" name="telephoneNumber" class="form-control" value="{{ $project->telephoneNumber }}">
                </div>


            </div>


            <div class="row">

                <div class="form-group col-md-6">

                    <label for="address">Address</label>

                    <input type="text" name="address" class="form-control" id="searchTextField" value="{{$project->address}}">
                    <input type="text" name="lat" value="{{$project->lat}}" hidden>
                    <input type="text" name="lng" value="{{$project->lng}}" hidden>
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
                <img src="/images/small/{{$project->foto}}.jpg" alt="">
                <img src="" alt="" class="project_foto" id="currentPicture" hidden>

                <div class="checkbox col-md-12">
                    <label>
                        <input type="checkbox" name="isPriority" checked="{{$project->isPriority}}"> Het is dringend!
                    </label>
                </div>

                <div class="checkbox col-md-12">
                    <label>
                        <input type="checkbox" name="isCompany" checked="{{$project->isCompany}}"> Ik ben een bedrijf.
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