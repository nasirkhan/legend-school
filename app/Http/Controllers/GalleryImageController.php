<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryImageController extends Controller
{
    public function index(){
        return view('backend.gallery-images.manage',[
            'images'=>GalleryImage::where('status','!=',3)->get()->sortByDesc('id')
        ]);
    }

    public function addForm(){
        return view('backend.gallery-images.add-form');
    }

    public function store(Request $request){
        if ($request->post()){
            $image = new GalleryImage();
            $image->title = $request->title;
            $image->description = $request->description;
            if (isset($request->thumbnail)){
                $image->url = fileUpload($request->file('thumbnail'),'gallery-images');
            }
            $image->status = 1;
            $image->creator_id = user()->id;
            $image->save();

            Alert::toast('Gallery Image saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.gallery-images.edit-form',[
            'image'=>GalleryImage::find($id)
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $image = GalleryImage::find($request->id);
            $image->title = $request->title;
            $image->description = $request->description;
            if (isset($request->thumbnail)){
                if (file_exists($image->thumbnail)){
                    unlink($image->url);
                }
                $image->url = fileUpload($request->file('thumbnail'),'gallery-images');
            }
            $image->status = 1;
            $image->save();

            Alert::toast('Gallery Image updated successfully', 'success');
            return redirect('/gallery-images');
        }
    }

    public function statusUpdate(Request $request){
        $image = GalleryImage::find($request->id);
        $image->status == 1 ? $image->status = 2 : $image->status = 1;
        $image->save();

        Alert::toast('Gallery Image Status Updated!!','success');
        return redirect('/gallery-images');
    }

    public function delete(Request $request){
        $image = GalleryImage::find($request->id);
        $image->status = 3;
        $image->save();

        Alert::toast('Gallery Image Deleted!!','success');
        return redirect('/gallery-images');
    }
}
