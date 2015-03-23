{{-- Display Name Form Input--}}
<div class="form-group">
    {!! Form::label("name","Display Name:") !!}
    @if($edit)
        {!! Form::text("name",null,["class"=>"form-control", 'disabled']) !!}
    @else
        {!! Form::text("name",null,["class"=>"form-control"]) !!}
    @endif

    {!! $errors->first('',"<span class='input-error'>:message</span>") !!}
</div>
{{-- Role Name Form Input--}}
<div class="form-group">
    {!! Form::label("display_name","Role Name:") !!}
    {!! Form::text("display_name",null,["class"=>"form-control"]) !!}
    {!! $errors->first('display_name',"<span class='input-error'>:message</span>") !!}
</div>

{!! Form::submit($submitButtonText,['class'=>'btn btn-success btn-block btn-lg']) !!}
