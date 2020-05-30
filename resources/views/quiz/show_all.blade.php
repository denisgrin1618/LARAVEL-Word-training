
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
                        
                        
                        @if ($quiz->pass_percentage() == 0)
                            <div class="rounded border border-secondary bg-white" style="width:100%; height: 35px; ">
                        @else
                            <div class="rounded border border-secondary bg-white" style="width:100%; height: 35px; background: linear-gradient(90deg, #DCDCDC {{$quiz->pass_percentage()}}%, #FFFFFF {{100-$quiz->pass_percentage()}}%)">
                        @endif

                            <h6 class="float-left mt-2 ml-2">{{ $quiz->name }}</h6>
                            <h6 class="float-right mt-2 mr-2">{{ $quiz->pass_percentage() }}%</h6>
                        </div>
                        <!--                        
                        <div style="margin-top: -23px; margin-left: 3px; margin-right: 3px; z-index: 10">
                            <h6 class="float-left">{{ $quiz->name }}</h6>
                            <h6 class="float-right">{{ $quiz->pass_percentage() }}%</h6>
                        </div>
                        -->
                        
                    </td>
                    <td class="text-right">
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

@endsection