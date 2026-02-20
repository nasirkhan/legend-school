<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\Section;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SectionController extends Controller
{
    public $sections;

    public function __construct()
    {
        $this->sections = Section::with(['classes','teachers'])->where('status','!=',3)->get()->sortBy('class_id');
    }
    public function index(){
        $sections = $this->sections;
        return view('backend.sections.manage',[
            'sections'=>$sections
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $section = new Section();
            $section->name = $request->name;
            $section->result_type = $request->result_type;
            $section->status = 1;
            $section->creator_id = user()->id;
            $section->save();

            $section->sl = count($this->sections)+1;
            $section->arrow = $section->status==1? 'up':'down';
            $section->btn = $section->status==1? 'success':'warning';
            $section->badge = $section->status==1? 'success':'danger';
            $section->badge_txt = $section->status==1? 'Active':'Close';
            $section->sa_title = 'Message';
            $section->sa_message = 'Sub ClassName Updated Successfully';
            $section->sa_icon = 'success';
            return $section;

            Alert::toast('Section saved successfully', 'success');
            return redirect('/batches');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $section = Section::find($request->id);
            $section->name = $request->name;
            $section->result_type = $request->result_type;
            $section->save();

            $section = Section::with('classes')->where('id',$request->id)->first(['id','name','result_type','status']);
            $section->sl = $request->sl;
            $section->arrow = $section->status==1? 'up':'down';
            $section->btn = $section->status==1? 'success':'warning';
            $section->badge = $section->status==1? 'success':'danger';
            $section->badge_txt = $section->status==1? 'Active':'Close';
            $section->sa_title = 'Message';
            $section->sa_message = 'Sub ClassName Updated Successfully';
            $section->sa_icon = 'success';
            return $section;
        }
    }


    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $section = Section::find($request->id);
            $section->status == 1 ? $section->status = 2 : $section->status = 1;
            $section->save();

            $section = Section::with('classes')->where('id',$request->id)->first(['id','name','result_type','status']);
            $section->sl = $request->sl;
            $section->arrow = $section->status==1? 'up':'down';
            $section->btn = $section->status==1? 'success':'warning';
            $section->badge = $section->status==1? 'success':'danger';
            $section->badge_txt = $section->status==1? 'Active':'Close';
            $section->sa_title = 'Message';
            $section->sa_message = 'Section Status Updated';
            $section->sa_icon = 'success';
            return $section;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $section = Section::find($request->id);
            $section->delete();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Sub ClassName Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }

    public function getSection(Request $request){
        if ($request->ajax()){
            $sections = Section::with('classes')->where([
                'status'=>1,
            ])->get(['id','name']);

            return response()->json([
                'sections'=>$sections
            ]);
        }
    }

    public function getSectionClasses(Request $request){
        if ($request->ajax()){
            $currentSection = Section::with('classes')->find($request->id);

            $unused = ClassName::where([
                'section_id'=>null,
                'status'=>1
            ])->get(['id','name']);


            return response()->json([
                'success'=>true,
                'result'=>$unused,
                'selectedClasses'=>$currentSection->classes
            ]);
        }
    }

    public function sectionClassUpdate(Request $request){
        if ($request->post()){
            if (isset($request->removed)){
                foreach ($request->removed as $key => $value){
                    $class = ClassName::find($key);
                    if (isset($class)){$class->section_id = null; $class->save();}
                }
            }

            if (isset($request->selected)){
                foreach ($request->selected as $key => $value){
                    $newClass = ClassName::find($key);
                    $newClass->section_id = $request->section_id;
                    $newClass->save();
                }
            }

            Alert::toast('Section Updated','success');
            return back();
        }
    }
}
