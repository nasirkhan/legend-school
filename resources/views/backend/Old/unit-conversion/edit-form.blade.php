<div class="modal-content">
    <form id="edit" action="{{ route('unit-conversion-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id"/>
        <div class="modal-header">
            <h5 class="modal-title mb-0 text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Unit Conversion Relation Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-0">

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">From</span>
                            </div>
                            <select name="from" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach(units() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">To</span>
                            </div>
                            <select name="to" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach(units() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Factor</span>
                            </div>
                            <input type="text" name="factor" class="form-control" value="" placeholder="factor">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        </div>
    </form>
</div>
