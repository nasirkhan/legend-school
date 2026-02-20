<?php

namespace App\Http\Controllers;

use App\Models\OtherAttendance;
use App\Models\Payment;
use App\Models\PaymentInfo;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $students;

    public function __construct()
    {
        $this->students = Student::with('school','classInfo','batch','session','photo')->where([
            'status'=>1
        ])->get();
    }

    public function index(){
        return view('backend.students.payment.add-form',['students'=>$this->students]);
    }

    public function paymentFormFillUp(Request $request){
        if ($request->ajax()){
            $student = Student::find($request->student_id);
            return response()->json([
                'student'=>$student,
                'attendances'=>$attendances = paymentAttendances($student,'unpaid')
            ]);
        }
    }

    public function store(Request $request){
        if ($request->ajax()){
            if (isset($request->attendances)){
                $student = Student::find($request->student_id);
                $info = new PaymentInfo();
                $info->student_id = $request->student_id;
                $info->year = $student->year;
                $info->class_id = $request->class_id;
                $info->receipt_no = $request->receipt_no;
                $info->received = $request->received;
                $info->creator_id = user()->id;
                $info->save();

                foreach ($request->attendances as $id => $value){
                    $attendance = OtherAttendance::find($id);

                    $payment = new Payment();
                    $payment->year = $attendance->year;
                    $payment->session_id = $attendance->session_id;
                    $payment->school_id = $request->school_id;
                    $payment->class_id = $request->class_id;
                    $payment->batch_id = $student->batch_id;
                    $payment->student_id = $request->student_id;
                    $payment->attendance_id = $id;
                    $payment->month_id = $attendance->row_id;
                    $payment->monthly_fee = $student->monthly_fee;
                    $payment->discount = $student->discount;
                    $payment->received = $student->monthly_payable;
                    $payment->payment_info_id = $info->id;
                    $payment->creator_id = user()->id;
                    $payment->save();

                    $attendance->reference_id = $payment->id;
                    $attendance->save();
                }

                return response()->json([
                    'success'=>true, 'attendances'=>paymentAttendances($student,'unpaid')
                ]);
            }else{
                return response()->json(['success'=>false]);
            }
        }else{
            return 'Access Denied';
        }
    }

    public function invoice($id){
        $payment = PaymentInfo::with('student','payments')->find($id);
        return view('backend.students.payment.invoice',[
            'payment'=>$payment
        ]);
    }
}
