<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        return view('backend.menu.manage',['menus'=>Menu::all()->sortBy('position')]);
    }

    public function store(Request $request){
        if ($request->post()){
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->status = 1;
            $menu->position = $request->position;
//            $menu->position = count(Menu::all())+1;
            $menu->creator_id = user()->id;
            $menu->save();

            $menu->sl = $menu->position;
            $menu->arrow = $menu->status==1? 'up':'down';
            $menu->btn = $menu->status==1? 'success':'warning';
            $menu->badge = $menu->status==1? 'success':'danger';
            $menu->badge_txt = $menu->status==1? 'Active':'Close';
            $menu->sa_title = 'Message';
            $menu->sa_message = 'Menu Created Successfully';
            $menu->sa_icon = 'success';
            return $menu;

            Alert::toast('Menu saved successfully', 'success');
            return redirect('/menus');
        }else{
            return 'Access denied';
        }
    }

    public function update(Request $request){
        if ($request->post()){
            $menu = Menu::find($request->id);
            $menu->name = $request->name;
            $menu->position = $request->position;
            $menu->save();

            $menu = Menu::where('id',$request->id)->first(['id','name','position','status']);
            $menu->sl = $request->sl;
            $menu->arrow = $menu->status==1? 'up':'down';
            $menu->btn = $menu->status==1? 'success':'warning';
            $menu->badge = $menu->status==1? 'success':'danger';
            $menu->badge_txt = $menu->status==1? 'Active':'Close';
            $menu->sa_title = 'Message';
            $menu->sa_message = 'Menu Updated Successfully';
            $menu->sa_icon = 'success';
            return $menu;
        }
    }

    public function statusUpdate(Request $request){
        if ($request->ajax()){
            $menu = Menu::find($request->id);
            $menu->status == 1 ? $menu->status = 2 : $menu->status = 1;
            $menu->save();

            $menu = Menu::where('id',$request->id)->first(['id','name','position','status']);
            $menu->sl = $request->sl;
            $menu->arrow = $menu->status==1? 'up':'down';
            $menu->btn = $menu->status==1? 'success':'warning';
            $menu->badge = $menu->status==1? 'success':'danger';
            $menu->badge_txt = $menu->status==1? 'Active':'Close';
            $menu->sa_title = 'Message';
            $menu->sa_message = 'Menu Status Updated';
            $menu->sa_icon = 'success';
            return $menu;
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            $menu = Menu::find($request->id);
            $menu->status = 3;
            $menu->save();

            return response()->json([
                'success'=>true,
                'sa_title'=>'Message',
                'sa_message'=>'Menu Deleted Successfully',
                'sa_icon'=>'success'
            ]);
        }
    }
}
