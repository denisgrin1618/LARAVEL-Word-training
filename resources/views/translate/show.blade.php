
@extends('layouts.app')

@section('content')





<div class="container">

    <main role="main" class="container" >

        <!--
                <form action="{{route('translate.add')}}" method="POST" >
                    @csrf
        
                    <div class="row justify-content-md-center">
        
                        <table>
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
        -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 5%" scope="col">#</th>
                    <th style="width: 17%" scope="col">ИмяСловаря</th>
                    <th style="width: 34%" scope="col">Слово</th>
                    <th style="width: 34%" scope="col">Перевод</th>
                    <th style="width: 10%" scope="col"></th>
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
                    <td  align="right" >
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

        <table class="table table-striped" id='table_translate_new'>

            <tbody>

                <tr >
                    <th scope="row" ></th>
                    <td style="width: 10%">
                        <select class="form-control" id="new_word1_language_name">
                            @foreach ($languages as $language)
                            <option>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width: 35%">
                        <textarea  id="new_word1_name" class="form-control" type="text" placeholder="слово" ></textarea>
                    </td>
                    <td style="width: 10%">
                        <select class="form-control" id="new_word2_language_name">
                            @foreach ($languages as $language)
                            <option>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width: 35%">
                        <textarea  id="new_word2_name" class="form-control" type="text" placeholder="перевод"></textarea> 
                    </td>
                    <td style="width: 10%" align="right"> 
                        <button type="button" class="btn btn-success  ml-1 mt-1" id='button_translate_new'>New</button>
                    </td>

                </tr>

            </tbody>
        </table>

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

                        <button  class="btn btn-success" data-dismiss="modal" id="modal_dialog_button_save">Сохранить</button>

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

        var curent_table_tr;

        $('#new_word1_name').autoResize();
        $('#new_word2_name').autoResize();

        $('.bt_edit').on("click", function (event) {


//            var modal = $(this);
            var button = $(event.target) // Кнопка, что спровоцировало модальное окно  

            console.log(button);

            curent_table_tr = button.parent().parent();
            var translate_word1_name = curent_table_tr.find('#translate_word1_name').text();
            var translate_word2_name = curent_table_tr.find('#translate_word2_name').text();
//            var translate_word1_language_id = curent_table_tr.find('#translate_word1_language_id').text();
//            var translate_word2_language_id = curent_table_tr.find('#translate_word2_language_id').text();
            var translate_word1_id = curent_table_tr.find('#translate_word1_id').text();
            var translate_word2_id = curent_table_tr.find('#translate_word2_id').text();
            var translate_id = curent_table_tr.find('#translate_id').text();



            $('#translateAddModal').find('#translate_word1_name').val(translate_word1_name).autoResize();
            $('#translateAddModal').find('#translate_word2_name').val(translate_word2_name).autoResize();
            $('#translateAddModal').find('#translate_id').val(translate_id);
//            $('#translateAddModal').find('#translate_word1_language_id').val(translate_word1_language_id);
//            $('#translateAddModal').find('#translate_word2_language_id').val(translate_word2_language_id);
            $('#translateAddModal').find('#translate_word1_id').val(translate_word1_id);
            $('#translateAddModal').find('#translate_word2_id').val(translate_word2_id);

        });

        $('#translateAddModal').on('shown.bs.modal', function (event) {
            console.log('shown');
//            var modal = $(this);
            $(this).find('#translate_word1_name').autoResize();
            $(this).find('#translate_word2_name').autoResize();
        });

        $('#modal_dialog_button_save').click(function (e) {

            e.preventDefault();

            console.log('click');
            var word1 = $('#translateAddModal').find('#translate_word1_name').val();
            var word2 = $('#translateAddModal').find('#translate_word2_name').val();

            curent_table_tr.find('#translate_word1_name').text(word1);
            curent_table_tr.find('#translate_word2_name').text(word2);

            $.ajax({
                type: 'POST',
                url: "/translate/edit",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "translate_word1_id": $('#translateAddModal').find('#translate_word1_id').val(),
                    "translate_word2_id": $('#translateAddModal').find('#translate_word2_id').val(),
                    "translate_word1_name": $('#translateAddModal').find('#translate_word1_name').val(),
                    "translate_word2_name": $('#translateAddModal').find('#translate_word2_name').val(),
                    "translate_id": $('#translateAddModal').find('#translate_id').val()

                },

                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    console.log("ERROR");
                }
            });
        });

        $('#button_translate_new').click(function (e) {

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "/translate/add",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "word1_language_name": $('#table_translate_new').find('#new_word1_language_name').val(),
                    "word2_language_name": $('#table_translate_new').find('#new_word2_language_name').val(),
                    "word1_name": $('#table_translate_new').find('#new_word1_name').val(),
                    "word2_name": $('#table_translate_new').find('#new_word2_name').val()

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