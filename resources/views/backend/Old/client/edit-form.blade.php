<div class="modal-content">
    <form id="edit" action="{{ route('client-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id"/>
        <div class="modal-header">
            <h5 class="modal-title mb-0 text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i> Client Info Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-0">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Client Type</span>
                            </div>
                            <select name="type" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach(activeClientTypes() as $type)
                                    <option value="{{ $type->name }}" {{ old('type')==$type->name ? 'selected':'' }}>{{ siteInfo('language')=='bengali'? $type->bn_name:$type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name" required>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mobile</span>
                            </div>
                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Past Bal.</span>
                            </div>
                            <input type="number" min="0" step="1" name="initial_balance" class="form-control" value="{{ old('initial_balance') }}" placeholder="Past Balance" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Taka</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Bal. Type</span>
                            </div>
                            <select name="balance_type" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="Credit" {{ old('balance_type') == 'Credit'? 'selected':'' }}>Credit (Receivable)</option>
                                <option value="Debit" {{ old('balance_type') == 'Debit'? 'selected':'' }}>Debit (Payable)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        </div>
    </form>
</div>
