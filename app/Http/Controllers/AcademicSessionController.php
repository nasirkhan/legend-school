<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AcademicSessionController extends Controller
{
    public $sessions;

    public function __construct()
    {
        $this->sessions = AcademicSession::where('status','!=',3)->get(['id','name','status']);
    }

    public function index(){
        return view('backend.academic-sessions.manage',[
            'sessions'=>$this->sessions
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $session = new AcademicSession();
            $session->name = $request->name;
            $session->status = 1;
            $session->creator_id = user()->id;
            $session->save();

            $session->sl = count($this->sessions)+1;
            $session->arrow = $session->status==1? 'up':'down';
            $session->btn = $session->status==1? 'success':'warning';
            $session->badge = $session->status==1? 'success':'danger';
            $session->badge_txt = $session->status==1? 'Active':'Close';
            $session->sa_title = 'Message';
            $session->sa_message = 'AcademicSession Created Successfully';
            $session->sa_icon = 'success';
            return $session;

            Alert::toast('Academic Session saved successfully', 'success');
            return redirect('/academic-sessions');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $session = AcademicSession::find($request->id);
            $session->name = $request->name;
            $session->save();

            $session = AcademicSession::where('id',$request->id)->first(['id','name','status']);
            $session->sl = $request->sl;
            $session->arrow = $session->status==1? 'up':'down';
            $session->btn = $session->status==1? 'success':'warning';
            $session->badge = $session->status==1? 'success':'danger';
            $session->badge_txt = $session->status==1? 'Active':'Close';
            $session->sa_title = 'Message';
            $session->sa_message = 'AcademicSession Updated Successfully';
            $session->sa_icon = 'success';
            return $session;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $session = AcademicSession::find($request->id);
            $session->status == 1 ? $session->status = 2 : $session->status = 1;
            $session->save();

            $session = AcademicSession::where('id',$request->id)->first(['id','name','status']);
            $session->sl = $request->sl;
            $session->arrow = $session->status==1? 'up':'down';
            $session->btn = $session->status==1? 'success':'warning';
            $session->badge = $session->status==1? 'success':'danger';
            $session->badge_txt = $session->status==1? 'Active':'Close';
            $session->sa_title = 'Message';
            $session->sa_message = 'AcademicSession Status Updated';
            $session->sa_icon = 'success';
            return $session;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $session = AcademicSession::find($request->id);
            $session->status = 3;
            $session->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Academic Session Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
