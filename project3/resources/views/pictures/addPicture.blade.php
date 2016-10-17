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
    </div>

    <div class="form-group col-md-12">
        <button class="btn btn-primary">Foto toevoegen</button>
    </div>

    {{Form::close()}}

    @if(count($errors))


        @foreach($errors->all() as $error)

            <li class="alert alert-danger col-md-12 list-group-item">{{$error}}</li>

        @endforeach



    @endif


    @endsection