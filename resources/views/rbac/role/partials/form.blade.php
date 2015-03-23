{{-- Role Name Form Input--}}
<div class="form-group">
    {!! Form::label("name","Role Name:") !!}
    {!! Form::text("name",null,["class"=>"form-control"]) !!}
    {!! $errors->first('name',"<span class='input-error'>:message</span>") !!}
</div>

{!! Form::submit($submitButtonText,['class'=>'btn btn-success btn-block btn-lg']) !!}
