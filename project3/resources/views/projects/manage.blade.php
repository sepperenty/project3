@extends('layouts/app')



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
                    <textarea name="description" cols="30" rows="10" class="form-control "></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control ">
                </div>

                <div class="form-group col-md-12">
                    <label for="goal">Goal</label>
                    <input type="text" name="goal" class="form-control ">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">

                    <label for="address">Address</label>

                    <input type="text" name="address" class="form-control" id="searchTextField">
                    <input type="text" name="lat" value="" hidden>
                    <input type="text" name="lng" value="" hidden>
                    <p class="alert alert-danger info_location col-md-12" hidden>Er ging iets mis, probeer het later nog eens</p>
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
                    <button class="btn btn-primary">Create Project</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>

    </div>

@endsection