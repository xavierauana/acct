@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open( ['route'=>['roles.store'], "role"=>"form", 'id'=>'form']) !!}
                    @include('rbac.role.partials.form', ['submitButtonText'=>"Create New"])
                    {!! Form::close() !!}
                    <br />
                    <a href="{{route('roles.index')}}" class="btn btn-info btn-block btn-lg">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<image id="original"></image>
<image id="changed"></image>
@endsection