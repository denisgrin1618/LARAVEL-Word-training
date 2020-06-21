
@extends('layouts.app')

@section('content')

<div class="container">

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
                            {{Auth::user()->total_time_spent}}
                        </td>
                    </tr>

                </tbody>
            </table>


        </div>
    </div>

</div>

@endsection
