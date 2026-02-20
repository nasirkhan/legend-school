<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\LatestNews;
use App\Models\Page;
use App\Models\PopularClass;
use App\Models\SubPage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FrontEndController extends Controller
{
    public function index(){
        $images = GalleryImage::where('status',1)->take(6)->latest()->get();

        $popularECAs = PopularClass::where([
            'status'=>1,
            'front_page_status'=>1,
        ])->take(3)->get(['id','title','content','thumbnail','updated_at'])->sortBy('sl');

        $latestNews = LatestNews::where([
            'status'=>1,
            'front_page_status'=>1,
        ])->take(3)->latest()->get(['id','author','title','content','thumbnail','updated_at']);

        return view('front.kinter.home.home',['images'=>$images,'popularECAs'=>$popularECAs,'latestNews'=>$latestNews]);
        return view('front.home.home');
    }

    public function principalSpeech(){
        return view('front.about.principal-speech');
    }

    public function missionVision(){
        return view('front.about.mission-vision');
    }

    public function page($id){
        $page = Page::with('menu')->find($id);
//        return $page;
        if (isset($page) and $page->status==1){
//            return 'Hello';
            return view('front.kinter.pages.page',['page'=>$page]);
//            return view('front.pages.page',['page'=>$page]);
        }else{
//            return 'Hi';
            Alert::tosat('error','Page not found !!!');
            return back();
        }
    }

    public function popularECA($id){
        $eca = PopularClass::find($id);

        if (isset($eca) and $eca->status==1){
            return view('front.kinter.pages.popular-eca',['eca'=>$eca]);
        }else{
            abort(404);
        }
    }

    public function allPopularECA(){
        $ecas = PopularClass::where([
            'status'=>1
        ])->get(['id','title','content','thumbnail','updated_at'])->sortBy('sl');
        return view('front.kinter.pages.all-popular-ecas',['ecas'=>$ecas]);
    }

    public function blog($id){
        $blog = LatestNews::find($id);
        if (isset($blog) and $blog->status==1){
            return view('front.kinter.pages.blog',['blog'=>$blog]);
        }else{
            abort(404);
        }
    }

    public function blogs(){
        $blogs = LatestNews::where('status',1)->get(['id','title','thumbnail','author','content','updated_at'])->sortByDesc('id');

        return view('front.kinter.pages.blogs',['blogs'=>$blogs]);
    }

    public function subPage($id){
        $page = SubPage::with('mainPage')->find($id);
        if (isset($page) and $page->status==1){
            return view('front.kinter.pages.sub-page',['page'=>$page]);
//            return view('front.pages.sub-page',['page'=>$page]);
        }else{
            Alert::tosat('error','Page not found !!!');
            return back();
        }
    }



    public function photoGallery(){
        $images = GalleryImage::where('status',1)->get()->sortByDesc('id');
        return view('front.kinter.pages.photo-gallery',['images'=>$images]);
//        return view('front.pages.photo-gallery',['images'=>$images]);
    }

    public function contactUs(){
        return view('front.kinter.pages.contact-page');
//        return view('front.pages.contact-page');
    }
}
