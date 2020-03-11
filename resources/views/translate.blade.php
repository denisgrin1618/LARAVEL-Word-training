
@extends('layouts.app')

@section('content')



<div class="container">
    
    <h1>TRANSLATE</h1>
    
    
    <form action="{{route('translate.add')}}" method="POST" >
      @csrf
      <div class="form-group">
        <label for="word1">Word1</label>
        <input type="text" class="form-control" id="word1" name="word1" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="word2">Word2</label>
        <input type="text" class="form-control" id="word2" name="word2">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
</div>
@endsection