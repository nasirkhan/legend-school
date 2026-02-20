<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Syllabus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class SyllabusController extends Controller
{
    public $year, $sessionId, $classId, $examId, $subjectId;

    public function __construct(){

    }

    protected function syllabi($status=null){
        if ($status!=null){
            return Syllabus::with('exam')->where(['exam_id'=>$this->examId])
                ->where('status','=',$status)->get();
        }else{
            return Syllabus::with('exam')->where(['exam_id'=>$this->examId])
                ->where('status','!=',3)->get();
        }
    }

    public function index(){
        $examId = Session::get('exam_id');
        $subjectId = Session::get('subject_id');
        if (isset($examId) and isset($subjectId)){ $this->examId = $examId; $this->subjectId = $subjectId; }

        $syllabi = Syllabus::where('exam_id',$examId)->where('status','!=',3)->get();

        return view('backend.exams.syllabus.manage',['syllabi'=>$syllabi]);
    }

    public function addForm(){
        return view('backend.exams.syllabus.add');
    }

    public function getSyllabus(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id;

            return view('backend.exams.syllabus.table',['syllabi'=>$this->syllabi()]);
        }
    }

    public function getRawSyllabus(Request $request){
        if ($request->ajax()){
            $this->examId = $request->exam_id;
            return $this->papers(1);
        }
    }

    public function store(Request $request){
        if ($request->post()){
            $this->examId = $request->exam_id;
            $syllabus = new Syllabus();
            $syllabus->exam_id = $request->exam_id;
            $syllabus->subject_id = $request->subject_id;
            $syllabus->exam_date = $request->exam_date;
            if (isset($request->attachment_url)){
                $syllabus->attachment_url = fileUpload($request->file('attachment_url'),'exam-syllabus');
            }
            $syllabus->syllabus_detail = $request->syllabus_detail;
            $syllabus->creator = user()->name;
            $syllabus->save();

            Alert::toast('Syllabus saved successfully', 'success');
            return redirect('/syllabus');
        }else{
            return 'Access denied';
        }
    }

    public function edit(Request $request){
        $syllabus = Syllabus::find($request->id);
        $exam = Exam::find($syllabus->exam_id);

        Session::forget('year');
        $year = Session::put('year',$exam->year);
        Session::forget('class_id');
        $classId = Session::put('class_id',$exam->class_id);
        Session::forget('exam_id');
        $examId = Session::put('exam_id',$syllabus->exam_id);
        Session::forget('subject_id');
        $subjectId = Session::put('subject_id',$syllabus->subject_id);

        if (isset($examId) and isset($subjectId)){$this->year = $year; $this->classId = $classId; $this->examId = $examId; $this->subjectId = $subjectId; }
        return view('backend.exams.syllabus.edit',['syllabi'=>$this->syllabi(),'currentSyllabus'=>$syllabus]);
    }

    public function update(Request $request){
        if ($request->post()){
            $this->examId = $request->exam_id;
            $syllabus = Syllabus::find($request->id);
            $syllabus->exam_id = $request->exam_id;
            $syllabus->subject_id = $request->subject_id;
            $syllabus->exam_date = $request->exam_date;
            if (isset($request->attachment_url)){
                if (file_exists($syllabus->attachment_url)){unlink($syllabus->attachment_url);}
                $syllabus->attachment_url = fileUpload($request->file('attachment_url'),'exam-syllabus');
            }
            $syllabus->syllabus_detail = $request->syllabus_detail;
            $syllabus->updater = user()->name;
            $syllabus->save();

            Alert::toast('Syllabus updated successfully', 'success');
            return redirect('/syllabus');
        }
    }


    public function statusUpdate($id){
        $syllabus = Syllabus::find($id);
        $syllabus->status == 1 ? $syllabus->status = 2 : $syllabus->status = 1;
        $syllabus->save();

        Alert::toast('Status Updated','success');
        return back();
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $syllabus = Syllabus::find($request->id);
            $syllabus->delete();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
