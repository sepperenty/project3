@extends("layouts/app")

@section('header')
	
	<title>Fotos - Graag Gedaan</title>

@endsection

@section('content')

	<div class="container-fluid ">
	        		<div class="row margin-top">
	            		<div class="col-md-10 col-md-offset-1 add_form">
			                <div class="row form-head">
			                    <div class="col-md-12">
			                        <h1 class=""><span class="line-headers">A</span>fbeeldingen</h1>
			                    </div>
			                </div>

					        <div class="col-md-12 white-space">

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
						<a href="/admin/picture/{{$picture->id}}/delete" class="badge">delete</a>
					</td>
				</tr>
				@endforeach
				{{$pictures->links()}}

		
		
			
		</table>
		</div>
		</div>
		</div>
		</div>



@endsection