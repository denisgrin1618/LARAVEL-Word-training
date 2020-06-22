
@extends('layouts.app')

@section('content')

<div class="container">


    <h1 id="quiz_id" class="invisible"> {{ $quiz->id }} </h1>

    <div class="row justify-content-center" id="div_quiz">
        <div class="col-md-8">

            <table class='table-responsive d-flex justify-content-center'>
                <tr >
                    <td>
                        <button id="button_back" class=" btn rounded border border-secondary " >            
                            <img  src="{{ asset('/img/icons/chevron-left.svg') }}" alt="" width="20" height="20" title="{{__('app_strings.back')}}">
                        </button>
                    </td>
                    <td>
                        <button id="button_next" class=" btn rounded border border-secondary " >            
                            <img src="{{ asset('/img/icons/chevron-right.svg') }}" alt="" width="20" height="20" title="{{__('app_strings.next')}}">
                        </button>
                    </td>
                    <td>
                        <button id="button_timer" class=" btn rounded border border-secondary pt-1 pl-1 pr-1" ><h4 id="timer" class="p-0 m-0">00:00</h4></button>
                    </td>
                    <td>
                        <button id="but_favorite" class="btn rounded border border-secondary" >            
                            <img src="{{ asset('/img/icons/star.svg') }}" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                        </button>

                    </td>
                    <td>
                        <button  class=" btn rounded border border-secondary " data-toggle="modal" data-target="#quiz_finish_modal" data-whatever="@mdo">            
                            <img src="{{ asset('/img/icons/check2.svg') }}" alt="" width="20" height="20" title="{{__('app_strings.finish')}}">
                        </button>

                    </td>
                </tr>
            </table>

            <br>

            <div class="input-group mb-3">
                <div class="input-group-prepend flex-wrap" id="word_box" >
                    <p class="input-group-text " id="p_word_box" style="word-break: break-word; white-space: normal;"></p>
                </div>
                <textarea class="form-control" aria-label="With textarea" id="translate_box"  style="resize: none; overflow:hidden; box-shadow: none!important;"></textarea>
            </div>

        </div>
    </div>

    <div class="row justify-content-center" id="div_quiz_number_current_word">
        <h4 id="number_current_word"></h4>
    </div>

    <div class="row justify-content-center invisible" id="div_result">
        <h5 id="result">RESULT 0%</h5>
        <br/>
        <table class="table-responsive table-striped w-100 d-block d-md-table" id="table_quiz">
            <thead>
                <tr>
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 30%" scope="col">Word</th>
                    <th style="width: 30%" scope="col">Your translation</th>
                    <th style="width: 30%" scope="col">Correct translation</th>
                    <th style="width: 0%" scope="col" class="d-none"></th>
                    <th style="width: 0%" scope="col" class="d-none"></th>
                </tr>
            </thead>
            <tbody id="table_translates">

                @foreach ($quiz->translations as $translate)
                <tr>
                    <td id="index_{{ $loop->iteration }}">{{ $loop->iteration }}</td>
                    <td id='word'>{{ $translate->word1->name }} </td>
                    <td id="translate_word_user"></td>
                    <td id='translate_word_correct'>{{ $translate->word2->name }}</td>
                    <td id='translate_id' class="d-none">{{ $translate->id }}</td>
                    <td id='translate_favorite' class="d-none">{{ is_null($translate->statistics) ? 0 : $translate->statistics->favorite }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>


    <div class="modal fade" id="quiz_finish_modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content-div">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-form-label">@lang('app_strings.worning_finish_quiz')</label>
                    </div>

                    <textarea class="form-control d-none" id="modal_translate_id" name="modal_quiz_id"></textarea>

                    <div class="text-right">
                        <button  class="btn btn-secondary" data-dismiss="modal" id="button_finish">@lang('app_strings.yes')</button>                         
                        <button  class="btn btn-secondary" data-dismiss="modal" >@lang('app_strings.no')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript" defer>


    var min_height_input = 100;
    var table_quiz_row_index = 0;
    var table_translates_rows_count = $('#table_translates tr').length;
    var timer;
    var timer_started = true;
    var quiz_time_seconds = 0;

    $(function ()
    {
        
        
        function update_number_current_word() {
            var number_current_word_text = "" + table_quiz_row_index + "/" + table_translates_rows_count;
            $('#number_current_word').text(number_current_word_text);
        }

        function start_timer(display) {

            timer_started = true;
            var minutes, seconds;

            timer = setInterval(function () {
                minutes = parseInt(quiz_time_seconds / 60, 10)
                seconds = parseInt(quiz_time_seconds % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);

                quiz_time_seconds++;

            }, 1000);
        }

        function resize_elements() {

            var width = $('.input-group-text').parent().parent().width();
            var height = $('.input-group-text').parent().parent().height();

            $('.input-group-text').css('width', width / 2);

            // при изменении размера textarea при наборе текста, будем менять размер зависимых елементов
            $('#translate_box').autoResize({elCopyResize: $("#p_word_box"), minHeight: min_height_input});
            $('#p_word_box').autoResize({elCopyResize: $("#translate_box"), minHeight: min_height_input});

            // при ручном растягивании textarea, будем менять размер зависимых елементов
//            $("#translate_box").ResizeSecondaryElement($("#p_word_box"), min_height_input);

        }

        function update_img_favorite() {

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var favorite = tr.find('#translate_favorite');

            if (favorite.text() === "1") {
                $('#but_favorite').find('img').attr("src", "{{ asset('/img/icons/star-fill.svg') }}");
            } else {
                $('#but_favorite').find('img').attr("src", "{{ asset('/img/icons/star.svg') }}");
            }

        }

        function update_current_words() {

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var word = tr.find('#word');
            var translate_user = tr.find('#translate_word_user');

            $('#p_word_box').text(word.text());
            $('#translate_box').val(translate_user.text().replace(/\n/g, ""));

        }


        $(document).ready(function () {
            
            resize_elements();
            start_timer($('#timer'));
            update_number_current_word();
//            console.log("ready " + $('#time').html());
//            Cookies.set('screen_size', $(window).width());
//            $.cookie('screen_size', $(window).width());
//            document.cookie = "screen_size="+$(window).width();
            
        });

        $(window).resize(function () {
            
            resize_elements();
//            Cookies.set('screen_size', $(window).width());
//            $.cookie('screen_size', $(window).width());

//            document.cookie = "screen_size="+$(window).width();         
        });

        $('#button_timer').click(function (e) {
            if (timer_started) {
                timer_started = false;
                clearTimeout(timer);
            } else {
                timer_started = true;
                start_timer($('#timer'));
            }
        });

        $('#but_favorite').click(function (e) {

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var td_favorite = tr.find('#translate_favorite');
            var favorite = 0;

            if (td_favorite.text() === "0") {
                favorite = 1;
                td_favorite.text(1);
            } else {
                favorite = 0;
                td_favorite.text(0);
            }

            update_img_favorite();

            $.ajax({
                type: 'POST',
                url: "/statistics/favorite",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "translation_id": tr.find('#translate_id').text(),
                    "favorite": favorite
                },

                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    console.log('data');
                }
            });
        });

        $('#button_finish').click(function (e) {

            timer_started = false;
            clearTimeout(timer);

            $("#button_next").trigger("click");
            $('#div_result').removeClass('invisible');
            $('#div_quiz').addClass('d-none');
            $('#div_quiz_number_current_word').addClass('d-none invisible');

            var quiz_id = $('#quiz_id').text();
            var data = [];
            $("#table_translates tr").each(function (index) {
                var correct = $(this).find('#translate_word_correct').text().replace(/\n/g, "");
                var user = $(this).find('#translate_word_user').text().replace(/\n/g, "");
                var id = $(this).find("#translate_id").text();
                var favorite = $(this).find("#translate_favorite").text();

                var row_data = new Object();
                row_data.quiz_id = quiz_id;
                row_data.translation_id = id;
                row_data.correct_answer = (correct == user);
                row_data.answer = user;
                row_data.favorite = favorite;
                row_data.time_in_seconds = quiz_time_seconds;
                data.push(row_data);
            });
//            console.log(JSON.stringify(data));

            $.ajax({
                type: 'POST',
                url: "/statistics/store",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "data": JSON.stringify(data)
                },

                success: function (data) {
//                        console.log("DATA /statistics/store ->");
//                        console.log(data);
                },
                error: function () {
//                        console.log("ERROR /statistics/store");
                }
            });


        });

        $('#button_next').click(function (e) {

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var word = tr.find('#word');
            var translate_correct = tr.find('#translate_word_correct');
            var translate_user = tr.find('#translate_word_user');

            translate_user.text($('#translate_box').val());
            if (translate_user.text().replace(/\n/g, "") == translate_correct.text().replace(/\n/g, "")) {
                translate_user.removeClass('text-danger').addClass('text-success');
            } else {
                translate_user.removeClass('text-success').addClass('text-danger');
            }

            if (table_quiz_row_index < table_translates_rows_count) {
                table_quiz_row_index++;
            }

//            console.log(table_quiz_row_index);

            update_current_words();



            //подсчитаем результат
            var result_persant = 0;
            var count_correct = 0;
            var count_error = 0;

            $("#table_translates tr").each(function (index) {
                var correct = $(this).find('#translate_word_correct').text().replace(/\n/g, "");
                var user = $(this).find('#translate_word_user').text().replace(/\n/g, "");
                var id = $(this).find("#translate_id").text();
                if (correct == user) {
                    count_correct++;
                } else {
                    count_error++;
                }


            });

            result_persant = Math.round(count_correct * 100 / (count_correct + count_error));
            $('#result').text("RESULT " + result_persant + "%");

            resize_elements();
            update_img_favorite();
            update_number_current_word();

        });

        $('#button_back').click(function (e) {

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var word = tr.find('#word');
            var translate_correct = tr.find('#translate_word_correct');
            var translate_user = tr.find('#translate_word_user');

            translate_user.text($('#translate_box').val());
            if (translate_user.text() == translate_correct.text()) {
                translate_user.removeClass('text-danger').addClass('text-success');
            } else {
                translate_user.removeClass('text-success').addClass('text-danger');
            }

            if (table_quiz_row_index > 1) {
                table_quiz_row_index--;
            }

            update_current_words();
            resize_elements();
            update_img_favorite();
            update_number_current_word();

        });

        $("#button_next").trigger("click");

        $("#translate_box").keypress(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);

            if (code == 13) {

                //избавимся от перевода строки
                if (event.preventDefault)
                    event.preventDefault();

                $("#translate_box").val().replace(/\n/g, "").replace(/\n/g, "");
                $("#button_next").trigger('click');


                return true;
            }
        });

    });


</script>


@endsection