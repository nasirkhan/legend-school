<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Batch;
use App\Models\ClassItem;
use App\Models\ClassName;
//use App\Models\DBLog;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\InvoiceNote;
use App\Models\Item;
//use App\Models\Result;
use App\Models\ResultMeta;
use App\Models\School;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentClassSubject;
use App\Models\StudentMonthlyFee;
use App\Models\StudentPhoto;
use App\Models\SubjectClass;
//use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Object_;
use RealRashid\SweetAlert\Facades\Alert;


class StudentController extends Controller
{
    public function registrationForm(): Object {
        return view('backend.students.registration-form');
    }

    public function store(Request $request){
//        return $request->all();
        if ($request->post()){
            $student = new Student();
            $student->name = $request->name;
            $student->nick_name = $request->nick_name;
            $student->blood_group = $request->blood_group;
            $student->mobile = $request->mobile;
            $student->photo_id = $this->studentPhotoUpload($request);
            $student->email = $request->email;
            $student->father_name = $request->father_name;
            $student->father_mobile = $request->father_mobile;
            $student->address = $request->address;
            $student->mother_name = $request->mother_name;
            $student->mother_mobile = $request->mother_mobile;
            $student->date_of_birth = $request->date_of_birth;
            $student->join_date = $request->join_date;
            $student->monthly_fee = $request->monthly_fee;
            $student->discount = $request->discount;
            $student->monthly_payable = $request->monthly_payable;
            $student->roll = '';
            $student->password = '';
            $student->status = 1;
            $student->creator_id = user()->id;
            $student->save();
            $passWord = addPassword($student->id);

            $class = new StudentClass();
            $class->student_id = $student->id;
            $class->class_id = $request->class_id;
            $class->year = $request->year;
            $class->creator_id = user()->id;
            $class->save();

            $fee = new StudentMonthlyFee();
            $fee->student_id = $student->id;
            $fee->class_id = $request->class_id;
            $fee->year = $request->year;
            $fee->monthly_fee = $request->monthly_fee;
            $fee->discount = $request->discount;
            $fee->payable = $request->monthly_payable;
            $fee->creator_id = user()->id;
            $fee->save();

            $photo = StudentPhoto::find($student->photo_id);
            $photo->student_id = $student->id;
            $photo->status = 1;
            $photo->save();

            //Add Roll/ID
            $studentRoll = Student::find($student->id);
            $studentRoll->roll = addRollNo($student->id);
            $studentRoll->save();

            Alert::toast('Student Added Successfully','success');
            return back();
        }
        return false;
    }

    public function studentPhotoUpload($request){
       $photo = new StudentPhoto();
       if (isset($request->avatar)){
           $photo->url = fileUpload($request->file('avatar'),'students');
       }else{
           $photo->url = '';
       }
       $photo->save();
       return $photo->id;
    }

    public function edit($id){
        $student = Student::with('photo')->find($id);
        $class = StudentClass::with('classInfo')->where(['student_id'=>$id, 'status'=>1])->latest()->first();
        $fee = StudentMonthlyFee::where(['student_id'=>$id,'class_id'=>$class->class_id,'year'=>$class->year,'status'=>1])->latest()->first();
        return view('backend.students.edit',[
            'student'=>$student, 'class'=>$class, 'fee'=>$fee
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $student = Student::find($request->id);
            $student->name = $request->name;
            $student->nick_name = $request->nick_name;
            $student->blood_group = $request->blood_group;
            $student->mobile = $request->mobile;
            $student->email = $request->email;
            $student->father_name = $request->father_name;
            $student->father_mobile = $request->father_mobile;
            $student->address = $request->address;
            $student->mother_name = $request->mother_name;
            $student->mother_mobile = $request->mother_mobile;
            $student->date_of_birth = $request->date_of_birth;
            $student->join_date = $request->join_date;
            $student->monthly_fee = $request->monthly_fee;
            $student->discount = $request->discount;
            $student->monthly_payable = $request->monthly_payable;
            $student->creator_id = user()->id;
            $student->save();

            $class = StudentClass::find($request->student_class_id);
            $class->class_id = $request->class_id;
            $class->year = $request->year;
            $class->creator_id = user()->id;
            $class->save();

            $fee = StudentMonthlyFee::find($request->fee_id);
            $fee->class_id = $request->class_id;
            $fee->year = $request->year;
            $fee->monthly_fee = $request->monthly_fee;
            $fee->discount = $request->discount;
            $fee->payable = $request->monthly_payable;
            $fee->creator_id = user()->id;
            $fee->save();

            if (isset($request->avatar)){
                $photo = StudentPhoto::find($request->student_photo_id);
                if ($photo->url != '' and file_exists($photo->url)){
                    unlink($photo->url);
                }

                $photo->url = fileUpload($request->file('avatar'),'students');
                $photo->save();
            }

            Alert::toast('Student Added Successfully','success');
            return back();
        }

        return false;
    }

     public function studentListForm($from){
        if ($from=='school'){return view('backend.students.list.select-school',['students'=>[],'from'=>$from]);}
        elseif ($from=='class'){
            $year = Session::get('year');
            $sectionId = Session::get('section_id');
            $classId = Session::get('class_id');

            if (isset($year) and isset($sectionId) and isset($classId)){
                $acYear = $year.' - '.$year+1;
                $section = Section::find($sectionId)->name;

                $class = $classId != 'all'? ClassName::find($classId)->name : 'All Classes';

                $request = (object) ['year'=>$year, 'section_id'=>$sectionId, 'class_id'=>$classId];

                $students = classAndBatchWiseStudents($request);

                $queries = ['year'=>$acYear, 'section'=>$section, 'class'=>$class];
                $title = 'Year : '.$year.' Section : '.$section.' Class : '.$class;

                return view('backend.students.list.select-class',[
                    'students'=>count($students)>0 ? $students : [],
                    'from'=>$from, 'queries'=>$queries, 'title'=>$title
                ]);
            }
            else{
                return view('backend.students.list.select-class',['students'=> [], 'from'=>$from,]);
            }
        }
        elseif ($from=='batch'){return view('backend.students.list.select-batch',['students'=>[],'from'=>$from]);}

        return false;
    }

    public function activeStudent(Request $request){
        if ($request->ajax()){
            $year = $request->year.' - '.$request->year+1;
            $section = Section::find($request->section_id)->name;
            if ($request->class_id=='all'){$class = 'All Classes';}
            else{$class = ClassName::find($request->class_id)->name;}
            if ($request->from=='class'){
                $students = classAndBatchWiseStudents($request);
                $queries = ['year'=>$year, 'section'=>$section, 'class'=>$class];
                $title = 'Year : '.$year.' Section : '.$section.' Class : '.$class;
            }

//            return $students;

            return view('backend.students.list.table',['students'=>$students,'from'=>$request->from,'queries'=>$queries,'title'=>$title]);
        }

        return false;
    }



    public function activeStudentForPassword(Request $request){
        if ($request->ajax()){
            $year = $request->year.' - '.$request->year+1;
            $section = Section::find($request->section_id)->name;
            if ($request->class_id=='all'){$class = 'All Classes';}
            else{$class = ClassName::find($request->class_id)->name;}
            if ($request->from=='class'){
                $students = classAndBatchWiseStudents($request);
                $queries = ['year'=>$year, 'section'=>$section, 'class'=>$class];
                $title = 'Year : '.$year.' Section : '.$section.' Class : '.$class;
            }
            return view('backend.students.list.password-table',['students'=>$students,'from'=>$request->from,'queries'=>$queries,'title'=>$title]);
        }
        return false;
    }

    public function activeStudentTitle(Request $request){
        if ($request->ajax()){
            $year = $request->year.' - '.$request->year+1;
            $session = AcademicSession::find($request->session_id)->name;
            if ($request->class_id=='all'){$class = 'All Classes';}
            else{$class = ClassName::find($request->class_id)->name;}
            if ($request->from=='school'){
                $school = School::find($request->school_id)->name;
                $title = 'Year : '.$year.', Session : '.$session.', School : '.$school.', Class : '.$class.' Student List';
            }
            elseif ($request->from=='class'){
                if ($request->batch_id=='all'){$batch = 'All Batches';}
                else{$batch = Batch::find($request->batch_id)->name;}
                $title = 'Year : '.$year.', Session : '.$session.', Class : '.$class.', Batch : '.$batch.' Student List';
            }
            return $title;
        }

        return false;
    }

    public function studentInformation($id){
        $student = Student::with(['photo'])->find($id);
        $studentClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'student'])
            ->where(['student_id'=>$id, 'status'=>1])->latest()->first();

        $studentMonthlyFee = StudentMonthlyFee::where([
            'student_id'=>$id, 'class_id'=>$studentClass->class_id, 'year'=>$studentClass->year, 'status'=>1
        ])->latest()->first(['student_id','class_id','year','monthly_fee','discount','payable']);

        $subjects = SubjectClass::with(['subject'=>function($query){$query->select(['id','name']);}])
            ->where(['class_id'=>$studentClass->classInfo->id])
            ->get(['id','class_id','subject_id','sub_code','status','creator_id'])
            ->sortBy('sub_code');

        $studentSubject = StudentClassSubject::with('subject')->where([
            'class_id'=>$studentClass->class_id,
            'student_id'=>$id
        ])->get();

        $selectedSubjects = [];

        foreach ($studentSubject as $item){
            $subjectClass = SubjectClass::where([
                'class_id'=>$item->class_id,
                'subject_id'=>$item->subject_id,
            ])->first();

//            return $subjectClass;

            if (!isset($subjectClass)){continue;}

            $code = $subjectClass->sub_code;

            $item->code = $code;

            $selectedSubjects[$code.$item->id] = $item;
        }

        ksort($selectedSubjects);

        return view('backend.students.profile',[
            'studentClass'=>$studentClass,
            'student'=>$student,
            'subjects'=>$subjects,
            'selectedSubjects'=>$selectedSubjects,
            'studentMonthlyFee'=>$studentMonthlyFee
        ]);
    }

    public function studentDetail($id){
        return Student::find($id);
    }

    public function delete(Request $request){
        $student = Student::find($request->id);
        $classes = StudentClass::where('student_id',$request->id)->get();
        foreach ($classes as $class){
            $class->status = 3; $class->save();

            DBlog('StudentClass','student_classes',$class->id,'Delete',user()->name);
        }
        $student->status = 3; $student->save();

        DBlog('Student','students',$request->id,'Delete',user()->name);


//        $year = Session::get('year');
//        $sectionId = Session::get('section_id');
//        $classId = Session::get('class_id');
//
//        $request = (object) ['year'=>$year, 'section_id'=>$sectionId, 'class_id'=>$classId];
//
//        $students = classAndBatchWiseStudents($request);

        return response()->json([
            'success'=>true,
            'sa_title'=>'Success',
            'sa_message'=>'Student Deleted Successfully',
            'sa_icon'=>'success'
        ]);
    }

    public function promotionForm(){
        $year = Session::get('year');
        $classId = Session::get('class_id');
        $nextYear = Session::get('next_year');
        $nextClassId = Session::get('next_class_id');

        $students = [];
        $charges = [];
        if (isset($year) and isset($classId) and isset($nextYear) and isset($nextClassId)){
            $students = $this->promotedStudentList($year, $classId, $nextYear, $nextClassId);
            $charges = $this->promotionCharges($nextYear, $nextClassId);
        }

//        return $students;

        if (count($students)>0){
            $fee = $this->tuitionFeeCheckForClass($nextYear,$nextClassId);

            if (!isset($fee)){
                Alert::error('Tuition Fee Not Found','Error');
            }
        }

        return view('backend.students.promotion.form',compact('students','charges'));
    }

    public function studentListForPromotion(Request $request){
        $year = $request->year;
        $classId = $request->class_id;
        $nextYear = $request->next_year;
        $nextClassId = $request->next_class_id;

        $students = $this->promotedStudentList($year, $classId, $nextYear, $nextClassId);

        $charges = $this->promotionCharges($nextYear, $nextClassId);

        if (count($students)>0){
            $fee = $this->tuitionFeeCheckForClass($nextYear,$nextClassId);

            if (!isset($fee)){
                return '<h3 class="text-danger text-center">Please Set Tuition Fee For Next Class, Then Try Again !!!</h3>';
            }
        }

        return view('backend.students.promotion.table',compact('students','charges'));
    }

    protected function promotedStudentList($year, $classId, $nextYear, $nextClassId){
        $students = [];
        $studentClasses = StudentClass::with([
            'student'=>function ($query) {
                $query->select(['id','name','mother_mobile','roll']);
            }
        ])->where([
            'year'=>$year, 'class_id'=>$classId,
        ])->get(['id','student_id']);

        if (count($studentClasses)>0){
            foreach ($studentClasses as $studentClass){
                $item = [];
                $checked = $this->checkStudentMeta($studentClass->student_id,$nextClassId);

                $invoice = invoiceChecker($nextYear,$nextClassId,$studentClass->student_id,2,1);

                if ($checked and !isset($invoice)){
                    $item['year']= $year;
                    $item['class_id']= $classId;
                    $item['next_year']= $nextYear;
                    $item['next_class_id']= $nextClassId;

                    $item['id'] = $studentClass->student_id;
                    $item['name'] = $studentClass->student->name;
                    $item['mother_mobile'] = $studentClass->student->mother_mobile;
                    $item['roll'] = $studentClass->student->roll;
                    $fee = StudentMonthlyFee::where([
                        'year'=>$year,'class_id'=>$classId, 'student_id'=>$studentClass->student_id, 'status'=>1
                    ])->latest()->first(['id','monthly_fee','discount']);
                    $item['monthly_fee_id'] = isset($fee)? $fee->id : false;
                    $item['monthly_fee'] = isset($fee)? $fee->monthly_fee : 0;
                    $item['discount'] = isset($fee)? $fee->discount : 0;
                    $item['payable'] = isset($fee)? ($fee->monthly_fee - $fee->discount) : 0;
                    $students[] = $item;
                }
            }
        }

        return $students;
    }

    protected function promotionCharges($nextYear, $nextClassId){
        $classItems = ClassItem::with(['item'])->where([
            'year'=>$nextYear,
//            'year'=>2025,
            'class_id'=>$nextClassId,
//            'class_id'=>11,
            'status'=>1,
        ])->get(['id','year','class_id','item_id','amount','status']);

        $selectedItems = [];
        foreach ($classItems as $classItem){
            $item = [];
            if ($classItem->item->used_for==1 and $classItem->item->billing_cycle==2){
                $item['class_item_id'] = $classItem->id;
                $item['item_id'] = $classItem->item_id;
                $item['name'] = $classItem->item->name;
                $item['amount'] = $classItem->amount;
                $item['year'] = $classItem->year;
                $item['class_id'] = $classItem->class_id;

                $selectedItems[]= $item;
            }
        }
        return $selectedItems;
    }

    public function checkStudentMeta($studentId,$promotedClassId){
        $meta = ResultMeta::where([
            'student_id'=>$studentId,
            'promoted_class_id'=>$promotedClassId,
            'promo_status'=>1,
        ])->latest()->first(['id','student_id','promoted_class_id']);

        if (isset($meta)){return $meta;}
        else{return false;}
    }

    public function invoiceGenerationForPromotion(Request $request){
        $data = $request->all();
        $items = Item::where([
            'used_for'=>1,  //1=student
            'status'=>1,
        ])->where('billing_cycle','!=',1)
            ->get(['id','name','billing_cycle']);

        return view('backend.students.promotion.invoice-generation-form',compact('data','items'));
    }

    public function getFeeByClassAndYear(Request $request){
        $tuitionFee = Item::where([
            'name'=>'Tuition Fee',
            'status'=>1,
        ])->latest()->first();
        if (!isset($tuitionFee)){
            $tuitionFee = new Item();
            $tuitionFee->name = 'Tuition Fee';
            $tuitionFee->used_for = 1;
            $tuitionFee->billing_cycle = 3;
            $tuitionFee->status = 1;
            $tuitionFee->creator_id = 1;
            $tuitionFee->save();

            $classItem = new ClassItem();
            $classItem->year =  $request->year;
            $classItem->class_id  = $request->class_id;
            $classItem->item_id = $tuitionFee->id;
            $classItem->amount = 1;
            $classItem->status = 1;
            $classItem->creator_id = 1;
            $classItem->save();
        }else{
            $classItem = ClassItem::where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'item_id'=>$tuitionFee->id,
                'status'=>1,
            ])->latest()->first();
            if (!isset($classItem)){
                $classItem = new ClassItem();
                $classItem->year =  $request->year;
                $classItem->class_id  = $request->class_id;
                $classItem->item_id = $tuitionFee->id;
                $classItem->amount = 1;
                $classItem->status = 1;
                $classItem->creator_id = 1;
                $classItem->save();
            }
        }

        return $classItem;
    }

    public function promotionSave(Request $request){
        if ($request->post()){
            $students = $request->students;
            if (isset($students) and count($students)>0){
                $lastYear = $request->year;
                $currentYear = $request->next_year;
                $lastClassId = $request->class_id;
                $currentClassId = $request->next_class_id;
                $originalCharges = $request->original_charges;
                $checkedItems = $request->charges;
                $discounts = $request->discount;
                $itemDiscounts = $request->item_discount;
                $receivables = $request->receivable;
                $remarks = $request->remark;

                foreach ($students as $studentId => $studentStatus){
                    $studentCheckedItems = $checkedItems[$studentId];
                    $hasInvoice = invoiceChecker($currentYear,$currentClassId,$studentId,2,1);
                    if (!isset($hasInvoice)){
                        //Insert New Invoice
                        $invoiceId = $this->insertInvoice($currentYear,$currentClassId,$studentId,$receivables,$discounts);
                        //Insert New Invoice Details
                        foreach ($studentCheckedItems as $classItemId => $studentCheckedItem){
                            $this->insertInvoiceDetail($invoiceId,$studentId,$classItemId,$originalCharges,$itemDiscounts);
                        }
                        //Insert Invoice Note if exist
                        if ($remarks[$studentId]!=null){
                            $this->insertNote($studentId,$remarks,$invoiceId);
                        }

                        $this->insertStudentClassAndMonthlyFee($studentId,$lastClassId,$lastYear,$currentClassId,$currentYear);
                    }
                }

                Alert::toast('Operation Successful','success');
                return back();
            }else{
                Alert::toast('No Student Selected','error');
                return back();
            }
        }

        return false;
    }

    protected function insertInvoice($currentYear,$currentClassId,$studentId,$receivables,$discounts){
        $invoice = new Invoice();
        $invoice->invoice_no = createInvoiceNumber();
        $invoice->invoice_type = 2;
        $invoice->year = $currentYear;
        $invoice->class_id = $currentClassId;
        $invoice->student_id = $studentId;
        $invoice->actual_amount = ($receivables[$studentId]+$discounts[$studentId]);
        $invoice->discount_amount = $discounts[$studentId];
        $invoice->receivable_amount = $receivables[$studentId];
        $invoice->creator_id = user()->id;
        $invoice->updater_id = user()->id;
        $invoice->save();
        return $invoice->id;
    }

    protected function insertInvoiceDetail($invoiceId,$studentId,$classItemId,$originalCharges,$itemDiscounts){
        $detail = new InvoiceDetails();
        $detail->invoice_id = $invoiceId;
        $detail->class_item_id = $classItemId;
        $detail->actual_amount = $originalCharges[$classItemId];
        $detail->discount_amount = $itemDiscounts[$studentId][$classItemId]==null ? 0 : $itemDiscounts[$studentId][$classItemId];
        $detail->receivable_amount = ($originalCharges[$classItemId] - $itemDiscounts[$studentId][$classItemId]);
        $detail->creator_id = user()->id;
        $detail->save();
        return true;
    }

    protected function insertNote($studentId,$remarks,$invoiceId){
        $note = new InvoiceNote();
        $note->invoice_id = $invoiceId;
        $note->note = $remarks[$studentId];
        $note->creator_id = user()->id;
        $note->save();
        return $note->id;
    }

    protected function insertStudentClassAndMonthlyFee($studentId,$classId,$year,$nextClassId,$nextYear){
        $oldClass =  StudentClass::where([
            'student_id'=>$studentId,
            'class_id'=>$classId,
            'year'=>$year,
            'status'=>1,
        ])->latest()->first();

        if(isset($oldClass)){
            $oldClass->status = 4; //Transferred
            $oldClass->save();
        }

        $currentClass = StudentClass::where([
            'student_id'=>$studentId,
            'class_id'=>$nextClassId,
            'year'=>$nextYear,
            'status'=>1,
        ])->latest()->first();

        if (!isset($currentClass)){
            $currentClass = new StudentClass();
        }
        $currentClass->student_id = $studentId;
        $currentClass->class_id = $nextClassId;
        $currentClass->year = $nextYear;
        $currentClass->creator_id = user()->id;
        $currentClass->save();

         $tuitionFee = Item::where([
            'name'=>'Tuition Fee',
            'used_for'=>1,
            'billing_cycle'=>3,
            'status'=>1,
        ])->latest()->first(['id','name']);

         if (!isset($tuitionFee)){
             return false;
         }else{
             $classTuitionFee = ClassItem::where([
                 'year'=>$nextYear,
                 'class_id'=>$nextClassId,
                 'item_id'=>$tuitionFee->id,
                 'status'=>1,
             ])->latest()->first(['id','amount']);

             if (!isset($classTuitionFee)){
                 return false;
             }else{
                 $oldFee = StudentMonthlyFee::where([
                     'student_id'=>$studentId,
                     'class_id'=>$classId,
                     'year'=>$year,
                     'status'=>1,
                 ])->latest()->first();

                 $payable = ($classTuitionFee->amount - ($classTuitionFee->amount*($oldFee->discount/100)));

                 $currentFee = StudentMonthlyFee::where([
                     'student_id'=>$studentId,
                     'class_id'=>$nextClassId,
                     'year'=>$nextYear,
                     'status'=>1,
                 ])->latest()->first();

                 if (!isset($currentFee)){
                     $currentFee = new StudentMonthlyFee();
                 }
                 $currentFee->student_id = $studentId;
                 $currentFee->class_id = $nextClassId;
                 $currentFee->year = $nextYear;
                 $currentFee->monthly_fee = $classTuitionFee->amount;
                 $currentFee->discount = $oldFee->discount;
                 $currentFee->payable = $payable;
                 $currentFee->creator_id = user()->id;
                 $currentFee->save();
             }
         }

         return false;
    }

    protected function tuitionFeeCheckForClass($year, $classId){
        $tuitionFee = Item::where([
            'name'=>'Tuition Fee',
            'used_for'=>1,
            'billing_cycle'=>3,
            'status'=>1,
        ])->latest()->first(['id','name']);

        if (!isset($tuitionFee)){
            return null;
        }else {
            $classTuitionFee = ClassItem::with('item')->where([
                'year' => $year,
                'class_id' => $classId,
                'item_id' => $tuitionFee->id,
                'status' => 1,
            ])->latest()->first(['id', 'amount']);

            if (!isset($classTuitionFee)){
                return null;
            }else{
                return $classTuitionFee;
            }
        }
    }
}
