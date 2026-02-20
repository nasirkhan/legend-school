<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">School Edit Form</h5>
    <form class="" action="{{ route('eca-item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ECA Type</span>
                    </div>
                    <select name="eca_type_id" class="form-control"></select>
                </div>
            </div>

            <div class="col col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ECA Item</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Item name" required>
                </div>
            </div>

            <div class="col col-md-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Enter Code" required>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
