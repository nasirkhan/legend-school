<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TimeSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZktecoController extends Controller
{
    private $request;

    public function index(Request $request){
        $this->request = $request;

        // Handshake with the device
        if($this->hasSerialNumber()) {
            return $this->proceed();
        }

        //Log for another operation, just pass it
        if($this->hasOperlog()) {
            return $this->proceed();
        }

        //Attendance Log
        if($this->hasAttlog()) {
            $attendanceLogs = $this->parseAttLog($this->getDeviceAttLog());
            foreach ($attendanceLogs as $log) {
                $this->operation($log);
            }
            return $this->proceed();
        }
    }

    private function operation($log){
        //Catch Data from Device Log
        $studentId = $log['user_id'];
        $punchedAt = $log['timestamp'];

        $punchedAt = Carbon::parse($punchedAt)->subHours(siteInfo('sub_hour'));

        //Do additional Operation like; Check into the database and send Message
        $student = Student::where(['roll'=>$studentId])->first();
        if (isset($student) and !empty($student)){
            $punches = TimeSheet::where(['student_id'=>$studentId,])
                ->whereDate('punched_at',Carbon::today())
                ->get();

            $studentStatus = '';
            if (count($punches)>0 and count($punches) % 2 == 1){$studentStatus = 'left';}
            else{$studentStatus = 'entered';}

            //Insert Punch Information Into Database
            DB::table('time_sheets')->insert([
                'student_id' => $studentId,
                'punched_at' => $punchedAt,
                'txt'=>$studentStatus
            ]);

            $mobile = ($student->mother_mobile != null ? $student->mother_mobile : $student->father_mobile);

            if ($mobile == null or $mobile == '' or $mobile == ' '){
//                return 0;
                return response("OK", 200);
            }

            $mobile = mobileNumberFilter($mobile);

            if ($mobile === false){return response("OK", 200);}

            // $mobile = mobileNumberFilter('01303321259');
            $name = $student->name;
            // $name = 'Muhammad Imran';
            $sender = siteInfo('sender_name');
            $message = "Dear parents,\nyour child $name $studentStatus the school at $punchedAt\n$sender";
            return $status = singleMessageSend($mobile,$message);
        }
        return response("OK", 200);
    }

    private function hasSerialNumber(){
        $query = $this->request->query();
        if($this->request->getMethod() == 'GET' && isset($query['SN'])){
            return $query['SN'];
        }
        return false;
    }

    private function getSerialNumber(){
        $query = $this->request->query();
        if(isset($query['SN'])){
            return $query['SN'];
        }
        return null;
    }

    private function hasAttlog(){
        $query = $this->request->query();
        if($this->request->getMethod() == 'POST' && isset($query['table']) && $query['table'] == 'ATTLOG'){
            return true;
        }
        return false;
    }

    private function hasOperlog(){
        $query = $this->request->query();
        if($this->request->getMethod() == 'POST' && isset($query['table']) && $query['table'] == 'OPERLOG') {
            return true;
        }
        return false;
    }

    private function getDeviceAttLog(){
        return $this->request->getContent();
    }

    /**
     * Parse attendance log from raw body
     *
     * @return array
     */
    private function parseAttLog($raw){
        $log = [];
        $rows = explode("\n", trim($raw));
        foreach($rows as $row) {
            // split columns by tab and whitespace
            $cols = preg_split("/[\t\s]+/", $row);
            array_push($log, ['user_id' => $cols[0], 'date' => $cols[1], 'time' => $cols[2], 'timestamp' => $cols[1] . ' ' . $cols[2]]);
        }
        return $log;
    }

    private function proceed(){
        return response("OK", 200);
    }

    //To Check SMS Balance Bulk-SMS-BD
    public function get_balance() {
        $url = "http://bulksmsbd.net/api/getBalanceApi";
//        $api_key = siteInfo('sms_password');
        $api_key = siteInfo('sms_pw');

//        return $api_key;

        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response,TRUE);
        if ($data['response_code'] == '202') {
            return 'Your SMS Balance is '.$data['balance'].' BDT';
        }else{
            return $data;
        }

    }

    public function test(){
        $studentId = 2500136;
        $punchedAt = '2026-01-25 12:22:00';

        $punchedAt = Carbon::parse($punchedAt)->subHours(siteInfo('sub_hour'));

        //Do additional Operation like; Check into the database and send Message
        $student = Student::where(['roll'=>$studentId])->first();
        if (isset($student) and !empty($student)){
            $punches = TimeSheet::where(['student_id'=>$studentId,])
                ->whereDate('punched_at',Carbon::today())
                ->get();

            $studentStatus = '';
            if (count($punches)>0 and count($punches) % 2 == 1){$studentStatus = 'left';}
            else{$studentStatus = 'entered';}

            //Insert Punch Information Into Database
            DB::table('time_sheets')->insert([
                'student_id' => $studentId,
                'punched_at' => $punchedAt,
                'txt'=>$studentStatus
            ]);

            $mobile = ($student->mother_mobile != null ? $student->mother_mobile : $student->father_mobile);

            if ($mobile == null or $mobile == '' or $mobile == ' '){
//                return 0;
                return response("OK", 200);
            }

            $mobile = mobileNumberFilter($mobile);

            if ($mobile === false){return response("OK", 200);}

            // $mobile = mobileNumberFilter('01303321259');
            $name = $student->name;
            // $name = 'Muhammad Imran';
            $sender = siteInfo('sender_name');
            $message = "Dear parents,\nyour child $name $studentStatus the school at $punchedAt\n$sender";
            return $status = singleMessageSend($mobile,$message);
        }
    }
}

