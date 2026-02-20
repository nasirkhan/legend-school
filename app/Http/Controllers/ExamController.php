<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ExamController extends Controller
{
    public $year, $sessionId, $sectionId, $classId;

    public function __construct(){

    }

    protected function exams(){
        $year = Session::get('year');
        $section_id = Session::get('section_id');
        $class_id = Session::get('class_id');
        if ($year && $section_id && $class_id){
            return Exam::with('classInfo')
                ->where(['year'=>$year,'section_id'=>$section_id,'class_id'=>$class_id])
                ->where('status','!=',3)
                ->get();
        }else{
            return Exam::with('classInfo')
                ->where(['year'=>$this->year,'section_id'=>$this->sectionId,'class_id'=>$this->classId])
                ->where('status','!=',3)
                ->get();
        }
    }

    public function index(){
        $classes = ClassName::where('status',1)->get(['id','name','code','status']);
        return view('backend.exams.manage',[
            'exams'=>$this->exams(),
            'classes'=>$classes
        ]);
    }

    public function getExams(Request $request){
        if ($request->ajax()){
            if (Session::get('year')){
                Session::forget('year');
                Session::put('year',$request->year);
            }else{
                Session::put('year',$request->year);
            }

            if (Session::get('section_id')){
                Session::forget('section_id');
                Session::put('section_id',$request->section_id);
            }else{
                Session::put('section_id',$request->section_id);
            }

            if (Session::get('class_id')){
                Session::forget('class_id');
                Session::put('class_id',$request->class_id);
            }else{
                Session::put('class_id',$request->class_id);
            }

            return view('backend.exams.table',['exams'=>$this->exams()]);
        }
    }

    public function getRawExams(Request $request){
        if ($request->ajax()){
            if (Session::get('year')){
                Session::forget('year');
                Session::put('year',$request->year);
            }else{
                Session::put('year',$request->year);
            }

            if (Session::get('class_id')){
                Session::forget('class_id');
                Session::put('class_id',$request->class_id);
            }else{
                Session::put('class_id',$request->class_id);
            }

            if (Session::get('section_id')){
                Session::forget('section_id');
                Session::put('section_id',$request->section_id);
            }else{
                Session::put('section_id',$request->section_id);
            }

            $this->year = $request->year;
            $this->sectionId = $request->section_id;
            $this->classId = $request->class_id;

            return $this->exams();
        }
    }

    public function store(Request $request){
        if ($request->post()){
            $this->year = $request->year;
            $this->sessionId = $request->session_id;
            $this->classId = $request->class_id;

            $exam = new Exam();
            $exam->year = $request->year;
            $exam->session_id = $request->session_id;
            $exam->section_id = $request->section_id;
            $exam->class_id = $request->class_id;
            $exam->name = $request->name;
            $exam->result_type = $request->result_type;
            $exam->hw_mark = $request->hw_mark;
            $exam->cw_mark = $request->cw_mark;
            $exam->comment = $request->comment;
            $exam->code = $request->code;
            $exam->sl = count($this->exams())+1;
            $exam->creator_id = user()->id;
            $exam->status = 1;
            $exam->save();

            Alert::toast('Exam saved successfully', 'success');
            return redirect('/exams');

            $exam->arrow = $exam->status==1? 'up':'down';
            $exam->btn = $exam->status==1? 'success':'warning';
            $exam->badge = $exam->status==1? 'success':'danger';
            $exam->badge_txt = $exam->status==1? 'Active':'Close';
            $exam->sa_title = 'Message';
            $exam->sa_message = 'Exam Created Successfully';
            $exam->sa_icon = 'success';
            return $exam;

            Alert::toast('Class saved successfully', 'success');
            return redirect('/exams');
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        $exam = Exam::with('classInfo')->find($id);

//        return $exam->classInfo->section->classes;

        return view('backend.exams.exam-edit',[
            'currentExam'=>$exam,
            'exams'=>Exam::all()->sortByDesc('id')
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
//            return $request->all();

            $exam = Exam::find($request->id);
            $exam->year = $request->year;
            $exam->section_id = $request->section_id;
            $exam->class_id = $request->class_id;
            $exam->name = $request->name;
            $exam->result_type = $request->result_type;
            $exam->hw_mark = $request->hw_mark;
            $exam->cw_mark = $request->cw_mark;
            $exam->comment = $request->comment;
            $exam->code = $request->code;
            $exam->creator_id = user()->id;
            $exam->save();

            Alert::toast('Exam updated successfully', 'success');
            return redirect('/exams');

//            $exam = Exam::where('id',$request->id)->first();
//            $exam->sl = $request->sl;
//            $exam->arrow = $exam->status==1? 'up':'down';
//            $exam->btn = $exam->status==1? 'success':'warning';
//            $exam->badge = $exam->status==1? 'success':'danger';
//            $exam->badge_txt = $exam->status==1? 'Active':'Close';
//            $exam->sa_title = 'Message';
//            $exam->sa_message = 'Exam Updated Successfully';
//            $exam->sa_icon = 'success';
//            return $exam;
        }
    }


    public function statusUpdate($id){
        $exam = Exam::find($id);
        $exam->status == 1 ? $exam->status = 2 : $exam->status = 1;
        $exam->save();

        Alert::toast('Status Updated','success');
        return back();
    }

    public function examShowToStudent($id){
        $exam = Exam::find($id);
        $exam->show_student == 1 ? $exam->show_student = 2 : $exam->show_student = 1;
        $exam->save();

        Alert::toast('Exam show on student profile status updated','success');
        return back();
    }

    public function markInputStatusUpdate($id){
        $exam = Exam::find($id);
        $exam->input_status == 1 ? $exam->input_status = 2 : $exam->input_status = 1;
        $exam->save();

        Alert::toast('Mark Input Status Updated','success');
        return back();
    }

    public function publicationStatusUpdate($id){
        $exam = Exam::find($id);
        $exam->publication_status == 1 ? $exam->publication_status = 2 : $exam->publication_status = 1;
        $exam->save();

        Alert::toast('Publication Status Updated','success');
        return back();
    }

    public function needPromotionalStatusUpdate($id){
        $exam = Exam::find($id);
        $exam->need_promo_status == 1 ? $exam->need_promo_status = 2 : $exam->need_promo_status = 1;
        $exam->save();

        Alert::toast('Need Promotional Status Updated','success');
        return back();
    }

    public function examScheduleStatusUpdate($id){
        $exam = Exam::find($id);
        $exam->schedule_status == 1 ? $exam->schedule_status = 2 : $exam->schedule_status = 1;
        $exam->save();

        Alert::toast('Schedule Status Updated','success');
        return back();
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $exam = Exam::find($request->id);
            $exam->status = 3;
            $exam->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
