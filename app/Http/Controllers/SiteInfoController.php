<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SiteInfoController extends Controller
{
    public $properties = [
        ['property'=>'name', 'value'=>'Company Name','type'=>'text'],
        ['property'=>'short_name', 'value'=>'Short Name','type'=>'text'],
        ['property'=>'title', 'value'=>'Site Title','type'=>'text'],
        ['property'=>'tag_line','value'=>'Tag Line','type'=>'text'],
        ['property'=>'logo','value'=>'assets/images/logo.png','type'=>'file'],
        ['property'=>'small_logo','value'=>'assets/images/small_logo.png','type'=>'file'],
        ['property'=>'favicon','value'=>'assets/images/favicon.png','type'=>'file'],
        ['property'=>'bKash','value'=>'01722454519','type'=>'text'],
        ['property'=>'Nagad','value'=>'01722454519','type'=>'text'],
        ['property'=>'Rocket','value'=>'01722454519','type'=>'text'],
        ['property'=>'powered_text','value'=>'FZIT Solution','type'=>'text'],
        ['property'=>'powered_link','value'=>'https://www.dev-with-imran.com','type'=>'text'],
        ['property'=>'powered_mobile','value'=>'01303-321259','type'=>'text'],
        ['property'=>'initial_cash','value'=>'0','type'=>'number'],
        ['property'=>'sms_url','value'=>'http://66.45.237.70/api.php','type'=>'text'],
        ['property'=>'sms_user','value'=>'01303321259','type'=>'text'],
        ['property'=>'sms_pw','value'=>'8FG4N39X','type'=>'text'],
        ['property'=>'sms_sid','value'=>'-','type'=>'text'],
        ['property'=>'sms_provider','value'=>'bulksmsbd','type'=>'text'],
        ['property'=>'sender_name', 'value'=>'Momin Chem','type'=>'text'],
        ['property'=>'domain', 'value'=>'https://','type'=>'text'],
        ['property'=>'language','value'=>'english','type'=>'text'],
        ['property'=>'address','value'=>'4/9-Block-F,Lalmatia,Dhaka-1207','type'=>'text'],
        ['property'=>'mobile','value'=>'01722-454519','type'=>'text'],
        ['property'=>'email','value'=>'info@legend.edu.bd','type'=>'text'],
        ['property'=>'active_hour','value'=>'9:00am to 5:00pm','type'=>'text'],
        ['property'=>'principal_signature','value'=>'','type'=>'file'],
        ['property'=>'vp_signature','value'=>'','type'=>'file'],
        ['property'=>'running_year','value'=>'2024','type'=>'text'],
        ['property'=>'invoice_signatory','value'=>'-','type'=>'text'],
        ['property'=>'daily_fine','value'=>'50','type'=>'number'],
        ['property'=>'sub_hour','value'=>'2','type'=>'number'],
        ['property'=>'current_session','value'=>'2025','type'=>'number'],
        ['property'=>'home_about','value'=>'','type'=>'textarea'],
        ['property'=>'home_about_photo','value'=>'','type'=>'file'],
        ['property'=>'total_student','value'=>'565','type'=>'number'],
        ['property'=>'total_teacher','value'=>'43','type'=>'number'],
        ['property'=>'total_staff','value'=>'15','type'=>'number'],
        ['property'=>'facebook','value'=>'https://facebook.com','type'=>'text'],
        ['property'=>'google','value'=>'https://google.com','type'=>'text'],
        ['property'=>'twitter','value'=>'https://twitter.com','type'=>'text'],
        ['property'=>'pinterest','value'=>'https://pinterest.com','type'=>'text'],
        ['property'=>'linkedin','value'=>'https://linkedin.com','type'=>'text'],
        ['property'=>'instagram','value'=>'https://instagram.com','type'=>'text'],
        ['property'=>'youtube','value'=>'https://youtube.com','type'=>'text'],
        ['property'=>'student_enrolled','value'=>'2500','type'=>'number'],
        ['property'=>'best_award_won','value'=>'12','type'=>'number'],
        ['property'=>'graduation_completed','value'=>'570','type'=>'number'],
        ['property'=>'total_faculty','value'=>'35','type'=>'number'],
    ];

    public function __construct(){
        foreach ($this->properties as $property){
            $checked = SiteInfo::where('property','=',$property['property'])->first();
            if (!isset($checked)){
                $siteInfo = new SiteInfo();
                $siteInfo->property  = $property['property'];
                $siteInfo->value     = $property['value'];
                $siteInfo->type      = $property['type'];
                $siteInfo->save();
            }
        }
    }

    public function index(){
        return view('backend.site-info.manage',[
            'siteInfos'=>SiteInfo::all()
        ]);
    }

    public function edit(Request $request){
        return view('backend.site-info.edit-form',[
            'info'=>SiteInfo::find($request->id)
        ]);
    }

    public function update(Request $request){
        if ($request->post()){




            $info = SiteInfo::find($request->id);
            if ($info->type=='file'){
                if (file_exists($info->value)){
                    unlink($info->value);
                }
                $info->value = fileUpload($request->file('value'),'images');
            }else{
                $info->value = $request->value;
            }
            $info->save();

            Alert::toast('Info Updated','success');
            return redirect('/site-info');
        }else{
            return 'Access denied';
        }
    }
}
