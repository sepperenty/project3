@extends("layouts/app")

@section('header')
		
		<title>Users - Graag Gedaan</title>

@endsection

@section('content')
	
	

	   		<div class="container-fluid ">
        		<div class="row margin-top">
            		<div class="col-md-10 col-md-offset-1 add_form">
		                <div class="row form-head">
		                    <div class="col-md-12">
		                        <h1 class=""><span class="line-headers">G</span>ebruikers</h1>
		                    </div>
		                </div>

				        <div class="col-md-12 white-space">
				              
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
										<th><a href="/admin/{{$user->id}}/delete" class="badge">delete</a></th>
										<th><a href="/admin/{{$user->id}}/projects" class="badge">Projects</a></th>
									</tr>
									@endforeach
									
									{{$users->links()}}


							</table>
						</div>
					</div>
				</div>
			</div>
	



@endsection