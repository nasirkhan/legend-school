<?php

use App\Http\Controllers\NumberToBanglaWord;
use App\Models\DBLog;
use App\Models\LatestNews;
use MirazMac\BanglaString\BanglaString;

function activeSlides(){
    return App\Models\Slide::where('status',1)->get()->sortBy('position');
}

function activeLeaders(){
    return App\Models\Leader::where('status',1)->get();
}

function activeTestimonilas(){
    return App\Models\Testimonial::where('status',1)->get();
}

function checkSubject($studentId,$classId,$subjectId){
    $result = App\Models\StudentClassSubject::where([
        'student_id'=>$studentId, 'class_id'=>$classId, 'subject_id'=>$subjectId
    ])->first();

    if (isset($result)){
        return true;
    }else{
        return false;
    }
}

function classRoutine($classId){
    return App\Models\ClassRoutine::where('class_id',$classId)->first();
}

function instagramFeed($number){
    return App\Models\GalleryImage::where('status',1)->take($number)->latest()->get();
}

function dp($value){
    $array = explode('.',"$value",2);
    $dp = 0;
    if (isset($array[1])){
        $dp = strlen($array[1]);
    }
    return $dp;
}

function bengaliNumber($number,$dp=null){
    $incomingNumber = number_format($number,$dp,'.',',');
    $number = new BanglaString("$incomingNumber");
    return $number->toAvro();
}

function bengaliString($string){
    $bengaliString = new BanglaString("$string");
    return $bengaliString->toAvro();
}

function inWord($number){
    $obj = new NumberToBanglaWord();
    $amount = $number;
    $amount  = floatval($amount);

    $intAmount = intval($amount);
    $floatAmount = floatval($amount);
    if ($floatAmount>$intAmount){
        $amountInWord = $obj->numToWord($floatAmount);
        return $amountInWord;
    }else{
        $amountInWord = $obj->numToWord($intAmount);
        return $amountInWord;
    }
}

function numberWithCommaSeparator($number, $dp=null){
    return number_format($number,$dp,'.',',');
}

function dateFormat($date,$format){
    return Carbon\Carbon::parse($date)->format($format);
}

function models(){
    $models = []; $path = './../app/Models/'; $files = scandir($path);
    foreach ($files as $file){
        if (strlen($file)>2){
            $split = explode('.',$file);
            $modelName = $split[0];
            array_push($models,$modelName);
        }
    }
    return $models;
}

function user(){
    return Auth::user();
}

function role(){
    return user()->role;
}

function fileUpload($file,$directory){
    $name = $file->getClientOriginalName();
    $filename = time().'_'.$name;
    $fileDirectory = 'assets/app/'.$directory.'/';
    $file->move($fileDirectory,$filename);
    return $fileDirectory.$filename;
}

function categories(){return App\Models\Category::all();}

function brands(){
    return App\Models\Brand::all('id','name','code');
}

function measurementCategories(){
    return App\Models\MeasurementCategory::all();
}

function units(){
    return App\Models\Unit::all('id','name','code','measurement_category_id');
}

function activeClientTypes(){
    return App\Models\ClientType::where(['status'=>1])->get(['id','name','bn_name']);
}

function activeBanks(){
    return App\Models\Bank::where('status','!=',3)->get(['id','name','code']);
}

function activeBankAccounts(){
    return App\Models\BankAccount::with('bank')->where('status','!=',3)->get();
}

function products(){
     return App\Models\Product::all('id','name');
}

function activeClient($type){
    return App\Models\Client::where([
        'type'=>$type,
        'status'=>1
    ])->get(['id','name']);
}

function bankPayment($request,$title,$amount){
    $transaction = new App\Models\BankTransaction();
    $transaction->account_id = $request->bank_account_id;
    $transaction->title = $title;
    $transaction->amount = $amount;
    $client = App\Models\Client::find($request->client_id);
    if ($client->type=='Supplier'){
        $transaction->particular = "Supplier's Bill Paid";
    }elseif ($client->type=='Customer'){
        $transaction->particular = "Customer's Bill Collection";
    }
    $transaction->transactor = $client->name;
    $transaction->contact = $client->mobile;
    $transaction->related_model = "ClientPayment";
    $transaction->related_id = null;
    $transaction->user_id = user()->id;
    $transaction->save();
    return $transaction->id;
}

//function clientPayment($clientId,$type,$model=null,$rowId=null,$amount,$title,$media,$bankPaymentId=null){
//    $payment = new App\Models\ClientPayment();
//    $payment->client_id = $clientId;
//    $payment->payment_type = $type;
//    $payment->model = $model;
//    $payment->row_id = $rowId;
//    $payment->amount = $amount;
//    $payment->title = $title;
//    $payment->media = $media;
//    $payment->bank_payment_id = $bankPaymentId;
//    $payment->user_id = user()->id;
//    $payment->save();
//    return $payment->id;
//}

function journal($model,$rowId,$amount,$title,$ledger,$finalTable,$date=null){
    $journal = new App\Models\Journal();
    $journal->model = $model;
    $journal->row_id = $rowId;
    $journal->amount = $title;
    $journal->title = $amount;
    $journal->ledger = $ledger;
    $journal->final_table = $finalTable;
    $journal->unique_id = $rowId.'_'.$model.'_'.uniqid();
    $journal->save();
}

function purchaseInvoices(){
    return App\Models\Purchase::with('product','unit')->get();
}

function cartProductCost(){
    $totalProductCost = 0;
    foreach (Cart::content() as $item){
        $totalProductCost += $item->qty*$item->price;
    }
    return $totalProductCost;
}

function sold($purchaseId, $date = null){
    if ($date != null){
        $soldItems = App\Models\SaleDetails::where([
            'purchase_id'=>$purchaseId,
            'status'=>1
        ])->where('created_at','<=',$date)->get();
    }else{
        $soldItems = App\Models\SaleDetails::where([
            'purchase_id'=>$purchaseId,
            'status'=>1
        ])->get();
    }

    return $soldItems->sum('quantity');
}

function order($purchaseId, $date = null){
    if ($date != null){
        $soldItems = App\Models\SaleDetails::where([
            'purchase_id'=>$purchaseId,
            'status'=>2
        ])->where('created_at','<=',$date)->get();
    }else{
        $soldItems = App\Models\SaleDetails::where([
            'purchase_id'=>$purchaseId,
            'status'=>2
        ])->get();
    }


    return $soldItems->sum('quantity');
}

function presentStock($purchaseId){
    $purchased = App\Models\Purchase::find($purchaseId)->quantity;
    $sold = sold($purchaseId);
    $order = order($purchaseId);
    $presentStock = $purchased - ($sold+$order);
    return $presentStock;
}

function productStock($productId,$startDate=null,$endDate=null){
    $product = App\Models\Product::find($productId);
    $times = conversionFactor($productId);

    $totalStock = $product->initial_quantity; $rate = $product->rate;
    if ($startDate!=null and $endDate!=null){
        $totalStock = 0;
    }
    if ($startDate!=null and $endDate!=null){
        $purchases = App\Models\PurchaseDetail::where('product_id',$productId)->whereBetween('created_at',[$startDate,$endDate])->get();
    }elseif ($startDate==null and $endDate!=null){
        $purchases = App\Models\PurchaseDetail::where('product_id',$productId)->where('created_at','<=',$endDate)->get();
    }else{
        $purchases = App\Models\PurchaseDetail::where('product_id',$productId)->get();
    }

    $totalStock += $purchases->sum('quantity');
    $cost = $totalStock*$rate;
    if (count($purchases)>0){
        foreach ($purchases as $purchase){
            $cost += $purchase->quantity*$purchase->rate;
        }

        $groups = $purchases->groupBy('purchase_id');
        foreach ($groups as $key => $group){
            $mainPurchase = App\Models\Purchase::find($key);
            $cost += ($mainPurchase->transport_cost+$mainPurchase->labour_cost-$mainPurchase->discount);
        }

        $rate = $cost / $totalStock;
    }
    if ($startDate!=null and $endDate!=null){
        $sales = App\Models\SaleDetails::where(['product_id'=>$productId, 'status'=>1])->whereBetween('created_at',[$startDate,$endDate])->get();
    }elseif ($startDate==null and $endDate!=null){
        $sales = App\Models\SaleDetails::where(['product_id'=>$productId, 'status'=>1])->where('created_at','<=',$endDate)->get();
    }else{
        $sales = App\Models\SaleDetails::where(['product_id'=>$productId, 'status'=>1])->get();
    }

    $totalStock -= $sales->sum('quantity')/$times;

    return $result = [
        'quantity'=>$totalStock,
        'rate'=>($rate/$times)
    ];
}

function saleOrder($productId){
    $sales = App\Models\SaleDetails::where([
        'product_id'=>$productId,
        'status'=>2
    ])->get()->sum('quantity');

    return $sales;
}

function clientBalance($clientId, $date=null){
    $client = App\Models\Client::find($clientId);
    $initialBalance = $client->initial_balance; $balance = $initialBalance;
    $balanceTitle = $client->balance_type; $title = $balanceTitle;

    if ($date != null){
        $clientPayments = App\Models\ClientPayment::where(['client_id'=>$clientId])->where('created_at','<=',$date)->get();
    }else{
        $clientPayments = App\Models\ClientPayment::where(['client_id'=>$clientId])->get();
    }

    $totalPayment = $clientPayments->sum('amount'); $totalBill = 0;

    if ($client->type=='Supplier'){
        if ($date != null){
            $purchases = App\Models\Purchase::where(['client_id'=>$clientId])->where('created_at','<=',$date)->get();
        }else{
            $purchases = App\Models\Purchase::where(['client_id'=>$clientId])->get();
        }

        $totalBill = $purchases->sum('total');
        $due = $totalBill - $totalPayment;
        if ($balanceTitle=='Debit'){
            if ($due>0){
                $balance += $due; $title = 'Debit';
            }else{
                $balance -= abs($due);
                $balance>0 ? $title='Debit':'Credit';
            }
        }else{
            if ($due>0){
                $balance -= $due;
                $balance>0 ? $title='Credit':'Debit';
            }else{
                $balance += abs($due); $title = 'Credit';
            }
        }
    }else if ($client->type=='Customer'){
        if ($date != null){
            $sales = App\Models\Sale::where(['client_id'=>$clientId,'status'=>1])->where('created_at','<=',$date)->get();
        }else{
            $sales = App\Models\Sale::where(['client_id'=>$clientId,'status'=>1])->get();
        }

        $totalBill = $sales->sum('total');
        $due = $totalBill - $totalPayment;
        if ($balanceTitle=='Credit'){
            if ($due>0){
                $balance += $due; $title = 'Credit';
            }else{
                $balance -= abs($due);
                $balance>0 ? $title='Credit':'Debit';
            }
        }else{
            if ($due>0){
                $balance -= $due;
                $balance>0 ? $title='Debit':'Credit';
            }else{
                $balance += abs($due); $title = 'Debit';
            }
        }
    }

    $result = [
        'balance'=>abs($balance),
        'title'=>$title,
    ];

    return $result;
}

function conversionFactor($productId){
    $product = App\Models\Product::find($productId);

    $conversionFactor = App\Models\UnitConversion::where([
        'from'=>$product->unit_id,
        'to'=>$product->secondary_unit_id
    ])->first();

    if(isset($conversionFactor)){
        return $conversionFactor->times;
    }else{
        return 1;
    }
}

function balanceCalculate($balance,$title,$payment){
    $newBalance = $balance; $newTitle = $title;
    if ($payment->model=='Purchase'){
        $bill = App\Models\Purchase::find($payment->row_id)->total;
    }else{
        $bill = App\Models\Sale::find($payment->row_id)->total;
    }

    $extra = $bill - $payment->amount;

    $newBalance = $balance + $extra;

    if ($title=='Debit'){
        if ($newBalance>0){
            $newTitle = 'Debit';
        }else{
            $newTitle = 'Credit';
        }
    }else{
        if ($newBalance>0){
            $newTitle = 'Credit';
        }else{
            $newTitle = 'Debit';
        }
    }

    $result = [
        'balance'=>abs($newBalance),
        'title'=>$newTitle,
    ];

    return $result;
}

function clientLastBalance($clientId,$paymentId=null){
    $client = App\Models\Client::find($clientId);
    if ($paymentId!=null){
        $payment = App\Models\ClientPayment::find($paymentId);
    }

    $totalBill = 0; $totalPayment = 0; $balance = 0; $title = '';
    $initialBalance = $client->initial_balance;
    $balanceType = $client->balance_type;
    $clientType = $client->type;

    if ($clientType=='Customer'){
        if ($paymentId!=null){
            $sales = App\Models\Sale::where([
                'client_id'=>$clientId
            ])->where('created_at','<',dateFormat($payment->created_at,'Y-m-d H:i:s'))->get();
        }else{$sales = App\Models\Sale::where(['client_id'=>$clientId])->get();}
        $totalBill = ($sales->sum('product_cost')+$sales->sum('vat')-$sales->sum('discount'));
    }elseif($clientType=='Supplier'){
        if ($paymentId!=null){
            $purchases = App\Models\Purchase::where([
                'client_id'=>$clientId
            ])->where('created_at','<',dateFormat($payment->created_at,'Y-m-d H:i:s'))->get();
        }else{$purchases = App\Models\Purchase::where(['client_id'=>$clientId])->get();}
        $totalBill = ($purchases->sum('product_cost')-$purchases->sum('discount'));
    }

    if ($paymentId!=null){
        $payments = App\Models\ClientPayment::where([
            'client_id'=>$clientId
        ])->where('created_at','<',dateFormat($payment->created_at,'Y-m-d H:i:s'))->get();
    }else{$payments = App\Models\ClientPayment::where(['client_id'=>$clientId])->get();}
    $totalPayment = $payments->sum('amount');

    $due = ($totalBill-$totalPayment);

    if ($clientType=='Supplier'){
        if ($balanceType=='Credit'){    /* আমার পাওনা আছে */
            if ($due<0){                /* আমি বেশী পরিশোধ করেছি */
                $balance = ($initialBalance + abs($due));   /* আমার পাওনা বেড়ে গেল */
                $title = 'Credit';
            }else{
                $balance = ($initialBalance - $due);   /* আমার দেনা আছে */
                if ($balance<0){$title = 'Debit';}else{$title = 'Credit';}
            }
        }elseif($balanceType=='Debit'){ /* আমার দেনা আছে */
            if ($due>0){                /* আমি কম পরিশোধ করেছি */
                $balance = ($initialBalance + $due);    /* আমার দেনা বেড়ে গেল */
                $title = 'Debit';
            }else{                      /* আমি বেশী পরিশোধ করেছি */
                $balance = ($initialBalance - abs($due));   /* আমার দেনা কমে গেল */
                if ($balance<0){        /* আমার পাওনা আছে */
                    $title = 'Credit';
                }else{
                    $title = 'Debit';   /* আমার দেনা আছে */
                }
            }
        }
    }elseif($clientType=='Customer'){
        if ($balanceType=='Credit'){    /* আমার পাওনা আছে */
            if ($due<0){                /* আমি বেশী আদায় করেছি */
                $balance =  ($initialBalance - abs($due));   /* আমার পাওনা কমে গেল */
                if ($balance<0){        /* আমার দেনা আছে */
                    $title = 'Debit';
                }else{                  /* আমার পাওনা আছে */
                    $title = 'Credit';
                }
            }else{                      /* আমি কম আদায় করেছি */
                $balance = ($initialBalance + $due);    /* আমার পাওনা বেড়ে গেল */
                $title = 'Credit';
            }
        }elseif($balanceType=='Debit'){ /* আমার দেনা আছে */
            if ($due>0){                /* আমি কম আদায় করেছি */
                $balance = ($initialBalance - $due);    /* আমার দেনা কমে গেল */
                if ($balance<0){        /* আমার পাওনা আছে */
                    $title = 'Credit';
                }else{                  /* আমার দেনা আছে */
                    $title = 'Debit';
                }
            }else{                      /* আমি বেশী আদায় করেছি */
                $balance = ($initialBalance + abs($due));   /* আমার দেনা কমে গেল */
                $title = 'Debit';
            }
        }
    }

    $result = ['balance'=>abs($balance), 'title'=>$title];
//    $result = ['balance'=>abs($balance), 'title'=>$client->balance_type];
    return $result;
}

function customerNewBalance($due,$lastBalance){
    $balance = 0; $title = '';
    if ($lastBalance['title']=='Credit'){   /* আমার পাওনা আছে */
        if ($due<0){                        /* আমি বেশী আদায় করেছি */
            $balance =  ($lastBalance['balance'] - abs($due));   /* আমার পাওনা কমে গেল */
            if ($balance<0){                /* আমার দেনা আছে */
                $title = 'Debit';
            }else{                          /* আমার পাওনা আছে */
                $title = 'Credit';
            }
        }else{                              /* আমি কম আদায় করেছি */
            $balance = ($lastBalance['balance'] + $due);    /* আমার পাওনা বেড়ে গেল */
            $title = 'Credit';
        }
    }elseif ($lastBalance['title']=='Debit'){   /* আমার দেনা আছে */
        if ($due>0){                            /* আমি কম আদায় করেছি */
            $balance =  ($lastBalance['balance'] - $due);   /* আমার দেনা কমে গেল */
            if ($balance<0){                /* আমার পাওনা আছে */
                $title = 'Credit';
            }else{                          /* আমার দেনা আছে */
                $title = 'Debit';
            }
        }else{                              /* আমি বেশী আদায় করেছি */
            $balance = ($lastBalance['balance'] + abs($due));    /* আমার দেনা বেড়ে গেল */
            $title = 'Debit';
        }
    }

    $result = [
        'balance'=>abs($balance),
        'title'=>$title,
    ];

    return $result;
}

function supplierNewBalance($due,$lastBalance){
    $balance = 0; $title = '';
    if ($lastBalance['title']=='Credit'){   /* আমার পাওনা আছে */
        if ($due<0){                        /* আমি বেশী পরিশোধ করেছি */
            $balance =  ($lastBalance['balance'] + abs($due));   /* আমার পাওনা বেড়ে গেল */
            $title = 'Credit';
        }else{                              /* আমি কম পরিশোধ করেছি */
            $balance = ($lastBalance['balance'] - $due);    /* আমার পাওনা কমে গেল */
            if ($balance<0){                /* আমার দেনা আছে */
                $title = 'Debit';
            }else{                          /* আমার পাওনা আছে */
                $title = 'Credit';
            }
        }
    }elseif ($lastBalance['title']=='Debit'){   /* আমার দেনা আছে */
        if ($due>0){                            /* আমি কম পরিশোধ করেছি */
            $balance = ($lastBalance['balance'] + $due);    /* আমার দেনা বেড়ে গেল */
            $title = 'Debit';
        }else{                              /* আমি বেশী পরিশোধ করেছি */
            $balance =  ($lastBalance['balance'] - abs($due));   /* আমার দেনা কমে গেল */
            if ($balance<0){                /* আমার পাওনা আছে */
                $title = 'Credit';
            }else{                          /* আমার দেনা আছে */
                $title = 'Debit';
            }
        }
    }

    $result = [
        'balance'=>abs($balance),
        'title'=>$title,
    ];

    return $result;
}

function memoNo($no){
    $memoNo = $no;
    if ($no<10){
        $memoNo = '000'.$no;
    }elseif($no<100){
        $memoNo = '00'.$no;
    }elseif ($no<1000){
        $memoNo = '0'.$no;
    }
    return $memoNo;
}

function sales($status){
    return App\Models\Sale::with('details')->where(['status'=>$status])->get();
}

function totalSale($type,$status,$date=null){
    if ($date!=null){
        $start = dateFormat($date,'Y-m-d').' 0:00:00';
        $end = dateFormat($date,'Y-m-d').' 23:59:59';
        $result = App\Models\Sale::where([
            'sale_type'=>$type,
            'status'=>$status
        ])->whereBetween('created_at',[$start,$end])->get();
    }else{
        $result = App\Models\Sale::where([
            'sale_type'=>$type,
            'status'=>$status
        ])->get();
    }
    return $result;
}

function totalPurchase($date,$interval=null){
    if ($interval==null){
        $start = dateFormat($date,'Y-m-d').' 0:00:00';
        $end = dateFormat($date,'Y-m-d').' 23:59:59';
    }else{
        $start = Carbon\Carbon::parse($date)->subDays($interval);
        $end = dateFormat($date,'Y-m-d').' 23:59:59';
    }

    $result = App\Models\Purchase::where([
    ])->whereBetween('created_at',[$start,$end])->get();

    return $result;
}

function  numberFormat($number,$dp=null,$separator=null){
    if ($dp!=null){$decimal = $dp;}else{$decimal = 0;}

    if ($separator!==null){
        $thousandSeparator = $separator;
    }else{$thousandSeparator=',';}

    return number_format($number,$decimal,'.',$thousandSeparator);
}

function avearge($mark,$total,$dp=null){
    if ($total==0){return 0;}
    if ($dp!=null){$decimal = $dp;}else{$decimal = 0;}
    $average = ($mark/$total)*100;
    return number_format($average,$decimal,'.',',');
}

function autoMark($average,$number,$dp=null){
    if ($average==0){return 0;}
    if ($dp!=null){$decimal = $dp;}else{$decimal = 0;}
    $autoMark = ($average/100)*$number;
    return number_format($autoMark,$decimal,'.',',');
}

function grade($mark,$class=null){
    if ($mark>=90){
        if ($class === null){
            return 'A*';
        }elseif ($class =='AS' or $class=='XI'){
            return 'A';
        }
    }
    elseif($mark<90 and $mark>=80){return 'A';}
    elseif($mark<80 and $mark>=70){return 'B';}
    elseif($mark<70 and $mark>=60){return 'C';}
    elseif($mark<60 and $mark>=50){return 'D';}
    elseif($mark<50 and $mark>=40){return 'E';}
    elseif($mark<40 and $mark>=0){return 'U';}
}

function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

function bankBalance($accountId){
    $account = App\Models\BankAccount::find($accountId);
    $totalCredit = App\Models\BankTransaction::where(['account_id'=>$accountId,'title'=>'Credit'])->get()->sum('amount');
    $totalDebit = App\Models\BankTransaction::where(['account_id'=>$accountId,'title'=>'Debit'])->get()->sum('amount');
    $balance = $account->initial_balance;

    $balance += $totalDebit;

    $balance -= $totalCredit;

    return $balance;
}

function clientType(){
    return App\Models\ClientType::all('name');
}

function sectors(){
    return App\Models\TransactionSector::where('status','=',1)->get(['id','name']);
}

function activeLoans(){
    return App\Models\BankLoan::with('bank')->where('status',1)->get();
}

function loanBalance($loanId, $date=null){
    $loan = App\Models\BankLoan::find($loanId);
    $principalBalance = $loan->principal_balance;
    $limitBalance = $loan->limiting_balance;
    $interestRate = $loan->interest_rate;
    $interestFactor = ($interestRate/(365*100));

    if ($date != null){
        $transactionGroup = App\Models\BankLoanTransaction::where([
            'bank_loan_id'=>$loanId
        ])->where('created_at','<=',$date)->get()->sortBy('created_at')->groupBy('created_at');
    }else{
        $transactionGroup = App\Models\BankLoanTransaction::where([
            'bank_loan_id'=>$loanId
        ])->get()->sortBy('created_at')->groupBy('created_at');
    }

    $count = 0; $lastTransactionDate = null;
    foreach ($transactionGroup as $created_at => $transactions){
        $latestTransactionDate = Carbon\Carbon::parse($created_at);
        if ($count==0){
            $previousTransactionDate = Carbon\Carbon::parse($loan->created_at);
        }else{
            $previousTransactionDate = $lastTransactionDate;
        }
        $dayInterval = $previousTransactionDate->diffInDays($latestTransactionDate);
        $interest = $principalBalance*$interestFactor*$dayInterval;
        foreach ($transactions as $transaction){
            $transaction->type=='Deposit' ? $principalBalance -= $transaction->amount : $principalBalance += $transaction->amount;
        }

        $principalBalance += $interest;
        $count ++;
        $lastTransactionDate = $latestTransactionDate;
    }

    $limitBalance -= $principalBalance;

    $result = [
        'principalBalance'=>$principalBalance,
        'limitBalance'=>$limitBalance
    ];

    return $result;
}

function siteInfo($property){
    $data = App\Models\SiteInfo::where(['property'=>$property])->first();
    if (isset($data)){ return $data->value; }
    else{ return 'Undefined '.$property; }
}



function unitConversionFactor($from,$to){
    $result = App\Models\UnitConversion::where([
        'from'=>$from,
        'to'=>$to
    ])->first();

    if (isset($result)){
        return $result->times;
    }else{
        return 1;
    }
}

function activeClients($type){
    return App\Models\Client::where(['type'=>$type,'status'=>1])->get();
}

function dateToDateLabourAndTransportCost($transactionType,$costType,$startDate,$endDate=null){
    if ($endDate==null){
        if ($transactionType=='Sale'){
            $transactions = App\Models\Sale::where('created_at','<=',$startDate)->get();
        }elseif ($transactionType=='Purchase'){
            $transactions = App\Models\Purchase::where('created_at','<=',$startDate)->get();
        }
    }else{
        if ($transactionType=='Sale'){
            $transactions = App\Models\Sale::whereBetween('created_at',[$startDate,$endDate])->get();
        }elseif ($transactionType=='Purchase'){
            $transactions = App\Models\Purchase::whereBetween('created_at',[$startDate,$endDate])->get();
        }
    }

    $cost = 0;
    if (isset($transactions)){
        if ($costType=='Transport'){
            $cost = $transactions->sum('transport_cost');
        }elseif ($costType=='Labour'){
            $cost = $transactions->sum('labour_cost');
        }
    }

    return $cost;
}

function ordinalNumber($number) {
    $suffix = ['th','st','nd','rd','th','th','th','th','th','th'];
    if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
        return $number . 'th';
    } else {
        return $number . $suffix[$number % 10];
    }
}

function teacherSectionCheck($teacherId,$sectionId){
    return App\Models\SectionTeacher::where([
        'teacher_id'=>$teacherId,
        'section_id'=>$sectionId
    ])->first();
}

function teacherScheduleCheck($teacherId,$classId,$subjectId,$year)
{
    return App\Models\ClassSchedule::with([
        'day','period'
    ])
        ->where([
        'teacher_id'=>$teacherId, 'class_id'=>$classId, 'subject_id'=>$subjectId, 'year'=>$year,'status'=>1
    ])->get();
}

function getMacAddress()
{
// Command to get MAC address, works on Linux
    $macAddress = exec('cat /sys/class/net/eth0/address');
// If the above doesn't work, you can try another command for Windows
    if (!$macAddress) {
        $macAddress = exec('getmac');
    }
    return $macAddress;
}

function DBlog($model,$table,$row,$operation,$performed_by)
{
    $log = new DBLog();
    $log->model = $model;
    $log->table = $table;
    $log->row = $row;
    $log->operation = $operation;
    $log->performed_by = $performed_by;
    $log->save();
}

function paymentMethod($number){
    switch ($number){
        case 1: return 'Cash'; break;
        case 2: return 'Bank'; break;
    }
}

function recentBlogs(){
    $blogs = LatestNews::orderBy('created_at', 'desc')
        ->offset(1)
        ->limit(2)
        ->get();

    return $blogs;
}

function partners(){
    $partners = App\Models\Partner::where('status',1)->get(['id','name','thumbnail']);

    return $partners;
}
