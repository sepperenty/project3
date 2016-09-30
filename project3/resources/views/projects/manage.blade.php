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
		
	</div>
	
	<div class="col-md-8">

    

	

	
	{{ Form::open(array('url' => '/projects/manage/add', 'files' => true)) }}

		

				 {{ csrf_field() }}

				<div class="form-group">

						<label for="title">Title</label>
						
						<input type="text" name="title" class="form-control" value="{{ old('title') }}">

				</div>

				<div class="form-group">

						<label for="description">Description</label>
					
						<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>

				</div>

				<div class="form-group">

						<label for="category">Category</label>
					
						<input type="text" name="category" class="form-control">

				</div>

				<div class="form-group">
						
						<label for="goal">Goal</label>

						<input type="text" name="goal" class="form-control">

				</div>

				<div class="form-group">
						
						<label for="address">Address</label>
						<input type="text" name="address" class="form-control">

				</div>

				<div class="form-group">

						<label for="foto">Foto</label>

						<input type="file" class="form-control" name="foto">

				</div>

				<div class="form-group">
						
						<button class="btn btn-primary">Create Project</button>

				</div>
				
			
		{{ Form::close() }}

	</div>



@endsection