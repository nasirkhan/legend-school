<?php

namespace App\Http\Controllers;

use App\Models\OtherAttendance;
use App\Models\Paper;
use App\Models\SMSRecord;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SMSController extends Controller
{
    public function index($from){
        if ($from=='new'){
            return view('backend.message.new-message-form');
        }elseif ($from=='sent'){
            return view('backend.message.sent-message-form');
        }elseif ($from=='unsent'){
            return view('backend.message.unsent-message-form');
        }elseif ($from=='password'){
            return view('backend.message.password-form',[
                'students'=>[]
            ]);
        }
    }

    public function sendPasswordToMother(Request $request){
        if (isset($request->student_id)){
            foreach ($request->student_id as $id => $password){
                $student = Student::where(['roll'=>$id])->first();
                $link = route('student-login-form');
                $name = $student->name;
                $sender = siteInfo('sender_name');
                $message = "Dear parents,\nPlease login through link below\n{$link}\nto check your child {$name}'s academic history.\nStudent ID: {$student->roll}\nPassword: {$password}\n$sender";
                singleMessageSend($student->mother_mobile,$message);
            }

            Alert::success('Success','Password sent successfully');
            return back();
        }else{
            Alert::error('Error','No student selected');
            return back();
        }
    }

    public function form(Request $request){
        if ($request->ajax()){
            if ($request->sms_type=='result'){
                $request->batch_id = 'all';
                $students = classAndBatchWiseStudents($request);
                $attendances = OtherAttendance::where(['table'=>'Exam', 'row_id'=>$request->exam_id])->get();
                $papers = Paper::where(['exam_id'=>$request->exam_id,'status'=>1])->get();
                return view('backend.message.result-table',['students'=>$students, 'attendances'=>$attendances ,'data'=>$request, 'papers'=>$papers]);
            }elseif ($request->sms_type=='attendance'){
                $request->batch_id = 'all';
                $students = classAndBatchWiseStudents($request);
            }elseif ($request->sms_type=='custom'){
                $students = classAndBatchWiseStudents($request);
            }
        }
    }

    public function sendMessage(Request $request){
        return $request->all();
    }

    public function unsentMessage(){
        return view('backend.sms.manage',[
            'messages'=>SMSRecord::where(['status'=>null])->get()->sortByDesc('id')
        ]);
    }

    public function smsResend(Request $request){
        $record =  SMSRecord::find($request->id);
        $status = singleMessageSend(mobileNumberFilter($record->receiver_no),$record->sms_body,'resend');
        if ($status){
            $record->status = 'Delivered';
            $record->save();
            Alert::toast('Message sent successfully.','success');
            return back();
        }else{
            Alert::toast('Message sending failed','info');
            return back();
        }
    }

    public function groupSMS(){
        return view('backend.sms.group-message-form');
    }

    public function groupSMSSend(Request $request){
        $this->validate($request,[
            'receivers'=>'required',
            'sms_body'=>'required',
        ]);
        $receivers = $request->receivers;
        $message = $request->sms_body;
        $numbers = (explode(",",$receivers));
        if (count($numbers)<1){
            Alert::toast('Receiver number invalid','error');
            return back();
        }else{
            $url  = siteInfo('sms_url');
            $sid  = siteInfo('sms_sid');
            $user = siteInfo('sms_user');
            $pass = siteInfo('sms_pw');

            foreach ($numbers as $number){
                $mobile = mobileNumberFilter($number);
                $param = messageParameterSet($sid,$user,$pass,$mobile,$message);
                $status = sendMessage($url,$param);
                $record = messageRecord($message,$mobile,$status);
            }

            Alert::toast('Message sent successful','success');
            return back();
        }
    }
}
