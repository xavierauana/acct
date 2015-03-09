@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($transaction, ['route'=>['transactions.update', $transaction->id], "role"=>"form", "files"=>true, 'id'=>'form', 'method'=>'PATCH']) !!}
                            @include('partials.form', ['submitButtonText'=>"Update Record"])
                        {!! Form::close() !!}
                        <br />
                        {!! Form::open(['route'=>['transactions.destroy', $transaction->id], "role"=>"form", 'id'=>'deleteForm', 'method'=>'DELETE']) !!}
                            {!! Form::submit("Delete Record", ['class'=>'btn btn-block btn-danger btn-lg']) !!}
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
        navigator.geolocation.getCurrentPosition(function(position){
            var positionField = $('[name="position"]');
            var positionFieldIsNotEmpty =  function () {
                return $("[name='position']") != "";
            };
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
        var deleteForm = $("#deleteForm");
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
        if(receiptIsNotEmpty())
        {
            uploadButton.text("Change File").removeClass('btn-default').addClass('btn-primary');
            removeButton.css('display','inline')
        }
        uploadButton.click(function(e){
            e.preventDefault();
            receipt.click();
        });
        removeButton.click(function(e){
            e.preventDefault();
            receipt.val("");
            $('[name="remove"]').val(1);
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

        deleteForm.submit(function(e){
            var message = "Are you sure you want to delete the record?";
            return confirm(message) == true;
//            e.preventDefault();
        })

    </script>
@endsection
