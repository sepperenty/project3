@extends('layouts/app')



@section('content')

	<h2>{{ $project->title }}</h2>

	<p>{{ $project->description }}</p>
	
	<p>{{ $project->goal }}</p>

	<p>{{ $project-> address }}</p>


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