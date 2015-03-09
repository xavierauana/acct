@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if($transaction->receipt)
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{$transaction->receipt}}" alt="" />
                                </div>
                                <div class="col-md-9">
                                    {!! Form::model($transaction, ['route'=>['transactions.update', $transaction->id], "role"=>"form", "files"=>true, 'id'=>'form', 'method'=>'PATCH']) !!}
                                    @include('partials.form', ['submitButtonText'=>"Update Record"])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @else
                            {!! Form::model($transaction, ['route'=>['transactions.update', $transaction->id], "role"=>"form", "files"=>true, 'id'=>'form', 'method'=>'PATCH']) !!}
                                @include('partials.form', ['submitButtonText'=>"Update Record"])
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <image id="original"></image>
    <image id="changed"></image>
@endsection

@section('scripts')
    <script>
        navigator.geolocation.getCurrentPosition(function(position){
            var positionField = $('[name="position"]');
            var positionFieldIsNotEmpty =  function () {
                return $("[name='position']") != "";
            };
//            $(".panel-body").prepend("<span>"+position.coords.latitude+"</span>");
            positionField.val(position.coords.latitude+","+position.coords.longitude);
            console.log(positionField);

            $("From").submit(function(e){
                if(positionFieldIsNotEmpty()) return;
                e.preventDefault();
            });
        },function(error){
            console.log("error code:"+error.code);
        });
    </script>

    <script>
        var receipt = $("[name='receipt']");
        var uploadButton =  $("#uploadButton");
        var removeButton = $("#removeButton");
        var form = $("form");
        var resizedImage = '';
        var receiptIsNotEmpty = function() {
            @if(isset($transaction->receipt) and $transaction->receipt)
                return true;
            @endif
            return receipt.val() != "" && receipt.val() != 'undefined' ;
        };
        var nameIsValid = function (name) {
            return name != 'undefined'
        };
        var constructFormData = function (inputs, targetName, targetValue) {
            var formData = new FormData();
            $.each(inputs,function(){
                var name = inputs.attr('name');
                if(nameIsValid(name))
                {
                    if(name == targetName)
                    {
                        formData.append(name,targetValue)
                    }else{
                        formData.append(name, $(this).val());
                    }
                }
            });
            return formData
        };
        var sendAjax = function(form, inputs, targetName, targetValue){
            var formData = constructFormData(inputs, targetName, targetValue);
            var request = new XMLHttpRequest();
            var url = form.attr('action');
            var method = form.attr('method');
            request.open(method, url);
            request.send(formData);
        };

        if(receiptIsNotEmpty())
        {
            uploadButton.text("Change File").removeClass('btn-default').addClass('btn-primary');
            removeButton.css('display','inline')
        }
        //        form.submit(function(e){
        //            if(!receiptIsNotEmpty() || resizedImage !='' )
        //            {
        //                return
        //            }else{
        //                var files = document.getElementById('receipt').files;
        //                var reader = new FileReader;
        //                reader.onloadend = function(e) {
        //                    var image = new Image();
        //                    image.src = reader.result;
        //
        //                    image.onload = function(){
        //                        var canvas = document.createElement('canvas');
        //                        canvas.width = image.width/2;
        //                        canvas.height = image.height/2;
        //                        var ctx = canvas.getContext('2d');
        //                        ctx.drawImage(this, 0, 0, image.width/2, image.height/2);
        //                        resizedImage = canvas.mozGetAsFile(files[0].name);
        ////                        sendAjax($(form), $('inputs'), 'receipt', resizedImage);
        ////                        resizedImage = canvas.toDataURL();
        ////                        var newInput = document.getElementById('modified');
        ////                        var formData = new FormData();
        ////                        $.each($('input'), function(){
        ////                            var name = $(this).attr('name');
        ////                            if(nameIsValid(name))
        ////                            {
        ////                                if(name == 'receipt')
        ////                                {
        ////                                    formData.append(name, resizedImage);
        ////                                }else{
        ////                                    formData.append(name, $(this).val());
        ////                                }
        ////                            }
        ////                        });
        ////                        var request = $.ajax({
        ////                            method:$(form).attr('method'),
        ////                            url:$(form).attr('action'),
        ////                            data:$(form).serialize()
        ////                        });
        ////                        request.always = function(){
        ////                            console.log('fired')
        ////                        };
        //                    }
        //                };
        //                reader.readAsDataURL(files[0]);
        //            }
        //            e.preventDefault();
        //        });
        uploadButton.click(function(e){
            e.preventDefault();
            receipt.click();
        });
        removeButton.click(function(e){
            e.preventDefault();
            receipt.val("");
            uploadButton.text("Upload Receipt").addClass('btn-default').removeClass('btn-primary');
            removeButton.css('display','none')
        });
        receipt.change(function(){
            if(receiptIsNotEmpty())
            {
                uploadButton.text("Change File").removeClass('btn-default').addClass('btn-primary');
                removeButton.css('display','inline')
            }
        })

    </script>
@endsection
