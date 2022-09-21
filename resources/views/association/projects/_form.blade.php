<div class="form-group">
    <x-form.select id="category_id" name="category_id" label="القسم " :options="$categories->pluck('name', 'id')"
                   :selected="$project->category_id"           />
</div>

<div class="form-group">
    <x-form.input id="title" name="title" label="عنوان المشروع " :value="$project->title" class="form-control-border"/>
</div>

<div class="form-group">
    <label for="description">الوصف</label>
    <textarea id="description" name="description"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <x-form.input type="number"  min="1" id="num_beneficiaries" name="num_beneficiaries" label="عدد المستفيدين "
                  :value="$project->num_beneficiaries" class="form-control-border"/>
</div>

<div class="form-group">
    <x-form.input type="number" min="1" id="require_amount" name="require_amount" label="المبلغ المطلوب "
                  :value="$project->require_amount" class="form-control-border"/>
</div>

<div class="form-group">
    <x-form.input type="number" min="1" id="interval" name="interval" label="فترة تنفيذ المشروع "
                  :value="$project->interval" class="form-control-border"/>
</div>

<div class="form-group">
    <x-form.input type="number" min="1" id="price_stock" name="price_stock" label="سعر السهم "
                  :value="$project->price_stock" class="form-control-border"/>
</div>

<div class="col-md-4 form-group">
    <label for="image_path">صورة او صور المشروع</label>
    <input type="file" name="image_path[]" id="image_path" accept="image/*" multiple
           class="uploadButton-input @error('image_path') is-invalid @enderror">

    @if (is_array($project->image_path))
        <div>
            <ul>
                @foreach ($project->image_path as $file)
                    <li><a href="{{ asset('uploads/projects/' . $file) }}">{{ basename($file) }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    @error('image_path')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>


<div class="form-group">
    <button class="btn-primary"> حفظ</button>
</div>

