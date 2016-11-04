@extends("layouts/app")

@section('content')

    <h1>Edit Project</h1>

    <p>Author : {{$project->user->name}}</p>

    {{ Form::open(array('url' => '/projects/manage/add', 'id'=>'form_project','files' => true)) }}

    {{ csrf_field() }}
    <div class="row">


        <input name="id" class="id" type="text" value="" hidden>

        <div class="form-group col-md-12">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $project->title  }}">
        </div>

        <div class="form-group col-md-12">
            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10"
                      class="form-control ">{{ $project->description  }}</textarea>
        </div>


        <div class="form-group col-md-12">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ $project->email }}">
        </div>


        <div class="form-group col-md-12">
            <label for="telephoneNumber">Telephone Number</label>
            <input type="text" name="telephoneNumber" class="form-control" value="{{ $project->telephoneNumber }}">
        </div>


    </div>


    <div class="row">

        <div class="form-group col-md-6">

            <label for="address">Address</label>

            <input type="text" name="address" class="form-control" id="searchTextField" value="{{ $project->address }}">
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
        <img src="/images/medium/{{$project->foto}}.jpg">

        <div class="checkbox col-md-12">
            <label>
                <input type="checkbox" name="isPriority" @if( $project->isPriority ) checked @endif> Het is dringend!
            </label>
        </div>

        <div class="checkbox col-md-12">
            <label>
                <input type="checkbox" name="isCompany" @if( $project->isCompany ) checked @endif> Ik ben een bedrijf.
            </label>
        </div>


        <div class="form-group col-md-12">
            <button class="btn btn-primary" id="manageBtn">Update Project</button>
        </div>
    </div>

    {{ Form::close() }}



    @endsection