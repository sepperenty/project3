@extends("layouts/app")

@section('content')



	<table class="table">
			<tr>
				<th>image</th>
				<th>info</th>
				<th>delete</th>
			</tr>

			
				@foreach($pictures as $picture)	
				<tr>
					<td>
					<img src="/images/small/{{$picture->name}}" alt="">
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

		
		
			
</table>
	


@endsection