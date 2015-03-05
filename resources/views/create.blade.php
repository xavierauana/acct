@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route'=>['transactions.store'], "role"=>"form"]) !!}
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

                        {!! Form::submit("Register Purchase", ["class"=>"btn btn-primary btn-block btn-lg"]) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
