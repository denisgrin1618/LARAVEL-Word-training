
@extends('layouts.app')

@section('content')





<div class="container">

    <h1>TRANSLATE</h1>

    <main role="main" class="container" >

        <div class="row justify-content-md-center">

            <form action="{{route('translate.add')}}" method="POST" >
                @csrf

                <table >
                    <tr>
                        <td>
                            <div class="form-group float-left" id="boxLanguageWord1">
                                <select class="form-control" id="languageWord1">
                                    <option>ru</option>
                                    <option>en</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group float-left" id="boxLanguageWord2">
                                <select class="form-control" id="languageWord2">
                                    <option>ru</option>
                                    <option>en</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control" aria-label="With textarea" id="word1" > перевод слова </textarea>
                        </td>
                        <td>
                            <textarea class="form-control" aria-label="With textarea" id="word2" > перевод слова </textarea>
                        </td>
                    </tr>

                </table>

            </form>

        </div>



        <div class="row justify-content-md-center">
            <div class="col-md-1 center-block">
                <button id="singlebutton" name="singlebutton" class="btn btn-success center-block">
                    Finish
                </button>
            </div>  
        </div>



    </main>

</div>



<script type="text/javascript">



    $(function ()
    {
        // при изменении размера textarea при наборе текста, будем менять размер зависимых елементов
        $('#word1').autoResize({elCopyResize: $("#word2")});
        $('#word2').autoResize({elCopyResize: $("#word1")});

        // при ручном растягивании textarea, будем менять размер зависимых елементов
        $("#word1").ResizeSecondaryElement($("#word2"));
        $("#word2").ResizeSecondaryElement($("#word1"));

        $(window).resize(function () {
            $('#word1').autoResize({elCopyResize: $("#word2")});
            $("#word1").ResizeSecondaryElement($("#word2"));
        });
    });



</script>


@endsection