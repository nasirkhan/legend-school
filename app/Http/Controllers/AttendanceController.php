<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\OtherAttendance;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\TimeSheet;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index(Request $request){
        if ($request->from=='regular'){
            if ($request->type=='add'){return view('backend.students.attendances.regular.add-form',['students'=>[],'from'=>$request->from]);}
            elseif ($request->type=='view'){return view('backend.students.attendances.regular.view-form',['students'=>[],'from'=>$request->from]);}
            elseif ($request->type=='edit'){return view('backend.students.attendances.regular.edit-form',['students'=>[],'from'=>$request->from]);}
        }elseif ($request->from=='exam'){
            if ($request->type=='add'){return view('backend.students.attendances.exam.add-form',['students'=>[],'from'=>$request->from]);}
            elseif ($request->type=='view'){return view('backend.students.attendances.exam.view-form',['students'=>[],'from'=>$request->from]);}
            elseif ($request->type=='edit'){return view('backend.students.attendances.exam.edit-form',['students'=>[],'from'=>$request->from]);}
        }elseif ($request->from=='payment'){
            if ($request->type=='add'){return view('backend.students.attendances.payment.add-form',['students'=>[],'from'=>$request->from]);}
            elseif ($request->type=='view'){return view('backend.students.attendances.payment.view-form',['students'=>[],'from'=>$request->from]);}
        }
    }

    public function form(Request $request){
        if ($request->ajax()){
            if ($request->from=='regular'){
                if ($request->type=='add'){
                    $students = classAndBatchWiseStudents($request);
                    return view('backend.students.attendances.regular.add-table',['students'=>$students,'data'=>$request]);
                } elseif ($request->type=='view'){
                    $students = classAndBatchWiseStudents($request);
                    return view('backend.students.attendances.regular.report-table',['students'=>$students,'data'=>$request]);
                }
            }elseif ($request->from=='exam'){
                if ($request->type=='add'){
                    $students = classAndBatchWiseStudents($request);
                    return view('backend.students.attendances.exam.add-table',['students'=>$students,'data'=>$request]);
                } elseif ($request->type=='view'){
                    $attendances = OtherAttendance::where([
                        'table'=>'Exam', 'row_id'=>$request->exam_id, 'batch_id'=>$request->batch_id
                    ])->get();
                    $students = classAndBatchWiseStudents($request);
                    return view('backend.students.attendances.exam.report-table',['students'=>$students,'data'=>$request,'attendances'=>$attendances]);
                }
            }elseif ($request->from=='payment'){
                $students = classAndBatchWiseStudents($request);
                return view('backend.students.attendances.payment.add-table',['students'=>$students,'data'=>$request]);
            }
        }
    }

    public function store(Request $request){
        if ($request->post()){
            if (count($request->attendance)>0){
                if ($request->from=='exam'){
                    foreach ($request->attendance as $id => $value){
                        $attendance = examAttendanceCheck($request, $id);
                        if ($attendance != null){
                            $attendance->status = $value;
                            $attendance->creator_id = user()->id;
                            $attendance->save();
                        }else{
                            $attendance = new OtherAttendance();
                            $attendance->year = $request->year;
                            $attendance->session_id = $request->session_id;
                            $attendance->class_id = $request->class_id;
                            $attendance->batch_id = $request->batch_id;
                            $attendance->subject_id = $request->subject_id;
                            $attendance->student_id = $id;
                            $attendance->table = 'Exam';
                            $attendance->row_id = $request->exam_id;
                            $attendance->status = $value;
                            $attendance->creator_id = user()->id;
                            $attendance->save();
                        }
                    }
                    return response()->json(['success'=>true]);

                    Alert::toast('Attendance Submitted Successfully','success');
                    return back();
                }
                elseif($request->from=='regular'){
                    foreach ($request->attendance as $id => $value){
                            $attendance = attendanceCheck($request, $id);
                        if ($attendance != null){
                            $attendance->status = $value;
                            $attendance->creator_id = user()->id;
                            $attendance->save();
                        }else{
                            $attendance = new Attendance();
                            $attendance->year = $request->year;
                            $attendance->session_id = $request->session_id;
                            $attendance->class_id = $request->class_id;
                            $attendance->batch_id = $request->batch_id;
                            $attendance->subject_id = $request->subject_id;
                            $attendance->student_id = $id;
                            $attendance->date = $request->date;
                            $attendance->status = $value;
                            $attendance->creator_id = user()->id;
                            $attendance->save();
                        }
                    }
                    Alert::toast('Attendance Submitted Successfully','success');
                    return back();
                }
                elseif ($request->from=='payment'){
                    foreach ($request->attendance as $studentId => $months){
                        foreach ($months as $monthId => $value){
                            $attendance = paymentAttendanceCheck($request, $monthId,$studentId);
                            if ($attendance != null){
                                $attendance->status = $value;
                                $attendance->creator_id = user()->id;
                                $attendance->save();
                            }else{
                                $attendance = new OtherAttendance();
                                $attendance->year = $request->year;
                                $attendance->session_id = $request->session_id;
                                $attendance->class_id = $request->class_id;
                                $attendance->batch_id = $request->batch_id;
                                $attendance->student_id = $studentId;
                                $attendance->table = 'Month';
                                $attendance->row_id = $monthId;
                                $attendance->status = $value;
                                $attendance->creator_id = user()->id;
                                $attendance->save();
                            }
                        }
                    }
                    return response()->json(['success'=>true]);

                    Alert::toast('Attendance Submitted Successfully','success');
                    return back();
                }
            }else{
                Alert::toast('No student was selected !!!','info');
                return back();
            }
        }
    }

    public function detail(Request $request){
        if ($request->ajax()){
            $attendances = Attendance::where([
                'year'=>$request->year,
                'session_id'=>$request->session_id,
                'class_id'=>$request->class_id,
                'batch_id'=>$request->batch_id,
                'student_id'=>$request->student_id,
            ])->whereBetween('date',[$request->start,$request->end])->get();

            return view('backend.students.attendances.modal.report-table',[
                'attendances'=>$attendances,
                'student'=>Student::with('school','classInfo','batch','session','photo')->find($request->student_id)
            ]);
        }
    }

    //Biometric Attendance Report
    public function attendanceReport(Request $request){

        return view('backend.students.attendances.biometric.view-form');

        return view('backend.students.attendances.biometric.report');

        if (!$request->year){
            $request->year = siteInfo('current_session');
        }



        if (Session::get('year')){Session::forget('year');Session::put('year',$request->year);}
        else{Session::put('year',$request->year);}

        $year = Session::get('year');

        $classStudents = StudentClass::with([
            'student'=>function ($query) {$query->where('status','=',1)->select('id','name','roll','mother_mobile');}
        ])
            ->where(['status'=>1,'year'=>$year])
            ->get(['id','student_id','class_id','year'])
            ->sortBy('class_id');
        return $classStudents;
    }

    public function biometricAttendanceReport(Request $request){
        $classStudents = StudentClass::with([
            'student'=>function ($query) {$query->where('status','=',1)->select('id','name','roll','mother_mobile');}
        ])->where([
            'year'=>$request->year,
            'class_id'=>$request->class_id,
            'status'=>1
        ])->get(['id','student_id','class_id','year'])->sortBy('student_id');

        foreach ($classStudents as $classStudent){
            $punches = TimeSheet::where([
                'student_id'=>$classStudent->student->roll,
            ])->whereBetween('punched_at',[$request->from.' 00:00:00',$request->to.' 23:59:59'])->get(['punched_at','txt']);

            $classStudent->punches = count($punches)>0 ? $punches : [];
        }

        return view('backend.students.attendances.biometric.report',compact('classStudents'));
    }
}
