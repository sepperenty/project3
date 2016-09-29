@extends('layouts/app')



@section('content')


	@foreach($projects as $project)

		<h1>{{$project->title}}</h1>
	

	@endforeach



@endsection