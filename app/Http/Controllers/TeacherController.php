<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Day;
use App\Models\Designation;
use App\Models\Period;
use App\Models\Section;
use App\Models\SectionTeacher;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use App\Models\TeacherLoginInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
        $teachers = Teacher::where('status','!=',3)->get()->sortBy('sl');
        return view('backend.teachers.manage',[
            'teachers'=>$teachers
        ]);
    }

    public function createTeacherLoginInfo(Request $request){
        if (Auth::user() and role()->code=='developer'){
            $defaultPassword = 12345678;
            $info = TeacherLoginInfo::where('teacher_id',$request->id)->first();
            if (!isset($info)){
                $teacher = Teacher::find($request->id);
                if (isset($teacher)){
                    $info = new TeacherLoginInfo();
                    $info->teacher_id = $request->id;
//                    $info->mobile = mobileNumberFilter($teacher->mobile);
                    $info->mobile = $teacher->mobile;
                    $info->email = $teacher->email;
                    $info->password = Hash::make($defaultPassword);
                    $info->save();
                }else{
                    Alert::toast('Teacher not found !!!');
                    return back();
                }
            }else{
                $info->password = Hash::make($defaultPassword);
                $info->save();
            }
            $mobile = mobileNumberFilter($info->mobile);
            $sender = siteInfo('sender_name');
            $message = "Honorable teacher,\nYour LIS Login password was reset.\nThe default password was set to 12345678.\nPlease update the password for your security.\nLEGEND.";

            singleMessageSend($mobile,$message);

            Alert::toast('Teacher Login Info Updated.','success');
            return back();

//            return response()->json([
//                'success'=>true,
//                'sa_title'=>'Message',
//                'sa_message'=>'Teacher Login Info Updated.'.'<br> Default password is: '.$defaultPassword,
//                'sa_icon'=>'success'
//            ]);
        }
    }
    public function registrationForm(){
        $sections = Section::all();
        $designations = Designation::all()->sortBy('id')->sortBy('sl');
        $teachers = Teacher::where('status','!=',3)->get()->sortBy('sl');
        return view('backend.teachers.registration-form',[
            'sections'=>$sections,
            'designations'=>$designations,
            'teachers'=>$teachers
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->designation_id = $request->designation_id;
            $teacher->mobile = $request->mobile;
            $teacher->email = $request->email;
            $teacher->passport = $request->passport;
            $teacher->address = $request->address;
            if (isset($request->avatar)){
                $teacher->photo = fileUpload($request->file('avatar'),'teachers');
            }

            $teacher->sl = count(Teacher::all())+1;
            $teacher->creator_id = user()->id;
            $teacher->save();
            $teacherId = $teacher->id;

            if (isset($request->sections)){
                foreach ($request->sections as $section){
                    $st = new SectionTeacher();
                    $st->section_id = $section;
                    $st->teacher_id = $teacherId;
                    $st->status = 1;
                    $st->creator_id = user()->id;
                    $st->save();
                }
            }

            Alert::toast('Success','success');
            return back();
        }
    }

    public function edit($id){
        $teacher = Teacher::with('sections')->find($id);
        $sections = Section::all();
        $designations = Designation::all()->sortBy('id')->sortBy('sl');
        $teachers = Teacher::where('status','!=',3)->get()->sortBy('sl');
        return view('backend.teachers.registration-edit-form',[
            'teacher'=>$teacher,
            'sections'=>$sections,
            'designations'=>$designations,
            'teachers'=>$teachers
        ]);
    }

    public function update(Request $request){
        if ($request->post()){

            $teacher = Teacher::find($request->id);
            $teacher->name = $request->name;
            $teacher->designation_id = $request->designation_id;
            $teacher->mobile = $request->mobile;
            $teacher->email = $request->email;
            $teacher->passport = $request->passport;
            $teacher->address = $request->address;
            if (isset($request->avatar)){
                if (file_exists($teacher->photo)){
                    unlink($teacher->photo);
                }
                $teacher->photo = fileUpload($request->file('avatar'),'teachers');
            }

            $teacher->creator_id = user()->id;
            $teacher->save();

            $teacherSections = SectionTeacher::where('teacher_id',$request->id)->get();
            foreach ($teacherSections as $teacherSection){$teacherSection->delete();}

            if (isset($request->sections)){
                foreach ($request->sections as $sectionId => $value){
                    $st = new SectionTeacher();
                    $st->section_id = $value;
                    $st->teacher_id = $request->id;
                    $st->status = 1;
                    $st->creator_id = user()->id;
                    $st->save();
                }
            }
            Alert::toast('Updated','success');
            return redirect('/teachers');
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            if (user()->id==1){
                $sts =  SectionTeacher::where(['teacher_id'=>$request->id])->get();
                foreach ($sts as $st){ $st->delete(); }

                $teacher = Teacher::find($request->id);
                $teacher->status = 3; $teacher->save();

                return response()->json([
                    'success'=>true,
                    'sa_title'=>'Message',
                    'sa_message'=>'Teacher Deleted Successfully',
                    'sa_icon'=>'success'
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'sa_title'=>'Message',
                    'sa_message'=>'Sorry, You are not able to Delete this Teacher !!!',
                    'sa_icon'=>'info'
                ]);
            }
        }
    }

    public function sectionWiseTeacher(Request $request){
        $sectionId = Session::get('section_id');
        if (!isset($sectionId)){
            Session::put('section_id',1);
        }
        $sectionId = Session::get('section_id');
        $section = Section::with([
            'teachers',
            'classes'=>function($query){$query->where('status',1)->get();}
        ])->find($sectionId);
        return view('backend.teachers.section-form',[
            'teachers'=>$section->teachers,
            'classes'=>$section->classes,
            'sectionId'=>$sectionId
        ]);
    }

    public function teacherClassSubjectSave(Request $request){
        if ($request->post() and Auth::user()){

            $oldClassSubject = TeacherClassSubject::where(['teacher_id'=>$request->id])->get();
            foreach ($oldClassSubject as $item){$item->delete();}

            foreach ($request->subject as $classId => $classSubject){
                foreach ($classSubject as $key => $value){

                    $data = new TeacherClassSubject();
                    $data->year = $request->year;
                    $data->teacher_id = $request->id;
                    $data->class_id = $classId;
                    $data->subject_id = $value;
                    $data->save();
                }
            }

            Alert::toast('Subject allocation successful','success');
            return back();
        }else{
            return 'Access Denied';
        }
    }

    public function teacherDetail($id){
        return view('front.teacher.profile.profile',[
            'teacher'=>Teacher::find($id)
        ]);
    }

    public function teacherSubjectList($id,$sectionId){
//        return view('front.teacher.subject-list',[
        return view('backend.teachers.subject-list',[
            'teacher'=>Teacher::find($id),
            'classSubjects'=>TeacherClassSubject::with(['subject','className'])->where(['teacher_id'=>$id])->get(),
            'days'=>Day::where('status',1)->get(), 'periods'=>Period::where([
                'status'=>1,'section_id'=>$sectionId
            ])->get(),'sectionId'=>$sectionId
        ]);
    }

    public function teacherClassScheduleSave(Request $request){
        if ($request->post() and Auth::user()){
            $oldSchedules = ClassSchedule::where([
                'year'=>$request->year,
                'teacher_id'=>$request->teacher_id,
                'class_id'=>$request->class_id,
                'subject_id'=>$request->subject_id,
                'status'=>1
            ])->get();

            foreach ($oldSchedules as $schedule){$schedule->status = 3; $schedule->save();}

            foreach ($request->period as $dayId => $periodId){
                if ($periodId!== null){
                 $newSchedule = new ClassSchedule();
                 $newSchedule->year = $request->year;
                 $newSchedule->teacher_id = $request->teacher_id;
                 $newSchedule->class_id = $request->class_id;
                 $newSchedule->subject_id = $request->subject_id;
                 $newSchedule->day_id = $dayId;
                 $newSchedule->period_id = $periodId;
                 $newSchedule->status = 1;
                 $newSchedule->creator_id = user()->id;
                 $newSchedule->save();
                }
            }

            Alert::toast('Period allocation successful','success');
            return back();
        }else{
            return 'Access Denied';
        }
    }
}
