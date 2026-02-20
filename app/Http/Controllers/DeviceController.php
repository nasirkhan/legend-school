<?php

namespace App\Http\Controllers;

use App\Models\BioAttendance;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function receivePunch(Request $request)
    {
        $rawData = $request->getContent();
        $sn = $request->query('SN');  // Serial number of the device

        // Extract attendance lines
        if (str_contains($rawData, 'UserID=')) {
            $lines = explode("\n", $rawData);
            foreach ($lines as $line) {
                if (str_contains($line, 'UserID=')) {
                    preg_match('/UserID=(\d+)\s+Verify=(\d+)\s+AttState=(\d+)\s+Time=([\d-]+\s[\d:]+)/', $line, $matches);
                    if ($matches) {
                        BioAttendance::create([
                            'device_sn' => $sn,
                            'user_id' => $matches[1],
                            'verify_mode' => $matches[2],
                            'att_state' => $matches[3],
                            'timestamp' => $matches[4],
                        ]);
                    }
                }
            }
        }

        // Always respond with OK so the device knows it succeeded
        return response('OK', 200);
    }
}
