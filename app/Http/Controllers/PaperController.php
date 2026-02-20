<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Paper;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class PaperController extends Controller
{
    public $year, $sessionId, $classId, $examId, $subjectId;

    public function __construct(){

    }

    protected function papers($status=null){
        if ($status!=null){
            return Paper::with('exam')->where(['exam_id'=>$this->examId,'subject_id'=>$this->subjectId])
                ->where('status','=',$status)->get()->sortBy('sl');
        }else{
            return Paper::with('exam')->where(['exam_id'=>$this->examId,'subject_id'=>$this->subjectId])
                ->where('status','!=',3)->get()->sortBy('sl');
        }
    }

    public function index(){
        $examId = Session::get('exam_id'); $subjectId = Session::get('subject_id');
        if (isset($examId) and isset($subjectId)){ $this->examId = $examId; $this->subjectId = $subjectId; }
        return view('backend.exams.papers.manage',['papers'=>$this->papers()]);
    }

    public function getPapers(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id; $this->subjectId = $request->subject_id;
            return view('backend.exams.papers.table',['papers'=>$this->papers()]);
        }
    }

    public function getRawPapers(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id;
            return $this->papers(1);
        }
    }

    public function store(Request $request){
        if ($request->post()){
            $this->examId = $request->exam_id;
            $paper = new Paper();
            $paper->exam_id = $request->exam_id;
            $paper->subject_id = $request->subject_id;
            $paper->name = $request->name;
            $paper->code = $request->code;
            $paper->mark = $request->mark;
            $paper->weight = $request->weight;
            if (isset($request->sl)){
                $paper->sl = $request->sl;
            }else{
                $paper->sl = count(Paper::where(['exam_id'=>$request->exam_id,'subject_id'=>$request->subject_id])->get(['id']))+1;
            }

            $paper->creator_id = user()->id;
            $paper->status = 1;
            $paper->save();

            $paper->arrow = $paper->status==1? 'up':'down';
            $paper->btn = $paper->status==1? 'success':'warning';
            $paper->badge = $paper->status==1? 'success':'danger';
            $paper->badge_txt = $paper->status==1? 'Active':'Close';
            $paper->sa_title = 'Message';
            $paper->sa_message = 'Paper Created Successfully';
            $paper->sa_icon = 'success';
            return $paper;

            Alert::toast('Paper saved successfully', 'success');
            return redirect('/exams');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $paper = Paper::find($request->id);
            $paper->name = $request->name;
            $paper->code = $request->code;
            $paper->mark = $request->mark;
            $paper->weight = $request->weight;
            $paper->sl = $request->serial;
            $paper->creator_id = user()->id;
            $paper->save();

            $paper = Paper::where('id',$request->id)->first();
            $paper->sl = $request->sl;
            $paper->serial = $request->serial;
            $paper->arrow = $paper->status==1? 'up':'down';
            $paper->btn = $paper->status==1? 'success':'warning';
            $paper->badge = $paper->status==1? 'success':'danger';
            $paper->badge_txt = $paper->status==1? 'Active':'Close';
            $paper->sa_title = 'Message';
            $paper->sa_message = 'Paper Updated Successfully';
            $paper->sa_icon = 'success';
            return $paper;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $paper = Paper::find($request->id);
            $paper->status == 1 ? $paper->status = 2 : $paper->status = 1;
            $paper->save();

            $paper = Paper::where('id',$request->id)->first();
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
            $paper = Paper::find($request->id);
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
