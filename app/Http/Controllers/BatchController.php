<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\Batch;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BatchController extends Controller
{
    public $batches;

    public function __construct()
    {
        $this->batches = Batch::with('className')->where('status','!=',3)->get();
    }
    public function index(){
        return view('backend.batches.manage',[
            'batches'=>$this->batches
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $batch = new Batch();
            $batch->class_id = $request->class_id;
            $batch->name = $request->name;
            $batch->status = 1;
            $batch->creator_id = user()->id;
            $batch->save();

            $batch->sl = count($this->batches)+1;
            $batch->class_name = ClassName::find($request->class_id)->name;
            $batch->arrow = $batch->status==1? 'up':'down';
            $batch->btn = $batch->status==1? 'success':'warning';
            $batch->badge = $batch->status==1? 'success':'danger';
            $batch->badge_txt = $batch->status==1? 'Active':'Close';
            $batch->sa_title = 'Message';
            $batch->sa_message = 'Sub ClassName Updated Successfully';
            $batch->sa_icon = 'success';
            return $batch;

            Alert::toast('Batch saved successfully', 'success');
            return redirect('/batches');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $batch = Batch::find($request->id);
            $batch->class_id = $request->class_id;
            $batch->name = $request->name;
            $batch->save();

            $batch = Batch::where('id',$request->id)->first(['id','class_id','name','status']);
            $batch->sl = $request->sl;
            $batch->class_name = ClassName::find($request->class_id)->name;
            $batch->arrow = $batch->status==1? 'up':'down';
            $batch->btn = $batch->status==1? 'success':'warning';
            $batch->badge = $batch->status==1? 'success':'danger';
            $batch->badge_txt = $batch->status==1? 'Active':'Close';
            $batch->sa_title = 'Message';
            $batch->sa_message = 'Sub ClassName Updated Successfully';
            $batch->sa_icon = 'success';
            return $batch;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $batch = Batch::find($request->id);
            $batch->status == 1 ? $batch->status = 2 : $batch->status = 1;
            $batch->save();

            $batch = Batch::where('id',$request->id)->first(['id','class_id','name','status']);
            $batch->sl = $request->sl;
            $batch->class_name = ClassName::find($batch->class_id)->name;
            $batch->arrow = $batch->status==1? 'up':'down';
            $batch->btn = $batch->status==1? 'success':'warning';
            $batch->badge = $batch->status==1? 'success':'danger';
            $batch->badge_txt = $batch->status==1? 'Active':'Close';
            $batch->sa_title = 'Message';
            $batch->sa_message = 'Sub ClassName Status Updated';
            $batch->sa_icon = 'success';
            return $batch;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $batch = Batch::find($request->id);
            $batch->delete();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Sub ClassName Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function getBatch(Request $request){
        if ($request->ajax()){
            $class = ClassName::find($request->class_id);
            $batches = Batch::where([
                'status'=>1,
                'class_id'=>$request->class_id
            ])->get(['id','name']);

            return response()->json([
                'className'=>$class,
                'batches'=>$batches
            ]);
        }
    }
}
