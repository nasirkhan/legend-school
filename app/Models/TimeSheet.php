<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimeSheet extends Model
{
    use HasFactory;

    public static function getDatesBetween($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public static function getWorkingDates($startDate, $endDate, $holidays = [])
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];

        foreach ($period as $date) {

            // Skip Friday (5) and Saturday (6)
            if (in_array($date->dayOfWeek, [5, 6])) {
                continue;
            }

            // Skip holidays
            if (in_array($date->format('Y-m-d'), $holidays)) {
                continue;
            }

            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public static function getAttendanceReport($startDate, $endDate, $studentId)
    {
        return DB::table('time_sheets')
            ->select(
                'student_id',
                DB::raw('DATE(punched_at) as punch_date'),
                DB::raw('MIN(punched_at) as first_punch')
            )
            ->whereBetween('punched_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ])
            ->where('student_id', '=', $studentId)
            ->groupBy('student_id', DB::raw('DATE(punched_at)'))
            ->orderBy('student_id')
            ->orderBy('punch_date')
            ->get();
    }
}
