
<div>
    <h4> Name Project:   {{$project->title}} </h4>
</div>

<input name="project_id" type="hidden" value="{{ $project->id}}">

<div class="form-group">
    <x-form.input type="text" id="reason_stopping" name="reason_stopping" label="Reason Stopping: "
                  :value="$project->reason_stopping" class="form-control-border"/>
</div>


<div class="form-group">
    <button class="btn-primary"> Save</button>
</div>

