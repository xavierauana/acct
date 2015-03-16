@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Upload New Video
                        </h4>

                    </div>
                    <div class="panel-body">
                       {!! Form::open(['route'=>['videos.store'], "role"=>"form", 'file'=>true]) !!}

                            {{-- Video Name Form Input--}}
                            <div class="form-group">
                                {!! Form::label("name","Video Name:") !!}
                                {!! Form::text("name",null,["class"=>"form-control"]) !!}
                                {!! $errors->first('name',"<span class='input-error'>:message</span>") !!}
                            </div>

                            {{-- Video File Form Input--}}
                            <div class="form-group">
                                {!! Form::label("link","Video File:") !!}
                                {!! Form::file("link") !!}
                                {!! $errors->first('link',"<span class='input-error'>:message</span>") !!}
                                <p id="fileErrorMessage" class="text-danger" style="display: none"></p>
                                <p class="help-block">File size is not over 10MB</p>
                            </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span><span id="percentage">45</span>% Complete</span>
                            </div>
                        </div>


                            {!! Form::submit("Upload",['class'=>'btn btn-primary']) !!}
                            <a class="btn btn-info" href="/videos">Back</a>
                       {!! Form::close() !!}
                        <a class="btn btn-info" href="/videos" id="backButton" style="display:none">Back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/components/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/components/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="/components/jquery-file-upload/js/jquery.fileupload.js"></script>
    <script>
        var form = $("form");
        var fileInput = $("input[type='file']");
//        $("#backButton").css('display','inline');


        form.submit(function(e){
            e.stopPropagation();
            e.preventDefault();
            var files = $("input[type='file']").prop('files');
            var fileErrorMessage = $("#fileErrorMessage");
            var formData = new FormData();

//            formData.append('link', files[0]);
//            var file = files[0];
//            if(file.size > 0)
//            {
//                fileErrorMessage.css({
//                    "font-style":"italic"
//                }).text('File size is too large').fadeIn(500);
//                setTimeout(function(){
//                    fileErrorMessage.fadeOut(500).end().text("");
//                },5000);
//                return false
//            }
            $("input[type='submit']").val("File uploading...").removeClass('btn-primary').addClass('btn-warning');
            var $testData ={};
            var request = $.ajax({
                url: form[0].action,
                method:form[0].method,
                data: {link:files[0]},
                dataType:'json',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("[name='_token']").val());
                },
                always:function(){
                    console.log('ajax fired')
                },
                success:function(data, textStatus, jqXHR)
                {
                    if(typeof data.error === 'undefined')
                    {
                        // Success so call function to process the form
//                        submitForm(event, data);
                        console.log('done')
                        console.log('textStatus'),
                        console.log('jqXHR')
                    }
                    else
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                }
            })
        })

    </script>

@endsection