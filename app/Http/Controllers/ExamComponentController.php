<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamComponent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class ExamComponentController extends Controller
{
    public $year, $sessionId, $classId, $examId;

    public function __construct(){

    }

    protected function papers($status=null){
        if ($status!=null){
            return ExamComponent::with('exam')->where(['exam_id'=>$this->examId])
                ->where('status','=',$status)->get();
        }else{
            return ExamComponent::with('exam')->where(['exam_id'=>$this->examId])
                ->where('status','!=',3)->get();
        }
    }

    public function index(){
        $examId = Session::get('exam_id');
        if (isset($examId)){ $this->examId = $examId; }
        return view('backend.exams.exam-components.manage',['papers'=>$this->papers()]);
    }

    public function getExamComponents(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id;
            return view('backend.exams.exam-components.table',['papers'=>$this->papers()]);
        }
    }

    public function getRawExamComponents(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id;
            return $this->papers(1);
        }
    }

    public function store(Request $request){
        if ($request->post()){
            $this->examId = $request->exam_id;
            $paper = new ExamComponent();
            $paper->exam_id = $request->exam_id;
//            $paper->subject_id = $request->subject_id;
            $paper->name = $request->name;
            $paper->code = $request->code;
            $paper->mark = $request->mark;
            $paper->weight = $request->weight;
            $paper->sl = count(ExamComponent::where('exam_id',$request->exam_id)->get(['id']))+1;
            $paper->creator_id = user()->id;
            $paper->status = 1;
            $paper->save();

            Alert::toast('Component Added Successfully','success');
            return back();

            $paper->arrow = $paper->status==1? 'up':'down';
            $paper->btn = $paper->status==1? 'success':'warning';
            $paper->badge = $paper->status==1? 'success':'danger';
            $paper->badge_txt = $paper->status==1? 'Active':'Close';
            $paper->sa_title = 'Message';
            $paper->sa_message = 'ExamComponent Created Successfully';
            $paper->sa_icon = 'success';
            return $paper;

            Alert::toast('ExamComponent saved successfully', 'success');
            return redirect('/exams');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $paper = ExamComponent::find($request->id);
            $paper->name = $request->name;
            $paper->code = $request->code;
            $paper->mark = $request->mark;
            $paper->weight = $request->weight;
            $paper->sl = $request->serial;
            $paper->creator_id = user()->id;
            $paper->save();

            $paper = ExamComponent::where('id',$request->id)->first();
            $paper->sl = $request->sl;
            $paper->serial = $request->serial;
            $paper->arrow = $paper->status==1? 'up':'down';
            $paper->btn = $paper->status==1? 'success':'warning';
            $paper->badge = $paper->status==1? 'success':'danger';
            $paper->badge_txt = $paper->status==1? 'Active':'Close';
            $paper->sa_title = 'Message';
            $paper->sa_message = 'ExamComponent Updated Successfully';
            $paper->sa_icon = 'success';
            return $paper;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $paper = ExamComponent::find($request->id);
            $paper->status == 1 ? $paper->status = 2 : $paper->status = 1;
            $paper->save();

            $paper = ExamComponent::where('id',$request->id)->first();
            $paper->sl = $request->sl;
            $paper->arrow = $paper->status==1? 'up':'down';
            $paper->btn = $paper->status==1? 'success':'warning';
            $paper->badge = $paper->status==1? 'success':'danger';
            $paper->badge_txt = $paper->status==1? 'Active':'Close';
            $paper->sa_title = 'Message';
            $paper->sa_message = 'Class Status Updated';
            $paper->sa_icon = 'success';
            return $paper;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $paper = ExamComponent::find($request->id);
            $paper->status = 3;
            $paper->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function reportCard(){
        $year = 2024;
        $sectionId = 1; //Junior
        $classId = 12; //Class-1
        $examId = 12; // Class-1 CT-1

        return Exam::where([
            'year'=>$year,
            'section_id'=>$sectionId,
            'class_id'=>$classId,
        ])->get();

    }
}
