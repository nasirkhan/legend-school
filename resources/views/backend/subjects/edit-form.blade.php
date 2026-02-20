<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Subject Edit Form</h5>
    <form class="" action="{{ route('subject-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-10 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subject </span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Subject Name" required>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
