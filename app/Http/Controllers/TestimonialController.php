<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{
    public function index(){
        return view('backend.testimonials.manage',[
            'testimonials'=>Testimonial::where('status','!=',3)->get()
        ]);
    }

    public function addForm(){
        return view('backend.testimonials.add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->profession = $request->profession;
            $testimonial->content = $request->page_content;
            if (isset($request->thumbnail)){
                $testimonial->thumbnail = fileUpload($request->file('thumbnail'),'testimonials');
            }
            $testimonial->status = 1;
            $testimonial->creator_id = user()->id;
            $testimonial->save();

            Alert::toast('Testimonial saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.testimonials.edit-form',[
            'testimonial'=>Testimonial::find($id)
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $testimonial = Testimonial::find($request->id);
            $testimonial->name = $request->name;
            $testimonial->profession = $request->profession;
            $testimonial->content = $request->page_content;
            if (isset($request->thumbnail)){
                if (file_exists($testimonial->thumbnail)){
                    unlink($testimonial->thumbnail);
                }
                $testimonial->thumbnail = fileUpload($request->file('thumbnail'),'testimonials');
            }
            $testimonial->status = 1;
            $testimonial->save();

            Alert::toast('Testimonial updated successfully', 'success');
            return redirect('/testimonials');
        }
    }

    public function statusUpdate(Request $request){
        $testimonial = Testimonial::find($request->id);
        $testimonial->status == 1 ? $testimonial->status = 2 : $testimonial->status = 1;
        $testimonial->save();

        Alert::toast('Testimonial Status Updated!!','success');
        return redirect('/testimonials');
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $testimonial = Testimonial::find($request->id);
            $testimonial->status = 3;
            $testimonial->save();

            Alert::toast('Testimonial Deleted','success');
            return redirect('/testimonials');
        }
    }
}
