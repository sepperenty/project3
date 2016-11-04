@extends("layouts/app")

	@section('header')
		
		<title>Oproepen {{$user->name}} - Graag Gedaan</title>

	@endsection

@section('content')

	  <div class="container-fluid ">
        <div class="row margin-top">
            <div class="col-md-10 col-md-offset-1 add_form">
                <div class="row form-head">
                    <div class="col-md-12">
                        <h1 class=""><span class="line-headers">P</span>rojecten van {{$user->name}} </h1>
                    </div>
                </div>
                <div class="col-md-12 white-space">
	


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
					<th><a href="/projects/{{$project->id}}/show">{{$project->title}}</a></th>
					<th>{{$project->email}}</th>
					<th>{{$project->telephoneNumber}}</th>
					<th>{{$project->address}}</th>
					<th><img src="/images/small/{{$project->foto}}" alt=""></th>
					<th><a href="/admin/project/{{$project->id}}/delete">delete</a></th>
				</tr>
				@endforeach
			@else
				<tr>
					<th>No projects found</th>
				</tr>
			@endif

			{{$projects->links()}}
		


	</table>

	</div>
	</div>
	</div>
	</div>
	


@endsection