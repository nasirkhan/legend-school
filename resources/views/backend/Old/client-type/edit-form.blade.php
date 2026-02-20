<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Client Type Edit</h5>
    <form class="" action="{{ route('client-type-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-5 pr-lg-0">
                <label class="sr-only" for="name">Client Type</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Client Type" required>
            </div>

            <div class="col-lg-5 pr-lg-0">
                <label class="sr-only" for="bn_name">Client Type</label>
                <input type="text" name="bn_name" class="form-control" value="{{ old('bn_name') }}" placeholder="ক্লাইন্টের ধরণ লিখুন">
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </form>
</div>
