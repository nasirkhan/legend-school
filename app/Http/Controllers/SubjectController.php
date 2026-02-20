<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\ClassName;
use App\Models\SubjectClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class SubjectController extends Controller
{
    public $subjects;

    public function __construct()
    {
        $this->subjects = Subject::where('status','!=',3)->get()->sortBy('name');
    }
    public function index(){
        return view('backend.subjects.manage',[
            'subjects'=>$this->subjects
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->sl = count(Subject::all())+1;
            $subject->status = 1;
            $subject->creator_id = user()->id;
            $subject->save();
            $id = $subject->id;
            $sl = $subject->sl;

            $subject = Subject::where('id',$id)->first(['id','name','status']);
            $subject->sl = $sl;
            $subject->arrow = $subject->status==1? 'up':'down';
            $subject->btn = $subject->status==1? 'success':'warning';
            $subject->badge = $subject->status==1? 'success':'danger';
            $subject->badge_txt = $subject->status==1? 'Active':'Close';
            $subject->sa_title = 'Message';
            $subject->sa_message = 'Subject Updated Successfully';
            $subject->sa_icon = 'success';
            return $subject;



        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $subject = Subject::find($request->id);
            $subject->name = $request->name;
            $subject->save();

            $subject = Subject::where('id',$request->id)->first(['id','name','status']);
            $subject->sl = $request->sl;
            $subject->arrow = $subject->status==1? 'up':'down';
            $subject->btn = $subject->status==1? 'success':'warning';
            $subject->badge = $subject->status==1? 'success':'danger';
            $subject->badge_txt = $subject->status==1? 'Active':'Close';
            $subject->sa_title = 'Message';
            $subject->sa_message = 'Subject Updated Successfully';
            $subject->sa_icon = 'success';
            return $subject;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $subject = Subject::find($request->id);
            $subject->status == 1 ? $subject->status = 2 : $subject->status = 1;
            $subject->save();

            $subject = Subject::where('id',$request->id)->first(['id','name','status']);
            $subject->sl = $request->sl;
            $subject->arrow = $subject->status==1? 'up':'down';
            $subject->btn = $subject->status==1? 'success':'warning';
            $subject->badge = $subject->status==1? 'success':'danger';
            $subject->badge_txt = $subject->status==1? 'Active':'Close';
            $subject->sa_title = 'Message';
            $subject->sa_message = 'Subject Status Updated';
            $subject->sa_icon = 'success';
            return $subject;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $subject = Subject::find($request->id);
            $subject->status=3;
            $subject->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Subject Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function getSubject(Request $request){
        if ($request->ajax()){

            if (Session::get('class_id')){
                Session::forget('class_id');
                Session::put('class_id',$request->class_id);
            }else{
                Session::put('class_id',$request->class_id);
            }

            $classWiseSubjects = SubjectClass::with([
                'subject'=>function($query){$query->select(['id','name']);}
            ])->where(['class_id'=>$request->class_id,'status'=>1])->orderBy('sub_code')->get(['id','class_id','subject_id','sub_code','status']);

            return response()->json([
                'subjects'=>$classWiseSubjects
            ]);
        }
    }
}

