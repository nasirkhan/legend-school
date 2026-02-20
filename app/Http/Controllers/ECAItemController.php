<?php

namespace App\Http\Controllers;

use App\Models\ECAItem;
use App\Models\ECAType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ECAItemController extends Controller
{
    public $ECAItems;

    public function __construct()
    {
        $this->ECAItems = ECAItem::where('status','!=',3)->get(['id','eca_type_id','name','code','status']);
    }

    public function index(){
        return view('backend.eca_items.manage',[
            'ECAItems'=>$this->ECAItems,
            'ECATypes'=>ECAType::where('status',1)->get()
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $ECAItem = new ECAItem();
            $ECAItem->eca_type_id = $request->eca_type_id;
            $ECAItem->name = $request->name;
            $ECAItem->code = $request->code;
            $ECAItem->status = 1;
            $ECAItem->creator_id = user()->id;
            $ECAItem->save();

            $ECAItem->sl = count($this->ECAItems)+1;
            $ECAItem->arrow = $ECAItem->status==1? 'up':'down';
            $ECAItem->btn = $ECAItem->status==1? 'success':'warning';
            $ECAItem->badge = $ECAItem->status==1? 'success':'danger';
            $ECAItem->badge_txt = $ECAItem->status==1? 'Active':'Close';
            $ECAItem->sa_title = 'Message';
            $ECAItem->sa_message = 'ECAItem Created Successfully';
            $ECAItem->sa_icon = 'success';
            return $ECAItem;

            Alert::toast('ECAItem saved successfully', 'success');
            return redirect('/eca-types');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $ECAItem = ECAItem::find($request->id);
            $ECAItem->eca_type_id = $request->eca_type_id;
            $ECAItem->name = $request->name;
            $ECAItem->code = $request->code;
            $ECAItem->save();

            $ECAItem = ECAItem::where('id',$request->id)->first(['id','name','code','status']);
            $ECAItem->sl = $request->sl;
            $ECAItem->arrow = $ECAItem->status==1? 'up':'down';
            $ECAItem->btn = $ECAItem->status==1? 'success':'warning';
            $ECAItem->badge = $ECAItem->status==1? 'success':'danger';
            $ECAItem->badge_txt = $ECAItem->status==1? 'Active':'Close';
            $ECAItem->sa_title = 'Message';
            $ECAItem->sa_message = 'ECAItem Updated Successfully';
            $ECAItem->sa_icon = 'success';
            return $ECAItem;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $ECAItem = ECAItem::find($request->id);
            $ECAItem->status == 1 ? $ECAItem->status = 2 : $ECAItem->status = 1;
            $ECAItem->save();

            $ECAItem = ECAItem::where('id',$request->id)->first(['id','name','code','status']);
            $ECAItem->sl = $request->sl;
            $ECAItem->arrow = $ECAItem->status==1? 'up':'down';
            $ECAItem->btn = $ECAItem->status==1? 'success':'warning';
            $ECAItem->badge = $ECAItem->status==1? 'success':'danger';
            $ECAItem->badge_txt = $ECAItem->status==1? 'Active':'Close';
            $ECAItem->sa_title = 'Message';
            $ECAItem->sa_message = 'ECAItem Status Updated';
            $ECAItem->sa_icon = 'success';
            return $ECAItem;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $ECAItem = ECAItem::find($request->id);
            $ECAItem->status = 3;
            $ECAItem->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'ECAItem Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
