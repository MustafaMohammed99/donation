<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name"
                   value="{{old('name', $association->name)}}"
            >
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address"
                   value="{{old('address', $association->address)}}"
            >
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email"
                   value="{{old('email', $association->email)}}"

            >
        </div>
    </div>

    <div class="col-md-4 form-group">
        <label for="image_path">Image Path</label>
        <input type="file" name="image_path" id="image_path" accept="image/*"
               class="uploadButton-input @error('image_path') is-invalid @enderror">

        @error('image_path')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="col-md-12 "/>

    <div class="col-md-4 form-group">
        <button class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 "> Save Changes</button>
        <a class="btn btn-default btn-close" href="{{ route('projects.index') }}">Cancel</a>
    </div>

</div>

