<div class="form-group">
    <label for="name">اسم القسم</label>
    <input type="text" name="name" id="name" value="{{old('name', $category->name)}}"
           class="form-control
           @error('name')
            is-invalid
           @enderror">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <label for="image_path">صورة القسم</label>
    <input type="file" name="image_path" id="image_path" accept="image/*"
           value="{{old('image_path', $category->image_path)}}"
           class="uploadButton-input @error('image_path') is-invalid @enderror">

    @if($category->image_path)
        <div>
            <img width="100" height="100" src="{{asset( $category->image_path)}}" alt="image category">
            <li><a href="{{ asset(  $category->image_path) }}"> {{ ($category->image_path) }}</a></li>
        </div>
    @endif
    @error('image_path')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <button class="btn-primary"> حفظ</button>
</div>

