<?php

namespace App\Http\Controllers;

use App\Models\ClassItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    public function __construct(){

    }

    public function index(){
        $items = Item::where('status','!=',3)->get(['id','name','used_for','billing_cycle','status'])->sortBy('used_for')->sortBy('billing_cycle');
        return view('backend.items.manage',['items'=>$items]);
    }

    public function getItems(Request $request){
        $items = Item::where(['status'=>1])->get(['id','name','used_for','billing_cycle','status'])->sortBy('used_for');
        return response()->json($items);
    }

    public function store(Request $request){
//        return $request->all();
        if ($request->post()){
            $item = new Item();
            $item->name = $request->name;
            $item->used_for = $request->used_for;
            $item->billing_cycle = $request->billing_cycle;
            $item->status = 1;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Transaction Item saved successfully', 'success');
            return redirect('/items');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $item = Item::find($request->id);
            $item->name = $request->name;
            $item->used_for = $request->used_for;
            $item->billing_cycle = $request->billing_cycle;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Transaction Item updated successfully', 'success');;
            return back();
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $item = Item::find($request->id);
            $item->status == 1 ? $item->status = 2 : $item->status = 1;
            $item->save();

            $item = Item::where('id',$request->id)->first(['id','name','used_for','billing_cycle','status']);

            $item->used_for_txt = $item->used_for == 1 ? 'Students' : 'Office Staff';
            $item->billing_cycle_txt = $this->billingCycle($item->billing_cycle);
            $item->sl = $request->sl;
            $item->arrow = $item->status==1? 'up':'down';
            $item->btn = $item->status==1? 'success':'warning';
            $item->badge = $item->status==1? 'success':'danger';
            $item->badge_txt = $item->status==1? 'Active':'Close';
            $item->sa_title = 'Message';
            $item->sa_message = 'Transaction Item Status Updated';
            $item->sa_icon = 'success';
            return $item;
        }
    }

    protected function billingCycle($id){
        switch ($id){
            case 1:
                return 'One Time';
                break;
            case 2:
                return 'Yearly';
                break;
            case 3:
                return 'Monthly';
                break;
            case 4:
                return 'Any Time';
                break;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $item = Item::find($request->id);
            $item->status = 3;
            $item->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Transaction Item Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function classWiseItems(){
        $classItems = [];
        if (Session::get('year') and Session::get('class_id')){
            $classItems = ClassItem::with('item')->where([
                'year'=>Session::get('year'),
                'class_id'=>Session::get('class_id'),
            ])->where('status','!=',3)
                ->get(['id','year','class_id','item_id','amount','status']);
        }

        return view('backend.items.class-wise.manage',compact('classItems'));
    }

    public function classWiseItemSave(Request $request){
        if ($request->post()){
            $classItem = ClassItem::where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'item_id'=>$request->item_id,
                'status'=>1
            ])->latest()->first();
            if (!isset($classItem)){
                $classItem = new ClassItem();
            }

            $classItem->year = $request->year;
            $classItem->class_id = $request->class_id;
            $classItem->item_id = $request->item_id;
            $classItem->amount = $request->amount;
            $classItem->creator_id = user()->id;
            $classItem->save();

            Alert::toast('Item added to the selected class', 'success');
            return back();
        }
    }

    public function getClassWiseItems(Request $request){
        if ($request->ajax()){
            $classItems = ClassItem::with('item')->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
            ])->where('status','!=',3)
                ->get(['id','year','class_id','item_id','amount','status']);

            $role = user()->role->code;

            return view('backend.items.class-wise.table',compact('classItems','role'));
        }
    }

    public function classWiseItemUpdate(Request $request){
        if ($request->post()){
            $classItem = ClassItem::find($request->id);
            if ($classItem){
                $classItem->year = $request->year;
                $classItem->class_id = $request->class_id;
                $classItem->item_id = $request->item_id;
                $classItem->amount = $request->amount;
                $classItem->creator_id = user()->id;
                $classItem->save();

                Alert::toast('Item updated successfully', 'success');
                return back();
            }
        }
    }

    public function classWiseItemStatusUpdate(Request $request){
        if ($request->ajax()){
            $classItem = ClassItem::find($request->id);
            $classItem->status = ($classItem->status==1?2:1);
            $classItem->save();

            $status = $classItem->status;


            $item = ClassItem::with('item')
                ->where(['id'=>$request->id])
                ->first(['id','year','class_id','item_id','amount','status']);


            return response()->json([
                'item'=>$item,
                'success'=>true,
                'status'=>$status==1?'Active':'Close',
                'badge_classes'=>'font-size-12 badge badge-pill badge-soft-'.($status==1?'success':'danger'),
                'btn_classes'=>'btn btn-sm btn-'.($status==1?'success':'warning'),
                'fa_classes'=>'fa fa-arrow-'.($status==1?'up':'down'),
                'sa_title'=>'Message',
                'sa_message'=>$status==1?'Item Activate':'Item Closed',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function classWiseItemDelete(Request $request){
        if ($request->ajax()){
            $item = ClassItem::find($request->id);
            $item->status = 3;
            $item->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Item Removed From This Class',
                'sa_icon'=>'success'
            ]);
        }
    }
}
