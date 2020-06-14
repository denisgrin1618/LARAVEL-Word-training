@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    <h2>{{ $user->name }}</h2>
                </div>

                <div class="card-body">

                    <div class="container p-0 m-0">
                        <div class="row">

                            <img id="imgavatar col-12 col-md-4 col-lg-4" src="/img/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                            <form class="col-12 col-md-8 col-lg-8" enctype="multipart/form-data" action="/profile" method="POST">
                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group row">
                                    <label for="formControlFile">@lang('app_strings.update_profile_image')</label>
                                    <input type="file" name="avatar" class="form-control-file" id="formControlFile">
                                </div>
                                
                                <div class="form-group row">
                                    <label for="staticName" class="col-12 col-md-3 col-form-label">Name</label>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="name" class="form-control" id="staticName" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-12 col-md-3 col-form-label">Email</label>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="email" class="form-control" id="staticEmail" value="{{$user->email}}">
                                    </div>
                                </div>
                                
                                <input type="submit" class="pull-right btn btn-primary">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
