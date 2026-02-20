<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public $days;

    public function __construct()
    {
        $this->days = Day::where('status','!=',3)->get(['id','name','code','sl','status']);
    }

    public function index(){
        return view('backend.days.manage',['days'=>$this->days]);
    }

    public function getDays(Request $request){
        $days = Day::where([
            'status'=>1
        ])->get(['id','name','code','sl','status']);

        return response()->json($days);
    }

    public function store(Request $request){
        if ($request->post()){

            $day = new Day();
            $day->name = $request->name;
            $day->code = $request->code;
            $day->status = 1;
            $day->sl = count(Day::all())+1;
            $day->save();

            $day->arrow = $day->status==1? 'up':'down';
            $day->btn = $day->status==1? 'success':'warning';
            $day->badge = $day->status==1? 'success':'danger';
            $day->badge_txt = $day->status==1? 'Active':'Close';
            $day->sa_title = 'Message';
            $day->sa_message = 'Class Created Successfully';
            $day->sa_icon = 'success';
            return $day;

            Alert::toast('Class saved successfully', 'success');
            return redirect('/days');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $day = Day::find($request->id);
            $day->name = $request->name;
            $day->code = $request->code;
            $day->save();

            $day = Day::where('id',$request->id)->first(['id','name','code','sl','status']);
            $day->arrow = $day->status==1? 'up':'down';
            $day->btn = $day->status==1? 'success':'warning';
            $day->badge = $day->status==1? 'success':'danger';
            $day->badge_txt = $day->status==1? 'Active':'Close';
            $day->sa_title = 'Message';
            $day->sa_message = 'Class Updated Successfully';
            $day->sa_icon = 'success';
            return $day;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $day = Day::find($request->id);
            $day->status == 1 ? $day->status = 2 : $day->status = 1;
            $day->save();

            $day = Day::where('id',$request->id)->first(['id','name','code','sl','status']);
            $day->arrow = $day->status==1? 'up':'down';
            $day->btn = $day->status==1? 'success':'warning';
            $day->badge = $day->status==1? 'success':'danger';
            $day->badge_txt = $day->status==1? 'Active':'Close';
            $day->sa_title = 'Message';
            $day->sa_message = 'Class Status Updated';
            $day->sa_icon = 'success';
            return $day;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $day = Day::find($request->id);
            $day->status = 3;
            $day->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
