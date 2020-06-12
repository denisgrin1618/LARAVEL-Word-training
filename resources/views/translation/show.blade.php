
@extends('layouts.app')

@section('content')


<div class="container">

    <main role="main" class="container" >

        <table class="table-responsive table-striped w-100 d-block d-md-table">
            <thead>
                <tr>
                    <!-- <th style="width: 3%" scope="col">#</th> -->
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 30%" scope="col">@lang('app_strings.word')</th>
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 30%" scope="col">@lang('app_strings.translation')</th>
                    <th style="width: 10%" scope="col"></th>
                    <th style="width: 50px" scope="col"></th>
                    <th style="width: 50px" scope="col"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>
                    <th style="width: 0%"  scope="col" class="d-none"></th>

                </tr>
            </thead>
            <tbody id="table_translates">

                {{ Form::open(array('route' => 'translation.search', 'method' => 'get')) }}
                <tr>
                    <td>
                        <select class="form-control" name="language1">

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
                        <input class="form-control" type="text" placeholder="{{__('app_strings.search')}}" name="word1" value="{{$search_input['word1'] ?? ''}}">
                    </td>
                    <td>
                        <select class="form-control" name="language2">

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
                        <input class="form-control" type="text" placeholder="{{__('app_strings.search')}}" name="word2" value="{{$search_input['word2'] ?? ''}}">
                    </td>
                    <td class="d-flex justify-content-center" >
                        <div type="button" class="but_favorite d-flex btn p-6 m-0">
                            <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                        </div>
                    </td>
                    <td></td>
                    <td align="right"> 
                        <!-- <button type="button" class="btn btn-secondary  ml-1 mt-1" >Search</button>  -->
                        <!--                        {{ Form::submit('Search',['class'=>'btn btn-secondary  ml-1 mt-1']) }}-->

                        <button type="submit" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white  " >            
                            <img class="mx-auto" src="/img/icons/search.svg" alt="" width="20" height="20" title="{{__('app_strings.search')}}">
                        </button>

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
                    <td id="translate_statistics"> 
<!--                        <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                    -->
                        <div type="button" class="but_favorite d-flex btn p-6 m-0">
                            <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                        </div>
                    </td>
                    <td align="right" >
                        <button id="bt_edit" type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white bt_edit" >
                            <img class="mx-auto" src="/img/icons/pencil.svg" alt="" width="20" height="20" title="{{__('app_strings.edit')}}">
                        </button>
                    </td>
                    <td align="right" >
                        <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white but_delete" data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">
                            <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                        </button>
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
                    <td id="translate_statistics" class="d-flex justify-content-center" > 
                        <button type="button" class="d-flex btn p-6 m-0">
                            <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                        </button>
                    </td>
                    <td align="right" >
                        <button id="bt_edit" type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white bt_edit" >
                            <img class="mx-auto" src="/img/icons/pencil.svg" alt="" width="20" height="20" title="{{__('app_strings.edit')}}">
                        </button>
                    </td>
                    <td align="right" >
                        <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white but_delete" data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">
                            <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                        </button>
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
                    <td id='translate_word1_language_name'  >{{ $translate->word1->language->name }} </td>
                    <td id="translate_word1_name"           >{{ $translate->word1->name }}</td>
                    <td id='translate_word2_language_name'  >{{ $translate->word2->language->name }}</td>
                    <td id="translate_word2_name"           >{{ $translate->word2->name }}</td>
                    <td id="translate_statistics"  class="d-flex justify-content-center"         >
<!--                        {!! !empty($translate->statistics) ? ''.$translate->statistics->count_success.'/'.($translate->statistics->count_error+$translate->statistics->count_success) : '0/0' !!} -->
                        @if(!empty($translate->statistics) && $translate->statistics->favorite)
                            <div  type="button" class="star_fill but_favorite d-flex btn p-6 m-0" >
                                <img class="mx-auto" src="/img/icons/star-fill.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                            </div>
                        @else
                            <div  type="button" class="but_favorite d-flex btn p-6 m-0"  >
                                <img class="mx-auto" src="/img/icons/star.svg" alt="" width="20" height="20" title="{{__('app_strings.favorite')}}">
                            </div>
                        @endif
                    </td>
                    <td align="right" >

                        <button id="bt_edit" type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white bt_edit" >
                            <img class="mx-auto" src="/img/icons/pencil.svg" alt="" width="20" height="20" title="{{__('app_strings.edit')}}">
                        </button>

                    </td>
                    <td align="right" >

                        <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white but_delete" data-toggle="modal" data-target="#quiz_delete_modal" data-whatever="@mdo">
                            <img class="mx-auto" src="/img/icons/trash.svg" alt="" width="20" height="20" title="{{__('app_strings.delete')}}">
                        </button>

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
                    <td style="width: 30%">
                        <textarea style="resize: none; " id="new_word1_name" class="form-control" type="text" placeholder="{{__('app_strings.word')}}" ></textarea>
                    </td>
                    <td style="width: 10%">
                        <select class="form-control" id="new_word2_language_name">
                            @foreach ($languages as $language)
                            <option>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width: 30%">
                        <textarea style="resize: none; " id="new_word2_name" class="form-control" type="text" placeholder="{{__('app_strings.translation')}}"></textarea> 
                    </td>

                    <td style="width: 20%" align="right"> 
                        <button type="button" class="d-flex btn p-6 m-0 rounded border border-secondary bt-light-white" id='button_translate_new'>
                            <img class="mx-auto" src="/img/icons/plus.svg" alt="" width="20" height="20" title="{{__('app_strings.new')}}">

                        </button>
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

        <div class="modal fade" id="quiz_delete_modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="modal-content-div">

                    <!--
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-label">New translate</h4>
                    </div>
                    -->
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

        $('.but_favorite').on("click", function (event) {
            
            var button = $(event.target);
            
            if (button.prop("tagName") == "IMG") {
                button = button.parent(); 
            }
            if (button.prop("tagName") == "IMG") {
                button = button.parent(); 
            }
            console.log(button.prop("tagName"));

            curent_table_tr     = button.parent().parent();
            var translation_id  = curent_table_tr.find('#translate_id').text();
//            console.log(curent_table_tr.find('translate_id').html());
            var favorite        = 0;
            
            if(button.hasClass('star_fill')){
                favorite = 0;
                button.removeClass('star_fill').find('img').attr("src", "/img/icons/star.svg");
            }else{
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

            var td_translate_word1_name = curent_table_tr.find('#translate_word1_name');
            var td_translate_word2_name = curent_table_tr.find('#translate_word2_name');

            if (button.attr('id') == 'bt_edit') {

                

                var translate_word1_name_text = td_translate_word1_name.text();
                var translate_word2_name_text = td_translate_word2_name.text();

                var textarea_word1 = $('<textarea/>', {text: translate_word1_name_text, class: 'form-control text-primary', id: 'textarea_word1'});
                var textarea_word2 = $('<textarea/>', {text: translate_word2_name_text, class: 'form-control text-primary', id: 'textarea_word2'});


                td_translate_word1_name.text("").append(textarea_word1);
                td_translate_word2_name.text("").append(textarea_word2);

                textarea_word1.autoResize({elCopyResize: $("#textarea_word2")});
                textarea_word2.autoResize({elCopyResize: $("#textarea_word1")});

                textarea_word1.ResizeSecondaryElement($("#textarea_word2"));
                textarea_word2.ResizeSecondaryElement($("#textarea_word1"));

                button.attr('id', 'bt_save');
                button.find('img').attr("src", "/img/icons/file-earmark-check.svg");
                curent_table_tr.addClass('text-white border border-secondary bg-info');


            }else if(button.attr('id') == 'bt_save'){


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
                        "translate_word1_id":   curent_table_tr.find('#translate_word1_id').text(),
                        "translate_word2_id":   curent_table_tr.find('#translate_word2_id').text(),
                        "translate_word1_name": curent_table_tr.find('#translate_word1_name').text(),
                        "translate_word2_name": curent_table_tr.find('#translate_word2_name').text(),
                        "translate_id":         curent_table_tr.find('#translate_id').text()

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
            var translate_id = curent_table_tr.find('#translate_id').text();

            $('#modal_translate_id').val(translate_id);
  
        });

        $('#modal_dialog_button_delete').click(function (e) {

            e.preventDefault();

//            console.log('click delete');

            var translate_id = $('#modal_translate_id').val();
            
            $.ajax({
                type: 'DELETE',
                url: "/translation/delete/"+translate_id,
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