<?php

namespace App\Http\Controllers;

use App\Models\ECAType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ECATypeController extends Controller
{
    public $ECATypes;

    public function __construct()
    {
        $this->ECATypes = ECAType::where('status','!=',3)->get(['id','name','code','status']);
    }

    public function index(){
        return view('backend.eca_types.manage',[
            'ECATypes'=>$this->ECATypes
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $ECAType = new ECAType();
            $ECAType->name = $request->name;
            $ECAType->code = $request->code;
            $ECAType->status = 1;
            $ECAType->creator_id = user()->id;
            $ECAType->save();

            $ECAType->sl = count($this->ECATypes)+1;
            $ECAType->arrow = $ECAType->status==1? 'up':'down';
            $ECAType->btn = $ECAType->status==1? 'success':'warning';
            $ECAType->badge = $ECAType->status==1? 'success':'danger';
            $ECAType->badge_txt = $ECAType->status==1? 'Active':'Close';
            $ECAType->sa_title = 'Message';
            $ECAType->sa_message = 'ECAType Created Successfully';
            $ECAType->sa_icon = 'success';
            return $ECAType;

            Alert::toast('ECAType saved successfully', 'success');
            return redirect('/eca-types');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $ECAType = ECAType::find($request->id);
            $ECAType->name = $request->name;
            $ECAType->code = $request->code;
            $ECAType->save();

            $ECAType = ECAType::where('id',$request->id)->first(['id','name','code','status']);
            $ECAType->sl = $request->sl;
            $ECAType->arrow = $ECAType->status==1? 'up':'down';
            $ECAType->btn = $ECAType->status==1? 'success':'warning';
            $ECAType->badge = $ECAType->status==1? 'success':'danger';
            $ECAType->badge_txt = $ECAType->status==1? 'Active':'Close';
            $ECAType->sa_title = 'Message';
            $ECAType->sa_message = 'ECAType Updated Successfully';
            $ECAType->sa_icon = 'success';
            return $ECAType;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $ECAType = ECAType::find($request->id);
            $ECAType->status == 1 ? $ECAType->status = 2 : $ECAType->status = 1;
            $ECAType->save();

            $ECAType = ECAType::where('id',$request->id)->first(['id','name','code','status']);
            $ECAType->sl = $request->sl;
            $ECAType->arrow = $ECAType->status==1? 'up':'down';
            $ECAType->btn = $ECAType->status==1? 'success':'warning';
            $ECAType->badge = $ECAType->status==1? 'success':'danger';
            $ECAType->badge_txt = $ECAType->status==1? 'Active':'Close';
            $ECAType->sa_title = 'Message';
            $ECAType->sa_message = 'ECAType Status Updated';
            $ECAType->sa_icon = 'success';
            return $ECAType;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $ECAType = ECAType::find($request->id);
            $ECAType->status = 3;
            $ECAType->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'ECAType Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
