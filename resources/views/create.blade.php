@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route'=>['transactions.store'], "role"=>"form", "files"=>true, 'id'=>'form']) !!}
                        {{-- Purchased Item Form Input--}}
                        <div class="form-group">
                            {!! Form::label("item","Purchased Item:") !!}
                            {!! Form::text("item",null,["class"=>"form-control", "autocomplete"=>"on"]) !!}
                            {!! $errors->first('item',"<span class='input-error'>:message</span>") !!}
                        </div>

                        {{-- Amount Form Input--}}
                        <div class="form-group">
                            {!! Form::label("amount","Amount:") !!}
                            {!! Form::input("number","amount",null,["class"=>"form-control", "step"=>"any"]) !!}
                            {!! $errors->first('amount',"<span class='input-error'>:message</span>") !!}
                        </div>

                        {{-- Vendor Form Input--}}
                        <div class="form-group">
                            {!! Form::label("vendor","Vendor:") !!}
                            {!! Form::text("vendor",null,["class"=>"form-control", "autocomplete"=>"on"]) !!}
                            {!! $errors->first('vendor',"<span class='input-error'>:message</span>") !!}
                        </div>

                        {{-- Payment Method Form Input--}}
                        <div class="form-group">
                            {!! Form::label("payment","Payment Method:") !!}
                            {!! Form::select("payment",[0=>"Cash", 1=>"Credit Card", 2=>"Octopus"],null,["class"=>"form-control"]) !!}
                            {!! $errors->first('payment',"<span class='input-error'>:message</span>") !!}
                        </div>

                        <button class="btn btn-default" id="uploadButton">Upload Receipt</button>
                        <button class="btn btn-danger" id="removeButton" style="display:none">Remove Receipt</button>
                        {{-- Upload Receipt Form Input--}}
                        <div class="form-group">
                            <input type="file" name="receipt" id="receipt" style="display: none;"/>
                            <input type="file" name="modified" id="modified" style="display: none;"/>
                            {!! $errors->first('receipt',"<span class='input-error'>:message</span>") !!}
                            {!! $errors->first('position',"<span class='input-error'>:message</span>") !!}
                        </div>

                        <input type="hidden" name="position" id="position" />

                        {!! Form::submit("Register Purchase", ["class"=>"btn btn-primary btn-block btn-lg"]) !!}

                        {!! Form::close() !!}
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
        var success =  function (position){
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var accuracy = position.coords.accuracy;
            $('[name="position"]').val(latitude+","+ longitude);
            $("From").submit(function(e){
                if($("[name='position']") != "") return;
                e.preventDefault();
            });
        };
        var error = function (errors){
            console.log("error code:"+errors.code);
        };
        var options = {
            enableHighAccuracy: true
        };
        navigator.geolocation.getCurrentPosition(success,error,options);
    </script>

    <script>
        var receipt = $("[name='receipt']");
        var uploadButton =  $("#uploadButton");
        var removeButton = $("#removeButton");
        var form = $("form");
        var resizedImage = '';
        var receiptIsNotEmpty = function() {
            return receipt.val() != "" && receipt.val() != 'undefined' ;
        };
        var nameIsValid = function (name) {
            return name != 'undefined'
        };
        var constructFormData = function (inputs, targetName, targetValue) {
            var formData = new FormData();
            $.each(inputs,function(){
                name = inputs.attr('name')
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
