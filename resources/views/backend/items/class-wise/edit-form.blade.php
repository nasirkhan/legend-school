<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Transaction Item Edit Form</h5>
    <form class="" action="{{ route('class-wise-item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">AC. Year</span>
                    </div>
                    <select class="form-control" name="year" required>
                        <option value="">--Select--</option>
                        @foreach(years() as $year)
                            <option value="{{ $year->year }}">{{ $year->year.' - '.$year->year+1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-lg-2 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    <select class="form-control" name="class_id" onchange="classWiseItems(this)" required>
                        <option value="">--Select--</option>
                        @foreach(activeAllClasses() as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item</span>
                    </div>
                    <select name="item_id" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach(transactionItems() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Amount</span>
                    </div>
                    <input type="number" name="amount" value="0" onclick="this.select()" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">Tk</span>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="">

            <div class="col col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
