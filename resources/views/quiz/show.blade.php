
@extends('layouts.app')

@section('content')

<div class="container">
    <main role="main" class="container" >

        <br/>

        <div class="row justify-content-center" id="div_quiz">
            <div class="col-md-8">

                <div class="row justify-content-md-center">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend" id="word_box" >
                            <p class="input-group-text" id="p_word_box" style="word-wrap: break-all; white-space: normal;"></p>
                        </div>
                        <textarea class="form-control" aria-label="With textarea" id="translate_box" placeholder="Введите перевод">  </textarea>
                    </div>

                </div>


                <button class="btn btn-primary float-left" id="button_back">
                    Back
                </button>

                <button class="btn btn-primary float-right" id="button_next">
                    Next
                </button>
                
                <button class="btn btn-success float-right d-none" id="button_finish">
                    Finish
                </button>

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
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>


    </main>
</div>

<script type="text/javascript">

    function ResizeElements() {
        var width = $('.input-group-text').parent().parent().width();
        var height = $('.input-group-text').parent().parent().height();
        $('.input-group-text').css('width', width / 2);
        $('.input-group-text').css('height', height < 100 ? 100 : height);
    }

    $(window).resize(function () {
        ResizeElements();
    });

    $('#translate_box').resize(function () {
        $('#word_box').css('height', $('#translate_box').height());
    });


    ResizeElements();


    var table_quiz_row_index = 0;
    var table_translates_rows_count = $('#table_translates tr').length;

    $(function ()
    {

        // при изменении размера textarea при наборе текста, будем менять размер зависимых елементов
        $('#translate_box').autoResize({elCopyResize: $("#p_word_box")});

        // при ручном растягивании textarea, будем менять размер зависимых елементов
        $("#translate_box").ResizeSecondaryElement($("#p_word_box"));

        $(window).resize(function () {
            $('#translate_box').autoResize({elCopyResize: $("#p_word_box")});
            $("#translate_box").ResizeSecondaryElement($("#p_word_box"));
        });

        $('#button_finish').click(function (e) {

            $("#button_next").trigger("click");
            $('#div_result').removeClass('invisible');
            $('#div_quiz').addClass('d-none');
                
                var data =[];
                $("#table_translates tr").each(function (index) {
                    var correct = $(this).find('#translate_word_correct').text();
                    var user    = $(this).find('#translate_word_user').text();
                    var id      = $(this).find("#translate_id").text();
                    
                    var row_data = new Object();
                    row_data.translation_id = id;
                    row_data.correct_answer = (correct == user);
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
                        console.log("DATA /statistics/store ->");
                        console.log(data);
                    },
                    error: function () {
                        console.log("ERROR /statistics/store");
                    }
                });

        });

        $('#button_next').click(function (e) {

            //нажали кнопку финиш
//            if(table_translates_rows_count == table_quiz_row_index){
//                $('#div_result').removeClass('invisible');
//                $('#div_quiz').addClass('d-none');  
//            }
            
            
            
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

            if (table_quiz_row_index < table_translates_rows_count) {
                table_quiz_row_index++;
            }

            console.log(table_quiz_row_index);

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var word = tr.find('#word');
            var translate_user = tr.find('#translate_word_user');
            console.log(translate_user.text());
            $('#p_word_box').text(word.text());
            $('#translate_box').val(translate_user.text());

            if (table_translates_rows_count == table_quiz_row_index) {
//                $(this).text('Finish').removeClass('btn-primary').addClass('btn-success');
                $('#button_finish').removeClass('d-none');
                $('#button_next').addClass('d-none');  
            }



            //подсчитаем результат
            var result_persant = 0;
            var count_correct = 0;
            var count_error = 0;

            
            $("#table_translates tr").each(function (index) {
                var correct = $(this).find('#translate_word_correct').text();
                var user    = $(this).find('#translate_word_user').text();
                var id      = $(this).find("#translate_id").text();
                if (correct == user) {
                    count_correct++;
                } else {
                    count_error++;
                }
                
               
            });

            result_persant = Math.round(count_correct * 100 / (count_correct + count_error));
            $('#result').text("RESULT " + result_persant + "%");
            
            
      
            
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

            if (table_quiz_row_index > 0) {
                table_quiz_row_index--;
            }

            console.log(table_quiz_row_index);

            var index = table_quiz_row_index;
            var tr = $('#index_' + index).parent();
            var word = tr.find('#word');
            var translate_user = tr.find('#translate_word_user');
            console.log(translate_user.text());
            $('#p_word_box').text(word.text());
            $('#translate_box').val(translate_user.text());

            $('#button_next').text('Next').removeClass('btn-success').addClass('btn-primary');

        });

    });


</script>


@endsection