<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SchoolController extends Controller
{
    public $schools;

    public function __construct()
    {
        $this->schools = School::where('status','!=',3)->get(['id','name','status']);
    }

    public function index(){
        return view('backend.schools.manage',[
            'schools'=>$this->schools
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $school = new School();
            $school->name = $request->name;
            $school->status = 1;
            $school->creator_id = user()->id;
            $school->save();

            $school->sl = count($this->schools)+1;
            $school->arrow = $school->status==1? 'up':'down';
            $school->btn = $school->status==1? 'success':'warning';
            $school->badge = $school->status==1? 'success':'danger';
            $school->badge_txt = $school->status==1? 'Active':'Close';
            $school->sa_title = 'Message';
            $school->sa_message = 'School Created Successfully';
            $school->sa_icon = 'success';
            return $school;

            Alert::toast('School saved successfully', 'success');
            return redirect('/schools');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $school = School::find($request->id);
            $school->name = $request->name;
            $school->save();

            $school = School::where('id',$request->id)->first(['id','name','status']);
            $school->sl = $request->sl;
            $school->arrow = $school->status==1? 'up':'down';
            $school->btn = $school->status==1? 'success':'warning';
            $school->badge = $school->status==1? 'success':'danger';
            $school->badge_txt = $school->status==1? 'Active':'Close';
            $school->sa_title = 'Message';
            $school->sa_message = 'School Updated Successfully';
            $school->sa_icon = 'success';
            return $school;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $school = School::find($request->id);
            $school->status == 1 ? $school->status = 2 : $school->status = 1;
            $school->save();

            $school = School::where('id',$request->id)->first(['id','name','status']);
            $school->sl = $request->sl;
            $school->arrow = $school->status==1? 'up':'down';
            $school->btn = $school->status==1? 'success':'warning';
            $school->badge = $school->status==1? 'success':'danger';
            $school->badge_txt = $school->status==1? 'Active':'Close';
            $school->sa_title = 'Message';
            $school->sa_message = 'School Status Updated';
            $school->sa_icon = 'success';
            return $school;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $school = School::find($request->id);
            $school->status = 3;
            $school->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'School Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
