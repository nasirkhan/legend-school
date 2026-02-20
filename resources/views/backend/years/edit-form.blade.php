<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Academic Year Edit Form</h5>
    <form class="" action="{{ route('year-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-10 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Academic Year</span>
                    </div>
                    <input type="text" name="year" placeholder="Enter Year" maxlength="4" minlength="4" class="form-control" required/>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
