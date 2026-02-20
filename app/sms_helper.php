<?php

function mobileNumberFilter($number){
    $digits = str_split($number,1);

    if(count($digits)<11){return false;}

    $filtered = '';
    foreach ($digits as $d){
        if ($d == '0' or $d == '1' or $d == '2' or $d == '3' or $d == '4' or $d == '5' or $d == '6' or $d == '7' or $d == '8' or $d == '9'){
            $filtered .= "$d";
        }
    }
    $countryCode = '88';
    if (strlen($filtered)==11){$filtered = $countryCode.$filtered;}
    return $filtered;
}

function messageParameterSet($sid,$user,$pass,$mobile,$message){
    if (siteInfo('sms_provider')=='bulksmsbd') {
        $param = ['api_key'=>$pass, 'senderid'=>$sid, 'number'=>$mobile, 'message'=>$message,];

//        $param= array('username'=>$user, 'password'=>$pass, 'number'=>"$mobile", 'message'=>$message);
    }elseif (siteInfo('sms_provider')=='ssdtech'){
        $param="masking=$sid&userName=$user&password=$pass&MsgType=TEXT&receiver=$mobile&message=$message";
    }
    return $param;
}

function sendMessage($url,$param){
    if (siteInfo('sms_provider')=='bulksmsbd'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, TRUE);

//        return $data;

        if ($data['response_code'] == '202'){$status = true;}
        else {$status = false;}
        return $status;

    }elseif (siteInfo('sms_provider')=='ssdtech'){
        $crl = curl_init();
        curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($crl,CURLOPT_URL,$url);
        curl_setopt($crl,CURLOPT_HEADER,0);
        curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($crl,CURLOPT_POST,1);
        curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
        $response = curl_exec($crl);
        curl_close($crl);

        $data = json_decode($response, TRUE);
        $status = $data[0]['success'];
        return $status;
    }
}

function messageRecord($message,$mobile,$status){
    $smsRecord = new App\Models\SMSRecord();
    $smsRecord->sms_body = $message;
    $smsRecord->receiver_no = $mobile;
    if ($status){
        $smsRecord->status = 'Delivered';
    }
    $smsRecord->save();
    return true;
}

function singleMessageSend($mobile,$message,$type=null){
    $url  = siteInfo('sms_url');
    $sid  = siteInfo('sms_sid');
    $user = siteInfo('sms_user');
    $pass = siteInfo('sms_pw');
    $param = messageParameterSet($sid,$user,$pass,$mobile,$message);

    $status = sendMessage($url,$param);
    if ($type==null){
        $record = messageRecord($message,$mobile,$status);
    }
    return $status;
}

function multipleMessageSend($url,$sid,$user,$pass,$mobile,$message){
    $param = messageParameterSet($sid,$user,$pass,$mobile,$message);
    $status = sendMessage($url,$param);
    $record = messageRecord($message,$mobile,$status);
    return $status;
}
