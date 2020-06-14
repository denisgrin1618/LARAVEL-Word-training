
@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row p-0 m-0" >


        <table class="table-responsive table-striped w-100 d-block d-md-table">

            <tbody id="table_translates">

                {{ Form::open(array('route' => 'translation.search', 'method' => 'get')) }}
                <tr>
                    <td>

                        <div class="container">
                            <div class="row">
                                <div class="col-10 p-0">
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-3 col-md-2 col-lg-1  p-0" >
                                                <select class="form-control " name="language1">

                                                    @foreach ($languages as $language)
                                                    @if ($language->name ===  ($search_input['language1'] ?? ""))
                                                    <option selected>{{ $language->name }}</option>
                                                    @else
                                                    <option>{{ $language->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>    
                                            <div class="col-9 col-md-4 col-lg-5 p-0" >
                                                <input class="form-control p-0" type="text" placeholder="{{__('app_strings.search')}}" name="word1" value="{{$search_input['word1'] ?? ''}}">
                                            </div>


                                            <div class="col-3 col-md-2 col-lg-1 p-0" >
                                                <select class="form-control" name="language2">

                                                    @foreach ($languages as $language) 
                                                    @if ($language->name ===  ($search_input['language2'] ?? ""))
                                                    <option selected>{{ $language->name }}</option>
                                                    @else
                                                    <option>{{ $language->name }}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                            </div>    
                                            <div class="col-9 col-md-4 col-lg-5 p-0" >
                                                <input class="form-control p-0" type="text" placeholder="{{__('app_strings.search')}}" name="word2" value="{{$search_input['word2'] ?? ''}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 p-0 ">
                                    <button type="submit" class="float-right d-flex btn p-6 m-0 rounded border border-secondary bt-light-white  " >            
                                        <img class="mx-auto" src="/img/icons/search.svg" alt="" width="20" height="20" title="{{__('app_strings.search')}}">
                                    </button>
                                </div>
                            </div>
                        </div>

                    </td>


                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>

                </tr>
                {{ Form::close() }}


                @foreach ($translates as $translate)
                <tr>

                    <td class="">

                        <div class="container ">
                            <div class="row justify-content-end">
                                <div class="col-10  p-0">
                                    <div class="container">
                                        <div class="row">

                                            <div id="translate_word1_language_name" class="col-3 col-md-2 col-lg-1 p-0 d-flex justify-content-center" >{{ $translate->word1->language->name }}</div>
                                            <div id="translate_word1_name"          class="col-9 col-md-4 col-lg-5 p-0" >{{ $translate->word1->name }}</div>

                                            <div id="translate_word2_language_name" class="col-3 col-md-2 col-lg-1 p-0 d-flex justify-content-center" >{{ $translate->word2->language->name }}</div>
                                            <div id="translate_word2_name"          class="col-9 col-md-4 col-lg-5 p-0" >{{ $translate->word2->name }}</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 p-0 ">
                                    <div class="container p-0">
                                        <div class="row justify-content-end no-gutters ">

                                            <div class="col-12  col-md-auto   p-0" >
                                                @if(!empty($translate->statistics) && $translate->statistics->favorite)
                                                <div  type="button" class="float-right star_fill but_favorite d-flex btn " >
                                                    <img class="mx-auto" src="/img/icons/star-fill.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                                                </div>
                                                @else
                                                <div  type="button" class="float-right but_favorite d-flex btn "  >
                                                    <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-auto   pl-1 " >
                                                <button id="bt_edit" type="button" class="float-right d-flex btn  rounded border border-secondary bt-light-white bt_edit" >
                                                    <img class="mx-auto" src="/img/icons/pencil.svg" alt="" width="20" height="20" title="{{__('app_strings.edit')}}">
                                                </button>
                                            </div>
                                            <div class="col-12  col-md-auto   pl-1 " >
                                                <button type="button" class="float-right d-flex btn  rounded border border-secondary bt-light-white but_delete" data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">
                                                    <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </td>

                    <td class="d-none" id="translate_word1_id">{{ $translate->word1->id }}</td>
                    <td class="d-none" id="translate_word2_id">{{ $translate->word2->id }}</td>
                    <td class="d-none" id="translate_id">{{ $translate->id }}</td>
                    <td class="d-none" id="translate_word1_language_id">{{ $translate->word1->language->id }}</td>
                    <td class="d-none" id="translate_word2_language_id">{{ $translate->word2->language->id }}</td>

                </tr>
                @endforeach


                <tr id="tr_blank" class="d-none">

                    <td class="">

                        <div class="container ">
                            <div class="row justify-content-end">
                                <div class="col-10 p-0">
                                    <div class="container">
                                        <div class="row">

                                            <div id="translate_word1_language_name" class="col-3 col-md-2 col-lg-1 p-0 d-flex justify-content-center" ></div>
                                            <div id="translate_word1_name"          class="col-9 col-md-4 col-lg-5 p-0" ></div>

                                            <div id="translate_word2_language_name" class="col-3 col-md-2 col-lg-1 p-0 d-flex justify-content-center" ></div>
                                            <div id="translate_word2_name"          class="col-9 col-md-4 col-lg-5 p-0" ></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 p-0 ">
                                    <div class="container p-0">
                                        <div class="row justify-content-end no-gutters ">

                                            <div class="col-12  col-md-auto   p-0" >
                                                <div  type="button" class="float-right but_favorite d-flex btn "  >
                                                    <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-auto   pl-1 " >
                                                <button id="bt_edit" type="button" class="float-right d-flex btn  rounded border border-secondary bt-light-white bt_edit" >
                                                    <img class="mx-auto" src="/img/icons/pencil.svg" alt="" width="20" height="20" title="{{__('app_strings.edit')}}">
                                                </button>
                                            </div>
                                            <div class="col-12  col-md-auto   pl-1 " >
                                                <button type="button" class="float-right d-flex btn  rounded border border-secondary bt-light-white but_delete" data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">
                                                    <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>

                    <td class="d-none" id="translate_word1_id"></td>
                    <td class="d-none" id="translate_word2_id"></td>
                    <td class="d-none" id="translate_id"></td>
                    <td class="d-none" id="translate_word1_language_id"></td>
                    <td class="d-none" id="translate_word2_language_id"></td>

                </tr>



            </tbody>
        </table>


        
    </div>
    <br>
    <div class="row p-0 m-0" >
        
        <table class=" table-responsive table-striped w-100 d-block d-md-table" id='table_translate_new'>

            <tbody>

                <tr>

                    <td>
                        <div class="container ">
                            <div class="row">
                                <div class="col-10 p-0">
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-3 col-md-2 col-lg-1 p-0" >
                                                <select class="form-control " id="new_word1_language_name">
                                                    @foreach ($languages as $language)
                                                    <option>{{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-9 col-md-4 col-lg-5 p-0" >
                                                <textarea style="resize: none; " id="new_word1_name" class="form-control pb-2" type="text" placeholder="{{__('app_strings.word')}}" ></textarea>
                                            </div>

                                            <div class="col-3 col-md-2 col-lg-1 p-0 " >
                                                <select class="form-control" id="new_word2_language_name">
                                                    @foreach ($languages as $language)
                                                    <option>{{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-9 col-md-4 col-lg-5 p-0" >
                                                <textarea style="resize: none; " id="new_word2_name" class="form-control pb-2" type="text" placeholder="{{__('app_strings.translation')}}"></textarea> 
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-2 p-0 ">
                                    <button type="button" class="float-right d-flex btn p-6 m-0 rounded border border-secondary bt-light-white" id='button_translate_new'>
                                        <img class="mx-auto" src="/img/icons/plus.svg" alt="" width="20" height="20" title="{{__('app_strings.new')}}">
                                    </button>
                                </div>
                            </div>
                        </div>

                    </td>  

                </tr>

            </tbody>
        </table>
    </div>
    <br/>

    <div class="d-flex justify-content-center">
        <!-- {{ $translates->links() }} -->     
        {{ $translates->appends(request()->query())->links() }}
    </div>





    <div >
        <div class="modal fade" id="quiz_delete_modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="modal-content-div">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-form-label">@lang('app_strings.worning_delete_traslation')</label>
                        </div>

                        <textarea class="form-control d-none" id="modal_translate_id" name="modal_quiz_id"></textarea>

                        <div class="text-right">
                            <button  class="btn btn-secondary" data-dismiss="modal" id="modal_dialog_button_delete">@lang('app_strings.yes')</button>                         
                            <button  class="btn btn-secondary" data-dismiss="modal" id="modal_dialog_button_cansel">@lang('app_strings.no')</button>
                        </div>
                    </div>
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

        $('.but_favorite').on("click", function (event) {

            var button = $(event.target);

            if (button.prop("tagName") == "IMG") {
                button = button.parent();
            }
            if (button.prop("tagName") == "IMG") {
                button = button.parent();
            }
            console.log(button.prop("tagName"));

            curent_table_tr = button.parent().parent();
            while (curent_table_tr.prop("tagName") != "TR") {
                curent_table_tr = curent_table_tr.parent();
            }

            var translation_id = curent_table_tr.find('#translate_id').text();
//            console.log(curent_table_tr.find('translate_id').html());
            var favorite = 0;

            if (button.hasClass('star_fill')) {
                favorite = 0;
                button.removeClass('star_fill').find('img').attr("src", "/img/icons/star.svg");
            } else {
                favorite = 1;
                button.addClass('star_fill').find('img').attr("src", "/img/icons/star-fill.svg");
            }





            $.ajax({
                type: 'POST',
                url: "/statistics/favorite",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "translation_id": translation_id,
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

        $('.bt_edit').on("click", function (event) {


            var button = $(event.target);
            if (button.prop("tagName") == "IMG") {
                button = button.parent();
            }

            curent_table_tr = button.parent().parent();
            while (curent_table_tr.prop("tagName") != "TR") {
                curent_table_tr = curent_table_tr.parent();
            }
//            console.log(curent_table_tr.html());

            var td_translate_word1_name = curent_table_tr.find('#translate_word1_name');
            var td_translate_word2_name = curent_table_tr.find('#translate_word2_name');

            if (button.attr('id') == 'bt_edit') {



                var translate_word1_name_text = td_translate_word1_name.text();
                var translate_word2_name_text = td_translate_word2_name.text();

                var textarea_word1 = $('<textarea/>', {text: translate_word1_name_text, class: 'form-control text-primary', id: 'textarea_word1', style: "resize: none; overflow:hidden; box-shadow: none!important;"});
                var textarea_word2 = $('<textarea/>', {text: translate_word2_name_text, class: 'form-control text-primary', id: 'textarea_word2', style: "resize: none; overflow:hidden; box-shadow: none!important;"});


                td_translate_word1_name.text("").append(textarea_word1);
                td_translate_word2_name.text("").append(textarea_word2);

                textarea_word1.autoResize({elCopyResize: $("#textarea_word2")});
                textarea_word2.autoResize({elCopyResize: $("#textarea_word1")});

//                textarea_word1.ResizeSecondaryElement($("#textarea_word2"));
//                textarea_word2.ResizeSecondaryElement($("#textarea_word1"));

                button.attr('id', 'bt_save');
                button.find('img').attr("src", "/img/icons/file-earmark-check.svg");
                curent_table_tr.addClass('text-white border border-secondary bg-info');


            } else if (button.attr('id') == 'bt_save') {


                curent_table_tr.removeClass('text-white border border-secondary bg-info');
                button.find('img').attr("src", "/img/icons/pencil.svg");
                button.attr('id', 'bt_edit');

                translate_word1_name_text = td_translate_word1_name.find('textarea').val();
                td_translate_word1_name.empty().text(translate_word1_name_text);

                translate_word2_name_text = td_translate_word2_name.find('textarea').val();
                td_translate_word2_name.empty().text(translate_word2_name_text);

                var id = curent_table_tr.find('#translate_id').text();
                console.log('id = ' + id);
                $.ajax({
                    type: 'POST',
                    url: "/translation/edit", //"{{ route('translation.edit') }}",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "translate_word1_id": curent_table_tr.find('#translate_word1_id').text(),
                        "translate_word2_id": curent_table_tr.find('#translate_word2_id').text(),
                        "translate_word1_name": curent_table_tr.find('#translate_word1_name').text(),
                        "translate_word2_name": curent_table_tr.find('#translate_word2_name').text(),
                        "translate_id": curent_table_tr.find('#translate_id').text()

                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function () {
                        console.log("ERROR");
                    }
                });




            }



        });

        $('.but_delete').on("click", function (event) {

            var button = $(event.target);
            if (button.prop("tagName") == "IMG") {
                button = button.parent();
            }

            curent_table_tr = button.parent().parent();
            while (curent_table_tr.prop("tagName") != "TR") {
                curent_table_tr = curent_table_tr.parent();
            }


            var translate_id = curent_table_tr.find('#translate_id').text();

            $('#modal_translate_id').val(translate_id);

        });

        $('#modal_dialog_button_delete').click(function (e) {

            e.preventDefault();

//            console.log('click delete');

            var translate_id = $('#modal_translate_id').val();

            $.ajax({
                type: 'DELETE',
                url: "/translation/delete/" + translate_id,
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


            console.log($('#table_translate_new').find('#new_word1_name').val());
            $.ajax({
                type: 'POST',
                url: "/translation/add",
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

//        $("button")
//            .mouseover(function() {
//              $( this ).removeClass('bt-light-white').addClass('bt-grey-silver');
//            })
//            .mouseout(function() {
//              $( this ).removeClass('bt-grey-silver').addClass('bt-light-white');
//        });



    });

</script>


@endsection