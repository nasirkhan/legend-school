<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Models\Income;
use App\Models\Month;
use App\Models\NewPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class IncomeExpenseController extends Controller
{
    public function __construct(){

    }

    public function create(){
//        return Expense::with([
//            'month'=>function ($query) {$query->select('id','name');},
//            'item'=>function ($query) {$query->select('id','name');},
//        ])->get();

        $items = ExpenseItem::where('status',1)->get(['id','name']);
        $beneficiaries = Beneficiary::where('status',1)->get(['id','name']);
        return view('backend.expenses.create',compact('items','beneficiaries'));
    }

    public function index(){
        $items = Expense::where('status','!=',3)->get(['id','name','status']);
        return view('backend.expenses.manage',['items'=>$items]);
    }

    public function getExpenses(Request $request){
        $items = Expense::where(['status'=>1])->get(['id','name','status']);
        return response()->json($items);
    }

    public function store(Request $request){
        if ($request->post()){
            $beneficiary = Beneficiary::find($request->beneficiary_id);

            if (!$beneficiary){
                Alert::error('Error', 'Account not found');
                return back();
            }elseif ($beneficiary->status != 1){
                Alert::error('Error', 'Unable to make transaction to this account. Please contact to administrator');
                return back();
            }

            $this->paymentValidated($request);

            if($request->transaction_type==1){
                $item = new Income();
            }elseif ($request->transaction_type==2){
                $item = new Expense();
            }

            $item->year = $request->year;
            $item->month_id = $request->month_id;
            $item->item_id = $request->expense_item_id;
            $item->account_id = $request->beneficiary_id;
            $item->bearer = $request->bearer;
            $item->contact_no = $request->contact_number;
            $item->amount = $request->amount;
            $item->payment_method = $request->media;
            $item->reference = $request->reference;
            $item->note = $request->note;
            $item->creator_id = user()->id;
            if (isset($request->date)){
                $item->created_at = Carbon::parse($request->date)->format('Y-m-d H:i:s');
            }
            $item->save();

            Alert::toast('Transaction successful', 'success');
            return redirect('/make-transaction');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){

            $this->paymentValidated($request);

            if($request->transaction_type==1){
                $item = Income::find($request->id);
            }elseif ($request->transaction_type==2){
                $item = Expense::find($request->id);
            }

            $item->year = $request->year;
            $item->month_id = $request->month_id;
            $item->item_id = $request->expense_item_id;
            $item->account_id = $request->beneficiary_id;
            $item->bearer = $request->bearer;
            $item->contact_no = $request->contact_number;
            $item->amount = $request->amount;
            $item->payment_method = $request->media;
            $item->reference = $request->reference;
            $item->note = $request->note;
            $item->creator_id = user()->id;
            if (isset($request->date)){
                $item->created_at = Carbon::parse($request->date)->format('Y-m-d H:i:s');
            }
            $item->save();

            Alert::toast('Transaction updated successfully', 'success');;
            return back();
        }
    }

    protected function paymentValidated($request){
        $request->validate([
            'year'=>'required',
            'month_id'=>'required',
            'expense_item_id'=>'required',
            'beneficiary_id'=>'required',
            'transaction_type'=>'required',
            'amount'=>'required',
            'media'=>'required',
            'bearer'=>'required',
            'contact_no'=>'required',
        ],[
            'year.required'=>'Please select year',
            'month_id.required'=>'Please select month',
            'expense_item_id.required'=>'Please select an item from the list',
            'beneficiary_id.required'=>'Please select an account from the list',
            'transaction_type.required'=>'Please select transaction type',
            'amount.required'=>'Please enter amount',
            'media.required'=>'Please select payment media',
            'bearer.required'=>'Please enter bearer name',
            'contact_no.required'=>'Please enter bearer contact number'
        ]);
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $item = Expense::find($request->id);
            $item->status == 1 ? $item->status = 2 : $item->status = 1;
            $item->save();

            $item = Expense::where('id',$request->id)->first(['id','name','status']);

            $item->sl = $request->sl;
            $item->arrow = $item->status==1? 'up':'down';
            $item->btn = $item->status==1? 'success':'warning';
            $item->badge = $item->status==1? 'success':'danger';
            $item->badge_txt = $item->status==1? 'Active':'Close';
            $item->sa_title = 'Message';
            $item->sa_message = 'Expense Status Updated';
            $item->sa_icon = 'success';
            return $item;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $item = Expense::find($request->id);
            $item->status = 3;
            $item->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Expense Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function dateWiseExpenseReport(Request $request){
        // For today
        //        $startOfDay = Carbon::today()->startOfDay(); // 00:00:00
        //        $endOfDay   = Carbon::today()->endOfDay();   // 23:59:59

        // Or for a specific date
        //        $date = Carbon::parse('2025-09-22');
        //        $startOfDay = $date->copy()->startOfDay();
        //        $endOfDay   = $date->copy()->endOfDay();

        if ($request->post() and (!isset($request->from_date) or !isset($request->to_date))) {
            Alert::info('Info', 'Please select dates');
            return back();
        }

        if (!isset($request->from_date) and !isset($request->to_date)){
            $start = Carbon::today('Asia/Dhaka')->startOfDay();
            $end = Carbon::today('Asia/Dhaka')->endOfDay();
        }else{
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
        }

        $expenses = Expense::with([
            'month'=>function ($query) {$query->select('id','name');},
            'item'=>function ($query) {$query->select('id','name');},
            'account'=>function ($query) {$query->select('id','name','contact_number');},
        ])->whereBetween('created_at',[$start,$end])->get()->sortByDesc('created_at');


        $incomes = Income::with([
            'month'=>function ($query) {$query->select('id','name');},
            'item'=>function ($query) {$query->select('id','name');},
            'account'=>function ($query) {$query->select('id','name','contact_number');},
        ])->whereBetween('created_at',[$start,$end])->get()->sortByDesc('created_at');


//        $transactions = $expenses->merge($incomes);

        $transactions = [];

        foreach ($expenses as $expense){
            $expense->type = 'Expense';
            array_push($transactions,$expense);
        }

        foreach ($incomes as $income){
            $income->type = 'Income';
            array_push($transactions,$income);
        }


//        $test = usort($transactions, function($a, $b) {
//            return strtotime($a->created_at) <=> strtotime($b->created_at);
//        });

        //Ascending
        usort($transactions, function($a, $b) {
            return $a->created_at <=> $b->created_at;
        });

        //Descending
//        usort($transactions, function($a, $b) {
//            return $b->created_at <=> $a->created_at;
//        });

//        return $transactions;

        return view('backend.expenses.date-wise-expense-report',[
            'expenses'=>$expenses,
            'from'=>$start,
            'to'=>$end,
            'transactions'=>$transactions,
        ]);
//        Expense::whereIn('status',[1,2])->whereBetween('created_at',[$start,$end])->get();
    }

    public function monthWiseExpenseReport(Request $request){
        if (user()->role->code=='developer' or user()->role->code=='s_admin' or user()->role->code=='accountant'){
            if ($request->post() and (!isset($request->year) or !isset($request->month_id))) {
                Alert::info('Info', 'Please select year and month');
                return back();
            }

            $year = ''; $monthId = '';

            if (!isset($request->year) and !isset($request->month_id)) {
                $year = Session::get('year'); $monthId = Session::get('month_id');
            } else{
                $year = $request->year; $monthId = $request->month_id;
            }

            if ($monthId=='all'){
                $expenses = Expense::with([
                    'month'=>function ($query) {$query->select('id','name');},
                    'item'=>function ($query) {$query->select('id','name');},
                    'account'=>function ($query) {$query->select('id','name','contact_number');},
                ])->where(['year'=>$year,])->get()->sortByDesc('created_at');
            }else{
                $expenses = Expense::with([
                    'month'=>function ($query) {$query->select('id','name');},
                    'item'=>function ($query) {$query->select('id','name');},
                    'account'=>function ($query) {$query->select('id','name','contact_number');},
                ])->where(['year'=>$year, 'month_id'=>$monthId,])->get()->sortByDesc('created_at');
            }

            if ($monthId=='all'){
                $incomes = Income::with([
                    'month'=>function ($query) {$query->select('id','name');},
                    'item'=>function ($query) {$query->select('id','name');},
                    'account'=>function ($query) {$query->select('id','name','contact_number');},
                ])->where(['year'=>$year,])->get()->sortByDesc('created_at');
            }else{
                $incomes = Income::with([
                    'month'=>function ($query) {$query->select('id','name');},
                    'item'=>function ($query) {$query->select('id','name');},
                    'account'=>function ($query) {$query->select('id','name','contact_number');},
                ])->where(['year'=>$year, 'month_id'=>$monthId,])->get()->sortByDesc('created_at');
            }

            $transactions = [];

            foreach ($expenses as $expense){
                $expense->type = 'Expense';
                array_push($transactions,$expense);
            }

            foreach ($incomes as $income){
                $income->type = 'Income';
                array_push($transactions,$income);
            }

            //Ascending
            usort($transactions, function($a, $b) {
                return $a->created_at <=> $b->created_at;
            });

            if ($monthId=='all'){
                $month = 'All Months';
                $studentPayments = NewPayment::whereYear('created_at',$year)->get(['received']);
            }elseif ($monthId==''){
                $month = '';
                $studentPayments = NewPayment::whereYear('created_at',$year)->get(['received']);
            } else{
                $month = Month::find($monthId)->name;
                $monthNumber = Carbon::parse("1 $month")->month;
                $studentPayments = NewPayment::whereMonth('created_at',$monthNumber)->whereYear('created_at',$year)->get(['received']);
            }

            $totalTuitionFee = $studentPayments->sum('received');

            return view('backend.expenses.month-wise-expense-report',compact('year','month','transactions','totalTuitionFee'));
        }else{
            abort(403);
        }
    }

    public function itemWiseExpenseReport(Request $request){
        //Post Request
        if ($request->post() and (!isset($request->year) or !isset($request->month_id) or !isset($request->expense_item_id))) {
            Alert::info('Info', 'Please select year, month and expense item');
            return back();
        }

        $expenseItems = ExpenseItem::where(['status'=>1])->get(['id','name']);

        $year = ''; $monthId = ''; $itemId = ''; $transactionType = ''; $modelName = 'App\Models\\';
        if (!isset($request->year) and !isset($request->month_id) and !isset($request->expense_item_id)) {
            $year = Session::get('year');
            $monthId = Session::get('month_id');
            $itemId = Session::get('expense_item_id');
            $transactionType = Session::get('transaction_type');
        } else{
            $year = $request->year;
            $monthId = $request->month_id;
            $itemId = $request->expense_item_id;
            $transactionType = $request->transaction_type;
        }

        if ($transactionType=='income'){
            $modelName .= 'Income'; // double backslash or single with string
        }elseif ($transactionType=='expense'){
            $modelName .= 'Expense';
        }

//        $data = $modelName::all();
//
//        return $data;

        if($year!='' and $monthId!='' and $itemId!=''){
            if ($monthId=='all'){
                if ($itemId=='all'){
                    $expenses = $modelName::with([
                        'month'=>function ($query) {$query->select('id','name');},
                        'item'=>function ($query) {$query->select('id','name');},
                        'account'=>function ($query) {$query->select('id','name','contact_number');},
                    ])
                        ->where(['year'=>$year,])
                        ->get()->sortBy('item_id')
                        ->sortByDesc('created_at')->groupBy('item_id');
                }else{
                    $expenses = $modelName::with([
                        'month'=>function ($query) {$query->select('id','name');},
                        'item'=>function ($query) {$query->select('id','name');},
                        'account'=>function ($query) {$query->select('id','name','contact_number');},
                    ])
                        ->where(['year'=>$year, 'item_id'=>$itemId])
                        ->get()->sortBy('item_id')
                        ->sortByDesc('created_at')->groupBy('item_id');
                }
            }else{
                if ($itemId=='all'){
                    $expenses = $modelName::with([
                        'month'=>function ($query) {$query->select('id','name');},
                        'item'=>function ($query) {$query->select('id','name');},
                        'account'=>function ($query) {$query->select('id','name','contact_number');},
                    ])
                        ->where(['year'=>$year, 'month_id'=>$monthId,])
                        ->get()->sortBy('item_id')
                        ->sortByDesc('created_at')->groupBy('item_id');
                }else{
                    $expenses = $modelName::with([
                        'month'=>function ($query) {$query->select('id','name');},
                        'item'=>function ($query) {$query->select('id','name');},
                        'account'=>function ($query) {$query->select('id','name','contact_number');},
                    ])
                        ->where(['year'=>$year, 'month_id'=>$monthId, 'item_id'=>$itemId])
                        ->get()->sortBy('item_id')
                        ->sortByDesc('created_at')->groupBy('item_id');
                }
            }

            if ($monthId=='all'){
                $month = 'All Months';
            }else{
                $month = Month::find($monthId)->name;
            }
            return view('backend.expenses.item-wise-expense-report',compact('year','monthId','itemId','expenses','expenseItems','month','transactionType'));
        }else{
            return view('backend.expenses.item-wise-expense-report',[
                'year'=>date('Y'),
                'monthId'=>null,
                'itemId'=>null,
                'expenses'=>[],
                'expenseItems'=>$expenseItems,
                'month'=>date('M'),
                'transactionType'=>$transactionType,
            ]);
        }
    }

    protected function getInvoicesForReportingNew($from,$to,$status,$classId){
        $upto = Carbon::parse($to)->addDay();
        if ($classId != 'all'){ return NewPayment::with([
            'student'=>function($q){$q->select('id','name','roll');},
            'class'=>function($q){$q->select('id','name');},
            'methods'=>function ($query) {$query->select('id','method','amount','account_number','transaction_id','new_payment_id');},
            'studentPaymentItems'=>function($q){$q->with([
                'item'=>function ($q) {$q->select('id','name','billing_cycle');},
                'month'=>function ($q) {$q->select('id','name');},
            ])->select('id','amount','lab_fee','discount','receivable','late_fee','payment_id','item_id','month_id','due_date');}
        ])->where(['status'=>$status,'class_id'=>$classId])->whereBetween('created_at',[$from,$upto])->get()->sortByDesc('created_at');}
        else{ return NewPayment::with([
            'student'=>function($q){$q->select('id','name','roll');},
            'class'=>function($q){$q->select('id','name');},
            'methods'=>function ($query) {$query->select('id','method','amount','account_number','transaction_id','new_payment_id');},
            'studentPaymentItems'=>function($q){$q->with([
                'item'=>function ($q) {$q->select('id','name','billing_cycle');},
                'month'=>function ($q) {$q->select('id','name');}
            ])->select('id','amount','lab_fee','discount','receivable','late_fee','payment_id','item_id','month_id','due_date');}
        ])->where(['status'=>$status])->whereBetween('created_at',[$from,$upto])->get()->sortByDesc('created_at');}
    }
}
