@extends('layouts/app')

@section('header')
    <title>Nieuwe foto toevoegen</title>
    @endsection



@section('content')

    <h1>New picture</h1>


    {{ Form::open(array('url' => '/pictures/store', 'id'=>'form_project','files' => true)) }}

    {{ csrf_field() }}

    <div class="form-group project_file col-md-12">
        <label for="foto">Foto</label>
        <input type="file" class="form-control" name="foto">
        @if ($errors->has('foto'))
                <span>
                    <strong>{{ $errors->first('foto') }}</strong>
                </span>
        @endif
    </div>

    <div class="form-group col-md-12">
        <label for="pictureInfo">Wat zie jehier ?</label>
        <input type="text" class="form-control" name="picture_info"></input>
        @if ($errors->has('picture_info'))
                <span>
                    <strong>{{ $errors->first('picture_info') }}</strong>
                </span>
        @endif
    </div>

    <div class="form-group col-md-12">
        <button class="btn btn-primary">Foto toevoegen</button>
    </div>




    {{Form::close()}}




    @endsection