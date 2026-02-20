<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Property Edit Form</h5>
    <form class="" action="{{ route('site-info-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Property</label>
                <input type="text" name="property" class="form-control" placeholder="Property" readonly>
            </div>

            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Value</label>
                <input type="text" name="value" class="form-control" placeholder="Value">
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
