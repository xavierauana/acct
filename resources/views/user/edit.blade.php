@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($role, ['route'=>['roles.update', $role->id], "role"=>"form", 'id'=>'form', 'method'=>'PATCH']) !!}
                        @include('rbac.role.partials.form', ['submitButtonText'=>"Update Record"])
                        {!! Form::close() !!}
                        <br />
                        {!! Form::open(['route'=>['roles.destroy', $role->id], "role"=>"form", 'id'=>'deleteForm', 'method'=>'DELETE']) !!}
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