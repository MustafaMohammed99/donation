<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{old('name', $category->name)}}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <label for="image_path">Image Path</label>
    <input type="text" name="image_path" id="image_path" value="{{old('image_path', $category->image_path)}}"
           class="form-control @error('image_path') is-invalid @enderror">
    @error('image_path')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <button class="btn-primary"> Save</button>
</div>

