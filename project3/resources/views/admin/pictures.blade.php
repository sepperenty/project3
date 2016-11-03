@extends("layouts/app")

@section('content')

	<div class="container">

	<table class="table">
			<tr>
				<th>image</th>
				<th>info</th>
				<th>delete</th>
			</tr>

			
				@foreach($pictures as $picture)	
				<tr>
					<td>
					<img src="/images/small/{{$picture->name}}.jpg" alt="">
					</td>
					<td>
						{{$picture->picture_info}}
					</td>
					<td>
						<a href="/admin/picture/{{$picture->id}}/delete">delete</a>
					</td>
				</tr>
				@endforeach
				{{$pictures->links()}}

		
	</div>


		
			




@endsection