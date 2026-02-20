<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\BeneficiaryType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BeneficiaryController extends Controller
{

    /*
     * All Beneficiaries are considered as an account
     * In routes, please don't confuse about beneficiary and account. Actually they are same */


    public function __construct(){

    }

    public function index(){
        $types = BeneficiaryType::where('status','=',1)->get(['id','name']);
        $beneficiaries = Beneficiary::get(['id','name','contact_number','type_id','status']);
//        return $beneficiaries;
//        return $types;
        return view('backend.beneficiaries.manage',compact('types','beneficiaries'));
    }

    public function getExpenseItems(Request $request){
        $items = Beneficiary::where(['status'=>1])->get(['id','name','contact_number','type_id','status']);
        return response()->json($items);
    }

    public function store(Request $request){
//        return $request->all();
        if ($request->post()){
            $item = new Beneficiary();
            $item->type_id = $request->beneficiary_type_id;
            $item->name = $request->name;
            $item->contact_number = $request->contact_number;
            $item->status = 1;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Account created successfully', 'success');
            return redirect('/accounts');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $item = Beneficiary::find($request->id);
            $item->type_id = $request->beneficiary_type_id;
            $item->name = $request->name;
            $item->contact_number = $request->contact_number;
            $item->creator_id = user()->id;
            $item->save();

            Alert::toast('Account updated successfully', 'success');;
            return back();
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $item = Beneficiary::find($request->id);
            $item->status == 1 ? $item->status = 2 : $item->status = 1;
            $item->save();

            $item = Beneficiary::where('id',$request->id)->first(['id','name','contact_number','type_id','status']);

            $item->sl = $request->sl;
            $item->arrow = $item->status==1? 'up':'down';
            $item->btn = $item->status==1? 'success':'warning';
            $item->badge = $item->status==1? 'success':'danger';
            $item->badge_txt = $item->status==1? 'Active':'Close';
            $item->sa_title = 'Message';
            $item->sa_message = 'Account Status Updated';
            $item->sa_icon = 'success';
            return $item;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $item = Beneficiary::find($request->id);
            $item->status = 3;
            $item->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Account Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
