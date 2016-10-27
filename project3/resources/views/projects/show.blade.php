@extends('layouts/app')



@section('content')

    <div class="container-fluid inleiding">
        <div class="row ">
            <div class="col-md-12 ">
                <h1>Over oproep</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid content-container">
        <div class="row">
            <div class="col-md-8">
                <div class="com-md-12">
                    <h2>{{ $project->title }}</h2>
                </div>
                <div class="col-md-12">
                    <p>{{ $project->description }}</p>
                </div>

            </div>
            <div class="col-md-4 oproep-contact-gegevens">
                <h2>Contact gegevens</h2>
                <p>{{$project->user->name}}</p>
                <p>{{$project-> address }}</p>
                <p>{{$project->telephoneNumber}}</p>
                <p>{{$project->email}}</p>
            </div>
            <div class="col-md-4">
                <h2>Tip: Hoe neem ik best contact</h2>
            </div>
        </div>
    </div>











    <h3>Reactions</h3>

    @if(Auth::check())
        <form action="/reactions/{{$project->id}}/add" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="body">New Reaction</label>
                <input type="text" class="form-control" name="body">
            </div>
            <div class="form-group">
                <input type="submit" value="verzend" class="btn btn-primary">
            </div>

        </form>
    @endif
    @foreach($project->reactions as $reaction)

        <strong>{{$reaction->user->name}}</strong>
        <p>{{$reaction->reaction}}</p>

    @endforeach

@endsection