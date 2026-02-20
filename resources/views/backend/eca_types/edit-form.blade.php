<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">School Edit Form</h5>
    <form class="" action="{{ route('eca-type-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ECA Type</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="" placeholder="Enter ECA Type" required>
                </div>
            </div>

            <div class="col col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="" placeholder="Enter Code" required>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
