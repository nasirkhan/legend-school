<div class="card-body">
    <h5 class="card-title text-primary mb-3">Select dates and click on <kbd>Get Report</kbd> button to get report</h5>
    <form class="" action="{{ route('date-wise-expense-report') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-5 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input type="date" class="form-control" name="from_date" value="{{ isset($from)? dateFormat($from,'Y-m-d') : date('Y-m-d') }}">
                </div>
            </div>
{{--            dateFormat($from,'m/d/Y')--}}
            <div class="col-lg-5 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input type="date" class="form-control" name="to_date" value="{{ isset($to)? dateFormat($to,'Y-m-d') : date('Y-m-d') }}">
                </div>
            </div>

{{--            <div class="col-lg-3 pr-lg-0 mt-2">--}}
{{--                <div class="input-group ">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Media</span>--}}
{{--                    </div>--}}
{{--                    <select class="form-control" name="media">--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        <option value="1">Cash</option>--}}
{{--                        <option value="2">Bank</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-file-alt"></i> Get Report </button>
            </div>
        </div>
    </form>
</div>
