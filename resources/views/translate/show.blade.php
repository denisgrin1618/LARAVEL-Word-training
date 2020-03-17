
@extends('layouts.app')

@section('content')





<div class="container">

    

    <main role="main" class="container" >


        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%" scope="col">#</th>
                    <th style="width: 20%" scope="col">ИмяСловаря</th>
                    <th style="width: 40%" scope="col">Слово</th>
                    <th style="width: 40%" scope="col">Перевод</th>
                    <th style="width: 15%" scope="col"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>

                </tr>
            </thead>
            <tbody>

                <tr >
                    <th scope="row" ></th>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td><input class="form-control" type="text" placeholder="search"></td>
                    <td align="right">    
                        <button type="button" class="btn btn-secondary  ml-1 mt-1" >Search</button>
                    </td>
                    <td class="d-none"> </td>
                    <td class="d-none"> </td>
                    <td class="d-none"> </td>
                    <td class="d-none"> </td>
                    <td class="d-none"> </td>
                </tr>


                @foreach ($translates as $translate)
                <tr>
                    <th scope="row" >{{ $loop->iteration }}</th>
                    <td >{{ $translate->word1->language->name }} - {{ $translate->word2->language->name }}</td>
                    <td  id="translate_word1_name">{{ $translate->word1->name }}</td>
                    <td  id="translate_word2_name" >{{ $translate->word2->name }}</td>
                    <td  align="right">
                        <button type="button" class="btn btn-primary  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#translateAddModal" data-whatever="@mdo">Edit</button>
                    </td>
                    <td class="d-none" id="translate_word1_id"> {{ $translate->word1->id }}</td>
                    <td class="d-none" id="translate_word2_id"> {{ $translate->word2->id }}</td>
                    <td class="d-none" id="translate_id"> {{ $translate->id }}</td>
                    <td class="d-none" id="translate_word1_language_id"> {{ $translate->word1->language->id }}</td>
                    <td class="d-none" id="translate_word2_language_id"> {{ $translate->word2->language->id }}</td>
                    
                </tr>
                @endforeach


            </tbody>
        </table>



        
                <form action="{{route('translate.add')}}" method="POST" >
                    @csrf
        
                    <div class="row justify-content-md-center">
        
                        <table >
                            <tr>
                                <td>
                                    <div class="form-group float-left" id="boxLanguageWord1">
                                        <select class="form-control" id="word1_language_name" name="word1_language_name" >
        
                                            @foreach ($languages as $language)
                                            <option>{{ $language->name }}</option>
                                            @endforeach
        
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group float-left" id="boxLanguageWord2">
                                        <select class="form-control" id="word2_language_name" name="word2_language_name">
                                            @foreach ($languages as $language)
                                            <option>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" aria-label="With textarea" id="word1_name" name="word1_name"> перевод слова </textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" aria-label="With textarea" id="word2_name" name="word2_name"> перевод слова </textarea>
                                </td>
                            </tr>
        
                        </table>
        
                    </div>
        
                    <div class="row justify-content-md-center">
                        <div class="col-md-1 center-block">
                            <button id="singlebutton" name="singlebutton" class="btn btn-success center-block">
                                Add
                            </button>
                        </div>  
                    </div>
        
                </form>
        
        





    </main>


    <div >

        <div class="modal fade" id="translateAddModal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal-content-div">



                    <!--
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-label">New translate</h4>
                    </div>
                    -->
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="translate_word1_name" class="col-form-label">Слово:</label>
                            <textarea class="form-control" id="translate_word1_name" name="translate_word1_name"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="translate_word2_name" class="col-form-label">Перевод:</label>
                            <textarea class="form-control" id="translate_word2_name" name="translate_word2_name"></textarea>
                        </div>
                        
                        
                        <textarea class="form-control d-none" id="translate_id" name="translate_id"></textarea>
                        <textarea class="form-control d-none" id="translate_word1_id" name="translate_word1_id"></textarea>
                        <textarea class="form-control d-none" id="translate_word2_id" name="translate_word2_id"></textarea>
                        <textarea class="form-control d-none" id="translate_word1_language_id" name="translate_word1_language_id"></textarea>
                        <textarea class="form-control d-none" id="translate_word2_language_id" name="translate_word2_language_id"></textarea>
                        
                        <button  class="btn btn-success" data-dismiss="modal" id="translateAddModalButSave">Сохранить</button>



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
        //// при изменении размера textarea при наборе текста, будем менять размер зависимых елементов
        //$('#word1').autoResize({elCopyResize: $("#word2")});
        //$('#word2').autoResize({elCopyResize: $("#word1")});

        //// при ручном растягивании textarea, будем менять размер зависимых елементов
        //$("#word1").ResizeSecondaryElement($("#word2"));
        //$("#word2").ResizeSecondaryElement($("#word1"));

        //$(window).resize(function () {
        //    $('#word1').autoResize({elCopyResize: $("#word2")});
        //    $("#word1").ResizeSecondaryElement($("#word2"));
        //});





        var curent_table_tr;

        $('.bt_edit').on("click", function (event) {

            
//            var modal = $(this);
            var button = $(event.target) // Кнопка, что спровоцировало модальное окно  

            console.log(button);

            curent_table_tr = button.parent().parent();
            var translate_word1_name        = curent_table_tr.find('#translate_word1_name').text();
            var translate_word2_name        = curent_table_tr.find('#translate_word2_name').text();
//            var translate_word1_language_id = curent_table_tr.find('#translate_word1_language_id').text();
//            var translate_word2_language_id = curent_table_tr.find('#translate_word2_language_id').text();
            var translate_word1_id          = curent_table_tr.find('#translate_word1_id').text();
            var translate_word2_id          = curent_table_tr.find('#translate_word2_id').text();
            var translate_id                = curent_table_tr.find('#translate_id').text();

            

            $('#translateAddModal').find('#translate_word1_name').val(translate_word1_name).autoResize();
            $('#translateAddModal').find('#translate_word2_name').val(translate_word2_name).autoResize();
            $('#translateAddModal').find('#translate_id').val(translate_id);
//            $('#translateAddModal').find('#translate_word1_language_id').val(translate_word1_language_id);
//            $('#translateAddModal').find('#translate_word2_language_id').val(translate_word2_language_id);
            $('#translateAddModal').find('#translate_word1_id').val(translate_word1_id);
            $('#translateAddModal').find('#translate_word2_id').val(translate_word2_id);


            // Если необходимо, вы могли бы начать здесь AJAX-запрос (и выполните обновление в обратного вызова).  
            // Обновление модальное окно Контента. Мы будем использовать jQuery здесь, но вместо него можно использовать привязки данных библиотеки или других методов.  

            //var recipient = button.data('whatever') // Извлечение информации из данных-* атрибутов  
            //modal.find('.modal-title').text('New message to ' + recipient)

//            var number = button.parent().siblings('th').text();
//            modal.find('.modal-title').text('Строка ' + number);

        });

        $('#translateAddModal').on('shown.bs.modal', function (event) {
            console.log('shown');
            var modal = $(this);
            modal.find('#translate_word1_name').autoResize();
            modal.find('#translate_word2_name').autoResize();
        });

        $('#translateAddModalButSave').on("click", function () {
            console.log('click');
            var word1 = $('#translateAddModal').find('#translate_word1_name').val();
            var word2 = $('#translateAddModal').find('#translate_word2_name').val();


            curent_table_tr.find('#translate_word1_name').text(word1);
            curent_table_tr.find('#translate_word2_name').text(word2);

            //console.log( '#translateAddModalButSave  click' );
            //console.log( Curent_tdWordTranslate );

//            curent_table_tr.addClass("table-success");

        });
















        console.log("redy");

        $('#translateAddModalButSave').click(function (e) {

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "/translate/edit",
                //data: $('#modal-content-div').serialize(),
                data: {
                    "_token":                       $('meta[name="csrf-token"]').attr('content'),
                    "translate_word1_id":           $('#translateAddModal').find('#translate_word1_id').val(),
                    "translate_word2_id":           $('#translateAddModal').find('#translate_word2_id').val(),
                    "translate_word1_name":         $('#translateAddModal').find('#translate_word1_name').val(),
                    "translate_word2_name":         $('#translateAddModal').find('#translate_word2_name').val(),
                    "translate_id":                 $('#translateAddModal').find('#translate_id').val()
//                    "translate_word1_language_id":  $('#translateAddModal').find('#translate_word1_language_id').val(),
//                    "translate_word2_language_id":  $('#translateAddModal').find('#translate_word2_language_id').val()
                    
                },

                success: function (data) {

                    console.log(data);

                },
                error: function () {
                    console.log("ERROR");
                }
            });
        });
    });



</script>


@endsection