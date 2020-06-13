
@extends('layouts.app')

@section('content')

<div class="container">
    <main role="main" class="container" >

        <h1 id="quiz_id" class="invisible"> {{ $quiz->id }} </h1>
        <!--
                <div class="row justify-content-center">
                    <div class="col-md-8">
        
                        <div class="row justify-content-md-center">
                            <table class="table  table-borderless">
        
                                <thead>
                                    <tr>                    
                                        <th class="text-left"></th>
                                        <th class="text-right"></th>
                                        <th class="text-left"></th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
        
        
                                    <tr>
                                        <td>
                                            <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bg-white" >
                                                <img class="mx-auto" src="/img/icons/chevron-double-left.svg" alt="" width="20" height="20" title="search">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="float-right d-flex btn p-6 m-0 rounded border border-secondary bg-white" >
                                                <img class="mx-auto" src="/img/icons/chevron-left.svg" alt="" width="20" height="20" title="search">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bg-white" >
                                                <img class="mx-auto" src="/img/icons/chevron-right.svg" alt="" width="20" height="20" title="search">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="float-right d-flex btn p-6 m-0 rounded border border-secondary bg-white" >
                                                <img class="mx-auto" src="/img/icons/chevron-double-right.svg" alt="" width="20" height="20" title="search">
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
        
                        </div>
                    </div>
                </div>
        -->

        <div class="row justify-content-center" id="div_quiz">
            <div class="col-md-8">

                <div class="row justify-content-md-center">

                    <table class='table-responsive d-flex justify-content-center'>
                        <tr >
                            <td>
                                <button id="button_back" class=" btn rounded border border-secondary " >            
                                    <img  src="/img/icons/chevron-left.svg" alt="" width="20" height="20" title="{{__('app_strings.back')}}">
                                </button>
                            </td>
                            <td>
                                <button id="button_next" class=" btn rounded border border-secondary " >            
                                    <img src="/img/icons/chevron-right.svg" alt="" width="20" height="20" title="{{__('app_strings.next')}}">
                                </button>
                            </td>
<!--                            <td>
                                <a href="{{ route('quiz.id', ['id'=> $quiz->id]) }}">  
                                    <button class=" btn rounded border border-secondary" >            
                                        <img src="/img/icons/clock.svg" alt="" width="20" height="20" title="{{__('app_strings.start')}}">
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('quiz.id', ['id'=> $quiz->id]) }}">  
                                    <button class=" btn rounded border border-secondary" >            
                                        <img src="/img/icons/eye.svg" alt="" width="20" height="20" title="{{__('app_strings.start')}}">
                                    </button>
                                </a>
                            </td>-->
                             <td>
                                <button id="but_favorite" class="btn rounded border border-secondary" >            
                                    <img src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                                </button>
                                
                            </td>
                            <td>
                                <button id="button_finish" class=" btn rounded border border-secondary " >            
                                    <img src="/img/icons/check2.svg" alt="" width="20" height="20" title="{{__('app_strings.finish')}}">
                                </button>
                                
                            </td>
                        </tr>
                    </table>











                </div>
                <br>

                <div class="row justify-content-md-center">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend flex-wrap" id="word_box" >
                            <p class="input-group-text " id="p_word_box" style="word-break: break-word; white-space: normal;"></p>
                        </div>
                        <textarea class="form-control" aria-label="With textarea" id="translate_box"  style="resize: none; overflow:hidden; box-shadow: none!important;"></textarea>
                    </div>

                </div>

<!--
                <button class="btn bt-grey-silver float-left" >
                    @lang('app_strings.back')
                </button>

                <button class="btn bt-grey-silver float-right" >
                    @lang('app_strings.next')
                </button>

                <button class="btn btn-success float-right d-none" id="button_finish">
                    @lang('app_strings.finish')
                </button>
-->

            </div>
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


    </main>
</div>

<script type="text/javascript" defer>


    var min_height_input = 100;
    var table_quiz_row_index = 0;
    var table_translates_rows_count = $('#table_translates tr').length;


    $(function ()
    {

        function resize_elements() {

            var width = $('.input-group-text').parent().parent().width();
            var height = $('.input-group-text').parent().parent().height();

            $('.input-group-text').css('width', width / 2);

            // при изменении размера textarea при наборе текста, будем менять размер зависимых елементов
            $('#translate_box').autoResize({elCopyResize: $("#p_word_box"), minHeight: min_height_input});

            // при ручном растягивании textarea, будем менять размер зависимых елементов
            //        $("#translate_box").ResizeSecondaryElement($("#p_word_box"), min_height_input);

        }

        function update_img_favorite(){
            
            var index    = table_quiz_row_index;
            var tr       = $('#index_' + index).parent();
            var favorite = tr.find('#translate_favorite');

            if(favorite.text() === "1"){
                $('#but_favorite').find('img').attr("src","/img/icons/star-fill.svg");
            }else{
                $('#but_favorite').find('img').attr("src","/img/icons/star.svg");
            }
            
        }
        
        $(document).ready(function () {
            resize_elements();

            console.log("ready");
        });

        $(window).resize(function () {
            resize_elements();
        });

        $('#but_favorite').click(function(e){
            
            var index       = table_quiz_row_index;
            var tr          = $('#index_' + index).parent();
            var td_favorite = tr.find('#translate_favorite');
            var favorite    = 0;

            if(td_favorite.text() === "0"){
                favorite = 1;
                td_favorite.text(1);
            }else{
                favorite = 0;
                td_favorite.text(0);
            }
            
            update_img_favorite();
            
            
           
             
//             console.log('translation_id - ' + tr.find('#translate_id').text());
            
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
//            
            
        });

        $('#button_finish').click(function (e) {

            $("#button_next").trigger("click");
            $('#div_result').removeClass('invisible');
            $('#div_quiz').addClass('d-none');

            var quiz_id = $('#quiz_id').text();
            var data = [];
            $("#table_translates tr").each(function (index) {
                var correct     = $(this).find('#translate_word_correct').text().replace(/\n/g, "");
                var user        = $(this).find('#translate_word_user').text().replace(/\n/g, "");
                var id          = $(this).find("#translate_id").text();
                var favorite    = $(this).find("#translate_favorite").text();

                var row_data = new Object();
                row_data.quiz_id        = quiz_id;
                row_data.translation_id = id;
                row_data.correct_answer = (correct == user);
                row_data.answer         = user;
                row_data.favorite       = favorite;
                data.push(row_data);
            });
                console.log(JSON.stringify(data));

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

            //нажали кнопку финиш
//            if(table_translates_rows_count == table_quiz_row_index){
//                $('#div_result').removeClass('invisible');
//                $('#div_quiz').addClass('d-none');  
//            }




            var index               = table_quiz_row_index;
            var tr                  = $('#index_' + index).parent();
            var word                = tr.find('#word');
            var translate_correct   = tr.find('#translate_word_correct');
            var translate_user      = tr.find('#translate_word_user');

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

            var index           = table_quiz_row_index;
            var tr              = $('#index_' + index).parent();
            var word            = tr.find('#word');
            var translate_user  = tr.find('#translate_word_user');
//            console.log(translate_user.text());
            $('#p_word_box').text(word.text());
            $('#translate_box').val(translate_user.text().replace(/\n/g, ""));

//            if (table_translates_rows_count == table_quiz_row_index) {
//                $('#button_finish').removeClass('d-none');
//                $('#button_next').addClass('d-none');
//            }



            //подсчитаем результат
            var result_persant = 0;
            var count_correct = 0;
            var count_error = 0;


            $("#table_translates tr").each(function (index) {
                var correct = $(this).find('#translate_word_correct').text().replace(/\n/g, "");
                var user    = $(this).find('#translate_word_user').text().replace(/\n/g, "");
                var id      = $(this).find("#translate_id").text();
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

        });

        $('#button_back').click(function (e) {



            var index               = table_quiz_row_index;
            var tr                  = $('#index_' + index).parent();
            var word                = tr.find('#word');
            var translate_correct   = tr.find('#translate_word_correct');
            var translate_user      = tr.find('#translate_word_user');

            translate_user.text($('#translate_box').val());
            if (translate_user.text() == translate_correct.text()) {
                translate_user.removeClass('text-danger').addClass('text-success');
            } else {
                translate_user.removeClass('text-success').addClass('text-danger');
            }

            if (table_quiz_row_index > 1) {
                table_quiz_row_index--;
            }

//            console.log(table_quiz_row_index);

            var index           = table_quiz_row_index;
            var tr              = $('#index_' + index).parent();
            var word            = tr.find('#word');
            var translate_user  = tr.find('#translate_word_user');
//            console.log(translate_user.text());
            $('#p_word_box').text(word.text());
            $('#translate_box').val(translate_user.text());

//            $('#button_next').text('Next').removeClass('btn-success').addClass('btn-primary');

//            $('#button_finish').addClass('d-none');
//            $('#button_next').removeClass('d-none');

            resize_elements();
            update_img_favorite();

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