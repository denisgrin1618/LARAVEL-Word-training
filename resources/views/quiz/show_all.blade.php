
@extends('layouts.app')

@section('content')

<div class="container">

    <main role="main" class="container" >


        
        <table class="table-responsive  w-100 d-block d-md-table">
            <thead class="thead-light" >
                <tr>
                    <!-- <th style="width: 3%" scope="col">#</th> -->
                    <th  scope="col"></th>
                    <th style="width: 50px" scope="col"></th>
                    <th style="width: 50px" scope="col"></th>

                </tr>
            </thead>
            <tbody id="table_translates">

                <tr>
                    <td colspan="3" > 
                    
<!--                        <a  class="d-flex align-content-end flex-wrap" href="{{ route('quiz.start') }}" style="text-decoration: none;">
                            <button class="font-weight-bold but_start_new_quiz  bt-light-green d-flex btn p-6 m-10 rounded border border-secondary mx-auto" >            
                                @lang('app_strings.start_new_quiz')
                            </button>
                        </a>-->
                        
                                    <a href="{{ route('quiz.start') }}" style="text-decoration: none;" 
                               class="float-right mx-auto font-weight-bold but_start_new_quiz  bt-light-green btn p-6 m-10 rounded border border-secondary " >            
                                @lang('app_strings.start_new_quiz')
                            </a>
                       
<!--                        
                        <img class="mx-auto" src="/img/icons/file-earmark-plus.svg" alt="" width="20" height="20" title="{{__('app_strings.start')}}">
                    -->
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3" class="align-middle"> 
                    
                        <br>
                        
                    </td>
                </tr>
                
                
                @foreach ($quizes as $quiz)
                <tr>
                    <!--<th scope="row" >{{ $loop->iteration }}</th> -->
                    <td>
                        <!--                        
                        <div class="progress border border-secondary bg-white" style="height: 35px; z-index: -10">
                            <div class="progress-bar text-dark text-right"  style="width: {{ $quiz->pass_percentage() }}%; background-color: #DCDCDC">   
                            </div>
                        </div>  
                        -->
                        
                        
                       

<!--                        
                         <div class="font-weight-bold div_quiz d-flex btn p-0 m-0 rounded border border-secondary bg-white" 
                             data-toggle="collapse" data-target="#div_quiz_details{{ $quiz->id }}" aria-expanded="false" aria-controls="div_quiz_details{{ $quiz->id }}"
                             style="width:100%;  background: linear-gradient(90deg, #DCDCDC 0%, #DCDCDC {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)">
                        -->
                        
                         <div class="font-weight-bold div_quiz d-flex btn p-0 m-0 rounded border border-secondary bg-white" 
                             data-toggle="collapse" data-target="#div_quiz_details{{ $quiz->id }}" aria-expanded="false" aria-controls="div_quiz_details{{ $quiz->id }}"
                             style="width:100%; background: linear-gradient(90deg, #DCDCDC 0%, #DCDCDC {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)">  
                        
                            
<!--                             
                             @if ($quiz->pass_percentage() < 40)
                                background: linear-gradient(90deg, #FFA07A 0%, #FFA07A {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)"
                             @elseif ($quiz->pass_percentage() > 40 && $quiz->pass_percentage() < 80 )
                                background: linear-gradient(90deg, #fcf100 0%, #fcf100 {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)"
                             @else
                                background: linear-gradient(90deg, #32CD32 0%, #32CD32 {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)"
                             @endif
                              
                             >
                            -->
                            <div class="m-1" style="width:100%">

                                
                                <table style="width:100%">
                                    <tr>
                                        
<!--                                        
-->                                        <td class="text-left">@lang('app_strings.total_words'): {{ $quiz->translations()->count() }}</td> 
                                        
                                        
                                        
                                        
<!--                                        @if ($quiz->pass_percentage() < 40)
                                            <td class="text-left text-danger">
                                        @elseif ($quiz->pass_percentage() > 40 && $quiz->pass_percentage() < 80 )
                                            <td class="text-left text-warning">
                                        @else
                                            <td class="text-left text-success"> 
                                        @endif 
                                        
                                        @lang('app_strings.total_words'): {{ $quiz->translations()->count() }}</td> 
                                        -->
                                        <td class="text-right" id="td_pass_percentage">  
<!--                                                {{ $quiz->pass_percentage() }}%  -->
<!--                                                  
                                                  
-->                                             @if ($quiz->pass_percentage() < 40)
                                                    <span class="badge badge-pill badge-danger">{{ $quiz->pass_percentage() }}%</span> 
                                                @elseif ($quiz->pass_percentage() > 40 && $quiz->pass_percentage() < 80 )
                                                    <span class="badge badge-pill badge-warning">{{ $quiz->pass_percentage() }}%</span> 
                                                @else
                                                    <span class="badge badge-pill badge-success">{{ $quiz->pass_percentage() }}%</span> 
                                                @endif 
                                                
                                        </td>
                                    </tr>
                                </table>
                                

                                <div id="div_quiz_details{{ $quiz->id }}" class="collapse">
                                    <div >
                                    <table class="d-none d-flex text-left p-2 ">
                                        <tr>
                                            <td>@lang('app_strings.success_rate'):</td>
                                            <td>{{ $quiz->pass_percentage() }}%</td>
                                        </tr>
                                        <tr >
                                            <td>@lang('app_strings.total_words'):</td>
                                            <td>{{ $quiz->translations()->count() }}</td>
                                        </tr>
                                        <tr class='text-success'>
                                            <td>@lang('app_strings.total_correct_answers'):</td>
                                            <td>{{ $quiz->total_correct_answers() }}</td>
                                        </tr>
                                        <tr class='text-danger'>
                                            <td>@lang('app_strings.total_wrong_answers'):</td>
                                            <td>{{ $quiz->total_wrong_answers() }}</td>
                                        </tr>
                                        
                            
                                        @if ($quiz->total_wrong_answers() > 0)
                                        <tr>
                                            <td colspan="2">
                                                <a href="{{ route('quiz.id', ['id'=> $quiz->id, 'only_wrong_translations' => 'yes']) }}">@lang('app_strings.start_quiz_only_with_wrong_answers')</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                    </div>
                                </div >
                                 
                            </div>
                            
                        </div>
                        <!--                        
                        <div style="margin-top: -23px; margin-left: 3px; margin-right: 3px; z-index: 10">
                            <h6 class="float-left">{{ $quiz->name }}</h6>
                            <h6 class="float-right">{{ $quiz->pass_percentage() }}%</h6>
                        </div>
                        -->
                        
                    </td>
                    <td class="text-right align-top">
<!--                        
                        <a class=" d-flex btn p-6 m-0 rounded border border-secondary bg-white" href="{{ route('quiz.id', ['id'=> $quiz->id]) }}"> 
                            -->
                        <a  href="{{ route('quiz.id', ['id'=> $quiz->id]) }}">  
                            <button class="but_start_new_quiz d-flex btn p-6 m-10 rounded border border-secondary mx-auto" >            
                                <img class="mx-auto" src="/img/icons/play-fill.svg" alt="" width="20" height="20" title="{{__('app_strings.start')}}">
                            </button>
                        </a>
                        
                    </td>
                    <td class="float-right align-top">

                        <button class="but_delete_quiz d-flex btn p-6 m-0 rounded border border-secondary "  data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">            
                            <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                            <p id="quiz_id" class="d-none">{{$quiz->id}}</p>
                        </button>
                        
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <br>
        
        
        <div class="d-flex justify-content-center">
            <!-- {{ $quizes->links() }} -->     
            {{ $quizes->appends(request()->query())->links() }}
        </div>
        
        
    </main>

    
    
    
     <div >

        <div class="modal fade" id="quiz_delete_modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="modal-content-div">

                    <!--
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-label">New translate</h4>
                    </div>
                    -->
                    <div class="modal-body">

                       <div class="form-group">
                            <label for="translate_word2_name" class="col-form-label">@lang('app_strings.worning_delete_quiz')</label>
                        </div>

                        <textarea class="form-control d-none" id="modal_quiz_id" name="modal_quiz_id"></textarea>
                        
                        <div class="text-right">
                            <button  class="btn btn-secondary" data-dismiss="modal" id="modal_dialog_button_delete">@lang('app_strings.yes')</button>                         
                            <button  class="btn btn-secondary" data-dismiss="modal" id="modal_dialog_button_cansel">@lang('app_strings.no')</button>
                        </div>
                    </div>
                    <!--
                    <div class="modal-footer">
                        
                    </div>
                    -->

                </div>
            </div>
        </div>
    </div>

    
    
    
</div>


<script type="text/javascript" defer>

    $(function ()
    {

        var curent_table_tr;
               
        $('.div_quiz').click(function(e){
            //При нажатии новой строки сворачивает все открытые div деталей
//            $('[id*="div_quiz_details"]').removeClass('show');
        });
        
//        $('.but_start_new_quiz').click(function(e){
//           $(location).attr('href', {{ route('quiz.start') }});
//        });
        
        $('.but_delete_quiz').on("click", function (event) {

            var button = $(event.target); 
            var quiz_id = button.parent().find('#quiz_id').text();
            console.log("quiz_id " + quiz_id);
            
            curent_table_tr = button.parent().parent().parent();
//            console.log(curent_table_tr.html());
            
            $('#modal_quiz_id').val(quiz_id);
  
        });

        $('#modal_dialog_button_delete').click(function (e) {

            e.preventDefault();

//            console.log('click delete');

            var quiz_id = $('#modal_quiz_id').val();
            console.log(quiz_id);
            $.ajax({
                type: 'DELETE',
                url: "/quiz/delete/"+quiz_id,
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },

                success: function (data) {
                    console.log(data);
//                    $('#table_translates').find('#translate_id').eq(translate_id).remove();
                    curent_table_tr.remove();
                },
                error: function () {
                    console.log("ERROR");
                }
            });
        });
        
        $('td .div_quiz').on("click", function (event) {

            console.log('1111');
            var target = $(event.target);
            while(!target.hasClass('div_quiz')){  //target.attr('id') != 'div_quiz'
               target = target.parent(); 
            }

            var pass_percentage  = target.find('#td_pass_percentage span').text(); 
            pass_percentage      = pass_percentage.replace("%", "");
            var div_quiz_details = target.find('[id*="div_quiz_details"] table');
            
//            console.log(div_quiz_details.html());
            if(div_quiz_details.hasClass("d-none")){
                div_quiz_details.removeClass('d-none');
                target.css('background', 'white');
            }else{
                div_quiz_details.addClass('d-none');
                target.css('background', "linear-gradient(90deg, #DCDCDC 0%, #DCDCDC "+pass_percentage+"%, white "+pass_percentage+"%, white "+ (100 - pass_percentage)+"%)");
            }

        });
  
//        $(".but_start_quiz")
//            .mouseover(function() {
//              $( this ).removeClass('bt-white').addClass('bg-secondary');
//            })
//            .mouseout(function() {
//              $( this ).removeClass('bg-secondary').addClass('bt-white');
//        });
//  
    });
     
</script>
     
@endsection