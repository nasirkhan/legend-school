<div class="modal-content">
    <form id="edit" action="{{ route('transaction-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id"/>
        <div class="modal-header">
            <h5 class="modal-title mb-0 text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i> Others Income Edit</h5>
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
                                <label class="input-group-text">Voucher Type</label>
                            </div>
                            <select class="custom-select" name="transaction_type" onchange="sectorWiseAccountList()" required>
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Sector</label>
                            </div>
                            <select class="custom-select select2" name="transaction_sector_id" onchange="sectorWiseAccountList()" required>
                                <option value="">--Select--</option>
                                @foreach(sectors() as $sector)
                                    <option value="{{ $sector->id }}" {{ old('transaction_sector_id') == $sector->id ? 'selected':'' }}>{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Account</label>
                            </div>
                            <select class="custom-select select2" name="transaction_item_id" required></select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Amount</span>
                            </div>
                            <input type="number" name="amount" onclick="this.select()" value="0" min="0" step="0.01" class="form-control" required/>
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
                                <span class="input-group-text">Remark</span>
                            </div>
                            <input type="text" name="remark" class="form-control" placeholder="If any  . . ."/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Via</span>
                            </div>
                            <input type="text" name="via" class="form-control" readonly/>
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
