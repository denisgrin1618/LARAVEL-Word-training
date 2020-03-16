
@extends('layouts.app')

@section('content')





<div class="container">

    <h1>TRANSLATE</h1>

    <main role="main" class="container" >


        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%" scope="col">#</th>
                    <th style="width: 20%" scope="col">ИмяСловаря</th>
                    <th style="width: 40%" scope="col">Слово</th>
                    <th style="width: 40%" scope="col">Перевод</th>
                    <th style="width: 15%" scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <tr >
                    <th scope="row" ></th>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td align="right">    
                        <button type="button" class="btn btn-success  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">New</button>
                    </td>
                </tr>


                @foreach ($translates as $translate)
                <tr>
                    <th scope="row" >1</th>
                    <td >{{ $translate->word1->language->name }} - {{ $translate->word2->language->name }}</td>
                    <td  class="tdWordOrigin">{{ $translate->word1->name }}</td>
                    <td  class="tdWordTranslate" >{{ $translate->word2->name }}</td>
                    <td  align="right">
                        <button type="button" class="btn btn-primary  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit</button>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>



        <!--
                <form action="{{route('translate.add')}}" method="POST" >
                    @csrf
        
                    <div class="row justify-content-md-center">
        
                        <table >
                            <tr>
                                <td>
                                    <div class="form-group float-left" id="boxLanguageWord1">
                                        <select class="form-control" id="languageWord1" name="languageWord1" >
        
                                            @foreach ($languages as $language)
                                            <option>{{ $language->name }}</option>
                                            @endforeach
        
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group float-left" id="boxLanguageWord2">
                                        <select class="form-control" id="languageWord2" name="languageWord2">
                                            @foreach ($languages as $language)
                                            <option>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" aria-label="With textarea" id="word1" name="word1"> перевод слова </textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" aria-label="With textarea" id="word2" name="word2"> перевод слова </textarea>
                                </td>
                            </tr>
        
                        </table>
        
                    </div>
        
                    <div class="row justify-content-md-center">
                        <div class="col-md-1 center-block">
                            <button id="singlebutton" name="singlebutton" class="btn btn-success center-block">
                                Finish
                            </button>
                        </div>  
                    </div>
        
                </form>
        
        -->





    </main>


    <div >

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <!--
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-label">New translate</h4>
                    </div>
                    -->
                    <div class="modal-body">
                        <form action="{{route('translate.add')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <div class="form-group float-left" id="boxLanguageWord1">
                                    <select class="form-control" id="languageWord1" name="languageWord1" >

                                        @foreach ($languages as $language)
                                        <option>{{ $language->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <textarea class="form-control" id="modal-word-1" name="word1"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-group float-left" id="boxLanguageWord2">
                                    <select class="form-control" id="languageWord2" name="languageWord1" >

                                        @foreach ($languages as $language)
                                        <option>{{ $language->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <textarea class="form-control" id="modal-word-2" name="word2"></textarea>
                            </div>
                            <button  class="btn btn-success" data-dismiss="modal" id="ModalButSave">Сохранить</button>

                          
                        </form>
                    </div>
                    <!--
                    <div class="modal-footer">
                        
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>


</div>



<script type="text/javascript" defer>

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