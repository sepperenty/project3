@extends("layouts/app")

@section('content')
	
	<h1>projecten van {{$user->name}}</h1>

	<table class="table">
			<tr>
				<th>name</th>
				<th>email</th>
				<th>Delete</th>
				<th>projects</th>
			</tr>	

			@foreach($users as $user)
			<tr>
				<th>{{$user->name}}</th>
				<th>{{$user->email}}</th>
				<th><a href="/{{$user->id}}/delete">delete</a></th>
				<th><a href="/{{$user->id}}/projects">Projects</a></th>
			</tr>
			@endforeach
	


	</table>


@endsection