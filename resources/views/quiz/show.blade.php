
@extends('layouts.app')

@section('content')

<div class="container">
    <main role="main" class="container" >

        <br/>

        <div class="row justify-content-center">
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

            </div>
        </div>

        <div class="row justify-content-center">
            <table class="table-responsive table-striped w-100 d-block d-md-table" id="table_quiz">
                <thead>
                    <tr>
                        <th style="width: 10%" scope="col"></th>
                        <th style="width: 30%" scope="col">Word</th>
                        <th style="width: 30%" scope="col">Your translation</th>
                        <th style="width: 30%" scope="col">Correct translation</th>
                    </tr>
                </thead>
                <tbody id="table_translates">

                    @foreach ($quiz->translations as $translate)
                    <tr>
                        <td id="index_{{ $loop->iteration }}">{{ $loop->iteration }}</td>
                        <td id='word'>{{ $translate->word1->name }} </td>
                        <td id="translate_word_user"></td>
                        <td id='translate_word_correct'>{{ $translate->word2->name }}</td>
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


    var table_quiz_row_index = 1;
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


        $('#button_next').click(function (e) {

            if (table_translates_rows_count > table_quiz_row_index) {
                
                $('#index_' + table_quiz_row_index)
                        .parent()
                        .find('#translate_word_user')
                        .text($('#translate_box').val());
                
                console.log($('#translate_box').val());

                table_quiz_row_index++;
                var word = $('#index_' + table_quiz_row_index).parent().find('#word');
                var translate_correct = $('#index_' + table_quiz_row_index).parent().find('#translate_word_correct');
                var translate_user = $('#index_' + table_quiz_row_index).parent().find('#translate_word_user');
                
                $('#p_word_box').text(word.text());
                $('#translate_box').val(translate_user.text());
            }

            if (table_translates_rows_count == table_quiz_row_index) {
                $(this).text('Finish').removeClass('btn-primary').addClass('btn-success');
            }
            
            
            
        });
        
        $('#button_back').click(function (e) {

            if (table_quiz_row_index > 1) {
      
                table_quiz_row_index--;
                var word = $('#index_' + table_quiz_row_index).parent().find('#word').text();
                var translate = $('#index_' + table_quiz_row_index).parent().find('#translate_word_user').text();
                //console.log(word);

                $('#p_word_box').text(word);
                $('#translate_box').val(translate);
                
                $('#button_next').text('Next').removeClass('btn-success').addClass('btn-primary');
            }

        });



    });


</script>


@endsection