@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>@lang('app_strings.start_new_quiz')
            </h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

           


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
                        <td class='@error('word_language') text-danger @enderror'>
                            <p>@lang('app_strings.language_word')</p>
                        </td>
                        <td>

                            <select class="form-control  @error('word_language') border-danger @enderror" name="word_language">

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
                        <td class='@error('translate_language') text-danger @enderror'>
                            <p>@lang('app_strings.language_translation')</p>
                        </td>
                        <td>
                            <select class="form-control @error('translate_language') border-danger @enderror" name="translate_language">

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
                        <td class='@error('quantity_of_words') text-danger @enderror'>
                            <p>@lang('app_strings.quantity_of_words')</p>
                        </td>
                        <td>
                            <input class="form-control   @error('quantity_of_words') border-danger @enderror" type="number" name="quantity_of_words">
                        </td>
                    </tr>    
<!--
                    <tr>
                        <td colspan="2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select_most_complicated_words" name="select_most_complicated_words">
                                <label class="custom-control-label" for="select_most_complicated_words">@lang('app_strings.select_most_complicated_words')</label>
                            </div>
                        </td>

                    </tr>  

                    <tr>
                        <td colspan="2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select_unanswered_words" name="select_unanswered_words">
                                <label class="custom-control-label" for="select_unanswered_words">@lang('app_strings.select_unanswered_words')</label>
                            </div>
                        </td>

                    </tr>    
-->
                    <tr>
                        <td>
                            <p>@lang('app_strings.filter')</p>
                        </td>
                        <td>
                            <select class="custom-select" name='filter'>
                                <option value="any_words" selected>@lang('app_strings.any_words')</option>
                                <option value="select_wrong_answered_words">@lang('app_strings.select_wrong_answered_words')</option>
                                <option value="select_unanswered_words">@lang('app_strings.select_unanswered_words')</option>
                                <option value="select_favorite_words">@lang('app_strings.select_favorite_words')</option>
                            </select>
                        </td>
                    </tr>   

<!--                    <tr>
                        <td colspan="2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="select_most_complicated_words" name="quiz_filter" class="custom-control-input">
                                <label class="custom-control-label" for="select_most_complicated_words">@lang('app_strings.select_most_complicated_words')</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="select_unanswered_words" name="quiz_filter" class="custom-control-input">
                                <label class="custom-control-label" for="select_unanswered_words">@lang('app_strings.select_unanswered_words')</label>
                            </div>
                        </td>
                    </tr>-->
                    
                </tbody>
            </table>

            {{ Form::submit( __('app_strings.start') ,['class'=>'btn btn-success  ml-1 mt-1 float-right']) }}

            {{ Form::close() }}






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
