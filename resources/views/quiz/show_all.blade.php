
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
                        <div class="progress" style="height: 35px;">
                            <div class="progress-bar text-left bg-secondary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%"> 
                                <h6>{{ $quiz->name }}</h6>
                            </div>
                        </div>  
                        
                    </td>
                    <td class="text-right">
                        <button class="btn btn-success">start</button>
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