<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class YearController extends Controller
{
    public $years;

    public function __construct()
    {
        $this->years = Year::where('status','!=',3)->get(['id','year','status']);
    }

    public function index(){
        return view('backend.years.manage',[
            'years'=>$this->years
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $year = new Year();
            $year->year = $request->year;
            $year->status = 1;
            $year->creator_id = user()->id;
            $year->save();

            $year->sl = count($this->years)+1;
            $year->arrow = $year->status==1? 'up':'down';
            $year->btn = $year->status==1? 'success':'warning';
            $year->badge = $year->status==1? 'success':'danger';
            $year->badge_txt = $year->status==1? 'Active':'Close';
            $year->sa_title = 'Message';
            $year->sa_message = 'Year Created Successfully';
            $year->sa_icon = 'success';
            return $year;

            Alert::toast('Year saved successfully', 'success');
            return redirect('/years');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $year = Year::find($request->id);
            $year->year = $request->year;
            $year->save();

            $year = Year::where('id',$request->id)->first(['id','year','status']);
            $year->sl = $request->sl;
            $year->arrow = $year->status==1? 'up':'down';
            $year->btn = $year->status==1? 'success':'warning';
            $year->badge = $year->status==1? 'success':'danger';
            $year->badge_txt = $year->status==1? 'Active':'Close';
            $year->sa_title = 'Message';
            $year->sa_message = 'Year Updated Successfully';
            $year->sa_icon = 'success';
            return $year;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $year = Year::find($request->id);
            $year->status == 1 ? $year->status = 2 : $year->status = 1;
            $year->save();

            $year = Year::where('id',$request->id)->first(['id','year','status']);
            $year->sl = $request->sl;
            $year->arrow = $year->status==1? 'up':'down';
            $year->btn = $year->status==1? 'success':'warning';
            $year->badge = $year->status==1? 'success':'danger';
            $year->badge_txt = $year->status==1? 'Active':'Close';
            $year->sa_title = 'Message';
            $year->sa_message = 'Year Status Updated';
            $year->sa_icon = 'success';
            return $year;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $year = Year::find($request->id);
            $year->status = 3;
            $year->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Year Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
