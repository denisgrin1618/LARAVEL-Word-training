
@extends('layouts.app')

@section('content')

<div class="container">

    <main role="main" class="container" >

        <table class="table-responsive  w-100 d-block d-md-table">
            <thead class="thead-light" >
                <tr>
                    <!-- <th style="width: 3%" scope="col">#</th> -->
                    <th  scope="col"></th>
                    <th style="width: 60px" scope="col"></th>

                </tr>
            </thead>
            <tbody id="table_translates">

  
                
                
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
                        
                        
                       
                        <div id="div_quiz" class="d-flex btn p-0 m-0 rounded border border-secondary bg-white" style="width:100%;  background: linear-gradient(90deg, #DCDCDC 0%, #DCDCDC {{$quiz->pass_percentage()}}%, white {{$quiz->pass_percentage()}}%, white {{100-$quiz->pass_percentage()}}%)">
                            <div class="m-1" style="width:100%">

                                
                                <table style="width:100%">
                                    <tr>
                                        <td class="text-left">{{ $quiz->name }}</td> 
                                        <td class="text-right" id="td_pass_percentage">{{ $quiz->pass_percentage() }}%</td>
                                    </tr>
                                </table>
                                
                                <div id="div_quiz_details" class="d-none">
                                    
                                    <table class="d-none d-flex text-left p-2">
                                        <tr >
                                            <td>total words:</td>
                                            <td>{{ $quiz->translations()->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>total correct answers:</td>
                                            <td>{{ $quiz->total_correct_answers() }}</td>
                                        </tr>
                                        <tr>
                                            <td>total wrong answers:</td>
                                            <td>{{ $quiz->total_wrong_answers() }}</td>
                                        </tr>
                                        <tr>
                                            <td>success rate:</td>
                                            <td>{{ $quiz->pass_percentage() }}%</td>
                                        </tr>
                                    </table>
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
                        <a class="btn btn-success" href="{{ route('quiz.id', ['id'=> $quiz->id]) }}">start</a>
                        <!-- <img src="/img/play_30.png" class="btn"> -->
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

</div>


<script type="text/javascript" defer>

    $(function ()
    {
        
        $('td #div_quiz').on("click", function (event) {

            var target = $(event.target);
            while(target.attr('id') != 'div_quiz'){
               target = target.parent(); 
            }

            var pass_percentage  = target.find('#td_pass_percentage').text(); 
            pass_percentage      = pass_percentage.replace("%", "");
            var div_quiz_details = target.find('#div_quiz_details');
            
            if(div_quiz_details.hasClass("d-none")){
                div_quiz_details.removeClass('d-none');
                target.css('background', 'white');
            }else{
                div_quiz_details.addClass('d-none');
                target.css('background', "linear-gradient(90deg, #DCDCDC 0%, #DCDCDC "+pass_percentage+"%, white "+pass_percentage+"%, white "+ (100 - pass_percentage)+"%)");
            }

        });
  
    });
     
</script>
     
@endsection