<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClassRoutineController extends Controller
{
    public function index(){
        return view('backend.class-routines.manage',[
            'classRoutines'=>ClassRoutine::with('classInfo')->where('status','!=',3)->get()
        ]);
    }

    public function addForm(){
        return view('backend.class-routines.add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $classRoutine = new ClassRoutine();
            $classRoutine->class_id = $request->class_id;
            if (isset($request->file)){
                $classRoutine->url = fileUpload($request->file('file'),'class-routines');
            }
            $classRoutine->status = 1;
            $classRoutine->creator_id = user()->id;
            $classRoutine->save();

            Alert::toast('Class Routine saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.class-routines.edit-form');
    }

    public function update(Request $request){
        if ($request->post()){
            $classRoutine = ClassRoutine::find($request->id);
            $classRoutine->class_id = $request->class_id;
            if (isset($request->file)){
                if (file_exists($classRoutine->url)){
                    unlink($classRoutine->url);
                }
                $classRoutine->url = fileUpload($request->file('file'),'pages');
            }
            $classRoutine->save();

            Alert::toast('Class Routine updated successfully', 'success');
            return redirect('/class-routines');
        }
    }

    public function statusUpdate(Request $request){
        $classRoutine = Page::find($request->id);
        $classRoutine->status == 1 ? $classRoutine->status = 2 : $classRoutine->status = 1;
        $classRoutine->save();

        Alert::toast('Page Status Updated!!','success');
        return redirect('/class-routines');
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $classRoutine = Page::find($request->id);
            $classRoutine->status = 3;
            $classRoutine->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Page Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
