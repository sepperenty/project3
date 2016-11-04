@extends('layouts/app')

@section('header')
    <title>{{$project->title}} - Graag Gedaan</title>
@endsection



@section('show_page')

    <div class="container-fluid page">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">

                    {{--<div class="inleiding uppercas"><h1 >Overzicht van het project</h1></div>--}}
                    <div class="element">
                        <img src="/images/medium/{{$project->foto}}"
                             alt="Foto van {{$project->user->name}} als titel {{ $project->title }}">
                        <div class="content">
                            <h1 class="uppercas"><span class="line-headers">O</span>verzicht van het project</h1>
                            <hr>
                            <h1 id="inhoud">{{ $project->title }}</h1>
                        </div>
                    </div>
                    <div class="content-body">
                        <div class="dicription">
                            <div class="col-md-8 beschrijving">
                                <h1>Beschrijving</h1>
                                <hr>
                                <p>{{$project->description}}</p>
                            </div>
                            <div class="col-md-4 contact">
                                <div class="col-md-11">

                                    <h1>Contact</h1>
                                    <hr>
                                    @if(Auth()->check())
                                        <p><strong>Naam:</strong><span
                                                    class="pull-right">{{$project->user->name}}</span>
                                        </p>
                                        <p><strong>Adres:</strong><span
                                                    class="pull-right">{{$project-> address }}</span>
                                        </p>
                                        <p><strong>Telefoon:</strong><span
                                                    class="pull-right">{{$project->telephoneNumber}}</span>
                                        </p>
                                        <p><strong>Email:</strong><span class="pull-right">
                                        @if(!empty($project->email))
                                                    {{$project->email}}
                                                @else
                                                    {{$project->user->email}}
                                                @endif
                                    </span>


                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 email_show_project">
                            <h1>Wil je deze persoon helpen? neem contact!</h1>
                            <hr>
                            <form action="/projects/{{$project->id}}/mail" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="subject"> Onderwerp </label>
                                        <input type="text" name="subject" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="message"> Bericht </label>
                                        <textarea name="message" id="" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-primary pull-right">
                                    </div>
                                </div>
                            </form>
                            @else
                                <p>Je moet ingelogt zijn om de contactinformatie te raadpleden.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="container-fluid inleiding">--}}
    {{--<div class="row ">--}}
    {{--<div class="col-md-12 ">--}}
    {{--<h1>Over oproep</h1>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="container-fluid content-container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8">--}}
    {{--<div class="com-md-12">--}}
    {{--<h2>{{ $project->title }}</h2>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<p>{{ $project->description }}</p>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--<div class="col-md-4 oproep-contact-gegevens">--}}
    {{--<h2>Contact gegevens</h2>--}}
    {{--<p>{{$project->user->name}}</p>--}}
    {{--<p>{{$project-> address }}</p>--}}
    {{--<p>{{$project->telephoneNumber}}</p>--}}
    {{--<p>{{$project->email}}</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-4">--}}
    {{--<h2>Tip: Hoe neem ik best contact</h2>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}











    {{--<h3>Reactions</h3>--}}

    {{--@if(Auth::check())--}}
    {{--<form action="/reactions/{{$project->id}}/add" method="POST">--}}

    {{--{{ csrf_field() }}--}}

    {{--<div class="form-group">--}}
    {{--<label for="body">New Reaction</label>--}}
    {{--<input type="text" class="form-control" name="body">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="submit" value="verzend" class="btn btn-primary">--}}
    {{--</div>--}}

    {{--</form>--}}
    {{--@endif--}}
    {{--@foreach($project->reactions as $reaction)--}}

    {{--<strong>{{$reaction->user->name}}</strong>--}}
    {{--<p>{{$reaction->reaction}}</p>--}}

    {{--@endforeach--}}

@endsection