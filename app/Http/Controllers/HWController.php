<?php

namespace App\Http\Controllers;

use App\Models\HW;
use App\Models\SubjectClass;
use Illuminate\Http\Request;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class HWController extends Controller
{
    public function addForm(){
        return view('backend.hw.hw-add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $hw = new HW();
            $hw->year =  $request->year;
            $hw->class_id =  $request->class_id;
            $hw->subject_id =  $request->subject_id;
            $hw->title =  $request->title;
            $hw->submission_date =  $request->submission_date;
            $hw->hw_detail =  $request->hw_detail;
            if (isset($request->attachment_url)){
                $hw->attachment_url = fileUpload($request->file('attachment_url'),'hw');
            }
            $hw->status =  2;
            $hw->creator = user()->name;
            $hw->save();

            Alert::toast('HW Saved Successfully','success');
            return back();
        }
    }

    public function classWiseHwList(Request $request){
        if (!isset($request->year) and !isset($request->class_id) and !isset($request->subject_id)){
            $year = Session::get('year'); $classId = Session::get('class_id'); $subjectId = Session::get('subject_id');
        }else{
            $year = $request->year; $classId = $request->class_id; $subjectId = $request->subject_id;
        }

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$classId,
            'status'=>1
        ])->get(['id','class_id','subject_id','sub_code','status'])->sortBy('sub_code');

        $homeWorks = [];

        if (isset($year) and isset($classId) and isset($subjectId)){
            $homeWorks = HW::where([
                'year'=>$year, 'class_id'=>$classId, 'subject_id'=>$subjectId
            ])->where('status','!=',3)->get();
        }

        return view('backend.hw.manage',[
            'homeWorks'=>$homeWorks,
            'classSubjects'=>$classSubjects,
            'data'=>['year'=>$year,'class_id'=>$classId]
        ]);
    }

    public function hwReview($id){
        $hw = HW::with(['classInfo','subject'])->find($id);
        return view('backend.hw.hw-review',[
            'hw'=>$hw
        ]);
    }

    public function edit($id){
        $hw = HW::find($id);

        Session::forget('year');
        Session::forget('section_id');
        Session::forget('class_id');
        Session::forget('subject_id');

        Session::put('year',$hw->year);
        Session::put('section_id',$hw->classInfo->section_id);
        Session::put('class_id',$hw->class_id);
        Session::put('subject_id',$hw->subject_id);

        return view('backend.hw.edit',[
            'hw'=>$hw
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $hw = HW::find($request->id);
            $hw->year =  $request->year;
            $hw->class_id =  $request->class_id;
            $hw->subject_id =  $request->subject_id;
            $hw->title =  $request->title;
            $hw->submission_date =  $request->submission_date;
            $hw->hw_detail =  $request->hw_detail;
            if (isset($request->attachment_url)){
                if (file_exists($hw->attachment_url)){unlink($hw->attachment_url);}
                $hw->attachment_url = fileUpload($request->file('attachment_url'),'hw');
            }
            $hw->updater = user()->name;
            $hw->save();

            Alert::toast('Home Work Updated Successfully','success');
            return redirect('/hw-review/'.$hw->id);
        }
    }

    public function statusUpdate($id){
        $hw = HW::find($id);
        $hw->status = $hw->status == 1 ? 2 : 1;
        $hw->save();

        Alert::toast('Home Work Status Updated','success');
        return back();
    }

    public function deleteAttachment($id){
        $hw =  HW::find($id);
        if (isset($hw)){
            if (file_exists($hw->attachment_url)){ unlink($hw->attachment_url); }
            $hw->attachment_url = null;
            $hw->save();
        }

        Alert::toast('Success','success');
        return back();
    }

    public function delete($id){
        $hw = HW::find($id);
        $hw->status = 3;
        $hw->save();

        Alert::toast('Home Work Deleted','success');
        return redirect('/class-wise-hw-list');
    }
}
