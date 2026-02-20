<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\StudentClassSubject;
use App\Models\Subject;
use App\Models\SubjectClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClassController extends Controller
{
    public $classes;

    public function __construct()
    {
        $this->classes = ClassName::with([
            'classSubjects'=>function($query){$query->select(['name','sub_code'])->orderBy('sub_code');}
        ])
            ->where('class_names.status','!=',3)
            ->get(['id','name','status']);
    }

    public function index(){
        $classes = ClassName::where('status','!=',3)->get();

        $result = [];
        foreach ($classes as $class){
            $subjects = SubjectClass::with(['subject'=>function($query){$query->select(['name','id']);}])
                ->where(['class_id'=>$class->id, 'status'=>1])
                ->orderBy('sub_code','asc')
                ->get(['id','subject_id','sub_code','lab_status']);

            $class->subjects = count($subjects)>0 ? $subjects : [];

            array_push($result,$class);
        }

//        return $result;

//        return $classes;
//        $result = [];
//        foreach ($classes as $class){
//            $subjects = [];
//            $classSubjects = SubjectClass::with('subject')->where([
//                'class_id'=>$class->id
//            ])->get();
//
//            foreach ($classSubjects as $classSubject){
//                $subjects[$classSubject->subject->name] = $classSubject->sub_code;
//            }
//
//            ksort($subjects);
//
//            $class->subjects = $subjects;
//
//            array_push($result,$class);
//        }

        return view('backend.classes.manage',[
            'classes'=>$classes,
//            'orderedClasses'=>$this->classes
        ]);
    }

    public function getClasses(Request $request){
        $classes = ClassName::where([
            'section_id'=>$request->id,
            'status'=>1
        ])->get(['id','name','status']);

        return response()->json($classes);
    }

    public function store(Request $request){
        if ($request->post()){
            $class = new ClassName();
            $class->name = $request->name;
            $class->status = 1;
            $class->creator_id = user()->id;
            $class->save();

            $class->sl = count($this->classes)+1;
            $class->arrow = $class->status==1? 'up':'down';
            $class->btn = $class->status==1? 'success':'warning';
            $class->badge = $class->status==1? 'success':'danger';
            $class->badge_txt = $class->status==1? 'Active':'Close';
            $class->sa_title = 'Message';
            $class->sa_message = 'Class Created Successfully';
            $class->sa_icon = 'success';
            return $class;

            Alert::toast('Class saved successfully', 'success');
            return redirect('/classes');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $class = ClassName::find($request->id);
            $class->name = $request->name;
            $class->save();

            $class = ClassName::where('id',$request->id)->first(['id','name','status']);
            $class->sl = $request->sl;
            $class->arrow = $class->status==1? 'up':'down';
            $class->btn = $class->status==1? 'success':'warning';
            $class->badge = $class->status==1? 'success':'danger';
            $class->badge_txt = $class->status==1? 'Active':'Close';
            $class->sa_title = 'Message';
            $class->sa_message = 'Class Updated Successfully';
            $class->sa_icon = 'success';
            return $class;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $class = ClassName::find($request->id);
            $class->status == 1 ? $class->status = 2 : $class->status = 1;
            $class->save();

            $class = ClassName::where('id',$request->id)->first(['id','name','status']);
            $class->sl = $request->sl;
            $class->arrow = $class->status==1? 'up':'down';
            $class->btn = $class->status==1? 'success':'warning';
            $class->badge = $class->status==1? 'success':'danger';
            $class->badge_txt = $class->status==1? 'Active':'Close';
            $class->sa_title = 'Message';
            $class->sa_message = 'Class Status Updated';
            $class->sa_icon = 'success';
            return $class;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $class = ClassName::find($request->id);
            $class->status = 3;
            $class->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function getClassSubjects(Request $request){
        if ($request->ajax()){
            $subjects = Subject::where(['status'=>1])->get();
            $subjectClasses = SubjectClass::with(['subject'=>function($query){$query->where('status',1);}])->where(['class_id'=>$request->id,])->get();

            $unused = []; $used = [];

            foreach ($subjects as $subject){
                $status = 'unused';
                foreach ($subjectClasses as $subjectClass){
                    if ($subject->id == $subjectClass->subject_id){
                        $status = 'used';
                        $subject->sub_code = $subjectClass->sub_code;
                        $subject->subject_class_id = $subjectClass->id;
                        $used[$subjectClass->sub_code.$subject->name] = $subject;
                        break;
                    }
                }

                if ($status=='unused'){
                    $unused[$subject->name] = $subject;
                }
            }

            ksort($unused);
            ksort($used);
            return response()->json([
                'success'=>true,
                'used'=>$used,
                'unused'=>$unused,
            ]);
        }
    }
    public function classSubjectUpdate(Request $request){
        if ($request->post()){
            //Update Subject Code If
            $subCodes = $request->used_subject_code;
            if (isset($subCodes)){
                foreach ($subCodes as $key => $value){
                    if ($value){
                        $codeData = SubjectClass::find($key);
                        $codeData->sub_code = $value;
                        $codeData->save();
                    }
                }
            }

            //Removed item if any
            if (isset($request->removed)){
                foreach ($request->removed as $key => $value){
                    $subject = SubjectClass::find($key);
                    if (isset($subject)){$subject->delete();}
                }
            }

            //Add item if any
            if (isset($request->selected)){
                foreach ($request->selected as $key => $value){
                    $newSubject = new SubjectClass();
                    $newSubject->class_id = $request->class_id;
                    $newSubject->subject_id = $key;
                    $newSubject->sub_code = $request->selected_code[$key];
                    $newSubject->creator_id = user()->id;
                    $newSubject->status = 1;
                    $newSubject->save();
                }
            }

            Alert::toast('Class Wise Subject Updated','success');
            return back();
        }
    }

    public function classSubjectUpdateForPractical(Request $request){
        if ($request->post()){
//            return $request->all();

            if (count($request->class_subject_id)>0){
                $classSubjects = SubjectClass::where([
                    'class_id'=>$request->class_id
                ])->get();

                foreach ($classSubjects as $classSubject){
                    $classSubject->update(['lab_status'=>0]);
                }

                foreach ($request->class_subject_id as $classSubjectId){
                    SubjectClass::find($classSubjectId)->update(['lab_status'=>1]);
                }

                Alert::toast('Class Wise Subject Lab Updated','success');
                return back();
            }
        }else{
            abort(404);
        }
    }

    public function getClassSubjectsForStudent(Request $request){
        if ($request->ajax()){
        $ClassSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','sl','status']);}
        ])->where(['class_id'=>$request->class_id,'status'=>1])
            ->get(['id','class_id','subject_id','sub_code','status'])
            ->sortBy('sub_code');

        $studentSubjects = StudentClassSubject::where([
            'student_id'=>$request->student_id,
            'class_id'=>$request->class_id
        ])->get();

            $unused = []; $used = [];

            foreach ($ClassSubjects as $classSubject){
                if ($classSubject->subject->status != 1){continue;}
                $status = 'unused';
                $subCode = $classSubject->sub_code;
                $subject = $classSubject->subject;
                $subject->code = $subCode;

                foreach ($studentSubjects as $studentSubject){
                    if ($classSubject->subject_id == $studentSubject->subject_id){
                        $status = 'used';
                        $subject->student_subject_id = $studentSubject->id;
                        $used[$subCode.$subject->name] = $subject;
                        break;
                    }
                }

                if ($status=='unused'){
                    $unused[$subCode.$subject->name] = $subject;
                }
            }

            ksort($unused);
            ksort($used);
            return response()->json([
                'success'=>true,
                'used'=>$used,
                'unused'=>$unused,
            ]);
        }
    }

    public function studentClassSubjectUpdate(Request $request){
        if ($request->post()){
            $studentPreviousSubject =  StudentClassSubject::where([
                'class_id'=>$request->class_id,
                'student_id'=>$request->student_id
            ])->get();

            if (isset($request->removed) and count($request->removed)>0){
                foreach ($request->removed as $key => $value){
                    $subject = StudentClassSubject::find($key);
                    if (isset($subject)){$subject->delete();}
                }
            }

            if (isset($request->selected) and count($request->selected)>0){
                foreach ($request->selected as $subjectId => $value){
                    $newSubject = new StudentClassSubject();
                    $newSubject->student_id = $request->student_id;
                    $newSubject->class_id = $request->class_id;
                    $newSubject->subject_id = $subjectId;
                    $newSubject->save();
                }
            }

            Alert::toast('Student subject updated.');
            return back();
        }
    }
}
