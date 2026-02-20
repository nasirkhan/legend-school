<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Client Type</h5>
    <form class="" action="{{ route('client-type-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-5 pr-lg-0">
                <label class="sr-only" for="name">Client Type</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Client Type">
            </div>

            <div class="col-lg-5 pr-lg-0">
                <label class="sr-only" for="bn_name">Client Type</label>
                <input type="text" name="bn_name" class="form-control" id="bn_name" value="{{ old('bn_name') }}" placeholder="ক্লাইন্টের ধরণ লিখুন">
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
