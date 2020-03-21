
@extends('layouts.app')

@section('content')


<div class="container">

    <main role="main" class="container" >

        <table class="table-responsive table-striped w-100 d-block d-md-table">
            <thead>
                <tr>
                    <!-- <th style="width: 3%" scope="col">#</th> -->
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 35%" scope="col">Word</th>
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 35%" scope="col">Translate</th>
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>

                </tr>
            </thead>
            <tbody id="table_translates">

                {{ Form::open(array('route' => 'translate.search', 'method' => 'get')) }}
                <tr>
                    <td>
                        <select class="form-control" name="language1">
                            <option></option>
                            @foreach ($languages as $language)
                                @if ($language->name ===  ($search_input['language1'] ?? ""))
                                    <option selected>{{ $language->name }}</option>
                                @else
                                    <option>{{ $language->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" placeholder="search" name="word1" value="{{$search_input['word1'] ?? ''}}">
                    </td>
                    <td>
                        <select class="form-control" name="language2">
                            <option></option>
                            @foreach ($languages as $language) 
                                @if ($language->name ===  ($search_input['language2'] ?? ""))
                                    <option selected>{{ $language->name }}</option>
                                @else
                                    <option>{{ $language->name }}</option>
                                @endif
                            @endforeach
                            
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" placeholder="search" name="word2" value="{{$search_input['word2'] ?? ''}}">
                    </td>
                    <td align="right"> 
                        <!-- <button type="button" class="btn btn-secondary  ml-1 mt-1" >Search</button>  -->
                        {{ Form::submit('Search',['class'=>'btn btn-secondary  ml-1 mt-1']) }}
                    </td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                </tr>
                {{ Form::close() }}

                <tr id="tr_blank" class="d-none">                  
                    <td id='translate_word1_language_name'> </td>
                    <td id="translate_word1_name"></td>
                    <td id='translate_word2_language_name'></td>
                    <td id="translate_word2_name" ></td>
                    <td align="right" >
                        <button type="button" class="btn btn-primary  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#translateAddModal" data-whatever="@mdo">Edit</button>
                    </td>
                    <td class="d-none" id="translate_word1_id"> </td>
                    <td class="d-none" id="translate_word2_id"> </td>
                    <td class="d-none" id="translate_id">test_id</td>
                    <td class="d-none" id="translate_word1_language_id"> </td>
                    <td class="d-none" id="translate_word2_language_id"> </td>

                </tr>
                
                <tr class="d-none">                  
                    <td id='translate_word1_language_name'> </td>
                    <td id="translate_word1_name"></td>
                    <td id='translate_word2_language_name'></td>
                    <td id="translate_word2_name" ></td>
                    <td align="right" >
                        <button type="button" class="btn btn-primary  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#translateAddModal" data-whatever="@mdo">Edit</button>
                    </td>
                    <td class="d-none" id="translate_word1_id"> </td>
                    <td class="d-none" id="translate_word2_id"> </td>
                    <td class="d-none" id="translate_id">test_id</td>
                    <td class="d-none" id="translate_word1_language_id"> </td>
                    <td class="d-none" id="translate_word2_language_id"> </td>

                </tr>
                
                
                @foreach ($translates as $translate)
                <tr>
                    <!--<th scope="row" >{{ $loop->iteration }}</th> -->
                    <td id='translate_word1_language_name'>{{ $translate->word1->language->name }} </td>
                    <td id="translate_word1_name">{{ $translate->word1->name }}</td>
                    <td id='translate_word2_language_name'>{{ $translate->word2->language->name }}</td>
                    <td id="translate_word2_name" >{{ $translate->word2->name }}</td>
                    <td align="right" >
                        <button type="button" class="btn btn-primary  ml-1 mt-1 bt_edit" data-toggle="modal" data-target="#translateAddModal" data-whatever="@mdo">Edit</button>
                    </td>
                    <td class="d-none" id="translate_word1_id">{{ $translate->word1->id }}</td>
                    <td class="d-none" id="translate_word2_id">{{ $translate->word2->id }}</td>
                    <td class="d-none" id="translate_id">{{ $translate->id }}</td>
                    <td class="d-none" id="translate_word1_language_id">{{ $translate->word1->language->id }}</td>
                    <td class="d-none" id="translate_word2_language_id">{{ $translate->word2->language->id }}</td>

                </tr>
                @endforeach


                


            </tbody>
        </table>

        <br>
        
        <table class="table-responsive table-striped w-100 d-block d-md-table" id='table_translate_new'>

            <tbody>

                <tr>
                    <th scope="row" ></th>
                    <td style="width: 10%">
                        <select class="form-control" id="new_word1_language_name">
                            @foreach ($languages as $language)
                            <option>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width: 35%">
                        <textarea style="resize: none; " id="new_word1_name" class="form-control" type="text" placeholder="слово" ></textarea>
                    </td>
                    <td style="width: 10%">
                        <select class="form-control" id="new_word2_language_name">
                            @foreach ($languages as $language)
                            <option>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width: 35%">
                        <textarea style="resize: none; " id="new_word2_name" class="form-control" type="text" placeholder="перевод"></textarea> 
                    </td>
                    <td style="width: 10%" align="right"> 
                        <button type="button" class="btn btn-success  ml-1 mt-1" id='button_translate_new'>New</button>
                    </td>

                </tr>

            </tbody>
        </table>

        <br/>
        
        <div class="d-flex justify-content-center">
            <!-- {{ $translates->links() }} -->     
            {{ $translates->appends(request()->query())->links() }}
        </div>
        
        
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

                        <div>
                            <!--
                            {{Form::open(array('method'=>'delete', 'route'=>['translate.destroy', 'route_param_translate_id']))}}
                                <button  class="btn btn-danger" data-dismiss="modal" id="modal_dialog_button_delete">Delete</button>                         
                            {{Form::close()}}
                            -->
    
                            <button  class="btn btn-danger" data-dismiss="modal" id="modal_dialog_button_delete">Delete</button>                         
                            <button  class="btn btn-success" data-dismiss="modal" id="modal_dialog_button_save">Save</button>
                        </div>
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

            
            curent_table_tr = button.parent().parent();
            var translate_word1_name    = curent_table_tr.find('#translate_word1_name').text();
            var translate_word2_name    = curent_table_tr.find('#translate_word2_name').text();
            var translate_word1_id      = curent_table_tr.find('#translate_word1_id').text();
            var translate_word2_id      = curent_table_tr.find('#translate_word2_id').text();
            var translate_id            = curent_table_tr.find('#translate_id').text();

            console.log(button);
            console.log(translate_id);


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

        $('#modal_dialog_button_delete').click(function (e) {

            e.preventDefault();

            console.log('click delete');

            var translate_id = $('#translateAddModal').find('#translate_id').val();
            
            $.ajax({
                type: 'DELETE',
                url: "/translate/delete/"+translate_id,
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },

                success: function (data) {
                    console.log(data);
//                    $('#table_translates').find('#translate_id').eq(translate_id).remove();
                    curent_table_tr.remove();
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
                    
//                    console.log(data);
                    var obj = $.parseJSON(data);
                    
                    var tr = $("#tr_blank").clone(true);
                    tr.removeAttr("id").removeAttr("class");
                   // tr.addClass("bg-success").css('color', '#fff');
                    tr.addClass("text-success");
                    tr.find('#translate_word1_language_name').text(obj.word1.language.name);
                    tr.find('#translate_word2_language_name').text(obj.word2.language.name);
                    tr.find('#translate_word1_name').text(obj.word1.name);
                    tr.find('#translate_word2_name').text(obj.word2.name);                  
                    tr.find('#translate_word1_id').text(obj.word1.id);
                    tr.find('#translate_word2_id').text(obj.word2.id);
                    tr.find('#translate_id').text(obj.id);
                    tr.find('#translate_word1_language_id').text(obj.word1.language.id);
                    tr.find('#translate_word2_language_id').text(obj.word2.language.id);
                    tr.appendTo("#table_translates");


                    $("#new_word1_name").val('');
                    $("#new_word2_name").val('');

                },
                error: function () {
                    console.log("ERROR");
                }
            });
        });

    });

</script>


@endsection