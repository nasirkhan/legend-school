<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Account Holder</h5>
    <form class="" action="{{ route('beneficiary-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-4 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Account Holder Type</span>
                    </div>
                    <select name="beneficiary_type_id" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ Session::get('beneficiary_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-lg-4 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" required>
                </div>
            </div>

            <div class="col-12 col-lg-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contact</span>
                    </div>
                    <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" placeholder="Enter Contact Number">
                </div>
            </div>

            <div class="col-12 col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
