<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Day Edit Form</h5>
    <form class="" action="{{ route('day-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-6 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Day Name</span>
                    </div>
                    <input type="text" name="name" placeholder="Enter Day Name" class="form-control" required/>
                </div>
            </div>

            <div class="col col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Day Code</span>
                    </div>
                    <input type="text" name="code" placeholder="Enter Day Code" class="form-control" required/>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
