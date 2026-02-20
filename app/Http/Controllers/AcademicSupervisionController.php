<?php

namespace App\Http\Controllers;

use App\Models\ClassPerformance;
use App\Models\ClassWork;
use App\Models\HW;
use App\Models\SubjectClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AcademicSupervisionController extends Controller
{

    public function dailyAcademicReport(Request $request){
        if ($request->section_id){Session::forget('section_id'); Session::put('section_id',$request->section_id);}
        if ($request->class_id){Session::forget('class_id'); Session::put('class_id',$request->class_id);}
        if ($request->date){Session::forget('date'); Session::put('date',$request->date);}

        $sectionId = Session::get('section_id');
        $classId = Session::get('class_id');
        $date = Session::get('date');

        $performances = ClassPerformance::where([
            'class_id'=>$classId,
            'date'=>$date
        ])->get()->groupBy('subject_id');

        return view('backend.academic-supervision.daily-academic-report',[]);
    }

    public function getDailyAcademicReport(Request $request){
        if ($request->ajax()){
            $classSubjects = SubjectClass::with([
                'subject'=>function($query){$query->select('id','name');}
            ])->where([
                'class_id'=>$request->class_id,
                'status'=>1
            ])->orderBy('sub_code')->get(['id','subject_id','sub_code']);

            foreach ($classSubjects as $classSubject){
                $performance = ClassPerformance::with([
                    'teacher'=>function($query){$query->select('id','name');},
                ])->where([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$classSubject->subject_id,
                    'date'=>$request->date
                ])->first();

                if (isset($performance)){$classSubject->performance = $performance;}
                else{$classSubject->performance = null;}

                $cw = ClassWork::where([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$classSubject->subject_id,
                    'date'=>$request->date
                ])->first();

                if (isset($cw)){$classSubject->cw = $cw;}
                else{$classSubject->cw = null;}

                $hw = HW::where([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$classSubject->subject_id,
                    'assignment_date'=>$request->date
                ])->first();

                if (isset($hw)){$classSubject->hw = $hw;}
                else{$classSubject->hw = null;}
            }

            return view('backend.academic-supervision.daily-report-table',['classSubjects'=>$classSubjects]);
        }
    }
    public function dateWiseAcademicReport(Request $request){

    }
}
