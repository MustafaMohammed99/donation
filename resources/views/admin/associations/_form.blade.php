<div class="form-group">
   <x-form.input  id="name" name="name" label="اسم الجمعية"  :value="$association->name"  class="form-control-border" />
</div>

<div class="form-group">
    <label for="address">العنوان</label>
    <input type="text" name="address" id="address" value="{{old('address', $association->address)}}"
           class="form-control @error('address') is-invalid @enderror">
    @error('address')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <label for="email">الايميل</label>
    <input type="email" name="email" id="email" value="{{old('email', $association->email)}}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <label for="password">كلمة السر</label>
    <input type="text" name="password" id="password" value="{{old('password', $association->password)}}"
           class="form-control @error('password') is-invalid @enderror">
    @error('password')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>


<div class="form-group">
    <label for="image_path">صورة الجمعية</label>
    <input type="file" name="image_path" id="image_path" accept="image/*"
           class="uploadButton-input @error('image_path') is-invalid @enderror">

    @error('image_path')
    <span class="uploadButton-file-name">Images  that might be helpful in describing your job</span>
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="form-group">
    <button  class="btn-primary">حفظ</button>
</div>

