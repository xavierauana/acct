@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($permission, ['route'=>['permissions.update', $permission->id], "role"=>"form", 'id'=>'form', 'method'=>'PATCH']) !!}
                        @include('rbac.permission.partials.form', ['submitButtonText'=>"Update Record",'edit'=>true])
                        {!! Form::close() !!}
                        <br />
                        {!! Form::open(['route'=>['permissions.destroy', $permission->id], "role"=>"form", 'id'=>'deleteForm', 'method'=>'DELETE']) !!}
                        {!! Form::submit("Delete Record", ['class'=>'btn btn-block btn-danger btn-lg']) !!}
                        {!! Form::close() !!}
                        <br />
                        <a href="{{route('permissions.index')}}" class="btn btn-info btn-block btn-lg">back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <image id="original"></image>
    <image id="changed"></image>
@endsection