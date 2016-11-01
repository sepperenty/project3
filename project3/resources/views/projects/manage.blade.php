
@extends('layouts/app')
@section('header')
   
@endsection

@section('content')


  <div class="col-md-12">
  <div class="row">
    
  <h1 class="pull-left">jouw oproepen</h1><a href="/projects/add" class="pull-right btn btn-primary">Nieuw Project</a>
  </div>
          <ul class="list-group">
              @foreach($projects as $project)
                  <li class="list-group-item project_list" data-project_id="{{$project->id}}">
                      <img src="/images/small/{{$project->foto}}.jpg" alt="">
                       {{$project->title}}
                      <a class="badge" href="/projects/{{$project->id}}/edit">edit</a>
                      <a class="badge" href="/projects/{{$project->id}}/delete">delete</a>
                  </li>
              @endforeach
              
              {{$projects->links()}}
      
              
             
      
      
              @if(count($errors))
                  @foreach($errors->all() as $error)
                      <li class="alert alert-danger col-md-12 list-group-item">{{$error}}</li>
                  @endforeach
              @endif
          </ul>
      
      
      
      </div>
       

@endsection