@if(isset($totalTuitionFee))
    <h6 class="text-primary"><i class="fa fa-edit"></i> Student Tuition Fees</h6>
    <table class="table table-bordered table-sm dt-responsive mb-3">
        <tr>
            <th>Description</th>
            <th class="text-right">Amount</th>
        </tr>
        <tr>
            <td>Total Tuition Fee Collection</td>
            <th class="text-right">{{ number_format($totalTuitionFee) }}</th>
        </tr>
    </table>
@endif

<h6 class="text-primary"><i class="fa fa-edit"></i> Other Income-Expense</h6>

<table id="datatable" class="table table-bordered table-sm dt-responsive mb-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th class="text-center" style="width: 40px">Sl</th>
        <th style="width: 200px">Description</th>
        <th>Account Holder</th>
{{--        <th>Bearer</th>--}}
{{--        <th>Contact</th>--}}
        <th>Date</th>
        <th>Media</th>
        <th>Note</th>
        <th class="text-right">Received(Tk)</th>
        <th class="text-right">Paid(Tk)</th>
{{--        @if($role=='developer' or $role=='s_admin')--}}
{{--            <th class="text-right">Option</th>--}}
{{--        @endif--}}
    </tr>
    </thead>
    <tbody>
    @php($totalIncome = 0)
    @php($totalExpense = 0)

    @foreach($transactions as $expense)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ $sl }}</td>
            <td>
                {{ $expense->item->name }}
                @if($expense->month_id !== null) : {{ $expense->month->name }}-{{ $expense->year }}@endif
            </td>

            <td>{{ $expense->account->name }}</td>
{{--            <td>{{ $expense->bearer }}</td>--}}
{{--            <td>{{ $expense->contact_no }}</td>--}}
            <td>{{ date_format($expense->created_at,'d/m/Y') }}</td>
            <td>{{ $method = paymentMethod($expense->payment_method) }} @if($method!='Cash') : {{ $expense->reference }} @endif </td>
            <td>{{ $expense->note }}</td>
            <td class="text-right">
                @if($expense->type=='Income')
                    {{ number_format($expense->amount) }}
                    @php($totalIncome += $expense->amount)

                @endif
            </td>

            <td class="text-right">
                @if($expense->type=='Expense')
                    {{ number_format($expense->amount) }}
                    @php($totalExpense += $expense->amount)
                @endif
            </td>

{{--            @if($role=='developer' or $role=='s_admin')--}}
{{--                <td class="text-right">--}}
{{--                    <button onclick="edit({--}}
{{--                item: JSON.stringify({{ $expense }})--}}
{{--                })" class="btn btn-sm btn-primary mb-sm-1">--}}
{{--                        <i class="fa fa-edit"></i>--}}
{{--                    </button>--}}

{{--                    <button onclick="itemDeleteConfirmation('{{ $expense->id }}','{{ $sl }}')" class="btn btn-sm btn-danger mb-sm-1" id="sa-params">--}}
{{--                        <i class="fa fa-trash-alt"></i>--}}
{{--                    </button>--}}
{{--                </td>--}}
{{--            @endif--}}
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="6" class="text-center">Total</th>
        <th class="text-right">{{ number_format($totalIncome) }}</th>
        <th class="text-right">{{ number_format($totalExpense) }}</th>
{{--        @if($role=='developer' or $role=='s_admin')--}}
{{--            <th></th>--}}
{{--        @endif--}}
    </tr>
    </tfoot>
</table>

@if(isset($totalTuitionFee))
    <h6 class="text-primary font-weight-bold"><i class="fa fa-file-alt"></i> Income-Expense Summary</h6>
    <table class="table table-bordered table-sm dt-responsive mb-3">
        <tr>
            <td>Student Fees Collection</td>
            <td class="text-right">{{ number_format($totalTuitionFee) }}</td>
        </tr>
        <tr>
            <td>Other Income</td>
            <td class="text-right">{{ number_format($totalIncome) }}</td>
        </tr>
        <tr>
            <td>Total Expense</td>
            <td class="text-right">{{ number_format($totalExpense) }}</td>
        </tr>

        @php($balance = $totalTuitionFee+$totalIncome-$totalExpense)

        <tr class="{{ $balance>0? 'bg-success' : 'bg-danger' }}  text-white">
            <th>Total Balance</th>
            <th class="text-right">{{ number_format($balance) }}</th>
        </tr>
    </table>
@endif
