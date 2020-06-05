
@extends('layouts.app')

@section('content')

<div class="container">

    <main role="main" class="container" >


        <!--        
                {{ Form::open(array('route' => 'translation.postimport', 'method' => 'post')) }}
        
                <input class="form-control" type="text" placeholder="spreadsheetId" name="spreadsheetId" >
                {{ Form::submit('import',['class'=>'btn btn-secondary  ml-1 mt-1']) }}
        
                {{ Form::close() }}
        -->

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">

            <!--            {{ Form::open(array('route' => 'translation.postimport', 'method' => 'post')) }}-->


            <div class="input-group mb-3">
                <input name="spreadsheetId" id="spreadsheetId" type="text" class="form-control" placeholder="Spreadsheet Id" aria-label="Spreadsheet Id" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <!--                    
                    <button class="btn btn-success" type="button" id="button_import">Import</button>
                    -->
                    <button class="d-flex btn p-6 m-0 rounded border border-secondary bg-white" type="button" id="button_import">
                        <img class="mx-auto" src="/img/icons/download.svg" alt="" width="20" height="20" title="start">
                    
                    </button>
                    
                        
                </div>
            </div>

            <!--            {{ Form::close() }}-->

            <div class="progress">
                <div id='import_progress_bar'  class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
       

        </div>






    </main>



</div>





<script type="text/javascript" defer>

    $(function ()
    {

        $('#button_import').click(function (e) {

            e.preventDefault();
            console.log('click');


            var myInterval = setInterval(function () {
//                $.get('/translation/importprogress', function (data) {
//                    console.log(data);
//                });
                
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
                        var bar = $('#import_progress_bar');
                        bar.text(data+"%").attr("aria-valuenow",data).css('width', data+'%');
                        
                        
                        
                        if (data == 100){
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

                    console.log('FINISH data');
                    console.log(data);
//                    clearInterval(myInterval);

                },
                error: function () {
                    console.log("ERROR");
                }
            });
        });

    });


//    $(document).ready(function() {
//        $('#button_import').click(function (e) {
//            setInterval(function(){
//                $.get('/translation/importprogress', function(data) {
//                    console.log(data);
//                });
//            }, 1000);
//
//            $.post(
//                '/translation/importpost',
//                {"_token": $('meta[name="csrf-token"]').attr('content'), "spreadsheetId": $('#spreadsheetId').val()},
//                function() {
//                    console.log("data");
//                },
//                'json'
//            );
//
//            return false;
//        });
//    });
</script>
@endsection