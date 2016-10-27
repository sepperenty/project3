@extends("layouts/app")

@section('content')
	
	<h1>Users</h1>

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
				<th><a href="/admin/{{$user->id}}/delete">delete</a></th>
				<th><a href="/admin/{{$user->id}}/projects">Projects</a></th>
			</tr>
			@endforeach
	


	</table>


@endsection