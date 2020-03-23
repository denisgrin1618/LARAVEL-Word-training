@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Start new quiz</div>

                <div class="card-body">

                    {{ Form::open(array('route' => 'quiz.start', 'method' => 'get')) }}
                            
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
                                    <input class="form-control" type="text" placeholder="search" >
                                </td>
                            </tr>    
                            
                            <tr>
                                <td>
                                    <p>language translate</p>
                                </td>
                                <td>
                                    <input class="form-control" type="text" placeholder="search" >
                                </td>
                            </tr>  
                            
                            <tr>
                                <td>
                                    <p>quantity of words</p>
                                </td>
                                <td>
                                    <input class="form-control" type="text" placeholder="search" >
                                </td>
                            </tr>    
                        </tbody>
                    </table>
                    
                    <button type="button" class="btn btn-success  ml-1 mt-1 float-right">Start</button>
                    
                    {{ Form::close() }}
                </div>

            </div>



        </div>
    </div>
</div>
@endsection
