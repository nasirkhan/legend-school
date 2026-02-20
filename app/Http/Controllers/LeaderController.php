<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaderController extends Controller
{
    public function index(){
        return view('backend.leaders.manage',[
            'leaders'=>Leader::where('status','!=',3)->get()
        ]);
    }

    public function addForm(){
        return view('backend.leaders.add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $leader = new Leader();
            $leader->name = $request->name;
            $leader->designation = $request->designation;
            $leader->short_description = $request->short_description;
            $leader->description = $request->description;
            if (isset($request->thumbnail)){
                $leader->thumbnail = fileUpload($request->file('thumbnail'),'leaders');
            }
            $leader->creator_id = user()->id;
            $leader->save();

            Alert::toast('Leader saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.leaders.edit-form',['leader'=>Leader::find($id)]);
    }

    public function update(Request $request){
        if ($request->post()){
            $leader = Leader::find($request->id);
            $leader->name = $request->name;
            $leader->designation = $request->designation;
            $leader->short_description = $request->short_description;
            $leader->description = $request->description;
            if (isset($request->thumbnail)){
                $leader->thumbnail = fileUpload($request->file('thumbnail'),'leaders');
            }
            $leader->save();
            Alert::toast('Leader updated successfully', 'success');
            return redirect('/leaders');
        }
    }

    public function statusUpdate(Request $request){
        $leader = Leader::find($request->id);
        $leader->status == 1 ? $leader->status = 2 : $leader->status = 1;
        $leader->save();

        Alert::toast('Leader Status Updated!!','success');
        return redirect('/leaders');
    }

    public function delete(Request $request){
        $leader = Leader::find($request->id);
        $leader->status = 3;
        $leader->save();

        Alert::toast('Leader Deleted','success');
        return redirect('/leaders');
    }
}
