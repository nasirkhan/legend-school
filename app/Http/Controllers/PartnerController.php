<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PartnerController extends Controller
{
    public $partners;

    public function __construct()
    {
        $this->partners = Partner::where('status','!=',3)->get(['id','name','thumbnail','status']);
    }

    public function index(){
        return view('backend.partners.manage',[
            'partners'=>$this->partners
        ]);
    }

//    public function create(){
//
//    }

    public function store(Request $request){
        if ($request->post()){
            $partner = new Partner();
            $partner->name = $request->name;
            if (isset($request->thumbnail)){
                $partner->thumbnail = fileUpload($request->file('thumbnail'),'partners');
            }
            $partner->sl = count($this->partners)+1;
            $partner->status = 1;
            $partner->creator_id = user()->id;
            $partner->save();

            Alert::toast('Partner saved successfully', 'success');
            return redirect('/partners');
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        $partner = Partner::find($id);
        return view('backend.partners.edit',[
            'editPartner'=>$partner,
            'partners'=>$this->partners
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $partner = Partner::find($request->id);
            $partner->name = $request->name;
            if (isset($request->thumbnail)){
                if (file_exists($partner->thumbnail)){unlink($partner->thumbnail);}
                $partner->thumbnail = fileUpload($request->file('thumbnail'),'partners');
            }
            $partner->save();

            Alert::toast('Partner updated successfully', 'success');
            return redirect('/partners');
        }
    }

    public function statusUpdate(Request $request){
        $partner = Partner::find($request->id);
        $partner->status == 1 ? $partner->status = 2 : $partner->status = 1;
        $partner->save();

        Alert::toast('Partner status updated successfully', 'success');
        return redirect('/partners');
    }

    public function delete(Request $request){
        $partner = Partner::find($request->id);
        $partner->status = 3;
        $partner->save();

        Alert::toast('Partner deleted successfully', 'success');
        return redirect('/partners');
    }
}
