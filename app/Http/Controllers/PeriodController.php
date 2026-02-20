<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public $periods;

    public function __construct()
    {
        $this->periods = Period::with([
            'section'=>function($query){
            $query->select('id','name');
            }
        ])->where('status','!=',3)->get(['id','name','code','start','end','sl','status','section_id']);
    }

    public function index(){
        return view('backend.periods.manage',['periods'=>$this->periods]);
    }

    public function getPeriods(Request $request){
        $periods = Period::where([
            'status'=>1
        ])->get(['id','name','code','sl','status']);

        return response()->json($periods);
    }

    public function store(Request $request){
        if ($request->post()){

            $period = new Period();
            $period->section_id = $request->section_id;
            $period->name = $request->name;
            $period->code = $request->code;
            $period->start = $request->start;
            $period->end = $request->end;
            $period->sl = count(Period::where('section_id',$request->section_id)->get('id'))+1;
            $period->status = 1;
            $period->creator_id = user()->id;
            $period->save();

            $period = Period::with([
                'section'=>function($query){$query->select(['id','name']);}
            ])->where('id',$period->id)->first(['id','name','code','start','end','sl','status','section_id']);
            $period->arrow = $period->status==1? 'up':'down';
            $period->btn = $period->status==1? 'success':'warning';
            $period->badge = $period->status==1? 'success':'danger';
            $period->badge_txt = $period->status==1? 'Active':'Close';
            $period->sa_title = 'Message';
            $period->sa_message = 'Class Created Successfully';
            $period->sa_icon = 'success';
            return $period;

            Alert::toast('Class saved successfully', 'success');
            return redirect('/periods');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $period = Period::find($request->id);
            $period->section_id = $request->section_id;
            $period->name = $request->name;
            $period->code = $request->code;
            $period->start = $request->start;
            $period->end = $request->end;
            $period->save();

            $period = Period::with([
                'section'=>function($query){$query->select(['id','name']);}
            ])->where('id',$request->id)->first(['id','name','code','start','end','sl','status','section_id']);
            $period->arrow = $period->status==1? 'up':'down';
            $period->btn = $period->status==1? 'success':'warning';
            $period->badge = $period->status==1? 'success':'danger';
            $period->badge_txt = $period->status==1? 'Active':'Close';
            $period->sa_title = 'Message';
            $period->sa_message = 'Class Updated Successfully';
            $period->sa_icon = 'success';
            return $period;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $period = Period::find($request->id);
            $period->status == 1 ? $period->status = 2 : $period->status = 1;
            $period->save();

            $period = Period::with([
                'section'=>function($query){$query->select(['id','name']);}
            ])->where('id',$request->id)->first(['id','name','code','start','end','sl','status','section_id']);
            $period->arrow = $period->status==1? 'up':'down';
            $period->btn = $period->status==1? 'success':'warning';
            $period->badge = $period->status==1? 'success':'danger';
            $period->badge_txt = $period->status==1? 'Active':'Close';
            $period->sa_title = 'Message';
            $period->sa_message = 'Class Status Updated';
            $period->sa_icon = 'success';
            return $period;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $period = Period::find($request->id);
            $period->status = 3;
            $period->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Class Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
