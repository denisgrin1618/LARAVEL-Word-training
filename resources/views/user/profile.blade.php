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

                    <img id="imgavatar" src="/img/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                    
                    <form enctype="multipart/form-data" action="/profile" method="POST">
                        <label>@lang('app_strings.update_profile_image')</label>
                        
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <br><br>
                        <input type="submit" class="pull-right btn btn-primary">
                    </form>
                    
                </div>

            </div>



        </div>
    </div>
</div>

    
@endsection
