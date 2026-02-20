<?php

namespace App\Http\Controllers;

use App\Models\LatestNews;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LatestNewsController extends Controller
{
    public function index(){
        $latestNews = LatestNews::where('status','!=',3)->latest()->get();
        return view('backend.latest-news.manage',compact('latestNews'));
    }

    public function create(){
        $sl = count(LatestNews::all())+1;
        return view('backend.latest-news.add-form',compact('sl'));
    }

    public function store(Request $request){
        if (auth() and $request->post()){
            $news = new LatestNews();
            $news->author = $request->author;
            $news->title = $request->title;
            $news->content = $request->page_content;
            $news->sl = $request->sl;
            if (isset($request->thumbnail)){
                $news->thumbnail = fileUpload($request->file('thumbnail'),'latest-news');
            }
            $news->status = 2;
            $news->front_page_status = $request->front_page_status;
            $news->created_by = user()->id;
            $news->save();

            Alert::toast('Latest saved successfully', 'success');
            return back();
        }else{
            abort(404);
        }
    }

    public function show(){}

    public function edit($id){
        if (auth()){
            $news = LatestNews::find($id);
            return view('backend.latest-news.edit-form',compact('news'));
        }else{
            abort(404);
        }
    }

    public function update(Request $request){
        if (auth() and $request->post()){
            $news = LatestNews::find($request->id);
            $news->author = $request->author;
            $news->title = $request->title;
            $news->content = $request->page_content;
            $news->sl = $request->sl;
            if (isset($request->thumbnail)){
                if (file_exists($news->thumbnail)){
                    unlink($news->thumbnail);
                }
                $news->thumbnail = fileUpload($request->file('thumbnail'),'latest-news');
            }
            $news->front_page_status = $request->front_page_status;
            $news->save();

            Alert::success('Message','Latest News Updated Successfully');
            return redirect()->route('latest-news');
        }else{
            abort(404);
        }
    }

    public function statusUpdate(Request $request){
        $news = LatestNews::find($request->id);
        $news->status == 1 ? $news->status = 2 : $news->status = 1;
        $news->save();

        Alert::success('Message','Latest News Status Updated Successfully');
        return redirect()->route('latest-news');
    }

    public function destroy($id){
        $news = LatestNews::find($id);
        $news->status = 3;
        $news->save();

        Alert::success('Message','News Deleted Successfully');
        return redirect()->route('latest-news');
    }
}
