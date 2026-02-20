<?php

namespace App\Http\Controllers;

use App\Models\ClassItem;
use App\Models\DBLog;
use App\Models\Fine;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\InvoiceNote;
use App\Models\Item;
use App\Models\Month;
use App\Models\NewPayment;
use App\Models\NewPaymentMethod;
use App\Models\Payment;
use App\Models\PreviousDue;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentMonthlyFee;
use App\Models\StudentPaymentItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function feesForm()
    {
        $year = Session::get('year');
        $classId = Session::get('class_id');

        if(isset($classId) and $classId=='all'){
            $studentClasses = StudentClass::with([
                'student'=>function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
                'classInfo'=>function($query){$query->select('id','name','code');}
            ])->where([
                'year'=>$year,
                'status'=>1,
            ])->get(['id','student_id','class_id','year']);
        }else{
            $studentClasses = StudentClass::with([
                'student'=>function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
                'classInfo'=>function($query){$query->select('id','name','code');}
            ])->where([
                'year'=>$year,
                'class_id'=>$classId,
                'status'=>1,
            ])->get(['id','student_id','class_id','year']);
        }

        $students = [];
        foreach ($studentClasses as $studentClass){
            $item = [];
            $studentId = $studentClass->student_id;
            $item['info'] = $studentClass->student;
            $fee = StudentMonthlyFee::where(['student_id'=>$studentId, 'class_id'=>$studentClass->class_id, 'year'=>$year, 'status'=>1])
                ->latest()->first(['id','monthly_fee','discount','payable']);

            $item['class'] = $studentClass->classInfo;
            $item['fee'] = $fee;

            $students[$studentClass->student->roll] = $item;
        }

        ksort($students);

        return view('backend.students.invoice.fees-form',compact('students'));
    }

    public function getFees(Request $request){
        $year = $request->year;
        $classId = $request->class_id;


        if ($request->class_id=='all'){
            $studentClasses = StudentClass::with([
                'student'=>function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
                'classInfo'=>function($query){$query->select('id','name','code');}
            ])->where([
                'year'=>$year,
                'status'=>1,
            ])->get(['id','student_id','class_id','year']);
        }else{
            $studentClasses = StudentClass::with([
                'student'=>function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
                'classInfo'=>function($query){$query->select('id','name','code');}
            ])->where([
                'year'=>$year,
                'class_id'=>$classId,
                'status'=>1,
            ])->get(['id','student_id','class_id','year']);
        }

        $students = [];
        foreach ($studentClasses as $studentClass){
            $item = [];
            $studentId = $studentClass->student_id;
            $item['info'] = $studentClass->student;
            $fee = StudentMonthlyFee::where(['student_id'=>$studentId, 'class_id'=>$studentClass->class_id, 'year'=>$year, 'status'=>1])
                ->latest()->first(['id','monthly_fee','discount','payable']);
            $item['class'] = $studentClass->classInfo;
            $item['fee'] = $fee;
            $students[$studentClass->student->roll] = $item;
        }

        ksort($students);

        return view('backend.students.invoice.fees-table',compact('students'));
    }

    public function invoiceCreationForm(){
        $items = Item::where([
            'used_for'=>1,
            'billing_cycle'=>3,
            'status' => 1,
        ])->get(['id', 'name']);

        $year = Session::get('year');
        $classId = Session::get('class_id');
        $monthId = Session::get('month_id');
        $itemId = Session::get('item_id');
        $students = []; $month = null; $item = null;
        if (isset($year) and isset($classId) and isset($itemId)){
            $item = $this->classItemForInvoiceCreation($year,$classId,$itemId);
            $month = Month::where('id',$monthId)->first(['id','name','code']);
            $students = $this->studentListForInvoiceCreation($year,$classId,$monthId,$itemId,$item->id);
        }

        return view('backend.students.invoice.invoice-creation-form',compact('students','items','month','item'));
    }

    public function invoiceCreationForStudent(Request $request){
        $studentId = $request->id;  $classId = $request->class_id; $year = $request->year;

        $student = Student::where('id',$studentId)->first(['id','name','roll','mobile','mother_mobile','father_mobile']);

        $classItems = ClassItem::with([
            'item'=>function($query){$query->select('id','name','billing_cycle');}
        ])->where([
            'class_id'=>$classId,
            'year'=>$year,
            'status'=>1
        ])->get(['id','item_id','amount']);

        $monthlyFee = StudentMonthlyFee::with([
//            'class'=>function ($query) use ($studentId) {$query->select('id','name','code');},
            'class'=>function ($query){$query->select('id','name','code');},
        ])->where([
            'student_id'=>$studentId,
            'class_id'=>$classId,
            'year'=>$year,
            'status'=>1
        ])->latest()->first(['id','monthly_fee','discount','payable','class_id','year']);

        $labSubjects = labFeeInfo($studentId,$classId,$year);

//        return $labSubjects;

        $data = [
            'query'=>$request,
            'student'=>$student,
            'classItems'=>$classItems,
            'monthlyFee'=>$monthlyFee,
            'labSubjects'=>$labSubjects,
            'months'=>months()
        ];

//        return $data;

        return view('backend.students.invoice.student-invoice-creation-form',compact('data'));
    }

    public function createStudentInvoice(Request $request){
//        return $request->all();

        $studentId = $request->student_id; $classId = $request->class_id; $year = $request->year;

        $classItems = $request->class_items;
        $classItemDiscounts = $request->class_item_discounts;
        $classItemNotes = $request->class_item_notes;

        $studentNonMonthlyPaymentItemsDelete = $request->non_monthly_class_items_delete;

        $monthlyFee = $request->monthly_fee;
        $discountPercent = $request->discount;
        $receivable = $request->payable;
        $months = $request->months;
        $monthsDelete = $request->months_delete;

        //Non-Monthly Fee
        if(isset($classItems)){
            foreach ($classItems as $classItemId){
                $classItem = ClassItem::with([
                    'item'=>function($query){$query->select('id','name','billing_cycle');}
                ])->where(['id'=>$classItemId])->first(['id','item_id','amount']);

                if ($classItem->item->billing_cycle == 1){
                    $studentPaymentInfo = StudentPaymentItem::where([
                        'student_id'=>$studentId,
                        'class_id'=>$classId,
                        'item_id'=>$classItem->item_id,
                    ])->latest()->first();
                }elseif ($classItem->item->billing_cycle == 2){
                    $studentPaymentInfo = StudentPaymentItem::where([
                        'student_id'=>$studentId,
                        'class_id'=>$classId,
                        'year'=>$year,
                        'item_id'=>$classItem->item_id,
                    ])->latest()->first();
                }

                if (!isset($studentPaymentInfo)){
                    $studentPaymentInfo = new StudentPaymentItem();
                }

                $studentPaymentInfo->year = $year;
                $studentPaymentInfo->class_id = $classId;
                $studentPaymentInfo->student_id = $studentId;
                $studentPaymentInfo->item_id = $classItem->item_id;
                $studentPaymentInfo->amount = $classItem->amount;
                $studentPaymentInfo->discount = $classItemDiscounts[$classItemId];
                $studentPaymentInfo->receivable = $classItem->amount - $classItemDiscounts[$classItemId];
                $studentPaymentInfo->note = $classItemNotes[$classItemId];
                $studentPaymentInfo->created_by = user()->name;
                $studentPaymentInfo->save();
            }
        }

        //Delete Selected Items
        if (isset($studentNonMonthlyPaymentItemsDelete)){
            foreach ($studentNonMonthlyPaymentItemsDelete as $studentNonMonthlyPaymentItemId){
                StudentPaymentItem::find($studentNonMonthlyPaymentItemId)->delete();
            }
        }


        //Tuition Fee and Lab Fee
        $tuitionFee = Item::where([
            'name'=>'Tuition Fee', 'status'=>1
        ])->first();

        if (isset($tuitionFee)){
            $labInfo = labFeeInfo($studentId,$classId,$year);
            foreach ($months as $monthId){
                $month = Month::find($monthId);
                $monthlyTuitionFee = StudentPaymentItem::where([
                    'student_id'=>$studentId,
                    'class_id'=>$classId,
                    'year'=>$year,
                    'item_id'=>$tuitionFee->id,
                    'month_id'=>$monthId,
                ])->first();

                if (!isset($monthlyTuitionFee)){
                    $monthlyTuitionFee = new StudentPaymentItem();
                }

                $monthlyTuitionFee->year = $year;
                $monthlyTuitionFee->class_id = $classId;
                $monthlyTuitionFee->student_id = $studentId;
                $monthlyTuitionFee->item_id = $tuitionFee->id;
                $monthlyTuitionFee->month_id = $monthId;
                $monthlyTuitionFee->amount = $monthlyFee;
                $monthlyTuitionFee->discount = round($monthlyFee*$discountPercent/100);
                $monthlyTuitionFee->lab_fee = $labInfo['lab_fee'];
                $monthlyTuitionFee->receivable = $receivable + $labInfo['lab_fee'];

                if ($month->code == 'Jan' or $month->code == 'Feb' or $month->code == 'Mar' or $month->code == 'Apr' or $month->code == 'May' or $month->code == 'Jun'){
                    $acYear = $year + 1;
                }else{
                    $acYear = $year;
                }

                $monthlyTuitionFee->due_date = stringToDate("10 {$month->name} $acYear");
                $monthlyTuitionFee->second_due_date = endOfMonth("10 {$month->name} $acYear");
                $monthlyTuitionFee->created_by = user()->name;
                $monthlyTuitionFee->save();
            }

            if (isset($monthsDelete)){
                foreach ($monthsDelete as $monthId => $itemId){
                    StudentPaymentItem::find($itemId)->delete();
                }
            }
        }

        Alert::toast('Successfully Done', 'success');
        return back();
    }

    public function getStudentsForCreatingInvoice(Request $request){
        if ($request->ajax()) {
            $item = $this->classItemForInvoiceCreation($request->year,$request->class_id,$request->item_id);
            $month = Month::where('id',$request->month_id)->first(['id','name','code']);
            $students = $this->studentListForInvoiceCreation($request->year,$request->class_id,$request->month_id,$request->item_id,$item->id);
            return view('backend.students.invoice.invoice-creation-table',compact('students','item','month'));
        }
    }
    protected function classItemForInvoiceCreation($year, $classId, $itemId){
        $item = ClassItem::with([
            'item' => function($query){$query->select('id', 'name');}
        ])->where([
            'year'=>$year,
            'class_id'=>$classId,
            'item_id'=>$itemId,
            'status'=>1,
        ])->latest()->first(['id','year','class_id','item_id','amount']);

        return $item;
    }
    protected function studentListForInvoiceCreation($year, $classId, $monthId = null, $itemId = null, $classItemId = null){
        $studentClasses = StudentClass::with([
            'student'=>function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');}
        ])->where([
            'year'=>$year,
            'class_id'=>$classId,
            'status'=>1,
        ])->get(['id','student_id','class_id','year']);

        $students = [];
        foreach ($studentClasses as $studentClass){
            $studentId = $studentClass->student_id;
            $invoice = $this->monthlyInvoiceCheck($year, $classId, $studentId,$monthId, $itemId, $classItemId);
            if (!isset($invoice)){
                $studentItem = [];
                $studentItem['info'] = $studentClass->student;
                $fee = StudentMonthlyFee::where([
                    'student_id'=>$studentId,
                    'class_id'=>$classId,
                    'year'=>$year,
                    'status'=>1
                ])->latest()->first(['id','monthly_fee','discount','payable']);

                $studentItem['fee'] = $fee;
                $students[] = $studentItem;
            }
        }
        return $students;
    }

    public function createClassWiseInvoice(Request $request){
        if ($request->post()){
            $deadLineMonth = dateFormat($request->deadline,'n');
            if ($deadLineMonth < $request->month_id){
                toast('The deadline month can not be earlier than the current month','error');
                return back();
            }
            $deadLineYear = dateFormat($request->deadline,'Y');

            if ($deadLineYear < $request->year){
                toast("The deadline year can not be earlier than {$request->year}",'error');
                return back();
            }

            $year = $request->year;
            $classId = $request->class_id; $monthId = $request->month_id;
            $itemId = $request->item_id; $classItemId = $request->class_item_id;
            $fees = $request->fee;  $discounts = $request->discount; $receivable = $request->payable; $students = $request->students;

            if (isset($students)){
                foreach ($students as $studentId => $value){
                   $invoice = $this->monthlyInvoiceCheck($year, $classId, $studentId,$monthId, $itemId, $classItemId);
                   if (!isset($invoice)){
                       //Create Invoice
                       $invoice = new Invoice();
                       $invoice->invoice_type = 3;
                       $invoice->invoice_no = createInvoiceNumber();
                       $invoice->year = $year;
                       $invoice->reference_id = $itemId;
                       $invoice->class_id = $classId;
                       $invoice->student_id = $studentId;
                       $invoice->actual_amount = $fees[$studentId];
                       $invoice->discount_amount = ($fees[$studentId]*($discounts[$studentId]/100));
                       $invoice->receivable_amount = $receivable[$studentId];
                       $invoice->deadline = $request->deadline;
                       $invoice->status = 2;
                       $invoice->creator_id = user()->id;
                       $invoice->updater_id = user()->id;
                       $invoice->save();
                       $invoiceId = $invoice->id;
                       //Create Invoice Details
                       $invoiceDetail = new InvoiceDetails();
                       $invoiceDetail->invoice_id = $invoiceId;
                       $invoiceDetail->class_item_id = $classItemId;
                       $invoiceDetail->reference_id = $monthId;
                       $invoiceDetail->actual_amount = $fees[$studentId];
                       $invoiceDetail->discount_amount = ($fees[$studentId]*($discounts[$studentId]/100));
                       $invoiceDetail->receivable_amount = $receivable[$studentId];
                       $invoiceDetail->status = 1;
                       $invoiceDetail->creator_id = user()->id;
                       $invoiceDetail->save();
                   }
                }
                Alert::toast('Invoice created successfully', 'success');
                return back();
            }else{
                Alert::toast('No Student Selected', 'error');
                return back();
            }
        }
    }

    protected function monthlyInvoiceCheck($year, $classId, $studentId,$monthId, $itemId, $classItemId){
        $invoice = Invoice::with('activeDetails')->where([
            'year'=>$year,
            'class_id'=>$classId,
            'student_id'=>$studentId,
            'reference_id'=>$itemId,
            'invoice_type'=>3,
        ])->latest()->first();

        if (isset($invoice)){
            $checked = false;
            foreach ($invoice->activeDetails as $activeDetail){
                if ($activeDetail->class_item_id == $classItemId and $activeDetail->reference_id == $monthId){
                    $checked = true;
                    break;
                }
            }

            if ($checked){return $invoice;}
            else{return null;}
        }
        else{return null;}
    }

    public function invoiceCheckForm(){
        $year = Session::get('year');
        $classId = Session::get('class_id');
        $students = [];
        if (isset($year) and isset($classId)){
            $students = $this->getClassWiseInvoice($year, $classId);
        }
        return view('backend.students.invoice.invoice-check-form',compact('students'));
    }

    public function classWiseInvoiceCheck(Request $request){
        if ($request->ajax()){
            $students = $this->getClassWiseInvoice($request->year,$request->class_id);
            return view('backend.students.invoice.invoice-table', compact('students'));
        }
    }

    protected function getClassWiseInvoice($year, $classId){
        if ($classId=='all'){
            $studentClasses = StudentClass::with(['student' => function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');}])
                ->where(['year'=>$year, 'status'=>1])
                ->get();

            $students = [];
            foreach ($studentClasses as $studentClass) {
                $invoices = Invoice::with('activeDetails')->where([
                    'year' => $year,
                    'student_id'=>$studentClass->student_id,
                    'status'=>2,
                ])->get()->sortByDesc('id');
                $item = [
                    'info'=>$studentClass->student,
                    'invoices'=>$invoices
                ];

                $students[] = $item;
            }
        }else{
            $studentClasses = StudentClass::with(['student' => function($query){$query->select('id','name','roll','mobile','mother_mobile','father_mobile');}])
                ->where(['year'=>$year, 'class_id'=>$classId, 'status'=>1])
                ->get();

            $students = [];
            foreach ($studentClasses as $studentClass) {
                $invoices = Invoice::with('activeDetails')->where([
                    'year' => $year,
                    'class_id'=>$classId,
                    'student_id'=>$studentClass->student_id,
                    'status'=>2,
                ])->get()->sortByDesc('id');
                $item = [
                    'info'=>$studentClass->student,
                    'invoices'=>$invoices
                ];

                $students[] = $item;
            }
        }

        return $students;
    }

    public function studentInvoice(Request $request){
        $invoice = $this->getInvoice($request->id);
        return view('backend.students.invoice.printable',compact('invoice'));
    }

    public function studentInvoiceNew(Request $request){
        $invoice = $this->getInvoiceNew($request->id);
        return view('backend.students.invoice.printable-new',compact('invoice'));
    }

    public function studentInvoiceDeleteNew(Request $request){
        $payment = NewPayment::with(['studentPaymentItems','methods'])->where('id',$request->id)->first();

        //Student Payment Item Undo
        foreach ($payment->studentPaymentItems as $studentPaymentItem){
            $studentPaymentItem->payment_id = null;
            $studentPaymentItem->payment_date = null;
            $studentPaymentItem->status = 2;
            $studentPaymentItem->save();

            DBlog('StudentPaymentItem','student_payment_items',$studentPaymentItem->id,'Undo',user()->name);
        }

        //New Payment Method Deleted
        foreach ($payment->methods as $method){
            $method->delete();
            DBlog('NewPaymentMethod','new_payment_methods',$method->id,'Delete',user()->name);
        }
        $payment->delete();

        DBlog('NewPayment','new_payments',$request->id,'Delete',user()->name);

        Alert::success('Successfully Deleted', 'Message');
        return back();
    }

    public function studentInvoiceEditNew(Request $request){
        $invoice = $this->getInvoiceNew($request->id);
        //To be added later
        return view('backend.students.invoice.edit-new',compact('invoice'));
    }

    public function studentInvoiceEdit(Request $request){
        $invoice = $this->getInvoice($request->id);

        $allClassItems = ClassItem::with([
            'item'=>function($query){$query->select('id','name','billing_cycle');},
        ])->where([
            'class_id'=>$invoice->class_id,
            'year'=>$invoice->year,
            'status'=>1
        ])->get(['id','year','class_id','item_id','amount']);

//        return $invoice->activeDetails;

        $classItems = [];
        foreach ($allClassItems as $classItem){
            if ($classItem->item->billing_cycle == 1){
                continue;
            }
//            return $classItem;
            $checked = false;
            foreach ($invoice->activeDetails as $activeDetail){
//                return $activeDetail;
                if ($activeDetail->classItem->item_id == $classItem->item_id){
                    $checked = true;
                }
            }

            if (!$checked){
                $classItems[] = $classItem;
            }
        }


//        return $classItems;

        return view('backend.students.invoice.edit',compact('invoice','classItems'));
    }

    public function studentInvoiceUpdate(Request $request){
        if ($request->post()){
//            return $request->all();

            $lessActualAmount = 0; $lessDiscountAmount = 0; $lessReceivableAmount = 0;
            $addActualAmount = 0; $addDiscountAmount = 0; $addReceivableAmount = 0;
            $oldPreviousDue = 0; $oldPreviousDueDiscount = 0; $oldPreviousDueReceivable = 0;

            //Invoice Info
            $invoiceId = $request->invoice_id;
            $invoice = Invoice::find($invoiceId);
            $invoiceActualAmount = $invoice->actual_amount;
            $invoiceDiscountAmount = $invoice->discount_amount;
            $invoiceReceivableAmount = $invoice->receivable_amount;

            $remark = $request->remark;
            $deadline = $request->deadline;

            //Invoice Details Item to Remove
            $invoiceDetailsIds = isset($request->invoice_detail_id) ? $request->invoice_detail_id : [];
            $detailActualAmounts = isset($request->detail_actual_amount) ? $request->detail_actual_amount : [];
            $detailDiscountAmounts = isset($request->detail_discount_amount) ? $request->detail_discount_amount : [];
            $detailReceivableAmounts = isset($request->detail_receivable_amount) ? $request->detail_receivable_amount : [];

            foreach ($invoiceDetailsIds as $invoiceDetailId){
               $invoiceDetail = InvoiceDetails::find($invoiceDetailId);
               $lessActualAmount += $invoiceDetail->actual_amount;
               $lessDiscountAmount += $invoiceDetail->discount_amount;
               $lessReceivableAmount += $invoiceDetail->receivable_amount;
               $invoiceDetail->delete();
            }

            //New Invoice Items
            $newItemIds = isset($request->new_item_ids) ? $request->new_item_ids : [];
            $newActualAmount = isset($request->new_actual_amount) ? $request->new_actual_amount : [];
            $newDiscount = isset($request->new_discount) ? $request->new_discount : [];
            $newReceivableAmount = isset($request->new_receivable_amount) ? $request->new_receivable_amount : [];
            $monthIds = isset($request->new_month_ids) ? $request->new_month_ids : [];

            foreach ($newItemIds as $classItemId => $itemId){
                $item = Item::find($itemId);
                $newDetail = new InvoiceDetails();
                $newDetail->invoice_id = $invoiceId;
                $newDetail->class_item_id = $classItemId;
                if ($item->billing_cycle == 3){
                    $newDetail->reference_id = $monthIds[$itemId][0];
                }
                $newDetail->actual_amount = $newActualAmount[$itemId];
                $newDetail->discount_amount = $newDiscount[$itemId];
                $newDetail->receivable_amount = $newReceivableAmount[$itemId];
                $newDetail->creator_id = user()->id;
                $newDetail->save();

                $addActualAmount += $newDetail->actual_amount;
                $addDiscountAmount += $newDetail->discount_amount;
                $addReceivableAmount += $newDetail->receivable_amount;
            }

            //Previous Due Info
            $previousDueId = isset($request->previous_due_id) ? $request->previous_due_id : null;
            $previousDueAmount = isset($request->previous_due) ? $request->previous_due : 0;
            $dueDescription = isset($request->due_description) ? $request->due_description : null;

            if ($previousDueAmount>0){
                $previousDue = PreviousDue::find($previousDueId);
                if (!isset($previousDue)){
                    $previousDue =  new PreviousDue();
                }else{
                    $oldPreviousDue = $previousDue->amount;
                    $oldPreviousDueDiscount = $previousDue->discount;
                    $oldPreviousDueReceivable = $previousDue->receivable;
                }
                $previousDue->invoice_id = $invoiceId;
                $previousDue->student_id = $invoice->student_id;
                $previousDue->description = $dueDescription;
                $previousDue->amount = $previousDueAmount;
                $previousDue->discount = 0;
                $previousDue->receivable = $previousDueAmount;
                $previousDue->creator = user()->name;
                $previousDue->save();
            }

            if ($remark!==null){
                if (isset($invoice->activeNote)){
                    $activeNote = $invoice->activeNote;
                    $activeNote->note = $remark;
                    $activeNote->save();
                }else{
                    $activeNote = new InvoiceNote();
                    $activeNote->invoice_id = $invoiceId;
                    $activeNote->note = $remark;
                    $activeNote->creator_id = user()->id;
                    $activeNote->save();
                }
            }

            $invoice->actual_amount = ($invoiceActualAmount + $addActualAmount + $previousDueAmount) - ($lessActualAmount + $oldPreviousDue);
            $invoice->discount_amount = ($invoiceDiscountAmount + $addDiscountAmount + 0) - ($lessDiscountAmount + $oldPreviousDueDiscount);
            $invoice->receivable_amount = ($invoiceReceivableAmount + $addReceivableAmount + $previousDueAmount) - ($lessReceivableAmount + $oldPreviousDueReceivable);
            $invoice->deadline = $deadline;
            $invoice->updater_id = user()->id;
            $invoice->save();

            Alert::success('Invoice Updated Successfully', 'Success');
            return redirect()->route('invoice-check-form');
//            return redirect()->route('student.invoice.edit',$invoiceId);
        }else{
            abort(404);
        }
    }

    public function studentInvoiceDelete(Request $request){
        $role = user()->role;
        if ($role->name=='Developer'){
            $invoice = Invoice::find($request->id);
//            $invoice->allDetails()->delete();
            foreach ($invoice->allDetails as $detail){$detail->delete();}

            foreach ($invoice->allNotes as $note){$note->delete();}

            foreach ($invoice->payments as $payment){$payment->delete();}

            if (isset($invoice->previousDue)){$invoice->previousDue->delete();}

            $invoice->delete();

            Alert::success('Invoice Deleted Successfully', 'Success');
            return back();
        }else{
            abort(404);
        }
    }

    public function getInvoice($id){
        $invoice = Invoice::with([
            'previousDue',
            'activeNote',
            'payments'=>function ($query) {$query->select('id','invoice_id','payment_type','amount','payment_method','payment_date','creator_id');},
            'student'=>function ($query) {$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
            'activeDetails'=>function ($query) {$query->with([
                'classItem'=>function ($query) {$query->with([
                    'item'=>function($query){$query->select('id','name','billing_cycle');},
                    'class'=>function ($query) {$query->select('id','name','code');}
                ])->select('id','year','class_id','item_id','amount')->where(['status' => 1]);},
                'month'=>function ($query) {$query->select('id','name','code')->where(['status' => 1]);}
            ])->select('id','invoice_id','class_item_id','actual_amount','discount_amount','receivable_amount','reference_id')->where('status', 1);},
            'fine'=>function ($query) {$query->select('id','invoice_id','due_date','payment_date','late_fee','delay','amount','discount','received','note','created_by');},
        ])->where('id',$id)
            ->first(['id','invoice_no','year','class_id','student_id','actual_amount','discount_amount','receivable_amount','status','deadline','invoice_type']);
        return $invoice;
    }

    public function getInvoiceNew($id){
        $invoice = NewPayment::with([
            'student'=>function ($query) {$query->select('id','name','roll','mobile','mother_mobile','father_mobile');},
            'class'=>function ($query) {$query->select('id','name','code');},
            'studentPaymentItems'=>function ($query) {
            $query->with([
                'item'=>function($query){$query->select('id','name','billing_cycle');},
                'month'=>function ($query) {$query->select('id','name','code');},
            ])->select('id','student_id','year','class_id','payment_id','item_id','month_id','amount','lab_fee','discount','receivable','late_fee');
            },
        ])->where('id',$id)
            ->first(['id','invoice_number','class_id','student_id','amount','discount','note','received','status','created_at']);
        return $invoice;
    }

    public function paymentCollectionForm(Request $request){
        $data = $request->all();
        $invoices = Invoice::where('status',2)->get(['id','invoice_no','year','class_id','student_id','actual_amount','discount_amount','receivable_amount','status','deadline']);

        $studentInvoice = null;
        if (isset($data['invoice_id'])){
            $studentInvoice = Invoice::where('id',$data['invoice_id'])->first();
        }

        return view('backend.students.invoice.payment-collection-form',compact('invoices','data','studentInvoice'));
    }

    public function paymentCollectionFormNew(){
        $students = Student::where('status',1)->get(['id','name','roll']);

        $data = [];
        foreach ($students as $student){
            $studentClass = StudentClass::with([
                'classInfo'=>function ($query) {$query->select('id','name','code');},
            ])
                ->where(['student_id'=>$student->id, 'status'=>1])
                ->latest()
                ->first(['id','student_id','class_id','year']);

            $student->class = $studentClass;
            $data[] = $student;
        }
        return view('backend.students.invoice.payment-collection-form-new',compact('data'));
    }

    public function checkPayment(Request $request){
        $student = Student::find($request->student_id);

        $monthlyFee = StudentMonthlyFee::with(['class'=>function  ($query) {$query->select('id','name','code');}])
            ->where(['year'=>$request->year, 'student_id'=>$request->student_id, 'status' => 1])
            ->latest()->first();

        $studentPaymentItems = StudentPaymentItem::with(['item'=>function($query) {$query->select('id','name','billing_cycle');}])
            ->where(['student_id'=>$request->student_id, 'year'=>$request->year])->get()->sortBy('item_id');

        return view('backend.students.invoice.payment-check-form',compact('student','studentPaymentItems','monthlyFee'));
    }

    public function collectPaymentNew(Request $request){
//        return $request->all();

        $studentPaymentItems = $request->student_payment_items;
        $total = $request->total;
        $discount = $request->discount;
        $note = $request->note;
        $receivable = $request->receivable;
        $methods = $request->payment_amounts;
        $references = $request->payment_references;
        $received = $request->total_received;
        $payment_date = $request->payment_date;

        if (count($studentPaymentItems) ===0){
            Alert::error('You have not selected any payment items!', 'Error');
            return back();
        }

        $classId = StudentClass::where(['year'=>$request->year, 'student_id'=>$request->student_id,'status'=>1])->latest()->first(['class_id'])->class_id;

        $payment = new NewPayment();
        $payment->invoice_number =  newCreateInvoiceNumber();
        $payment->student_id =  $request->student_id;
        $payment->class_id =  $classId;
        $payment->amount =  $total;
        $payment->discount =  $discount;
        $payment->note =  $note;
        $payment->received =  $received;
        $payment->created_by = user()->name;

        if ($payment_date !== null){
            $payment->created_at = $payment_date.' '.Carbon::now()->toTimeString();
        }

        $payment->save();

        $paymentId = $payment->id;
        $paymentDate = $payment->created_at;

        foreach ($methods as $key => $value){
            if ($value>0){
                $paymentMethod = new NewPaymentMethod();
                $paymentMethod->new_payment_id = $paymentId;
                $paymentMethod->method = $key;
                $paymentMethod->amount = $value;
                if ($key != 1){$paymentMethod->transaction_id = $references[$key];}
                $paymentMethod->created_at = $payment->created_at;
                $paymentMethod->save();
            }
        }

        foreach ($studentPaymentItems as $studentPaymentItemId => $studentPaymentItem){
            StudentPaymentItem::find($studentPaymentItemId)->update(['payment_id'=>$paymentId,'payment_date'=>$paymentDate,'status' =>1]);
        }

        return redirect()->route('student-invoice-new',['id'=>$paymentId]);

        Alert::toast('Payment Received Successfully!', 'success');
        return back();
    }

    public function collectPayment(Request $request){
        if ($request->post()){
            $invoiceId = $request->invoice_id;
            if (Invoice::find($invoiceId)->status == 2){
                if ($request->total_received===$request->receivable_amount){
                    $methods = $request->payment_amounts;
                    foreach ($methods as $method => $amount){
                        if ($amount >0){
                            $payment = new Payment();
                            $payment->invoice_id = $invoiceId;
                            $payment->payment_type = 1; //1=Received, 2=Paid
                            $payment->amount = $amount;
                            $payment->payment_method = $method; //1=Cash, 2=bKash, 3=Nagad, 4=Bank

                            if ($request->payment_date!=null){$paymentDate = $request->payment_date;}
                            else{$paymentDate = Carbon::today()->toDateString();}

                            $payment->payment_date = $paymentDate;
                            $payment->creator_id = user()->id;
                            $payment->save();
                        }
                    }

                    Invoice::find($invoiceId)->update(['status'=>1,'payment_date'=>$paymentDate]);

                    $prevDue = PreviousDue::where([
                        'invoice_id'=>$invoiceId,
                        'status'=>2
                    ])->latest()->first();

                    if (isset($prevDue)){
                        $prevDue->status = 1;
                        $prevDue->save();
                    }

                    if (isset($request->late_fee) and $request->late_fee > 0){
                        $invInfo = Invoice::find($invoiceId);
                        $finePerDay = siteInfo('daily_fine'); //Tobe Modified
                        $delay = invoiceDelay($invInfo->deadline);

                        $lateFee = lateFee($invoiceId);

                        $fine = new Fine();
                        $fine->invoice_id = $invoiceId;
                        $fine->due_date = $invInfo->deadline;
                        $fine->payment_date = $paymentDate;
                        $fine->late_fee = $finePerDay;
                        $fine->delay = $lateFee['reference'];
                        $fine->amount = $request->late_fee;
                        $fine->discount = $request->discount;
                        $fine->received = ($request->late_fee - $request->discount);
                        $fine->note = $request->reference;
                        $fine->created_by = user()->name;
                        $fine->save();
                    }

                    $invoice = $this->getInvoice($invoiceId);
                    return view('backend.students.invoice.printable',compact('invoice'));
                }
            }elseif(Invoice::find($invoiceId)->status == 1){
                $msg = '<h3 class="text-center">Payment Already Collected. Please Try Another One</h3>';
                Alert::html('Message!', $msg, 'success');
                return back();
            }
        }
    }

    public function addToPayment(Request $request){
        if ($request->ajax()){
            $invoice = $this->getInvoice($request->invoice_id);
            if ($invoice->status == 2){
                return view('backend.students.invoice.payment-form',compact('invoice'));
            }elseif($invoice->status == 1){
                return '<h3 class="text-center text-success">Payment Already Collected. Please Try Another One</h3>';
            }
        }
    }

    protected function updateSessionInvoiceIds($invoiceId,$toDo){
        if ($toDo == 'add'){
            if (Session::has('invoiceIds')){
                $data = Session::get('invoiceIds',[]);
                if (!in_array($invoiceId,$data)){$data[] = $invoiceId;Session::put('invoiceIds',$data);}
            }else{
                $data[] = $invoiceId;
                Session::put('invoiceIds',$data);
            }
        }elseif ($toDo == 'remove'){
            $data = Session::get('invoiceIds',[]);
            $key = array_search($invoiceId, $data);
            if ($key !== false) {
                unset($data[$key]);
                Session::put('invoiceIds',$data);
            }
        }
        return Session::get('invoiceIds',[]);
    }

    public function paymentCollectionReportForm(Request $request){
        $from = Session::get('from'); $to = Session::get('to'); $classId = Session::get('class_id');

        $invoices = [];
        if (isset($from) and isset($to) and isset($classId)){
            $invoices = $this->getInvoicesForReporting($from,$to,1,$classId);
        }

        return view('backend.students.invoice.payment-collection-report-form',compact('invoices'));
    }

    public function paymentCollectionReportFormNew(Request $request){
        $from = Session::get('from'); $to = Session::get('to'); $classId = Session::get('class_id');

        $invoices = [];
        if (isset($from) and isset($to) and isset($classId)){
            $invoices = $this->getInvoicesForReportingNew($from,$to,1,$classId);
        }

//        return $invoices[0];

        return view('backend.students.invoice.payment-collection-report-form-new',compact('invoices'));
    }

    public function getPaymentReport(Request $request){
        if ($request->ajax()){
            if (Session::get('from')){Session::forget('from');Session::put('from', $request->from);}
            else{Session::put('from', $request->from);}

            if (Session::get('to')){Session::forget('to'); Session::put('to', $request->to);}
            else{Session::put('to', $request->to);}

            $invoices = $this->getInvoicesForReporting($request->from,$request->to,1,$request->class_id);
            return view('backend.students.invoice.payment-report-table',compact('invoices'));
        }
    }

    public function getPaymentReportNew(Request $request){
        if ($request->ajax()){
            if (Session::get('from')){Session::forget('from');Session::put('from', $request->from);}
            else{Session::put('from', $request->from);}

            if (Session::get('to')){Session::forget('to'); Session::put('to', $request->to);}
            else{Session::put('to', $request->to);}

            $invoices = $this->getInvoicesForReportingNew($request->from,$request->to,1,$request->class_id);
            return view('backend.students.invoice.payment-report-table-new',compact('invoices'));
        }
    }

    protected function getInvoicesForReporting($from,$to,$status,$classId){
        if ($classId != 'all'){
            $invoices = Invoice::where(['status'=>$status, 'class_id'=>$classId])->whereBetween('payment_date',[$from,$to])->get();
        }else{
            $invoices = Invoice::where(['status'=>$status])->whereBetween('payment_date',[$from,$to])->get();
        }
        return $invoices;
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

    public function classWisePaymentReportForm(){
//        $invoices = [];
        $year = Session::get('year');
        $classId = Session::get('class_id');
//        $items = [];
//        if (isset($year) and isset($classId)){
//            $items = ClassItem::with([
//                'item'=>function($query){$query->select('id','name');},
//            ])->where([
//                'year'=>$year,
//                'class_id'=>$classId,
//                'status'=>1
//            ])->get(['id','year','class_id','item_id','amount','status']);
//        }

        $requestArray = [
            'year'=>$year,
            'class_id'=>$classId,
        ];
        $request = (object)$requestArray;
        $data = $this->getClassWiseDueReport($request);
        $query = $request;

        return view('backend.students.invoice.class-wise-payment-report-form',compact('data','query'));
    }

    public function getPaymentItem(Request $request){
        if ($request->ajax()){
            $items = ClassItem::with([
                'item'=>function($query){$query->select('id','name');},
            ])->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'status'=>1
            ])->get(['id','year','class_id','item_id','amount','status']);

            return $items;
        }
    }

    public function itemWisePaymentReport(Request $request){
        if ($request->ajax()){
            $classStudents = StudentClass::with([
                'student'=>function($query){$query->select(['id','name','mobile','mother_mobile','father_mobile']);},
            ])->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'status'=>1
            ])->get(['id','student_id']);

            $item = Item::where('id',$request->item_id)->first(['id','name','billing_cycle']);

            $students = [];
            foreach ($classStudents as $classStudent){
                $data = [];

            }
        }
    }

    public function dueReportForm()
    {
        $year = Session::get('year');
        $classId = Session::get('class_id');
        $students = [];
        if (isset($year) and isset($classId)){
            $students = $this->getClassWiseInvoice($year, $classId);
        }

        return view('backend.students.invoice.due-report-form',compact('students'));
    }

    public function dueReportFormNew()
    {
        $year = Session::get('year');
        $classId = Session::get('class_id');
        $itemId = Session::get('item_id');
        $monthId = Session::get('month_id');
        $studentPaymentItems = [];
        if (isset($year) and isset($classId) and isset($itemId)){
            $item = Item::find($itemId);

            if ($item->billing_cycle === 3  and isset($monthId)){
                $studentPaymentItems = StudentPaymentItem::with([
                    'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                    'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                    'month'=>function ($query) {$query->select(['id','name']);},
                ])->where([
                    'year'=>$year,
                    'class_id'=>$classId,
                    'status'=>2,
                    'item_id'=>$itemId,
                    'month_id'=>$monthId
                ])->get();
            }else{
                $studentPaymentItems = StudentPaymentItem::with([
                    'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                    'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                    'month'=>function ($query) {$query->select(['id','name']);},
                ])->where([
                    'year'=>$year,
                    'class_id'=>$classId,
                    'status'=>2,
                    'item_id'=>$itemId
                ])->get();
            }


//            $students = $this->getClassWiseInvoice($year, $classId);
        }

        return view('backend.students.invoice.due-report-form-new',compact('studentPaymentItems'));
    }

    public function getDueReport(Request $request)
    {
        if ($request->ajax()){
            $students = $this->getClassWiseInvoice($request->year,$request->class_id);
            return view('backend.students.invoice.due-table', compact('students'));
        }
    }

    public function getDueReportNew(Request $request)
    {
        if ($request->ajax()){
            $year = $request->year; $classId = $request->class_id; $itemId = $request->item_id; $monthId = $request->month_id;

            if (isset($year) and isset($classId) and isset($itemId)){
                $item = Item::find($itemId);

                if($classId=='all'){
                    if ($item->billing_cycle === 3  and isset($monthId)){
                        $studentPaymentItems = StudentPaymentItem::with([
                            'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                            'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                            'month'=>function ($query) {$query->select(['id','name']);},
                            'class'=>function ($query) {$query->select(['id','name']);},
                        ])->where([
                            'year'=>$year,
                            'status'=>2,
                            'item_id'=>$itemId,
                            'month_id'=>$monthId
                        ])->get()->sortBy('class_id');
                    }else{
                        $studentPaymentItems = StudentPaymentItem::with([
                            'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                            'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                            'month'=>function ($query) {$query->select(['id','name']);},
                            'class'=>function ($query) {$query->select(['id','name']);},
                        ])->where([
                            'year'=>$year,
                            'status'=>2,
                            'item_id'=>$itemId
                        ])->get()->sortBy('class_id');
                    }
                }else{
                    if ($item->billing_cycle === 3  and isset($monthId)){
                        $studentPaymentItems = StudentPaymentItem::with([
                            'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                            'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                            'month'=>function ($query) {$query->select(['id','name']);},
                            'class'=>function ($query) {$query->select(['id','name']);},
                        ])->where([
                            'year'=>$year,
                            'class_id'=>$classId,
                            'status'=>2,
                            'item_id'=>$itemId,
                            'month_id'=>$monthId
                        ])->get()->sortBy('class_id');
                    }else{
                        $studentPaymentItems = StudentPaymentItem::with([
                            'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                            'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                            'month'=>function ($query) {$query->select(['id','name']);},
                            'class'=>function ($query) {$query->select(['id','name']);},
                        ])->where([
                            'year'=>$year,
                            'class_id'=>$classId,
                            'status'=>2,
                            'item_id'=>$itemId
                        ])->get()->sortBy('class_id');
                    }
                }
            }
            return view('backend.students.invoice.due-table-new', compact('studentPaymentItems'));
        }
    }

    public function studentPaymentReport(Request $request){
        $student = Student::find($request->student_id);

        $monthlyFee = StudentMonthlyFee::with(['class'=>function  ($query) {$query->select('id','name','code');}])
            ->where(['year'=>$request->year, 'student_id'=>$request->student_id, 'status' => 1])
            ->latest()->first();

        $currentMonthDueDate = Carbon::now()->addMonth()->day(10)->toDateString();

        $studentPaymentItems = StudentPaymentItem::with(['item'=>function($query) {$query->select('id','name','billing_cycle');}])
            ->where(['student_id'=>$request->student_id, 'year'=>$request->year,'status'=>2])
            ->where('due_date','<=',$currentMonthDueDate)
            ->orWhere('due_date','=',null)
            ->get()->sortBy('item_id');

        $studentPaymentItems = $studentPaymentItems->where('student_id',$request->student_id)->where('payment_id','=',null);

//        return $studentPaymentItems;

        return view('backend.students.invoice.printable-payment-report',compact('student','studentPaymentItems','monthlyFee'));
//        return view('backend.students.invoice.payment-check-form',compact('student','studentPaymentItems','monthlyFee'));
    }

    public function classWiseDueReport(Request $request){
        if ($request->ajax()){
            $data = $this->getClassWiseDueReport($request);
            $query = $request->all();
            return view('backend.students.invoice.class-wise-due-report-table',compact('data','query'));
        }
    }

    public function getClassWiseDueReport($request){
        $data = [];

        $currentMonthDueDate = Carbon::now()->addMonth()->day(11)->toDateString();

        if ($request->class_id != 'all'){
            $groups = StudentPaymentItem::with([
                'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                'month'=>function ($query) {$query->select(['id','name']);},
                'class'=>function ($query) {$query->select(['id','name']);},
            ])->where([
                'year'=>$request->year, 'class_id'=>$request->class_id, 'status'=>2
            ])->where('due_date','<=',$currentMonthDueDate)
                ->orWhere('due_date','=',null)
                ->get()->sortBy('student_id')
                ->where('class_id','=',$request->class_id)
                ->where('payment_id','=',null)
                ->groupBy('student_id');

            foreach ($groups as $groupId => $group){
                $item = [];
                $item['student'] = $group[0]->student;
                $item['amount'] = $group->sum('amount');
                $item['discount'] = $group->sum('discount');
                $item['receivable'] = $group->sum('receivable');
                $item['lab_fee'] = $group->sum('lab_fee');
                $item['total'] = $group->sum('lab_fee') + $group->sum('receivable');
                $item['items'] = $group;
                $data[$groupId] = $item;
            }
        }else{
            $groups = StudentPaymentItem::with([
                'student'=>function($query){$query->select(['id','name','roll','mobile','mother_mobile','father_mobile']);},
                'item'=>function ($query) {$query->select(['id','name','billing_cycle']);},
                'month'=>function ($query) {$query->select(['id','name']);},
                'class'=>function ($query) {$query->select(['id','name']);},
            ])->where([
                'year'=>$request->year, 'status'=>2, 'payment_id'=>null
            ])->where('due_date','<=',$currentMonthDueDate)
                ->orWhere('due_date','=',null)
                ->get()->groupBy('student_id');

            foreach ($groups as $groupId => $group){
                $item = [];
                if ($group[0]->payment_id == null){
                    $item['student'] = $group[0]->student;
                    $item['amount'] = $group->sum('amount');
                    $item['discount'] = $group->sum('discount');
                    $item['receivable'] = $group->sum('receivable');
                    $item['lab_fee'] = $group->sum('lab_fee');
                    $item['total'] = $group->sum('lab_fee') + $group->sum('receivable');
                    $item['items'] = $group;
                    $data[$groupId] = $item;
                }
            }
        }
        return $data;
    }

    public function studentPaymentItemDueDateUpdateForm(){
        $items = StudentPaymentItem::where([
            'year'=>2025,
            'status'=>2
        ])
            ->where('month_id','!=',null)
            ->where('month_id','=',1)
            ->orWhere('month_id','=',2)
            ->get(['id','due_date','second_due_date','late_fee']);

        foreach ($items as $item){
//            return Carbon::parse($item->due_date)->addMonths(2);


//            $item->due_date = Carbon::parse($item->due_date)->addMonths(2);
            $item->due_date = null;
            $item->second_due_date = null;
//            $item->second_due_date = Carbon::parse($item->second_due_date)->addMonths(2);
            $item->late_fee = 0;
            $item->save();
        }


        return 'done';

//        Alert::success('Success', 'Due Date Updated Successfully');
//        return back();

        return $items;

        return count($items);
    }

    public function dueDateAdd()
    {
        $items = StudentPaymentItem::where(['year'=>2025])
            ->where('month_id','!=',null)
            ->where('month_id','=',1)
            ->orWhere('month_id','=',2)
            ->get(['id','due_date','second_due_date','late_fee','month_id']);

        foreach ($items as $item){
            $month = Month::find($item->month_id);
            $item->due_date = stringToDate("10 {$month->name} $item->year");
            $item->second_due_date = endOfMonth("10 {$month->name} $item->year");
            $item->save();
        }
        return 'done';
    }
}
