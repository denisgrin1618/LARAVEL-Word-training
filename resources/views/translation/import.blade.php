
@extends('layouts.app')

@section('content')

<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div >
        <h1>@lang('app_strings.import_instruction_header')</h1>
        <div class="input-group " >
            <input name="spreadsheetId" id="spreadsheetId" type="text" autocomplete="off"
                   placeholder="Spreadsheet ID" aria-label="Spreadsheet ID" aria-describedby="basic-addon2"
                   class="form-control "
                   >
            <div class="input-group-append">

                <button class="d-flex btn p-6 m-0 rounded-right border border-secondary bt-light-white" type="button" id="button_import">
                    <img class="mx-auto" src="/img/icons/download.svg" alt="" width="20" height="20" title="start">
                </button>
            </div>
        </div>

        <div id="div_count_downloaded_translations" class="alert alert-success invisible">
            
        </div>
        
        <br>

        <p>1. @lang('app_strings.import_instruction_1') </p>
        <p>2. @lang('app_strings.import_instruction_2') <img src="/img/Import_words_phrasebook_icon.jpg"> </p>
        <p>3. @lang('app_strings.import_instruction_3') <img src="/img/Import_words_export_icon_2.jpg"></p>
        <p>4. @lang('app_strings.import_instruction_4')</p>
        <p>5. @lang('app_strings.import_instruction_5')</p>
        <img src="/img/Import_words_export_icon_3.jpg">
    </div>

    <br>
    <br>
    <br>

</div>

<script type="text/javascript" defer>

    $(function ()
    {
        $('#button_import').click(function (e) {

            e.preventDefault();

//            var myInterval = setInterval(function () {
//
//                $.ajax({
//                    type: 'POST',
//                    url: "/translation/importprogress",
//                    async: true,
//                    cache: false,
//                    data: {
//                        "_token": $('meta[name="csrf-token"]').attr('content'),
//                        "spreadsheetId": $('#spreadsheetId').val()
//                    },
//
//                    success: function (data) {
//                        console.log(data);
////                        var bar = $('#import_progress_bar');
////                        bar.text(data+"%").attr("aria-valuenow",data).css('width', data+'%');
//
//
//                        $('#spreadsheetId').css('background', "linear-gradient(90deg, #DCDCDC 0%, #DCDCDC " + data + "%, white " + data + "%, white " + (100 - data) + "%)");
//
//
//
////                        if (data == 100) {
////                            clearInterval(myInterval);
////                        }
//
//                    },
//                    error: function () {
//                        console.log("ERROR");
//                        clearInterval(myInterval);
//                    }
//
//                });
//
//            }, 1000);

            
//                class="form-control progress-bar progress-bar-striped progress-bar-animated" 
//                role="progressbar" 
//                aria-valuenow="100" 
//                aria-valuemin="0" 
//                aria-valuemax="100" 
//                style="width: 100%"
              
              $('#spreadsheetId')
                      .removeAttr("placeholder")
                      .attr("role","progressbar")
                      .attr("aria-valuenow","100")
                      .attr("aria-valuemin","0")
                      .attr("aria-valuemax","100")
                      .css("width", "100%")
                      .addClass("progress-bar progress-bar-striped progress-bar-animated");
     

            $.ajax({
                type: 'POST',
                url: "/translation/importpost",
                async: true,
                cache: false,
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "spreadsheetId": $('#spreadsheetId').val()
                },

                success: function (data) {
                    console.log(data);
//                    clearInterval(myInterval);
                    $('#div_count_downloaded_translations')
                            .removeClass('invisible')
                            .text("downloaded translations:" + data);
                            
                    $('#spreadsheetId')
                      .attr("placeholder", "Spreadsheet ID")
                      .removeAttr("role")
                      .removeAttr("aria-valuenow")
                      .removeAttr("aria-valuemin")
                      .removeAttr("aria-valuemax")
                      .css("width", "100%")
                      .removeClass("progress-bar progress-bar-striped progress-bar-animated");
          
                         
                    
                },
                error: function () {
                    console.log("ERROR");
//                    clearInterval(myInterval);

                    $('#div_count_downloaded_translations')
                            .removeClass('invisible')
                            .text("ERROR downloaded translations:" + 0);
                            
                    $('#spreadsheetId')
                      .attr("placeholder", "Spreadsheet ID")
                      .removeAttr("role")
                      .removeAttr("aria-valuenow")
                      .removeAttr("aria-valuemin")
                      .removeAttr("aria-valuemax")
                      .css("width", "100%")
                      .removeClass("progress-bar progress-bar-striped progress-bar-animated");
          
                }
            });

        });
    });

</script>
@endsection