@extends('layouts/app')



@section('content')

	<h2>{{ $project->title }}</h2>

	<p>{{ $project->description }}</p>
	
	<p>{{ $project->goal }}</p>

	<p>{{ $project-> address }}</p>


	<h3>Reactions</h3>

	@foreach($project->reactions as $reaction)
		
		<strong>{{$reaction->user->name}}</strong>
		<p>{{$reaction->reaction}}</p>

	@endforeach

@endsection