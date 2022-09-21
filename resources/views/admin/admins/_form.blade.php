<div class="form-group">
   <x-form.input  id="name" name="name" label="اسم المشرف"  :value="$admin->name"  class="form-control-border" />
</div>


<div class="form-group">
    <x-form.select id="address" name="address" label="العنوان: " :options="$address"
                 />
</div>

{{--<div class="form-group">--}}
{{--    <label for="address">Address</label>--}}
{{--    <input type="text" name="address" id="address" value="{{old('address', $admin->address)}}"--}}
{{--           class="form-control @error('address') is-invalid @enderror">--}}
{{--    @error('address')--}}
{{--    <p class="invalid-feedback">{{$message}}</p>--}}
{{--    @enderror--}}
{{--</div>--}}

<div class="form-group">
    <label for="email">الايميل</label>
    <input type="email" name="email" id="email" value="{{old('email', $admin->email)}}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

<div class="custom-control custom-checkbox">
    <input type="checkbox"  name="is_super_admin" >
    <label >مشرف بصلاحيات كاملة</label>
</div>

<div class="form-group">
    <label for="password">كلمة السر</label>
    <input type="text" name="password" id="password" value="{{old('password', $admin->password)}}"
           class="form-control @error('password') is-invalid @enderror">
    @error('password')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>


<div class="form-group">
    <label for="image_path">صورة المشرف</label>
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

