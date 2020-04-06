
@extends('layouts.app')

@section('content')

<div class="container">

    <main role="main" class="container" >


        <!--        
                {{ Form::open(array('route' => 'translation.postimport', 'method' => 'post')) }}
        
                <input class="form-control" type="text" placeholder="spreadsheetId" name="spreadsheetId" >
                {{ Form::submit('import',['class'=>'btn btn-secondary  ml-1 mt-1']) }}
        
                {{ Form::close() }}
        -->

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">

            {{ Form::open(array('route' => 'translation.postimport', 'method' => 'post')) }}

            
            <div class="input-group mb-3">
                <input name="spreadsheetId" type="text" class="form-control" placeholder="Spreadsheet Id" aria-label="Spreadsheet Id" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Import</button>
                </div>
              </div>

            {{ Form::close() }}
        </div>




</main>



</div>

@endsection