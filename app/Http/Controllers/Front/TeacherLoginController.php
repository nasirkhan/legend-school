<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Section;
use App\Models\SubjectClass;
use App\Models\Teacher;
use App\Models\TeacherLoginInfo;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class TeacherLoginController extends Controller
{
    public function teacherLoginForm(){
        $teacher = Teacher::find(Session::get('teacherId'));
        if (isset($teacher)){
            return $this->teacherProfile();
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherLogin(Request $request){
        $teacher = TeacherLoginInfo::where('mobile',$request->uid)
            ->orWhere('email',$request->uid)->first();

//        return $teacher;

        if (isset($teacher)){
            if (password_verify($request->password,$teacher->password)){
                Session::put('teacherId',$teacher->teacher_id);

                return redirect('/teacher-profile');
//                return $this->teacherProfile();
            }else{
                return 'Failed';
            }
        }else{
            Alert::info('Failed','Data does not matched !!!');
            return back();
        }
    }

    public function teacherProfile(){
        if (Session::get('teacherId')){
            $id = Session::get('teacherId');
            $teacher = Teacher::with([
                'designation'=>function($query){$query->select(['id','name']);}
            ])->where('id',$id)->first(['id','name','designation_id','mobile','email','address','passport','photo','status']);

            $schedules = ClassSchedule::with([
                'day'=>function($query){$query->select(['id','name','code']);},
                'period'=>function($query){$query->where('status',1)->select(['id','name','code','start','end','status']);}
            ])
                ->where(['year'=>siteInfo('running_year'), 'teacher_id'=>$id])
                ->get();

            return view('front.teacher.profile.profile',[
                'schedules'=>$schedules, 'section'=>Section::find(3), 'teacher'=>$teacher
            ]);

            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            $subjects = SubjectClass::with(['subject'=>function($query){$query->select(['id','name']);}])
                ->where(['class_id'=>$teacherClass->classInfo->id])
                ->get(['id','class_id','subject_id','sub_code','status','creator_id'])
                ->sortBy('sub_code');

            $teacherSubject = StudentClassSubject::with('subject')
                ->where(['class_id'=>$teacherClass->class_id, 'teacher_id'=>$id])
                ->get();

            $selectedSubjects = [];

            foreach ($teacherSubject as $item){
                $code = SubjectClass::where(['class_id'=>$item->class_id, 'subject_id'=>$item->subject_id,])
                    ->first()->sub_code;

                $item->code = $code;

                $selectedSubjects[$code.$item->id] = $item;
            }

            ksort($selectedSubjects);
            return view('front.teacher.profile.profile',['teacherClass'=>$teacherClass,'teacher'=>$teacher,'subjects'=>$subjects, 'selectedSubjects'=>$selectedSubjects]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherProfileEdit(){
        $id = Session::get('teacherId');
        $teacher = Teacher::with([
            'designation'=>function($query){$query->select(['id','name']);},
            'sections'
        ])->where('id',$id)->first(['id','name','designation_id','mobile','email','address','passport','photo','status']);

        return view('front.teacher.profile-update-form',['teacher'=>$teacher]);
    }

    public function teacherProfileUpdate(Request $request){
        $id = Session::get('teacherId');
        if (isset($id) and $request->post()){
            $teacher = Teacher::find($id);

            $teacher->name = $request->name;
            $teacher->mobile = $request->mobile;
            $teacher->email = $request->email;
            $teacher->passport = $request->passport;
            $teacher->address = $request->address;

            if (isset($request->photo)){
                if (file_exists($teacher->photo)){
                    unlink($teacher->photo);
                }
                $teacher->photo = fileUpload($request->file('photo'),'teachers');
            }

            $teacher->save();

            Alert::success('Message','Profile Updated Successfully !!!');
            return redirect('/teacher-profile');
        }else{
            abort(404);
        }
    }

    public function teacherPasswordChangeForm(){
        $id = Session::get('teacherId');
        $teacher = Teacher::with([
            'designation'=>function($query){$query->select(['id','name']);},
            'sections'
        ])->where('id',$id)->first(['id','name','designation_id','mobile','email','address','passport','photo','status']);

        return view('front.teacher.password-update-form',['teacher'=>$teacher]);
    }

    public function teacherPasswordUpdate(Request $request){
        $id = Session::get('teacherId');
        if (isset($id) and $request->post()){
            $teacher = TeacherLoginInfo::where('teacher_id',$id)->first();

            if (isset($teacher)){
                if (password_verify($request->old_password,$teacher->password)){
                    $teacher->password = Hash::make($request->new_password);
                    $teacher->save();
                    Alert::success('Message','Password Updated Successfully !!!');
                    return back();
                }else{
                    Alert::error('Failed','Old Password is not matched !!!');
                    return back();
                }

            }else{
                Alert::error('Failed','User Not Found !!!');
                return back();
            }
        }else{
            abort(404);
        }
    }

    public function teacherSchedule(){
        $id = Session::get('teacherId');
        $teacher = Teacher::with([
            'designation'=>function($query){$query->select(['id','name']);},
            'sections'
        ])->where('id',$id)->first(['id','name','designation_id','mobile','email','address','passport','photo','status']);

        $schedules = ClassSchedule::with([
            'day'=>function($query){$query->select(['id','name','code']);},
            'period'=>function($query){$query->where('status',1)->select(['id','name','code','start','end','status']);}
        ])
            ->where(['year'=>siteInfo('running_year'), 'teacher_id'=>$id])
            ->get();

        return view('front.teacher.profile.schedules',[
            'schedules'=>$schedules, 'section'=>Section::find(3), 'teacher'=>$teacher,
        ]);
    }

    public function teacherLogout(){
        Session::forget('teacherId');
        return redirect('/');
    }

    public function teacherSubjectChoiceForm(){
        if (Session::get('teacherId')){
            $teacher = Student::with('classInfo','photo')->find(Session::get('teacherId'));
            return view('front.teacher.subject-choice-form',[
                'teacher'=>$teacher,
                'class'=>ClassName::with('subjects')->find($teacher->class_id)
            ]);

        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherSubjectList(){
        $id = Session::get('teacherId');
        if ($id){
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            $classSubjects = $this->subjects($teacherClass->class_id);

            return view('front.teacher.subject-list',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherRoutine($id){
        return ClassRoutine::where('class_id',$id)->first();
    }

    public function teacherSyllabus(){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            $classSubjects = $this->subjects($teacherClass->class_id);

            return view('front.teacher.syllabus',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherAttendanceReport(){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            $teacherSubject = StudentClassSubject::with('subject')
                ->where(['class_id'=>$teacherClass->class_id, 'teacher_id'=>$id])
                ->get();

            $selectedSubjects = [];

            foreach ($teacherSubject as $item){
                $code = SubjectClass::where(['class_id'=>$item->class_id, 'subject_id'=>$item->subject_id,])
                    ->first()->sub_code;

                $item->code = $code;

                $selectedSubjects[$code.$item->id] = $item;
            }

            $attendances = [
                ['sl'=>1,'date'=>'01/08/2024', 'day'=>'Sunday', 'status'=>'Present'],
                ['sl'=>2,'date'=>'02/08/2024', 'day'=>'Monday', 'status'=>'Present'],
                ['sl'=>3,'date'=>'03/08/2024', 'day'=>'Tuesday', 'status'=>'Present'],
                ['sl'=>4,'date'=>'04/08/2024', 'day'=>'Wednesday', 'status'=>'Absent'],
                ['sl'=>5,'date'=>'05/08/2024', 'day'=>'Thursday', 'status'=>'Present'],
            ];

            ksort($selectedSubjects);
            return view('front.teacher.attendance-report',[
                'teacher'=>$teacher,
                'selectedSubjects'=>$selectedSubjects,
                'teacherClass'=>$teacherClass,
                'teacherSubject'=>$teacherSubject,
                'attendances'=>$attendances
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherExamSchedule(){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            $classSubjects = $this->subjects($teacherClass->class_id);

            return view('front.teacher.exam-schedule',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function academicTranscript(){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();


            $exams = Exam::where([
                'class_id'=>$teacherClass->class_id,
                'status'=>1,
                'publication_status'=>1
            ])->get();

//            return $exams;

            return view('front.teacher.exam-report-card',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'exams'=>$exams
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherReportCardByOwn(Request $request){
        $exam = Exam::with(['classInfo'])->find($request->exam_id);

        $classSubjects = $this->subjects($request->class_id);

        $comment = ClassTeachersComment::where([
            'teacher_id'=>$request->teacher_id,
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
            return view('front.teacher.report-card.report-card-print',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'teacher'=>Student::find($request->teacher_id),
                'components'=>$exam->components,
                'data'=>$request, 'comment'=>$comment,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }else{
//            return view('backend.exams.results.senior-report-card-print',[
            return view('front.teacher.report-card.senior-report-card',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'teacher'=>Student::find($request->teacher_id),
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

    public function teacherHomeWork(){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            return view('front.teacher.home-work-list',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'classSubjects'=>$this->subjects($teacherClass->class_id)
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherHomeWorkDetails(Request $request){
        $id = Session::get('teacherId');
        if ($id) {
            $teacher = Student::with('photo')->find($id);
            $teacherClass = StudentClass::with(['classInfo'=>function($query){$query->select('id','name','code','section_id');}, 'teacher'])
                ->where(['teacher_id'=>$id, 'status'=>1])->latest()->first();

            return view('front.teacher.home-work-detail',[
                'teacher'=>$teacher,
                'teacherClass'=>$teacherClass,
                'hw'=>HW::with('subject')->find($request->id)
            ]);
        }else{
            return view('front.teacher.login-form');
        }
    }

    public function teacherHomeWorkUpload(Request $request){

        $request->validate([
            'file'=>'required'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');


            $shw = teacherHomeWork($request->teacher_id,$request->hw_id);

            if (!isset($shw)){
                $shw = new StudentHW();
            }
            $shw->teacher_id = $request->teacher_id;
            $shw->hw_id = $request->hw_id;
            $shw->hw_url = fileUpload($file,'teacher-home-work');
            $shw->save();

            return response()->json(['success' => 'File uploaded successfully']);
        }

        return response()->json(['error' => 'No file was uploaded'], 400);
    }


    public function getTeacherClasses(Request $request){
        $id = Session::get('teacherId');
        $year = $request->year;
        return teacherClass($year,$id);
    }

    public function getTeacherSubject(Request $request){
        $id = Session::get('teacherId');
        $year = $request->year;
        $classId = $request->class_id;
        return teacherClassSubject($year,$id,$classId);

//        $schedules = ClassSchedule::with('subject')->where(['year'=>$year, 'teacher_id'=>$id, 'class_id'=>$request->class_id, 'status'=>1])
//            ->get()->groupBy('subject_id');
//
//        $subjects = [];
//        foreach ($schedules as $subjectId => $schedule){
//            $subjects[$subjectId] = $schedule[0]->subject;
//        }
//
//        return $subjects;
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
}
