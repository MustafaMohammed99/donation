@props([
'id', 'name', 'label', 'value'=>'', 'type'=>'text'
])
<label for="{{$id}}">{{$label}}</label>
<input
    type="{{$type}}"
    name="{{$name}}"
    id="{{$id}}"
    value="{{old($name, $value)}}"
    class="form-control @error("$name") is-invalid @enderror"
    {{$attributes->class(['form-control','is-invalid'=>$errors->has($name)] )}} {{--    بتستدعي الاتربيوت وبتضيف على الكلاس اي كلاس تاني --}}

>
@error("$name")
<p class="invalid-feedback">{{$message}}</p>
@enderror
