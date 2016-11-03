@extends('layouts/app')
@section('header')
    
    <title>Beheer pagine - Graag Gedaan</title>


@endsection

@section('content')


    <div class="container-fluid ">
        <div class="row margin-top">
            <div class="col-md-10 col-md-offset-1 add_form">
                <div class="row form-head">
                    <div class="col-md-12">
                        <h1 class="">Projecten beheren</h1>
                    </div>
                </div>
                <div class="col-md-12 white-space">
                    @foreach($projects as $project)
                        <div class="row manage_page">
                            <div class="col-xs-6 col-md-2">
                                <a href="/projects/{{$project->id}}/show" class="thumbnail">
                                    <img src="/images/small/{{$project->foto}}.jpg"
                                         alt="Foto van {{$project->user->name}} als titel {{ $project->title }}">
                                </a>
                            </div>
                            <div class=" col-md-8">
                                <h1>{{ $project->title }}</h1>
                                <hr>
                            </div>
                            <div class="col-md-2 ">
                                <a class="white" href="/projects/{{$project->id}}/edit"> <div class="col-md-12 a-button">Bijwerken</div></a>
                                <a class="white" href="/projects/{{$project->id}}/delete"> <div class="col-md-12 a-button">Verwijderen</div></a>
                            </div>

                        </div>
                        {{--<li class="list-group-item project_list" data-project_id="{{$project->id}}">--}}
                        {{--<img src="/images/small/{{$project->foto}}.jpg" alt="">--}}
                        {{--{{$project->title}}--}}
                        {{--<a class="badge" href="/projects/{{$project->id}}/edit">edit</a>--}}
                        {{--<a class="badge" href="/projects/{{$project->id}}/delete">delete</a>--}}
                        {{--</li>--}}
                    @endforeach
                    {{$projects->links()}}
                </div>
            </div>
        </div>
    </div>

    {{--<div class="col-md-12">--}}
    {{--<div class="row">--}}
    {{----}}
    {{--<h1 class="pull-left">jouw oproepen</h1><a href="/projects/add" class="pull-right btn btn-primary">Nieuw Project</a>--}}
    {{--</div>--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($projects as $project)--}}
    {{--<li class="list-group-item project_list" data-project_id="{{$project->id}}">--}}
    {{--<img src="/images/small/{{$project->foto}}.jpg" alt="">--}}
    {{--{{$project->title}}--}}
    {{--<a class="badge" href="/projects/{{$project->id}}/edit">edit</a>--}}
    {{--<a class="badge" href="/projects/{{$project->id}}/delete">delete</a>--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{----}}
    {{--{{$projects->links()}}--}}
    {{----}}
    {{----}}
    {{----}}
    {{----}}
    {{----}}
    {{--@if(count($errors))--}}
    {{--@foreach($errors->all() as $error)--}}
    {{--<li class="alert alert-danger col-md-12 list-group-item">{{$error}}</li>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{----}}
    {{----}}
    {{----}}
    {{--</div>--}}


@endsection