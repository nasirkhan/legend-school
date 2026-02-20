<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ClassName;
use App\Models\ClassPerformance;
use App\Models\ClassRoutine;
use App\Models\ClassTeachersComment;
use App\Models\ECAType;
use App\Models\Exam;
use App\Models\HW;
use App\Models\NewPayment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentClassSubject;
use App\Models\StudentHW;
use App\Models\StudentPaymentItem;
use App\Models\Subject;
use App\Models\SubjectClass;
use App\Models\TimeSheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class StudentLoginController extends Controller
{
    public function studentLoginForm(){
        $student = Student::find(Session::get('studentId'));
        if (isset($student)){
            return $this->studentProfile();
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentLogin(Request $request){
        if ($request->post()){
            $student = Student::where(['mobile'=>$request->mobile, 'password'=>$request->password, 'status'=>1])->first();
            if (isset($student)){
                Session::put('studentId',$student->id);
                return $this->studentProfile();
            }else{
                return back()->with('error_message','No Data Found !!!');
            }
        }
    }

    public function studentProfile(){
        if (Session::get('studentId')){
            $id = Session::get('studentId');
            $student = Student::with('classInfo','photo')->find($id);
            $studentClass = $this->studentClass();

            $subjects = SubjectClass::with(['subject'=>function($query){$query->select(['id','name']);}])
                ->where(['class_id'=>$studentClass->classInfo->id])
                ->get(['id','class_id','subject_id','sub_code','status','creator_id'])
                ->sortBy('sub_code');

            $studentSubject = StudentClassSubject::with('subject')
                ->where(['class_id'=>$studentClass->class_id, 'student_id'=>$id])
                ->get();

            $selectedSubjects = [];

            foreach ($studentSubject as $item){
                $code = SubjectClass::where(['class_id'=>$item->class_id, 'subject_id'=>$item->subject_id,])
                    ->first()->sub_code;

                $item->code = $code;

                $selectedSubjects[$code.$item->id] = $item;
            }

            ksort($selectedSubjects);
            return view('front.student.profile.profile',[
                'studentClass'=>$studentClass,
                'student'=>$student,
                'subjects'=>$subjects,
                'selectedSubjects'=>$selectedSubjects
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentPasswordUpdateForm(){
        $id = Session::get('studentId');
        if ($id){
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            return view('front.student.profile.password-update-form',[
                'student'=>$student,
                'studentClass'=>$studentClass,
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentPasswordUpdate(Request $request){
        $id = Session::get('studentId');
        if ($id){
            $student = Student::with('photo')->find($id);

            $request->validate([
                'old_password'=>'required',
                'new_password'=>'required',
            ]);

            if ($student->password == $request->old_password and $request->new_password!=null and $request->new_password!=''){
                $student->password = $request->new_password;
                $student->save();
                Alert::success('Success', 'Password updated successfully !!!');
                return redirect('/student-profile');
            }else{
                Alert::error('Error', 'Password not updated !!!');
                return back();
            }

        }else{
            return view('front.student.login-form');
        }
    }
    public function studentLogout(){
        Session::forget('studentId');
        return redirect('/');
    }

    public function studentSubjectChoiceForm(){
        if (Session::get('studentId')){
        $student = Student::with('classInfo','photo')->find(Session::get('studentId'));
        return view('front.student.subject-choice-form',[
            'student'=>$student,
            'class'=>ClassName::with('subjects')->find($student->class_id)
        ]);

        }else{
            return view('front.student.login-form');
        }
    }

    public function studentSubjectList(){
        $id = Session::get('studentId');
        if ($id){
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $classSubjects = $this->subjects($studentClass->class_id);

            return view('front.student.subject-list',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentRoutine($id){
        return ClassRoutine::where('class_id',$id)->first();
    }

    public function studentSyllabus(){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $classSubjects = $this->subjects($studentClass->class_id);

            return view('front.student.syllabus',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentRevisionWorksheet(){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $classSubjects = $this->subjects($studentClass->class_id);

            return view('front.student.revision-worksheet',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentAttendanceReport(Request $request){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $studentSubject = StudentClassSubject::with('subject')
                ->where(['class_id'=>$studentClass->class_id, 'student_id'=>$id])
                ->get();

            $selectedSubjects = [];

            foreach ($studentSubject as $item){
                $code = SubjectClass::where(['class_id'=>$item->class_id, 'subject_id'=>$item->subject_id,])
                    ->first()->sub_code;
                $item->code = $code;
                $selectedSubjects[$code.$item->id] = $item;
            }

            ksort($selectedSubjects);

            //Attendance Processing
            if (!isset($request->from) and !isset($request->to)){
                $from = Carbon::today()->subMonth();
                $to = Carbon::today();
            }else{
                $from = $request->from;
                $to = $request->to;
            }
            return view('front.student.attendance-report',[
                'student'=>$student,
                'selectedSubjects'=>$selectedSubjects,
                'studentClass'=>$studentClass,
                'studentSubject'=>$studentSubject,
                'attendances'=>TimeSheet::getAttendanceReport($from,$to,$student->roll),
                'from'=>$from, 'to'=>$to
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentExamSchedule(){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $classSubjects = $this->subjects($studentClass->class_id);

            return view('front.student.exam-schedule',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function academicTranscript(){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            $exams = Exam::with('classInfo')->where([
                'year'=>$studentClass->year,
                'class_id'=>$studentClass->class_id,
                'status'=>1,
                'publication_status'=>1
            ])->get(['id','name','year','class_id','section_id']);


            return view('front.student.exam-report-card',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'exams'=>$exams
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentReportCardByOwn(Request $request){
        $exam = Exam::with(['classInfo'])->find($request->exam_id);

        $classSubjects = $this->subjects($request->class_id);

        $comment = ClassTeachersComment::where([
            'student_id'=>$request->student_id,
            'exam_id'=>$request->exam_id
        ])->first();

        $sc = $this->ecaType(1);
        $lc = $this->ecaType(2);
        $sic = $this->ecaType(3);
        $cpac = $this->ecaType(4);
        $csc = $this->ecaType(5);
        $ac = $this->ecaType(6);
        $tic = $this->ecaType(7);
        $olmp = $this->ecaType(8);

        if ($exam->classInfo->section_id == 1 or $exam->classInfo->section_id == 2){
//            return view('backend.exams.results.report-card-print',[
            return view('front.student.report-card.report-card-print',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'components'=>$exam->components,
                'data'=>$request, 'comment'=>$comment,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }else{
//            return view('backend.exams.results.senior-report-card-print',[
            return view('front.student.report-card.senior-report-card',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'data'=>$request, 'comment'=>$comment,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }
    }

    protected function ecaType($id){
        return ECAType::with(['items'=>function($query){$query->where(['status'=>1])->select(['id','eca_type_id','name','code']);}])
            ->where(['id'=>$id, 'status'=>1])
            ->first(['id','name','code','status']);
    }

    public function studentHomeWork(){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            return view('front.student.home-work-list',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'classSubjects'=>$this->subjects($studentClass->class_id)
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentHomeWorkDetails(Request $request){
        $id = Session::get('studentId');
        if ($id) {
            $student = Student::with('photo')->find($id);
            $studentClass = $this->studentClass();

            return view('front.student.home-work-detail',[
                'student'=>$student,
                'studentClass'=>$studentClass,
                'hw'=>HW::with('subject')->find($request->id)
            ]);
        }else{
            return view('front.student.login-form');
        }
    }

    public function studentHomeWorkUpload(Request $request){

        $request->validate([
            'file'=>'required'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $shw = studentHomeWork($request->student_id,$request->hw_id);

            if (!isset($shw)){
                $shw = new StudentHW();
            }
            $shw->student_id = $request->student_id;
            $shw->hw_id = $request->hw_id;
            $shw->hw_url = fileUpload($file,'student-home-work');
            $shw->save();

            return response()->json(['success' => 'File uploaded successfully']);
        }

        return response()->json(['error' => 'No file was uploaded'], 400);
    }


    protected function subjects($classId){
        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$classId,
            'status'=>1
        ])->get(['id','class_id','subject_id','sub_code','status'])->sortBy('sub_code');

        return $classSubjects;
    }

    public function studentDetailPaymentReport(){
        $id = Session::get('studentId');

        $student = Student::with('photo')->find($id);

        $studentClass = $this->studentClass();

        $paymentInfos1 = StudentPaymentItem::with(['item','month','payment'])->where(['student_id'=>$id,])
            ->where('due_date','=',null)
            ->get();

        $paymentInfos2 = StudentPaymentItem::with(['item','month','payment'])->where(['student_id'=>$id,])
            ->where('due_date','<=',Carbon::today()->format('Y-m-d'))
            ->get();

        $paymentInfos = $paymentInfos1->merge($paymentInfos2);

        return view('front.student.payment-report',compact('paymentInfos','student','studentClass'));
    }

    public function studentClassPerformance(){
        $id = Session::get('studentId');
        $student = Student::with('photo')->find($id);
        $studentClass = $this->studentClass();

        $classSubjects = StudentClassSubject::with([
            'subject'=>function($query){$query->select(['id','name']);}
        ])->where([
            'student_id'=>$id,
            'class_id'=>$studentClass->class_id,
        ])->get(['id','student_id','class_id','subject_id']);

        $classPerformances = [
            ['subject'=>'Physics', 'topic'=>'Motion' ,'performance'=>'Very Good'],
            ['subject'=>'Chemistry', 'topic'=>'Bonding', 'performance'=>'Good'],
            ['subject'=>'Math-D', 'topic'=>'Simultaneous Equation Solving', 'performance'=>'Average'],
            ['subject'=>'Additional Math', 'topic'=>'Circle', 'performance'=>'Good'],
            ['subject'=>'Biology', 'topic'=>'Cell Division','performance'=>'Good'],
            ['subject'=>'Computer Science', 'topic'=>'For Loop','performance'=>'Good'],
            ['subject'=>'Bangla', 'topic'=>'চিঠি', 'performance'=>'Average'],
            ['subject'=>'English Language', 'topic'=>'Comprehension', 'performance'=>'Good'],
            ['subject'=>'English Literature', 'topic'=>'Harry Porter' ,'performance'=>'Average'],
        ];

        return view('front.student.class-performance',compact('student','studentClass','classPerformances','classSubjects'));
    }

    public function classPerformanceHistory(Request $request){
        $id = Session::get('studentId');
        $student = Student::with('photo')->find($id);
        $studentClass = $this->studentClass();
        $subject = Subject::where('id',$request->subject_id)->first(['id','name']);

        $history = ClassPerformance::with([
            'tag'=>function ($query) {
                $query->select(['id','name']);
            }
        ])->where([
            'class_id'=>$studentClass->class_id,
            'subject_id'=>$request->subject_id,
            'student_id'=>$id,
        ])->orderBy('id','desc')->get();

        return view('front.student.class-performance-history',compact('student','studentClass','subject','history'));
    }

    protected function studentClass(){
        $id = Session::get('studentId');
        return StudentClass::with(['classInfo'=>function($query){$query->select('id','name','code','section_id');}, 'student'])
            ->where(['student_id'=>$id, 'status'=>1])->latest()->first();
    }
}
