@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route'=>['transactions.store'], "role"=>"form", "files"=>true]) !!}
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

                        <button class="btn btn-default" id="upload">Upload Receipt</button>
                        <button class="btn btn-danger" id="remove" style="display:none">Remove Receipt</button>
                        {{-- Upload Receipt Form Input--}}
                        <div class="form-group">
                            <input type="file" name="receipt" id="receipt" style="display: none;"/>
                            {!! $errors->first('receipt',"<span class='input-error'>:message</span>") !!}
                        </div>

                        {!! Form::submit("Register Purchase", ["class"=>"btn btn-primary btn-block btn-lg"]) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        receipt = $("[name='receipt']");
        uploadButton =  $("#upload");
        uploadButton.click(function(e){
            e.preventDefault();
            receipt.click();
        });
        $("#remove").click(function(e){
            e.preventDefault();
            receipt.val("");
            uploadButton.text("Upload Receipt").addClass('btn-default').removeClass('btn-primary');
            $("#remove").css('display','none')
        });
        receipt.change(function(){
            if($(this).val() != "")
            {
               uploadButton.text("Change File").removeClass('btn-default').addClass('btn-primary');
                $("#remove").css('display','inline')
            }
        })
    </script>
@endsection
