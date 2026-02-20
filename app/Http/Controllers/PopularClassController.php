<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PopularClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PopularClassController extends Controller
{
    public function index(){

        return view('backend.popular-classes.manage',[
            'popularECAs'=>PopularClass::where('status','!=',3)->get()->sortBy('position')->sortBy('menu_id')
        ]);
    }

    public function addForm(){

        $sl = count(PopularClass::all())+1;

        return view('backend.popular-classes.add-form',compact('sl'));
    }

    public function store(Request $request){
        if ($request->post()){
            $pClass = new PopularClass();
            $pClass->sl = count(PopularClass::take('*')->get())+1;
            $pClass->title = $request->title;
            $pClass->content = $request->page_content;
            if (isset($request->thumbnail)){
                $pClass->thumbnail = fileUpload($request->file('thumbnail'),'popular-classes');
            }
            $pClass->status = 1;
            $pClass->front_page_status = $request->front_page_status;
            $pClass->created_by = user()->id;
            $pClass->save();

            Alert::toast('Popular ECA saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.popular-classes.edit-form',[
            'page'=>PopularClass::find($id)
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $pClass = PopularClass::find($request->id);
            $pClass->title = $request->title;
            $pClass->content = $request->page_content;
            if (isset($request->thumbnail)){
                if (file_exists($pClass->thumbnail)){
                    unlink($pClass->thumbnail);
                }
                $pClass->thumbnail = fileUpload($request->file('thumbnail'),'popular-classes');
            }
            $pClass->sl = $request->sl;
            $pClass->front_page_status = $request->front_page_status;
            $pClass->save();

            Alert::toast('PopularClass updated successfully', 'success');
            return redirect('/popular-ecas');
        }
    }

    public function statusUpdate(Request $request){
        $pClass = PopularClass::find($request->id);
        $pClass->status == 1 ? $pClass->status = 2 : $pClass->status = 1;
        $pClass->save();

        Alert::toast('PopularClass Status Updated!!','success');
        return redirect('/popular-ecas');
    }

    public function delete(Request $request){
//        if ($request->ajax()){
        $pClass = PopularClass::find($request->id);
        $pClass->status = 3;
        $pClass->save();

        Alert::toast('PopularClass Deleted','success');
        return redirect('/popular-ecas');

//            return response()->json([
//                'success'=>true,
//                'sa_title'=>'Message',
//                'sa_message'=>'PopularClass Deleted Successfully',
//                'sa_icon'=>'success'
//            ]);
//        }
    }
}
