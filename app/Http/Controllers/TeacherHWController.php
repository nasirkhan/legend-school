<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\ClassPerformance;
use App\Models\ClassWork;
use App\Models\Exam;
use App\Models\HW;
use App\Models\HWAnnotation;
use App\Models\Section;
use App\Models\StudentHW;
use App\Models\SubjectClass;
use App\Models\Syllabus;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherHWController extends Controller
{
    public function addForm(){
        $id = Session::get('teacherId');

        $classId = Session::get('class_id');

        if (isset($id)){

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

            return view('front.teacher.hw.hw-add-form',[
                'teacher'=>Teacher::find($id),
                'classSubjects'=>$classSubjects
            ]);
        }else{
            return redirect('/teacher-login-form');
        }

    }

    public function store(Request $request){
        if ($request->post()){
            $hw = new HW();
            $hw->year =  $request->year;
            $hw->class_id =  $request->class_id;
            $hw->subject_id =  $request->subject_id;
            $hw->title =  $request->title;
            $hw->assignment_date =  $request->assignment_date;
            $hw->submission_date =  $request->submission_date;
            $hw->hw_detail =  $request->hw_detail;
            if (isset($request->attachment_url)){
                $hw->attachment_url = fileUpload($request->file('attachment_url'),'hw');
            }
            $hw->status =  2;
            $hw->creator = Teacher::find(Session::get('teacherId'))->name;
            $hw->save();

            Alert::toast('HW Saved Successfully','success');
            return back();
        }
    }

    public function classWiseHwList(Request $request){
        $id = Session::get('teacherId');
        $teacher = Teacher::find($id);

        if (!isset($request->year) and !isset($request->class_id) and !isset($request->subject_id)){
            $year = Session::get('year'); $classId = Session::get('class_id'); $subjectId = Session::get('subject_id');
        }else{
            $year = $request->year; $classId = $request->class_id; $subjectId = $request->subject_id;
        }

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$classId,
            'status'=>1
        ])->get(['id','class_id','subject_id','sub_code','status'])->sortBy('sub_code');

        $homeWorks = [];

        if (isset($year) and isset($classId) and isset($subjectId)){
            $homeWorks = HW::where([
                'year'=>$year, 'class_id'=>$classId, 'subject_id'=>$subjectId
            ])->where('status','!=',3)->get();
        }

        return view('front.teacher.hw.manage',[
            'homeWorks'=>$homeWorks,
            'classSubjects'=>$classSubjects,
            'data'=>['year'=>$year,'class_id'=>$classId],
            'teacher'=>$teacher
        ]);
    }

    public function hwReview($id){
        $teacherId = Session::get('teacherId');
        $hw = HW::with(['classInfo','subject'])->find($id);
        return view('front.teacher.hw.hw-review',[
            'hw'=>$hw,'teacher'=>Teacher::find($teacherId)
        ]);
    }

    public function edit($id){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $hw = HW::find($id);

            Session::forget('year');
            Session::forget('section_id');
            Session::forget('class_id');
            Session::forget('subject_id');

            Session::put('year',$hw->year);
            Session::put('section_id',$hw->classInfo->section_id);
            Session::put('class_id',$hw->class_id);
            Session::put('subject_id',$hw->subject_id);

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$hw->class_id,
                'status'=>1
            ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

            return view('front.teacher.hw.edit',[
                'hw'=>$hw, 'teacher'=>Teacher::find($teacherId), 'classSubjects'=>$classSubjects
            ]);
        }else{
            Alert::toast('Access Denied !!!','error');
            return back();
        }
    }

    public function update(Request $request){
        $id = Session::get('teacherId');

        if ($request->post() and isset($id)){
            $hw = HW::find($request->id);
            $hw->year =  $request->year;
            $hw->class_id =  $request->class_id;
            $hw->subject_id =  $request->subject_id;
            $hw->title =  $request->title;
            $hw->assignment_date =  $request->assignment_date;
            $hw->submission_date =  $request->submission_date;
            $hw->hw_detail =  $request->hw_detail;
            if (isset($request->attachment_url)){
                if (file_exists($hw->attachment_url)){unlink($hw->attachment_url);}
                $hw->attachment_url = fileUpload($request->file('attachment_url'),'hw');
            }
            $hw->updater = Teacher::find($id)->name;
            $hw->save();

            Alert::toast('Home Work Updated Successfully','success');
            return redirect('/teacher-hw-review/'.$hw->id);
        }else{
            return 'Access Denied';
        }
    }

    public function statusUpdate($id){
        $hw = HW::find($id);
        $hw->status = $hw->status == 1 ? 2 : 1;
        $hw->save();

        Alert::toast('Home Work Status Updated','success');
        return back();
    }

    public function deleteAttachment($id){
        $hw =  HW::find($id);
        if (isset($hw)){
            if (file_exists($hw->attachment_url)){ unlink($hw->attachment_url); }
            $hw->attachment_url = null;
            $hw->save();
        }

        Alert::toast('Success','success');
        return back();
    }

    public function delete($id){
        $hw = HW::find($id);
        $hw->status = 3;
        $hw->save();

        Alert::toast('Home Work Deleted','success');
        return redirect('/teacher-class-wise-hw-list');
    }

    public function studentsHWCheckByTeacher(){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            return view('front.teacher.hw.students-hw',['teacher'=>Teacher::find($teacherId),'homeWorks'=>[]]);
        }else{
            return 'Access Denied';
        }
    }

    public function getMySubjectHW(Request $request){
        $teacherId = Session::get('teacherId');
        if ($request->ajax() and isset($teacherId)){
            $hws = HW::with([
                'studentHomeWorks'
            ])->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'subject_id'=>$request->subject_id,
                'status'=>1
            ])->get();

            return response()->json($hws);
        }else{
            return 'Access Denied';
        }
    }

    public function getMyStudentsHW(Request $request){
        $teacherId = Session::get('teacherId');
        if ($request->ajax() and isset($teacherId)){
            $hw = HW::with(['studentHomeWorks'=>function($query){$query->where(['status'=>2]);}])->find($request->hw_id);
            return view('front.teacher.hw.students-submitted-hw',['homeWorks'=>$hw->studentHomeWorks]);
        }
    }

    public function returnedHWForm(){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            return view('front.teacher.hw.students-returned-hw-form',['teacher'=>Teacher::find($teacherId),'homeWorks'=>[]]);
        }else{
            return 'Access Denied';
        }
    }

    public function studentsReturnedHWByTeacher(Request $request){
        $teacherId = Session::get('teacherId');
        if ($request->ajax() and isset($teacherId)){
            $hw = HW::with(['studentHomeWorks'=>function($query){$query->where(['status'=>1]);}])->find($request->hw_id);
            return view('front.teacher.hw.students-submitted-hw',['homeWorks'=>$hw->studentHomeWorks]);
        }
    }

    public function openHWForChecking($id){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $hw = StudentHW::find($id);
            return view('annotation.hw.open-hw-for-checking',[
                'hw'=>$hw, 'teacher'=>Teacher::find($teacherId), 'pdf'=>asset($hw->hw_url),
            ]);
        }else{
            return 'Access Denied';
        }
    }

    public function saveAnnotationTogether(Request $request){
        if ($request->ajax()){
            $hwAnnotations = HWAnnotation::where([
                'doc_type'=>$request->doc_type,
                'doc_id'=>$request->doc_id,
            ])->get();

            if (count($hwAnnotations)>0){
                foreach ($hwAnnotations as $hwAnnotation){
                    $hwAnnotation->delete();
                }
            }

            $docType = $request->doc_type;
            $docId = $request->doc_id;
            $allPageAnnotations = $request->all_page_annotations;
            foreach ($allPageAnnotations as $allPageAnnotation){
                if (isset($allPageAnnotation['annotations'])){
                    $pageNo = $allPageAnnotation['pageNumber'];
                    $pageAnnotations = $allPageAnnotation['annotations'];
                    foreach ($pageAnnotations as $annotation){
                        $ann = new HWAnnotation();
                        $ann->doc_type = $docType;
                        $ann->doc_id = $docId;
                        $ann->page_no = $pageNo;
                        $ann->annotations = $annotation['annotation'];
                        $ann->ann_color = $annotation['ann_color'];
                        $ann->ann_type = $annotation['ann_type'];
                        if (Session::get('teacherId')){
                            $ann->ann_maker_type = 'Teacher';
                            $ann->user_id = Session::get('teacherId');
                        }elseif(Session::get('studentId')){
                            $ann->ann_maker_type = 'Student';
                            $ann->user_id = Session::get('studentId');
                        }
                        $ann->save();
                    }
                }
            }


            $hw = StudentHW::find($docId);
            if ($hw->status==2){
                $hw->status = 1;
                $hw->save();
            }

            return response()->json('Success');
        }
    }

    public function allPageAnnotations(Request $request){
        if ($request->ajax()){
            $hwAnnotations = HWAnnotation::where([
                'doc_type'=>$request->doc_type,
                'doc_id'=>$request->doc_id,
            ])->get()->groupBy('page_no');

            $result = [];

            if (count($hwAnnotations)>0){
                for ($i=0; $i< $request->pages; $i++){
                    $matched = false;
                    foreach ($hwAnnotations as $pageNo => $annotation){
                        $annotations = [];
                        foreach ($annotation as $key => $item){
                            $annotations[$key] = [
                                'ann_type'=>$item->ann_type,
                                'ann_color'=>$item->ann_color,
                                'annotation'=>$item->annotations
                            ];
                        }

                        if ($pageNo==($i+1)){
                            $matched = true;
                            $result[$i] = [
                                'pageNumber'=>($i+1),
                                'annotations'=>$annotations
                            ];
                        }
                    }

                    if (!$matched){
                        $result[$i] = [
                            'pageNumber'=>($i+1),
                            'annotations'=>[]
                        ];
                    }
                }
            }else{
                for ($i=0; $i< $request->pages; $i++){
                    $result[$i] = [
                        'pageNumber'=>($i+1),
                        'annotations'=>[]
                    ];
                }
            }
            return response()->json($result);
        }
    }

    public function homeWorkAnnotationSave(Request $request){
        if ($request->ajax()){
            $ann = new HWAnnotation();
            $ann->doc_type = $request->doc_type;
            $ann->doc_id = $request->doc_id;
            $ann->page_no = $request->page_no;
            $ann->ann_type = $request->ann_type;
            $ann->ann_color = $request->ann_color;
            $ann->annotations = $request->annotations;

            if (Session::get('teacherId')){
                $ann->ann_maker_type = 'Teacher';
                $ann->user_id = Session::get('teacherId');
            }elseif(Session::get('studentId')){
                $ann->ann_maker_type = 'Student';
                $ann->user_id = Session::get('studentId');
            }
            $ann->save();

            return response()->json(true);
        }
    }

    public function getHomeWorkAnnotations(Request $request){
        $marks = HWAnnotation::where([
            'doc_id'=>$request->doc_id,
            'page_no'=>$request->page_no,
            'ann_type'=>!'pencil'
        ])->get();

        $drawings = HWAnnotation::where([
            'doc_id'=>$request->doc_id,
            'page_no'=>$request->page_no,
            'ann_type'=>'pencil'
        ])->get();

        $all = HWAnnotation::where([
            'doc_id'=>$request->doc_id,
            'page_no'=>$request->page_no
        ])->get();

        $result = [
            'marks'=>$marks,
            'drawings'=>$drawings,
            'all'=>$all
        ];

        return response()->json($result);
    }

    public function remHWAnnotation(Request $request){
        if ($request->ajax()){
            $annotation = HWAnnotation::find($request->id);
            if (isset($annotation)){
                if (Session::get('teacherId')){
                    $annotation->delete();
                    return response()->json('Deleted');
                }else{
                    $studentId = Session::get('studentId');
                    if ($annotation->user_id == $studentId){
                        $annotation->delete();
                        return response()->json('Deleted');
                    }else{
                        return response()->json('You are not able to delete this item');
                    }
                }
            }else{
                return response()->json(true);
            }
        }
    }

    public function hwCheckingFinish(Request $request){
        if ($request->ajax()){
            $hw = StudentHW::find($request->id);
            if ($hw->status==2){
                $hw->status = 3;
                $hw->save();
            }

            $result = [
                'success'=>true
            ];
            return response()->json($result);
        }
    }

    public function classActivity(Request $request){
        $teacherId = Session::get('teacherId');
        $year = Session::get('year');
        $sectionId = Session::get('section_id');
        $classId = Session::get('class_id');
        $subjectId = Session::get('subject_id');
        $date = Session::get('date');

        $request->year = $year;
        $request->section_id = $sectionId;
        $request->class_id = $classId;
        $request->subject_id = $subjectId;
        $request->date = $date;
        $request->from = 'class';

        if (isset($sectionId) and isset($classId)){
            $section = Section::find($sectionId)->name;
            $class = ClassName::find($classId)->name;

//            $classSubjects = teacherAndClassWiseSubjects($year,$classId,$teacherId);
        }else{
            $section = '-';
            $class = '-';
            $classSubjects = [];
        }

        if ($request->from=='class'){
            $students = studentsForClassActivity($request);
            $queries = ['year'=>$year, 'section'=>$section, 'class'=>$class];
            $title = 'Year : '.$year.' Section : '.$section.' Class : '.$class;
        }

        $teacher = Teacher::find($teacherId);

//        return $classSubjects;

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
        ])->where([
            'class_id'=>$classId,
            'status'=>1
        ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

        return view('front.teacher.class-activity.manage',[
            'students'=>$students,
            'from'=>$request->from,
            'queries'=>$queries,
            'title'=>$title,
            'teacher'=>$teacher,
            'classSubjects'=>$classSubjects,
            'data'=>$request
        ]);
    }

    public function getSubjectForClassActivity(Request $request){
        if ($request->ajax()){
            $year = $request->year;
            $classId = $request->class_id;

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->orderBy('sub_code')->get(['id','subject_id','sub_code','status']);

            return $classSubjects;

//            $teacherId = Session::get('teacherId');
//            return $classSubjects = teacherAndClassWiseSubjects($year,$classId,$teacherId);
        }
    }

    protected function subjectClasses($classId){
        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$classId,
            'status'=>1
        ])->get();

        return $classSubjects;
    }

    public function activeStudentForClassActivity(Request $request){
        if ($request->ajax()){
            $year = $request->year.' - '.$request->year+1;
            $section = Section::find($request->section_id)->name;
            $class = ClassName::find($request->class_id)->name;

            if ($request->from=='class'){
//                $students = classAndBatchWiseStudents($request);
                $queries = ['year'=>$year, 'section'=>$section, 'class'=>$class];
                $title = 'Year : '.$year.' Section : '.$section.' Class : '.$class;
            }

            $students = studentsForClassActivity($request);

            return view('front.teacher.class-activity.students',[
                'students'=>$students,'from'=>$request->from,'queries'=>$queries,'title'=>$title,'data'=>$request
            ]);
        }

        return false;
    }

    public function studentClassActivityUpdate(Request $request){
        if ($request->post()){
            Session::put('date',$request->date);

            if ($request->performance){
                foreach ($request->performance as $studentId => $tagId){
                    $performance = ClassPerformance::where([
                        'student_id'=>$studentId,
                        'class_id'=>$request->class_id,
                        'subject_id'=>$request->subject_id,
                        'date'=>$request->date
                    ])->first();

                    if(!isset($performance)){
                        $performance = new ClassPerformance();
                        $performance->student_id = $studentId;
                        $performance->class_id = $request->class_id;
                        $performance->subject_id = $request->subject_id;
                        $performance->date = $request->date;
                    }
                    $performance->teacher_id = Session::get('teacherId');
                    $performance->tag_id = $tagId;
                    $performance->save();
                }

                Alert::success('Message','Student Class Activity Updated Successfully');
                return back();
            }
        }else{
            abort(404);
        }
    }

    public function teacherClassActivityAddForm(){
        $teacherId = Session::get('teacherId');
        $classId = Session::get('class_id');
        if (isset($teacherId)){

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->orderBy('sub_code')->get(['id','subject_id','sub_code','status']);

            return view('front.teacher.cw.add-form',[
                'teacher'=>Teacher::find($teacherId),
                'classSubjects'=>$classSubjects
            ]);
        }else{
            abort(404);
        }
    }

    public function teacherCWSave(Request $request){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId) and $request->post()){
            $cw = ClassWork::where([
                'class_id'=>$request->class_id,
                'subject_id'=>$request->subject_id,
                'teacher_id'=>$teacherId,
                'date'=>$request->date,
            ])->first();

            if (!isset($cw)){
                $cw = new ClassWork();
                $cw->year = $request->year;
                $cw->class_id = $request->class_id;
                $cw->subject_id = $request->subject_id;
                $cw->teacher_id = $teacherId;
                $cw->date = $request->date;
                $cw->creator_id = $teacherId;
            }

            $cw->chapter = $request->chapter;
            $cw->cw_detail = $request->cw_detail;
            if (isset($request->attachment_url)){
                if (file_exists($cw->attachment_url)){unlink($cw->attachment_url);}
                $cw->attachment_url = fileUpload($request->file('attachment_url'),'cw');
            }

            $cw->save();
            Alert::success('Message','Class Activity Saved Successfully');
            return back();
        }else{
            abort(404);
        }
    }

    public function teacherClassWiseCWList()
    {
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            if (!isset($request->year) and !isset($request->class_id) and !isset($request->subject_id)){
                $year = Session::get('year'); $classId = Session::get('class_id'); $subjectId = Session::get('subject_id');
            }else{
                $year = $request->year; $classId = $request->class_id; $subjectId = $request->subject_id;
            }

            $classWorks = [];

            if (isset($year) and isset($teacherId) and isset($classId) and isset($subjectId)){
                $classWorks = ClassWork::with(['subject'=>function($query){$query->select(['id','name']);}])->where([
                    'year'=>$year,
                    'teacher_id'=>$teacherId,
                    'class_id'=>$classId,
                    'subject_id'=>$subjectId,
                ])->orderBy('date','desc')->get();
            }

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->orderBy('sub_code')->get(['id','subject_id','sub_code','status']);

            return view('front.teacher.cw.manage',[
                'classWorks'=>$classWorks,
                'classSubjects'=>$classSubjects,
                'data'=>['year'=>$year,'class_id'=>$classId],
                'teacher'=>Teacher::find($teacherId)
            ]);
        }
    }

    public function teacherCWReview($id){
        $teacherId = Session::get('teacherId');
        $cw = ClassWork::with(['classInfo','subject'])->find($id);
        return view('front.teacher.cw.cw-review',[
            'cw'=>$cw,'teacher'=>Teacher::find($teacherId)
        ]);
    }
    public function teacherCWEdit($id){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $cw = ClassWork::with(['classInfo','subject'])->find($id);

            Session::forget('year');
            Session::forget('class_id');
            Session::forget('subject_id');

            Session::put('year',$cw->year);
            Session::put('class_id',$cw->class_id);
            Session::put('subject_id',$cw->subject_id);

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$cw->class_id,
                'status'=>1
            ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

            return view('front.teacher.cw.edit',[
                'cw'=>$cw, 'teacher'=>Teacher::find($teacherId), 'classSubjects'=>$classSubjects
            ]);
        }else{
            Alert::toast('Access Denied !!!','error');
            return back();
        }
    }

    public function teacherCWUpdate(Request $request){
        $id = Session::get('teacherId');

        if ($request->post() and isset($id)){
            $cw = ClassWork::find($request->id);
            $cw->year =  $request->year;
            $cw->class_id =  $request->class_id;
            $cw->subject_id =  $request->subject_id;
            $cw->chapter =  $request->chapter;
            $cw->date =  $request->date;
            $cw->cw_detail =  $request->cw_detail;
            if (isset($request->attachment_url)){
                if (file_exists($cw->attachment_url)){unlink($cw->attachment_url);}
                $cw->attachment_url = fileUpload($request->file('attachment_url'),'cw');
            }
            $cw->save();

            Alert::toast('Home Work Updated Successfully','success');
            return redirect('/teacher-cw-review/'.$cw->id);
        }else{
            return 'Access Denied';
        }
    }

    public function teacherCWStatusUpdate($id){
        $cw = ClassWork::find($id);
        $cw->status = $cw->status == 1 ? 2 : 1;
        $cw->save();

        Alert::toast('Class Activity Status Updated','success');
        return back();
    }

    public function teacherCWDeleteAttachment($id){
        $cw =  ClassWork::find($id);
        if (isset($cw)){
            if (file_exists($cw->attachment_url)){ unlink($cw->attachment_url); }
            $cw->attachment_url = null;
            $cw->save();
        }

        Alert::success('Message','Attachment Deleted Successfully');
        return back();
    }

    public function teacherCWDelete($id){
        $cw = ClassWork::find($id);
        $cw->status = 3;
        $cw->save();

        Alert::success('Message','Class Activity Deleted');
        return redirect('/teacher-class-wise-cw-list');
    }

    //Syllabus Management

    public function syllabusAddByTeacher(){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $classId = Session::get('class_id');
            $year = Session::get('year');

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

            $exams = Exam::where([
                'year'=>$year,
                'class_id'=>$classId,
                'status'=>1,
            ])->get(['id','name','code']);

            return view('front.teacher.syllabus.add-form',[
                'teacher'=>Teacher::find($teacherId),
                'classSubjects'=>$classSubjects,
                'exams'=>$exams
            ]);
        }else{
            abort(404);
        }
    }

    public function examListByTeacher(Request $request){
        if ($request->ajax()){
            return Exam::where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'status'=>1,
            ])->get(['id','name','code']);
        }
    }

    public function syllabusSaveByTeacher(Request $request){
        $teacherId = Session::get('teacherId');
        if ($request->post() and isset($teacherId)){
            $syllabus = Syllabus::where([
                'exam_id'=>$request->exam_id,
                'subject_id'=>$request->subject_id
            ])->first();

            if (!isset($syllabus)){
                $syllabus = new Syllabus();
                $syllabus->exam_id = $request->exam_id;
                $syllabus->subject_id = $request->subject_id;
            }

            $syllabus->syllabus_detail = $request->syllabus_detail;

            if (isset($request->attachment_url)){
                $syllabus->attachment_url = fileUpload($request->file('attachment_url'),'exam-syllabus');
            }
            $syllabus->creator = Teacher::find(Session::get('teacherId'))->name;
            $syllabus->save();

            Alert::success('Message','Syllabus Saved Successfully');
            return back();
        }else{
            abort(404);
        }
    }

    public function syllabusViewByTeacher(){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $classId = Session::get('class_id');
            $teacher = Teacher::find($teacherId);
            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->orderBy('sub_code')->get(['id','subject_id','sub_code','status']);
            return view('front.teacher.syllabus.manage',compact('teacher','classSubjects'));
        }
    }

    public function teacherSyllabusEdit($id){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $classId = Session::get('class_id');
            $year = Session::get('year');
            $teacher = Teacher::find($teacherId);
            $syllabus = Syllabus::with('exam')->find($id);

            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->where('status',1)->select(['id','name']);}
            ])->where([
                'class_id'=>$classId,
                'status'=>1
            ])->get(['subject_id','sub_code','status'])->sortBy('sub_code');

            $exams = Exam::where([
                'year'=>$year,
                'class_id'=>$classId,
                'status'=>1,
            ])->get(['id','name','code']);

            return view('front.teacher.syllabus.edit',compact('syllabus','classSubjects','exams','teacher'));
        }else{
            abort(404);
        }
    }

    public function teacherSyllabusUpdate(Request $request){
        $teacherId = Session::get('teacherId');
        if ($request->post() and isset($teacherId)){
            $syllabus = Syllabus::find($request->id);
            $syllabus->exam_id = $request->exam_id;
            $syllabus->subject_id = $request->subject_id;
            $syllabus->syllabus_detail = $request->syllabus_detail;

            if (isset($request->attachment_url)){
                if (file_exists($syllabus->attachment_url)){unlink($syllabus->attachment_url);}
                $syllabus->attachment_url = fileUpload($request->file('attachment_url'),'exam-syllabus');
            }
            $syllabus->updater = Teacher::find(Session::get('teacherId'))->name;
            $syllabus->save();

            Alert::success('Message','Syllabus Updated Successfully');
            return redirect('/syllabus-view-by-teacher');
        }else{
            abort(404);
        }
    }

    public function teacherSyllabusStatusUpdate($id){
        $teacherId = Session::get('teacherId');
        if (isset($teacherId)){
            $syllabus = Syllabus::find($id);
            $syllabus->status = $syllabus->status == 1 ? 2 : 1;
            $syllabus->save();
            Alert::success('Message','Syllabus Status Updated Successfully');
            return back();
        }else{
            abort(404);
        }
    }
}
