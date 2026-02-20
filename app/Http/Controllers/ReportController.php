<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\ClassName;
use App\Models\PaymentInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index($from,$type){
        if ($from=='payment'){
            if ($type=='date-to-date'){
                $start = Carbon::parse()->format('Y-m-d 0:00:00');
                $end = Carbon::parse()->format('Y-m-d 23:59:59');
                return view('backend.report.payments.date-to-date-payment',[
                    'payments'=>$this->paymentReport($start,$end,null)
                ]);
            }elseif ($type=='batch-wise'){
                return view('backend.report.payments.batch-form',['students'=>[],'from'=>$from]);
            }
        }
    }

    protected function paymentReport($start,$end,$request=null){
        if ($request!=null){

        }else{
            return PaymentInfo::with('payments','student','classInfo')->whereBetween('created_at',[$start,$end])->get();
        }
    }

    public function report(Request $request){
        if ($request->from=='payment' and $request->report_type == 'date-to-date'){
            $start = Carbon::parse($request->start)->format('Y-m-d 0:00:00');
            $end = Carbon::parse($request->end)->format('Y-m-d 23:59:59');
            if ($request->type=='view'){
                return view('backend.report.payments.table',['payments'=>$this->paymentReport($start,$end,null)]);
            }elseif($request->type=='print'){
                return view('backend.report.payments.date-to-date-payment-print',[
                    'payments'=>$this->paymentReport($start,$end,null),
                    'data'=>$request
                ]);
            }
        }elseif ($request->from=='payment' and $request->report_type == 'batch-wise'){
            $students = classAndBatchWiseStudents($request);
            if ($request->type=='view'){
                return view('backend.report.payments.batch-wise-report-table',['students'=>$students,'data'=>$request]);
            }elseif ($request->type=='print'){
                $title = $request->year.'-'.ClassName::find($request->class_id)->name.'-'.Batch::find($request->batch_id)->name;
                return view('backend.report.payments.batch-wise-report-print',[
                    'students'=>$students,'data'=>$request,'title'=>$title
                ]);
            }
        }
    }
}
