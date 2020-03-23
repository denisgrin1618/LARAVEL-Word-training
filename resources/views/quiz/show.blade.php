
@extends('layouts.app')

@section('content')

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



            <div class="row justify-content-md-center">
                <div class="col-md-1 center-block">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary center-block">
                        Next
                    </button>
                </div>  
            </div>
        </div>
    </div>


</main>


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

   




    ///////////////////////////////////////////////////////////////////////////

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


        

    });


    //////////////////////////////////////////////////////////////////////////////////

</script>


@endsection