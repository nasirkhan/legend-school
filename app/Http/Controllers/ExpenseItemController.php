<?php

namespace App\Http\Controllers;

use App\Models\ExpenseItem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseItemController extends Controller
{
    public function __construct(){

    }

    public function index(){
        $items = ExpenseItem::where('status','!=',3)->get(['id','name','type','status']);
        return view('backend.expense-items.manage',['items'=>$items]);
    }

    public function getExpenseItems(Request $request){
        $items = ExpenseItem::where(['status'=>1])->get(['id','name','type','status']);
        return response()->json($items);
    }

    public function store(Request $request){
//        return $request->all();
        if ($request->post()){
            $item = new ExpenseItem();
            $item->name = $request->name;
            $item->type = $request->type;
            $item->status = 1;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Income Expense Item saved successfully', 'success');
            return redirect('/income-expense-items');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $item = ExpenseItem::find($request->id);
            $item->name = $request->name;
            $item->type = $request->type;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Income Expense Item updated successfully', 'success');;
            return back();
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $item = ExpenseItem::find($request->id);
            $item->status == 1 ? $item->status = 2 : $item->status = 1;
            $item->save();

            $item = ExpenseItem::where('id',$request->id)->first(['id','name','type','status']);

            $item->sl = $request->sl;
            $item->arrow = $item->status==1? 'up':'down';
            $item->btn = $item->status==1? 'success':'warning';
            $item->badge = $item->status==1? 'success':'danger';
            $item->badge_txt = $item->status==1? 'Active':'Close';
            $item->sa_title = 'Message';
            $item->sa_message = 'Income Expense Item Status Updated';
            $item->sa_icon = 'success';
            return $item;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $item = ExpenseItem::find($request->id);
            $item->status = 3;
            $item->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Income Expense Item Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
