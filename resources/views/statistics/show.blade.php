
@extends('layouts.app')

@section('content')





<div class="container">




    <div class="container">

        <main role="main" class="container" >

            <div class="row justify-content-center">
                <div class="col-md-8">


                    <h1>@lang('app_strings.statistic')</h1>

                    <table class="table-responsive w-100 d-block d-md-table">
                        <thead>
                            <tr>
                                <th style="width: 80%" scope="col"></th>
                                <th style="width: 20%" scope="col"></th>


                            </tr>
                        </thead>
                        <tbody id="table_translates">



                            <tr>
                                <td>@lang('app_strings.success_rate'):</td>
                                <td>
            <!--                        <span class="text-danger">23</span>-->
                                    {{Auth::user()->success_rate}}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_words'):</td>
                                <td>
                                    {{Auth::user()->total_words}}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_wrong_answers'):</td>
                                <td>
                                    {{Auth::user()->total_wrong_answers}}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_correct_answers'):</td>
                                <td>
                                    {{Auth::user()->total_correct_answers}}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_unanswered'):</td>
                                <td>
                                    {{Auth::user()->total_words - Auth::user()->total_correct_answers - Auth::user()->total_wrong_answers }}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_favorites'):</td>
                                <td>
                                    {{Auth::user()->total_favorites}}
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('app_strings.total_time_spent'):</td>
                                <td>
                                    0
                                </td>
                            </tr>

<!--                <tr>
    <td>@lang('app_strings.total_languages')</td>
    <td>
        0
    </td>
</tr>-->

                        </tbody>
                    </table>




                </div>
            </div>


<!--
            <div class="row">
                <table class="w-100 d-block d-md-table">
                    <tr>
                        <td>

                            <div class="container">
                                <div class="row">
                                     <div class="col-md-6 bt-light-red" >
111111111111111
                            </div>

                            <div class="col-md-6 bt-light-yellow" >
22222222222222
                            </div>
                                </div>
                            </div>
                           
                        </td>
                    </tr>
                    
                     <tr>
                        <td>

                            <div class="container">
                                <div class="row">
                                     <div class="col-md-6 bt-light-red" >
sdfkj  sdlfkjs df sdlfkjs dfl s fljsd fljs fsd flsd fjsldf sdl fsdlfj sldfjk sdfl sdfls flsdf
                            </div>

                            <div class="col-md-6 bt-light-yellow" >
22222222222222
                            </div>
                                </div>
                            </div>
                           
                        </td>
                    </tr>
                </table>
            </div>
        -->
        
        </main>






    </div>


</div>



@endsection
