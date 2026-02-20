<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    public function index(){
        return view('backend.pages.manage',[
            'pages'=>Page::where('status','!=',3)->get()->sortBy('position')->sortBy('menu_id')
        ]);
    }

    public function addForm(){
        return view('backend.pages.add-form',[
            'menus'=>Menu::where('status',1)->get()
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $page = new Page();
            $page->menu_id = $request->menu_id;
            $page->menu_txt = $request->menu_txt;
            $page->position = count(Page::where('menu_id',$request->menu_id)->get())+1;
            $page->title = $request->title;
            $page->content = $request->page_content;
            if (isset($request->thumbnail)){
                $page->thumbnail = fileUpload($request->file('thumbnail'),'pages');
            }
            $page->status = 1;
            $page->creator_id = user()->id;
            $page->save();

            Alert::toast('Page saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.pages.edit-form',[
            'menus'=>Menu::where('status',1)->get(),
            'page'=>Page::with('menu')->find($id)
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $page = Page::find($request->id);
            $page->menu_id = $request->menu_id;
            $page->menu_txt = $request->menu_txt;
            $page->title = $request->title;
            $page->content = $request->page_content;
            if (isset($request->thumbnail)){
                if (file_exists($page->thumbnail)){
                    unlink($page->thumbnail);
                }
                $page->thumbnail = fileUpload($request->file('thumbnail'),'pages');
            }
            $page->position = $request->position;
            $page->status = 1;
            $page->save();

            Alert::toast('Page updated successfully', 'success');
            return redirect('/pages');
        }
    }

    public function statusUpdate(Request $request){
        $page = Page::find($request->id);
        $page->status == 1 ? $page->status = 2 : $page->status = 1;
        $page->save();

        Alert::toast('Page Status Updated!!','success');
        return redirect('/pages');
    }

    public function delete(Request $request){
//        if ($request->ajax()){
            $page = Page::find($request->id);
            $page->status = 3;
            $page->save();

            Alert::toast('Page Deleted','success');
            return redirect('/pages');

//            return response()->json([
//                'success'=>true,
//                'sa_title'=>'Message',
//                'sa_message'=>'Page Deleted Successfully',
//                'sa_icon'=>'success'
//            ]);
//        }
    }
}
