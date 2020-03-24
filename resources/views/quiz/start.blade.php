@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Start new quiz
                </div>

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

                    {{ Form::open(array('route' => 'quiz.store', 'method' => 'post')) }}

                    <table class="table-responsive w-100 d-block d-md-table">
                        <thead>
                            <tr>
                                <th style="width: 30%" scope="col"></th>
                                <th style="width: 70%" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <p>language word</p>
                                </td>
                                <td>
                                   
                                    <select class="form-control" name="word_language">
                            
                                        @foreach ($languages as $language) 
                                            @if ($language->name ===  ($search_input['language2'] ?? ""))
                                                <option selected>{{ $language->name }}</option>
                                            @else
                                                <option>{{ $language->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    
                                </td>
                            </tr>    

                            <tr>
                                <td>
                                    <p>language translate</p>
                                </td>
                                <td>
                                    <select class="form-control" name="translate_language">
                            
                                        @foreach ($languages as $language) 
                                            @if ($language->name ===  ($search_input['language2'] ?? ""))
                                                <option selected>{{ $language->name }}</option>
                                            @else
                                                <option>{{ $language->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </td>
                            </tr>  

                            <tr>
                                <td>
                                    <p>quantity of words</p>
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="quantity_of_words">
                                </td>
                            </tr>    
                        </tbody>
                    </table>

                    {{ Form::submit('Start',['class'=>'btn btn-success  ml-1 mt-1 float-right']) }}

                    {{ Form::close() }}
                </div>

            </div>



        </div>
    </div>
</div>
@endsection
