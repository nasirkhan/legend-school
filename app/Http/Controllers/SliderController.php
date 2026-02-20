<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index(){
        return view('backend.slider.manage',[
            'slides'=>Slide::where('status','!=',3)->get()
        ]);
    }

    public function addForm(){
        return view('backend.slider.add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $slide = new Slide();
            $slide->title = $request->title;
            $slide->description = $request->description;
            $slide->page_link = $request->page_link;
            if (isset($request->thumbnail)){
                $slide->url = fileUpload($request->file('thumbnail'),'slides');
            }
            $slide->creator_id = user()->id;
            $slide->save();

            Alert::toast('Slide saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.slider.edit-form',['slide'=>Slide::find($id)]);
    }

    public function update(Request $request){
        if ($request->post()){
            $slide = Slide::find($request->id);
            $slide->title = $request->title;
            $slide->description = $request->description;
            $slide->page_link = $request->page_link;
            if (isset($request->thumbnail)){
                if (file_exists($slide->url)){
                    unlink($slide->url);
                }
                $slide->url = fileUpload($request->file('thumbnail'),'slides');
            }
            $slide->creator_id = user()->id;
            $slide->save();

            Alert::toast('Slide updated successfully', 'success');
            return redirect('/slides');
        }
    }

    public function statusUpdate(Request $request){
        $slide = Slide::find($request->id);
        $slide->status == 1 ? $slide->status = 2 : $slide->status = 1;
        $slide->save();

        Alert::toast('Slide Status Updated!!','success');
        return redirect('/slides');
    }

    public function delete(Request $request){
        $slide = Slide::find($request->id);
        $slide->status = 3;
        $slide->save();

        Alert::toast('Slide Deleted','success');
        return redirect('/slides');
    }

    public function serializeSlides(){
        return view('backend.slider.serialize-form',[
            'slides'=>Slide::all()->sortBy('position')
        ]);
    }

    public function updateSlidePosition(Request $request){
        foreach ($request->position as $id => $position){
            $slide = Slide::find($id);
            $slide->position = $position;
            $slide->save();
        }
        Alert::toast('Slider serialization complete','success');
        return back();
    }
}
