<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Year;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MonthController extends Controller
{
    public $months = [
        ['name'=>'January',     'code'=>'Jan'],
        ['name'=>'February',    'code'=>'Feb'],
        ['name'=>'March',       'code'=>'Mar'],
        ['name'=>'April',       'code'=>'Apr'],
        ['name'=>'May',         'code'=>'May'],
        ['name'=>'June',        'code'=>'Jun'],
        ['name'=>'July',        'code'=>'Jul'],
        ['name'=>'August',      'code'=>'Aug'],
        ['name'=>'September',   'code'=>'Sep'],
        ['name'=>'October',     'code'=>'Oct'],
        ['name'=>'November',    'code'=>'Nov'],
        ['name'=>'December',    'code'=>'Dec'],
    ];

    public function __construct()
    {
        foreach ($this->months as $item){
            $month = Month::where(['name'=>$item['name']])->first();
            if (!isset($month)){
                $month = new Month();
                $month->name = $item['name'];
                $month->code = $item['code'];
                $month->creator_id = 1;
                $month->save();
            }
        }
    }

    public function index(){
        return view('backend.months.manage',[
            'months'=>Month::all()
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $month = new Year();
            $month->year = $request->year;
            $month->status = 1;
            $month->creator_id = user()->id;
            $month->save();

            $month->sl = count($this->years)+1;
            $month->arrow = $month->status==1? 'up':'down';
            $month->btn = $month->status==1? 'success':'warning';
            $month->badge = $month->status==1? 'success':'danger';
            $month->badge_txt = $month->status==1? 'Active':'Close';
            $month->sa_title = 'Message';
            $month->sa_message = 'Year Created Successfully';
            $month->sa_icon = 'success';
            return $month;

            Alert::toast('Year saved successfully', 'success');
            return redirect('/years');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $month = Month::find($request->id);
            $month->name = $request->name;
            $month->code = $request->code;
            $month->creator_id = user()->id;
            $month->save();

            $month = Month::where('id',$request->id)->first(['id','name','code','status']);
            $month->sl = $request->sl;
            $month->arrow = $month->status==1? 'up':'down';
            $month->btn = $month->status==1? 'success':'warning';
            $month->badge = $month->status==1? 'success':'danger';
            $month->badge_txt = $month->status==1? 'Active':'Close';
            $month->sa_title = 'Message';
            $month->sa_message = 'Year Updated Successfully';
            $month->sa_icon = 'success';
            return $month;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $month = Month::find($request->id);
            $month->status == 1 ? $month->status = 2 : $month->status = 1;
            $month->save();

            $month = Month::where('id',$request->id)->first(['id','name','code','status']);
            $month->sl = $request->sl;
            $month->arrow = $month->status==1? 'up':'down';
            $month->btn = $month->status==1? 'success':'warning';
            $month->badge = $month->status==1? 'success':'danger';
            $month->badge_txt = $month->status==1? 'Active':'Close';
            $month->sa_title = 'Message';
            $month->sa_message = 'Year Status Updated';
            $month->sa_icon = 'success';
            return $month;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $month = Year::find($request->id);
            $month->status = 3;
            $month->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Year Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
