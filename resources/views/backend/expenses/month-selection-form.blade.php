<div class="card-body">
    <h5 class="card-title text-primary mb-3">Select Year and Month and then click on <kbd>Get Report</kbd> button to get report</h5>
    <form class="" action="{{ route('month-wise-expense-report') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-5 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year" required>
                        <option value="">--Select--</option>
                        @foreach(activeYears() as $year)
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected':'' }}>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-5 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month</span>
                    </div>
                    <select class="form-control" name="month_id" required>
                        <option value="">--Select--</option>
                        <option value="all" {{ Session::get('month_id') == 'all' ? 'selected':'' }}>All Months</option>
                        @foreach(months() as $month)
                            <option value="{{ $month->id }}" {{ Session::get('month_id') == $month->id ? 'selected':'' }}>{{ $month->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

{{--            <div class="col-lg-4 pr-lg-0">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Transaction Type</span>--}}
{{--                    </div>--}}
{{--                    <select class="form-control" name="transaction_type" required>--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        <option value="income" {{ Session::get('transaction_type') == 'income' ? 'selected':'' }}>Income</option>--}}
{{--                        <option value="expense" {{ Session::get('transaction_type') == 'expense' ? 'selected':'' }}>Expense</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

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
