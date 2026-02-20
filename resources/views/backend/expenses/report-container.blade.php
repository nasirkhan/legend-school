<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
{{--                <h4 class="card-title text-primary">--}}
{{--                    <i class="fa fa-edit"></i>--}}
{{--                   Income-Expense report : From {{ dateFormat($from,'jS M-Y') }} To {{ dateFormat($to,'jS M-Y') }}--}}
{{--                </h4>--}}
                <div id="table" class="table-responsive">
                    @include('backend.expenses.expense-table')
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
