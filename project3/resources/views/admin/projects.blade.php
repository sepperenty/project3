@extends("layouts/app")

@section('content')
	
	<h1>projecten van {{$user->name}}</h1>

	<table class="table">
			<tr>
				<th>title</th>
				<th>email</th>
				<th>telephone number</th>
				<th>address</th>
				<th>picture</th>
				<th>delete</th>
			</tr>	
			@if(count($projects)>0)

				@foreach($projects as $project)
				<tr>
					<th>{{$project->title}}</th>
					<th>{{$project->email}}</th>
					<th>{{$project->telephoneNumber}}</th>
					<th>{{$project->address}}</th>
					<th><img src="/images/small/{{$project->foto}}.jpg" alt=""></th>
					<th><a href="/admin/project/{{$project->id}}/delete">delete</a></th>
				</tr>
				@endforeach
			@else
				<tr>
					<th>No projects found</th>
				</tr>
			@endif
		


	</table>


@endsection