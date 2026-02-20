<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('backend.home.view');
    }

    public function users(){
        if (role()->code=='developer'){
            $users = User::with([
                'role'=>function($q){$q->select('id','name','code');}
            ])->get(['id','name','email','mobile','role_id']);
            return view('backend.users.list',compact('users'));
        }else{
            abort('404');
        }
    }
}
