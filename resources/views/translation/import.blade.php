
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
                   class="form-control" placeholder="Spreadsheet ID" aria-label="Spreadsheet ID" aria-describedby="basic-addon2">
            <div class="input-group-append">

                <button class="d-flex btn p-6 m-0 rounded-right border border-secondary bt-light-white" type="button" id="button_import">
                    <img class="mx-auto" src="/img/icons/download.svg" alt="" width="20" height="20" title="start">
                </button>
            </div>
        </div>

        <br>

        <p>1. @lang('app_strings.import_instruction_1') </p>
        <p>2. @lang('app_strings.import_instruction_2') <img src="/img/Import_words_phrasebook_icon.jpg"> </p>
        <p>3. @lang('app_strings.import_instruction_3') <img src="/img/Import_words_export_icon_2.jpg"></p>
        <p>4. @lang('app_strings.import_instruction_4')</p>
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

            var myInterval = setInterval(function () {

                $.ajax({
                    type: 'POST',
                    url: "/translation/importprogress",
                    async: true,
                    cache: false,
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "spreadsheetId": $('#spreadsheetId').val()
                    },

                    success: function (data) {
                        console.log(data);
//                        var bar = $('#import_progress_bar');
//                        bar.text(data+"%").attr("aria-valuenow",data).css('width', data+'%');


                        $('#spreadsheetId').css('background', "linear-gradient(90deg, #DCDCDC 0%, #DCDCDC " + data + "%, white " + data + "%, white " + (100 - data) + "%)");



                        if (data == 100) {
                            clearInterval(myInterval);
                        }

                    },
                    error: function () {
                        console.log("ERROR");
                        clearInterval(myInterval);
                    }

                });

            }, 1000);

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

                },
                error: function () {
                    console.log("ERROR");
                }
            });

        });
    });

</script>
@endsection