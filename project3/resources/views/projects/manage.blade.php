@extends('layouts/app')



@section('content')
	
	<div class="col-md-4">
		
		<ul class="list-group">
			@foreach($projects as $project)
				<li class="list-group-item">
					{{$project->title}}
				</li>
					
				

			@endforeach
		</ul>
		
	



@endsection