@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    @lang('app_strings.start_new_quiz')
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
                                    <p>@lang('app_strings.language_word')</p>
                                </td>
                                <td>
                                   
                                    <select class="form-control" name="word_language">
                            
                                        @foreach ($languages as $language) 
                                            @if ($language->name ===  'en')
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
                                    <p>@lang('app_strings.language_translation')</p>
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
                                    <p>@lang('app_strings.quantity_of_words')</p>
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="quantity_of_words">
                                </td>
                            </tr>    
                            
                            <tr>
                                <td colspan="2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="select_most_complicated_words">
                                        <label class="custom-control-label" for="customCheck1">@lang('app_strings.select_most_complicated_words')</label>
                                      </div>
                                </td>
                               
                            </tr>    
                        </tbody>
                    </table>

                    {{ Form::submit( __('app_strings.start') ,['class'=>'btn btn-success  ml-1 mt-1 float-right']) }}

                    {{ Form::close() }}
                </div>

            </div>


            
<!--            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <a class="btn btn-outline-secondary" >RU</a>
                    <a class="btn btn-outline-secondary" >EN</a>
                </div>
                
                <div class="input-group-prepend">
                    <a class="btn btn-outline-secondary rounded-right" >UK</a>
                </div>   
            </div>-->

   
            

        </div>
    </div>
</div>
@endsection
