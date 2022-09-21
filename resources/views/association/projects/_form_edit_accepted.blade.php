<div class="uploadButton margin-top-30 form-group">
    <label for="image_path">اضافة صورة او صور للمشروع</label>
    <input type="file" name="image_path[]" id="image_path" accept="image/*" multiple
           class="uploadButton-input @error('image_path') is-invalid @enderror">

    @if($project_path)
            <div>
                <ul>
                    @foreach ($project_path as $project)
                        <li><a href="{{ asset( $project->image_path) }}">{{ basename($project->image_path) }}</a></li>
                    @endforeach
                </ul>
            </div>
    @endif

    @error('image_path[]')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>


<div class="form-group">
    <button class="btn-primary"> Save</button>
</div>

