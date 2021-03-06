@extends('layouts/app')

@section('header')
    <title>Nieuwe foto toevoegen</title>
@endsection



@section('content')
    <div class="container-fluid ">

        <div class="row">
            <div class="col-md-10 col-md-offset-1 add_form margin-top margin_bottom">
                <div class="row form-head">
                    <div class="col-md-12 ">
                        <h1 class=""><span class="line-headers">K</span>ies een foto om aan onze foto fotogalerij toe te
                            voegen
                        </h1>
                        <p class="subHead"> Heb je een leuke foto genomen tijdens een hulpverlening ? Hier kan je hem plaatsen.</p>
                        {{--<a href="/projects/beheer" class="pull-right btn btn-primary focus">Berheer projecten</a>--}}
                    </div>
                </div>

                <div class="col-md-12">
                    {{ Form::open(array('url' => '/pictures/store', 'id'=>'form_project','files' => true)) }}

                    {{ csrf_field() }}

                    <div class="form-group project_file col-md-6">
                        <label for="foto">Foto(*)</label>
                        <input type="file" class="form-control" name="foto">
                        @if ($errors->has('foto'))
                            <span>
                    <strong>{{ $errors->first('foto') }}</strong>
                </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="pictureInfo">Over wat gaat deze foto?(*)</label>
                        <input type="text" class="form-control" placeholder="" name="picture_info" value="{{ old('picture_info') }}">
                        <p>Deze beschrijving is voor blinden en slechtzienden. Het is enkel zichtbaar met screenreaders.</p>
                        @if ($errors->has('picture_info'))
                            <span>
                    <strong>{{ $errors->first('picture_info') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12 mobileBtn">
                        <button class="btn btn-primary pull-right">Foto toevoegen</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>





@endsection