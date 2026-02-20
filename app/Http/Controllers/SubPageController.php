<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use App\Models\SubPage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubPageController extends Controller
{
    public function index(){
        return view('backend.sub-pages.manage',[
            'pages'=>SubPage::with('mainPage')->where('status','!=',3)->get()->sortBy('position')->sortBy('page_id')
        ]);
    }

    public function addForm(){
        return view('backend.sub-pages.add-form',[
            'menus'=>Page::where('status',1)->get()
        ]);
    }

    public function store(Request $request){
        if ($request->post()){
            $page = new SubPage();
            $page->page_id = $request->page_id;
            $page->menu_txt = $request->menu_txt;
            $page->position = count(Page::where('menu_id',$request->menu_id)->get())+1;
            $page->title = $request->title;
            $page->content = $request->page_content;
            if (isset($request->thumbnail)){
                $page->thumbnail = fileUpload($request->file('thumbnail'),'sub-pages');
            }
            $page->status = 1;
            $page->creator_id = user()->id;
            $page->save();

            Alert::toast('Sub Page saved successfully', 'success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function edit($id){
        return view('backend.sub-pages.edit-form',[
            'menus'=>Page::where('status',1)->get(),
            'page'=>SubPage::with('mainPage')->where(['id'=>$id])->first()
        ]);
    }

    public function update(Request $request){
        if ($request->post()){
            $page = SubPage::find($request->id);
            $page->page_id = $request->page_id;
            $page->menu_txt = $request->menu_txt;
            $page->title = $request->title;
            $page->content = $request->page_content;
            if (isset($request->thumbnail)){
                if (file_exists($page->thumbnail)){
                    unlink($page->thumbnail);
                }
                $page->thumbnail = fileUpload($request->file('thumbnail'),'pages');
            }
            $page->status = 1;
            $page->position = $request->position;
            $page->save();

            Alert::toast('Page updated successfully', 'success');
            return redirect('/sub-pages');
        }
    }

    public function statusUpdate(Request $request){
        $page = SubPage::find($request->id);
        $page->status == 1 ? $page->status = 2 : $page->status = 1;
        $page->save();

        Alert::toast('Sub Page Status Updated!!','success');
        return redirect('/sub-pages');
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $page = SubPage::find($request->id);
            $page->status = 3;
            $page->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Sub Page Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
