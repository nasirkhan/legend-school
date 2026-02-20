<?php

use App\Models\Attendance;
use App\Models\ClassName;
use App\Models\ClassSchedule;
use App\Models\ECAActivity;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\OtherAttendance;
use App\Models\Month;
use App\Models\Payment;
use App\Models\PredictedGrade;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentMonthlyFee;
use App\Models\Result;
use App\Models\SubjectClass;
use App\Models\Syllabus;
use App\Models\TranscriptMark;
use App\Models\Year;
use App\Models\AcademicSession;
use App\Models\Section;
use Illuminate\Support\Str;

function classes(){
    return ClassName::where('status','!=',3)->get();
}

function activeAllClasses(){
    return ClassName::where('status','=',1)->get();
}

function activeClasses(){
    $sectionId = Session::get('section_id');
    $classes = [];
    if (isset($sectionId)){
        return ClassName::where([
            'section_id'=>$sectionId,
            'status'=>1
        ])->get();
    }

    return $classes;
}

function deletedClasses(){
    return ClassName::with('batches')->where('status','=',3)->get();
}

function schools(){
    return School::where('status','!=',3)->get();
}

function activeSchools(){
    return School::where('status','=',1)->get();
}

function deletedSchools(){
    return School::where('status','=',3)->get();
}

function addPassword($id){
    $idLength = strlen("$id");
    $stringLength = 6 - $idLength;
    $string = Str::upper(Str::random($stringLength)) ;
    $password = $string.$id;
    $participant = Student::find($id);
    $participant->password = $password;
    $participant->save();
    return $password;
}

function addRollNo($studentId){
    $students = App\Models\Student::where('creator_id','!=',null)->get(['id']);
    $no = count($students); $sl = '';

    if ($no<10){$sl = '0000'.$no;}
    elseif ($no<100){$sl = '000'.$no;}
    elseif ($no<1000){$sl = '00'.$no;}
    elseif ($no<10000){$sl = '0'.$no;}
    else{$sl = $no;}

    $year = date('y');

    return $year.$sl;
}

function years(){
    return Year::where('status','!=',3)->get();
}

function activeYears(){
    return Year::where('status','=',1)->get()->sortByDesc('year');
}

function sessions(){
    return AcademicSession::where('status','!=',3)->get();
}

function activeSessions(){
    return AcademicSession::where('status','=',1)->get();
}

function activeSections(){
    return Section::where('status','=',1)->get();
}

function activeDays()
{
    return App\Models\Day::where('status',1)->get(['id','name','code']);
}

function sectionWisePeriod($sectionId)
{
    return App\Models\Period::where([
        'section_id'=>$sectionId,
        'status'=>1
    ])->get(['id','name','code','start','end']);
}

function teacherRoutineCheck($teacherId,$classId){
    return App\Models\ClassSchedule::where(['teacher_id'=>$teacherId, 'class_id'=>$classId,'year'=>siteInfo('running_year')])
        ->get(['id']);
}

function teacherSchedule($teacherId,$dayId,$periodId){
    return App\Models\ClassSchedule::with(['className','subject'])
        ->where(['teacher_id'=>$teacherId, 'day_id'=>$dayId, 'period_id'=>$periodId, 'year'=>siteInfo('running_year')])
        ->first();
}

function teacherClass($year,$teacherId)
{
    $schedules = ClassSchedule::with('className')->where(['year'=>$year, 'teacher_id'=>$teacherId, 'status'=>1])
        ->get()->groupBy('class_id');

    $classes = [];
    foreach ($schedules as $classId => $schedule){
        $classes[$classId] = $schedule[0]->className;
    }
    return $classes;
}

function teacherClassSubject($year,$teacherId,$classId)
{
    $schedules = ClassSchedule::with('subject')->where(['year'=>$year, 'teacher_id'=>$teacherId, 'class_id'=>$classId, 'status'=>1])
        ->get()->groupBy('subject_id');

    $subjects = [];
    foreach ($schedules as $subjectId => $schedule){
        $subjects[$subjectId] = $schedule[0]->subject;
    }

    return $subjects;
}

function teacherClassSubjectHWs($year,$classId,$subjectId){
    return App\Models\HW::where(['year'=>$year, 'class_id'=>$classId, 'subject_id'=>$subjectId,'status'=>1])->get();
}

function teacherAndClassWiseSubjects($year,$classId,$teacherId){
    return App\Models\TeacherClassSubject::with([
        'subject'=>function($query){$query->select(['id','name']);},
    ])->where(['year'=>$year, 'class_id'=>$classId, 'teacher_id'=>$teacherId,'status'=>1])->get();
}



function activeSubjects($clsId=null){
    $classId = Session::get('class_id');
    if ($clsId!=null){
        $classId = $clsId;
    }

    if (isset($classId)){
        $class = ClassName::with([
            'classSubjects'=>function($query){$query->where('subjects.status','=',1)->select(['subjects.status','name','sub_code','subject_id','class_id'])->orderBy('sub_code');}
        ])->find($classId);

        $classWiseSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name']);}
        ])->where(['class_id'=>$classId,'status'=>1])->orderBy('sub_code')->get(['id','class_id','subject_id','sub_code','status']);

//        $classWiseSubjects = App\Models\SubjectClass::with([
//            'subject'=>function($query){$query->select(['id','name']);}
//        ])->where([
//            'class_id'=>$classId, 'status'=>1
//        ])->get(['id','class_id','subject_id','sub_code','status']);

        return $class->classSubjects;
    }else{
        return [];
    }
}

function activeExams(){
    $year = Session::get('year');
    $sectionId = Session::get('section_id');
    $classId = Session::get('class_id');
    if (isset($year) and isset($sectionId) and isset($classId)){
        return App\Models\Exam::where([
            'year'=>$year,
            'section_id'=>$sectionId,
            'class_id'=>$classId,
        ])->where('status','!=',3)->get(['id','name']);
    }else{
        return [];
    }
}

function homeWorks($year, $classId, $subjectId){
    return App\Models\HW::with('subject')->where([
        'year'=>$year,
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
    ])->where('status','!=',3)->get()->sortByDesc('id');
}

function classWorks( $year, $teacherId, $classId, $subjectId){
    return App\Models\ClassWork::with('subject')->where([
        'year'=>$year,
        'teacher_id'=>$teacherId,
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
    ])->where('status','!=',3)->get()->sortByDesc('id');
}

function syllabusForTeacher($year, $teacherId, $classId, $subjectId){
    $syllabi = Syllabus::with([
        'exam'=>function($query){$query->with([
            'classInfo'=>function($query){$query->select(['id','name']);}
        ])->select(['id','year','class_id','name','code']);},
        'subject'=>function($query){$query->select(['id','name']);}
    ])->where([
        'subject_id'=>$subjectId,
    ])->latest()->get(['id','exam_id','subject_id','exam_date','syllabus_detail','attachment_url','creator','updater','status']);

    $result = [];

    foreach ($syllabi as $syllabus){
        $item = [];
        if ($year == $syllabus->exam->year and $classId == $syllabus->exam->class_id){
            $item['id'] = $syllabus->id;
            $item['subject'] = $syllabus->subject->name;
            $item['class'] = $syllabus->exam->classInfo->name;
            $item['exam'] = $syllabus->exam->name;
            $item['syllabus'] = $syllabus->syllabus_detail;
            $item['rw'] = $syllabus->attachment_url;
            $item['creator'] = $syllabus->creator;
            $item['updater'] = $syllabus->updater;
            $item['status'] = $syllabus->status;

            array_push($result,$item);
        }
    }

    return $result;
}

function studentHomeWorks($year, $classId, $subjectId){
    return App\Models\HW::where([
        'year'=>$year,
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
    ])->where('status','=',1)->get()->sortByDesc('id');
}



function schoolWiseStudents($request){
    if ($request->class_id=='all'){
        return Student::with('school','classInfo','batch','session','photo')->where([
            'year'=>$request->year,
            'session_id'=>$request->session_id,
            'school_id'=>$request->school_id,
            'status'=>1,
        ])->get();
    }else{
        return Student::with('school','classInfo','batch','session','photo')->where([
            'year'=>$request->year,
            'session_id'=>$request->session_id,
            'school_id'=>$request->school_id,
            'class_id'=>$request->class_id,
            'status'=>1,
        ])->get();
    }
}

function classAndBatchWiseStudents($request,$status=null){

    $students = [];

    if ($status!=null){
        if ($request->class_id=='all'){
            $classStudents = App\Models\StudentClass::with('student')->where([
                'year'=>$request->year,
//            'class_id'=>$request->class_id,
                'status'=>$status,
            ])->get();
        }else{
            $classStudents = App\Models\StudentClass::with('student')->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'status'=>$status,
            ])->get();
        }
    }else{
        if ($request->class_id=='all'){
            $classStudents = App\Models\StudentClass::with('student')->where([
                'year'=>$request->year,
//            'class_id'=>$request->class_id,
                'status'=>1,
            ])->get();
        }else{
            $classStudents = App\Models\StudentClass::with('student')->where([
                'year'=>$request->year,
                'class_id'=>$request->class_id,
                'status'=>1,
            ])->get();
        }
    }


    if (count($classStudents)>0){
        foreach ($classStudents as $classStudent){
            $students[$classStudent->student->roll] = $classStudent;
        }

        ksort($students);
        return $students;
    }else{
        return $students;
    }

//    return $classStudents;


//    return Student::with('classInfo','photo')->where([
//        'year'=>$request->year,
//        'session_id'=>$request->session_id,
//        'class_id'=>$request->class_id,
//        'batch_id'=>$request->batch_id,
//        'status'=>1,
//    ])->get();
}

function studentsForClassActivity($request){
    $class = ClassName::find($request->class_id);

    $students = [];

    $classStudents = App\Models\StudentClass::with('student')->where([
        'year'=>$request->year,
        'class_id'=>$request->class_id,
        'status'=>1,
    ])->get();

    if (count($classStudents)>0){
        if ($class->section_id==3){
            foreach ($classStudents as $classStudent){
                $subjectChecked = App\Models\StudentClassSubject::where([
                    'student_id'=>$classStudent->student_id,
                    'class_id'=>$classStudent->class_id,
                    'subject_id'=>$request->subject_id,
                ])->first();

                if ($subjectChecked){
                    $students[$classStudent->student->roll] = $classStudent;
                }
            }
        }else{
            foreach ($classStudents as $classStudent){
                $students[$classStudent->student->roll] = $classStudent;
            }
        }
        ksort($students);
        return $students;
    }else{
        return $students;
    }
}

function attendanceCheck($data,$id){
    $attendance = Attendance::where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
        'batch_id'=>$data->batch_id, //Section
        'subject_id'=>$data->subject_id,
        'student_id'=>$id,
        'date'=>$data->date
    ])->first();

    return isset($attendance)? $attendance : null;
}

function examAttendanceCheck($data,$id){
    $attendance = OtherAttendance::where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
        'batch_id'=>$data->batch_id,
        'subject_id'=>$data->subject_id,
        'table'=>'Exam',
        'row_id'=>$data->exam_id,
        'student_id'=>$id
    ])->first();

    return isset($attendance)? $attendance : null;
}

function paymentAttendanceCheck($data,$monthId,$studentId){
    $attendance = OtherAttendance::where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
//        'batch_id'=>$data->batch_id,
        'table'=>'Month',
        'row_id'=>$monthId,
        'student_id'=>$studentId
    ])->first();

    return isset($attendance)? $attendance : null;
}

function paymentCheck($data,$monthId,$studentId){
    $attendance = paymentAttendanceCheck($data,$monthId,$studentId);
    if (isset($attendance)){
        if ($attendance->status == 1){
            $payment = Payment::where([
                'year'=>$data->year,
                'session_id'=>$data->session_id,
                'class_id'=>$data->class_id,
                'student_id'=>$studentId,
                'month_id'=>$monthId
            ])->first();
            if (isset($payment)){return $payment->received;}
            else{
                return 'Due';
            }
        }else{
            return 'Leave';
        }
    }else{
        return 'N/A';
    }
}

function monthlyPaymentCheck($data,$monthId){
    return Payment::where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
        'batch_id'=>$data->batch_id,
        'month_id'=>$monthId
    ])->get();
}

function monthlyDueCheck($data,$monthId){
    $attendances = OtherAttendance::with('student')->where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
        'batch_id'=>$data->batch_id,
        'table'=>'Month',
        'row_id'=>$monthId,
        'status'=>1,
        'reference_id'=>null
    ])->get();

    $dueAmount = 0;
    foreach ($attendances as $attendance){
        $feeInfo = StudentMonthlyFee::where([
            'year'=>$attendance->year,
            'session_id'=>$attendance->session_id,
            'class_id'=>$attendance->class_id,
            'student_id'=>$attendance->student_id,
            'status'=>1,
        ])->first();

        if (isset($feeInfo)){
            $dueAmount += ($feeInfo->monthly_fee - $feeInfo->discount);
        }
    }
    return $dueAmount;
}

function paymentAttendances($student,$type){
    if ($type=='paid'){
        $attendances = OtherAttendance::with('month')->where([
            'year'=>$student->year,
            'session_id'=>$student->session_id,
            'class_id'=>$student->class_id,
            'batch_id'=>$student->batch_id,
            'student_id'=>$student->id,
            'table'=>'Month',
            'status'=>1,
        ])->where('reference_id','!=',null)->get();
    }else{
        $attendances = OtherAttendance::with('month')->where([
            'year'=>$student->year,
            'session_id'=>$student->session_id,
            'class_id'=>$student->class_id,
            'batch_id'=>$student->batch_id,
            'student_id'=>$student->id,
            'table'=>'Month',
            'status'=>1,
            'reference_id'=>null
        ])->get();
    }

    return $attendances;
}



function attendanceCount($data,$id,$status){
    $attendances = Attendance::where([
        'year'=>$data->year,
        'session_id'=>$data->session_id,
        'class_id'=>$data->class_id,
        'batch_id'=>$data->batch_id,
        'student_id'=>$id,
        'status'=>$status
    ])->whereBetween('date',[$data->start,$data->end])->get();

    return count($attendances);
}

function subjectCheck($studentId,$classId,$subjectId){
    $subject = App\Models\StudentClassSubject::where([
        'student_id'=>$studentId, 'class_id'=>$classId, 'subject_id'=>$subjectId
    ])->first();

    if (isset($subject)){return true;}
    else{return false;}
}

function exam($year,$classId,$userType=null){
    if ($userType=='student'){
        return App\Models\Exam::where([
            'year'=>$year,
            'class_id'=>$classId,
            'status'=>1,
            'show_student'=>1
        ])->get()->sortBy('id');
    }else{
        return App\Models\Exam::where([
            'year'=>$year,
            'class_id'=>$classId,
            'status'=>1
        ])->get()->sortBy('id');
    }
}

function examSchedule($year,$classId,$userType=null){
    return App\Models\Exam::where([
        'year'=>$year,
        'class_id'=>$classId,
        'status'=>1,
        'schedule_status'=>1
    ])->get()->sortBy('id');
}

function papersForCTReportCard($examId){
    $firstPaper = App\Models\Paper::where([
        'exam_id'=>$examId,
        'status'=>1
    ])->first();

    $totalMark = App\Models\Paper::where([
        'exam_id'=>$examId,
        'subject_id'=>$firstPaper->subject_id,
        'status'=>1
    ])->get()->sum('mark');

    $uniformMark = true;

    $allPapers = App\Models\Paper::where([
        'exam_id'=>$examId,
        'status'=>1
    ])->get()->groupBy('subject_id');

    foreach ($allPapers as $key => $paperGroup){
        if ($paperGroup->sum('mark') !== $totalMark){
            $uniformMark = false;
            break;
        }
    }

    if ($uniformMark){
        $papers = App\Models\Paper::where([
            'exam_id'=>$examId,
            'subject_id'=>$firstPaper->subject_id,
            'status'=>1
        ])->get()->sortBy('sl');

        return [
            'status'=>$uniformMark,
            'papers'=>$papers
        ];
    }else{
        return [
            'status'=>$uniformMark,
            'papers'=>[]
        ];
    }
}

function papers($examId,$subjectId,$studentId=null){
    $papers = App\Models\Paper::where([
        'exam_id'=>$examId,
        'subject_id'=>$subjectId,
        'status'=>1
    ])->get()->sortBy('sl');

    $modifiedPapers = clone $papers;

    $modifiedPapers->each(fn($item, $key) => $modifiedPapers->forget($key));

    if ($studentId !== null){

        foreach ($papers as $paper){
            $result = Result::where([
                'exam_id'=>$examId,
                'subject_id'=>$subjectId,
                'paper_id'=>$paper->id,
                'student_id'=>$studentId
            ])->first();

            if (isset($result) and $result->skippable == false){
                $id = $paper->id;
                $modifiedPapers[] = $paper;
            }
        }

        return $modifiedPapers;
    }

    if (count($papers)>0){
        return $papers;
    }else{
        return [];
    }
}

function resultCheck($data,$id){
    $result = Result::where([
        'student_id'=>$id,
        'exam_id'=>$data->exam_id,
        'subject_id'=>$data->subject_id,
        'paper_id'=>$data->paper_id,
    ])->latest()->first();

    return isset($result)? $result : null;
}

function pastResultCheck($examId, $subjectId, $studentId)
{
    return Result::where([
        'student_id'=>$studentId,
        'exam_id'=>$examId,
        'subject_id'=>$subjectId,
        'skippable'=>false
    ])->get();
}

function weightedResult($obtainedMark,$outOf,$weight)
{
    if ($outOf==0){
        return 0;
    }else{
        $weightedMark = ($obtainedMark/$outOf)*$weight;
        return round($weightedMark);
    }

}

//function topScore($examId,$subjectId){
//    $results = Result::where([
//        'exam_id'=>$examId,
//        'subject_id'=>$subjectId,
//    ])->get()->groupBy('student_id');
//
//    return count($results);
//}

function ecaActivity($studentId,$examId,$ecaItemId){
    $activity = ECAActivity::where([
        'student_id'=>$studentId,
        'exam_id'=>$examId,
        'eca_item_id'=>$ecaItemId
    ])->first();

    return isset($activity)? $activity : null;
}

//function resultCheck($studentId,$examId,$subjectId,$paperId){
//    $result = Result::where([
//        'student_id'=>$studentId,
//        'exam_id'=>$examId,
//        'subject_id'=>$subjectId,
//        'paper_id'=>$paperId
//    ])->first();
//
//    if (isset($result)){
//        return $result->mark;
//    }else{
//        return null;
//    }
//}


//function grade($averageMark){
//    if ($averageMark>=90){return 'A*';}
//    elseif ($averageMark<90 and $averageMark>=80){return 'A';}
//    elseif ($averageMark<80 and $averageMark>=70){return 'B';}
//    elseif ($averageMark<70 and $averageMark>=60){return 'C';}
//    elseif ($averageMark<60 and $averageMark>=50){return 'D';}
//    elseif ($averageMark<50 and $averageMark>=40){return 'E';}
//    else {return 'N/A';}
//}

function topScore($examId,$subjectId){
   $rawResults = Result::where(['exam_id'=>$examId,'subject_id'=>$subjectId])->get(['exam_id','subject_id','student_id','mark'])->groupBy('student_id');

   $results = [];

   foreach ($rawResults as $id => $rawResult){
       $result = ['exam_id'=>$examId, 'subject_id'=>$subjectId, 'student_id' =>$id, 'total'=>$rawResult->sum('mark')];
       array_push($results,$result);
   }
    array_multisort( array_column($results, "total"), SORT_DESC, $results );
//    $test = max(array_column($results, 'total'));
//   $top = $results[0];

   if (count($results)>0){
       return $results[0]['total'];
   }else{
       return 0;
   }

//   return $top;

   $student = Student::with('school','batch','photo')->where(['id'=>$top['student_id']])
       ->first(['name','nick_name','mobile','year','email','school_id','batch_id','photo_id']);
   $topResults = Result::with('paper')->where(['exam_id'=>$examId,'student_id'=>$top['student_id']])->get(['mark','paper_id']);

   return ['student'=>$student, 'results'=>$topResults];
}

function topScoreForTranscript($examId,$subjectId,$transcriptId,$skipIds){
    $transcript = App\Models\Transcript::with('rules')->find($transcriptId);

    $rawResults = Result::where(['exam_id'=>$examId,'subject_id'=>$subjectId])->get(['exam_id','subject_id','student_id','mark'])->groupBy('student_id');

    $results = [];

    foreach ($rawResults as $id => $rawResult){
        $pastTotalMark = 0;  $total = 0;

        foreach ($transcript->rules as $rule){
            $skip = false;
            foreach ($skipIds as $skipId){
                if ($skipId == $rule->exam_id){
                    $skip = true;
                    break;
                }
            }

            if (!$skip){
                $pastResults = Result::where(['exam_id'=>$rule->exam_id,'subject_id'=>$subjectId,'student_id'=>$id])
                    ->get(['exam_id','subject_id','student_id','mark']);
                $pastTotalMark += $pastResults->sum('mark');
            }
        }

        $total = $pastTotalMark + $rawResult->sum('mark');

        $result = ['exam_id'=>$examId, 'subject_id'=>$subjectId, 'student_id' =>$id, 'total'=>$total];
        array_push($results,$result);
    }
    array_multisort( array_column($results, "total"), SORT_DESC, $results );

    if (count($results)>0){
        return $results[0]['total'];
    }else{
        return 0;
    }
}

function studentTotalWeightWeightedMark($examId,$subjectId,$transcriptId,$studentId,$skipIds)
{
    $transcript = App\Models\Transcript::with('rules')->find($transcriptId);

    $rawResults = Result::where(['exam_id'=>$examId,'subject_id'=>$subjectId, 'student_id'=>$studentId])->get(['exam_id','subject_id','student_id','mark'])->groupBy('student_id');

    $results = [];

    foreach ($rawResults as $id => $rawResult){
        $pastTotalWeightedMark = 0;

        foreach ($transcript->rules as $rule){
            $skip = false;
            foreach ($skipIds as $skipId){
                if ($skipId == $rule->exam_id){
                    $skip = true;
                    break;
                }
            }

            if (!$skip){
                $pastResults = Result::where(['exam_id'=>$rule->exam_id,'subject_id'=>$subjectId,'student_id'=>$id, 'skippable'=>0])
                    ->get(['exam_id','subject_id','student_id','mark']);
                $pastObtainedMark = $pastResults->sum('mark');
                $pastExamMark = App\Models\Paper::where(['exam_id'=>$rule->exam_id,'subject_id'=>$subjectId,'status'=>1])->get()->sum('mark');
                $pastWeightedMark = weightedResult($pastObtainedMark,$pastExamMark,$rule->forward_mark);
                $pastTotalWeightedMark += $pastWeightedMark;
            }
        }

        $total = $pastTotalWeightedMark;

        $rawTotal = 0;
        foreach ($rawResult as $item){
            $paper = App\Models\Paper::where(['exam_id'=>$item->exam_id,'subject_id'=>$subjectId,'status'=>1])->latest()->first();
            $paperWeightedMark = weightedResult($item->mark,$paper->mark,$paper->weight);
            $rawTotal += $paperWeightedMark;
        }
        $rawResultWeightedMark = weightedResult($rawTotal,100,$transcript->forward_mark);

        $total += $rawResultWeightedMark;

        $result = ['exam_id'=>$examId, 'subject_id'=>$subjectId, 'student_id' =>$id, 'total'=>$total];
        array_push($results,$result);
    }
    array_multisort( array_column($results, "total"), SORT_DESC, $results );
    if (count($results)>0){
        return $results[0]['total'];
    }else{
        return 0;
    }
}

function weightedTopScoreForTranscript($examId,$subjectId,$transcriptId,$skipIds){

    $transcript = App\Models\Transcript::with('rules')->find($transcriptId);

    $currentExamResults = Result::where(['exam_id'=>$examId,'subject_id'=>$subjectId,'skippable'=>0])->get(['exam_id','subject_id','student_id','mark'])->groupBy('student_id');

    $results = [];

    foreach ($currentExamResults as $studentId =>$examResult){
        $studentWeightedTotalMark = 0;

        foreach ($transcript->rules as $rule){
            $pastPapersTotalMark = 0;

            $exam_id = $rule->exam_id;

            $forward_mark = $rule->forward_mark;

            $pastResults = Result::with([
                'paper'=>function ($query) {$query->where(['status'=>1]);}
            ])->where(['exam_id'=>$exam_id,'subject_id'=>$subjectId,'student_id'=>$studentId, 'skippable'=>0])
                ->get(['exam_id','subject_id','student_id','mark','paper_id']);

            foreach ($pastResults as $pastResult){ $pastPapersTotalMark += isset($pastResult->paper)? $pastResult->paper->mark : 0; }

            $studentWeightedTotalMark += weightedResult($pastResults->sum('mark'),$pastPapersTotalMark,$forward_mark);
        }

        $presentPapersTotalWeightedMarkByComponent = 0;
        $presentResults = Result::with('paper')->where(['exam_id'=>$transcript->exam_id,'subject_id'=>$subjectId,'student_id'=>$studentId, 'skippable'=>0])
            ->get(['exam_id','subject_id','student_id','mark','paper_id']);

        foreach ($presentResults as $presentResult){
            $presentPaperWeightedMarkByComponent = weightedResult($presentResult->mark,$presentResult->paper->mark,$presentResult->paper->weight);
            $presentPapersTotalWeightedMarkByComponent +=  $presentPaperWeightedMarkByComponent;
        }

        $presentPapersTotalWeightedMarkByTranscript = weightedResult($presentPapersTotalWeightedMarkByComponent,100,$transcript->forward_mark);

        $studentWeightedTotalMark += $presentPapersTotalWeightedMarkByTranscript;

        $result = ['exam_id'=>$examId, 'subject_id'=>$subjectId, 'student_id' =>$studentId, 'total'=>$studentWeightedTotalMark];
//        array_push($results,$result);

        $results[] = $result;
    }


//    foreach ($currentExamResults as $id => $currentExamResult){
//        $total = 0;
//        $pastTotalWeightedMark = 0;
//
//        foreach ($transcript->rules as $rule){
//            $skip = false;
//            foreach ($skipIds as $skipId){
//                if ($skipId == $rule->exam_id){
//                    $skip = true;
//                    break;
//                }
//            }
//
//            if (!$skip){
//                $pastResults = Result::where(['exam_id'=>$rule->exam_id,'subject_id'=>$subjectId,'student_id'=>$id, 'skippable'=>0])
//                    ->get(['exam_id','subject_id','student_id','mark']);
//                $pastObtainedMark = $pastResults->sum('mark');
//                $papers = papers($rule->exam_id,$subjectId,$id);
////                $pastExamMark = App\Models\Paper::where(['exam_id'=>$rule->exam_id,'subject_id'=>$subjectId,'status'=>1])->get()->sum('mark');
//                $pastExamMark = $papers->sum('mark');
//                $pastWeightedMark = weightedResult($pastObtainedMark,$pastExamMark,$rule->forward_mark);
//                $pastTotalWeightedMark += $pastWeightedMark;
//            }
//        }
//
//        $total = $pastTotalWeightedMark;
//
//        $rawTotal = 0; $examWeightedSubjectTotal = 0;
//        foreach ($currentExamResult as $item){
////            $paper = App\Models\Paper::where(['exam_id'=>$item->exam_id,'subject_id'=>$subjectId,'status'=>1])->latest()->first();
//            $paper = App\Models\Paper::where(['exam_id'=>$transcript->exam_id,'subject_id'=>$subjectId,'status'=>1])->latest()->first();
//            $paperWeightedMark = weightedResult($item->mark,$paper->mark,$paper->weight);
//            $examWeightedSubjectTotal += $paperWeightedMark;
//        }
////        $rawResultWeightedMark = weightedResult($rawTotal,100,$transcript->forward_mark);
//
//        $total += round(($examWeightedSubjectTotal/100)*$transcript->forward_mark);
//
//        $result = ['exam_id'=>$examId, 'subject_id'=>$subjectId, 'student_id' =>$id, 'total'=>$total];
//        array_push($results,$result);
//    }
//    array_multisort( array_column($results, "total"), SORT_DESC, $results );
    if (count($results)>0){
        return $maxScore = max(array_column($results, 'total'));
//        return $results[0]['total'];
    }else{
        return 0;
    }
}

function meritList($examId){
   $rawResults = Result::where(['exam_id'=>$examId])->get(['exam_id','student_id','mark'])->groupBy('student_id');
   $results = [];
   foreach ($rawResults as $id => $rawResult){
       $result = ['exam_id'=>$examId, 'student_id' =>$id, 'total'=>$rawResult->sum('mark')];
       array_push($results,$result);
   }
   array_multisort( array_column($results, "total"), SORT_DESC, $results );
   $merits = []; $currentScore = max(array_column($results, 'total'));; $position = 1;

   foreach ($results as $key => $result){
       if ($key!=0){if ($result['total']<$currentScore){ $position ++; $currentScore = $result['total'];}}
       $merit = ['position'=>$position, 'exam_id'=>$result['exam_id'], 'student_id'=>$result['student_id'], 'mark'=>$result['total']];
       array_push($merits,$merit);
   }
   return $merits;
}

function ordinal($number){
    if ($number>=11 and $number<=20){
        return 'th';
    }else{
        $digits = preg_split("//", $number, -1, PREG_SPLIT_NO_EMPTY);
        $lastDigit = $digits[0];
        if ($lastDigit==1){ return 'st'; }
        elseif ($lastDigit==2){ return 'nd'; }
        elseif ($lastDigit==3){ return 'rd'; }
        else{ return 'th'; }
    }
}

function months(){
    return Month::where('status',1)->get(['id','name','code']);
}

function frontMenus(){
    return App\Models\Menu::where('status','=',1)->get(['id','name','position'])->sortBy('position');
}

function menuItems($menuId){
    return App\Models\Page::with('subPages')->where([
        'status'=>1,
        'menu_id'=>$menuId,
    ])->get()->sortBy('position');
}

function studentHomeWork($studentId,$hwId){
    return App\Models\StudentHW::where([
        'student_id'=>$studentId,
        'hw_id'=>$hwId,
    ])->first();
}

function studentExamSyllabus($examId,$subjectId)
{
    return App\Models\Syllabus::where([
        'exam_id'=>$examId,
        'subject_id'=>$subjectId,
        'status'=>1
    ])->first();
}

function checkTranscriptMark($studentId,$subjectId,$grade,$exam){
    $mark = TranscriptMark::where([
        'student_id'=>$studentId,
        'subject_id'=>$subjectId,
        'grade'=>$grade,
        'exam'=>$exam
    ])->first();

    return $mark;
}

function checkPredictedGrade($studentId,$subjectId)
{
    return PredictedGrade::where(['student_id'=>$studentId,'subject_id'=>$subjectId])->first();
}

function pointToGrade($point)
{
    if ($point==4){return 'A';}
    if ($point==3.5){return 'B';}
    if ($point==3){return 'C';}
    if ($point==2.5){return 'D';}
    if ($point==2){return 'E';}
    if ($point<2){return 'U';}
}

function GradeToPoint($grade){
    if ($grade == 'A*' or $grade == 'A'){return 4;}
    if ($grade == 'B'){return 3.5;}
    if ($grade == 'C'){return 3;}
    if ($grade == 'D'){return 2.5;}
    if ($grade == 'E'){return 2;}
    if ($grade == 'U'){return 0;}
}

function transcriptChecker($examId){
    $transcript = App\Models\Transcript::where(['exam_id'=>$examId,'status'=>1])->first();
    if (isset($transcript)){
        return $transcript;
    }
    return false;
}

function transcriptRuleChecker($transcriptId,$examId)
{
    $rule = App\Models\TranscriptRule::where([
        'transcript_id'=>$transcriptId,
        'exam_id'=>$examId
    ])->first();

    if (!isset($rule)){
        return false;
    }
    return $rule;
}

function isResult($examId,$studentId){
    $results = Result::where([
        'exam_id'=>$examId, 'student_id'=>$studentId
    ])->get(['id','mark']);

    if (count($results)>0){
        if ($results->sum('mark')>0){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function resultMeta($examId,$studentId){
    $meta = App\Models\ResultMeta::where([
        'exam_id'=>$examId, 'student_id'=>$studentId
    ])->first();

    if (isset($meta)){
        $result = [
            'no_of_class'=>$meta->no_of_class, 'no_of_class_present'=>$meta->no_of_class_present,
            'ptm'=>$meta->ptm, 'ptm_attended'=>$meta->ptm_attended,
            'promo_status'=>$meta->promo_status,
            'promoted_class_id'=>$meta->promoted_class_id,
            'promoted_class_name'=>isset($meta->promoted_class_id)? ClassName::find($meta->promoted_class_id)->name:null,
        ];
    }else{
        $result = ['no_of_class'=>null,'no_of_class_present'=>null,'ptm'=> 1, 'ptm_attended'=> 1, 'promo_status'=> null, 'promoted_class_id'=> null];
    }
    return $result;
}

function transactionItems(){
    $items = Item::where([
        'used_for'=>1,  //1=student
        'status'=>1,
    ])->get(['id','name','billing_cycle']);

    return $items;
}

function invoiceChecker($year,$classId,$studentId,$invoiceType,$status=null){
    /* $invoiceType
     * 1=One Time
     * 2=Annual
     * 3=Monthly
     * 4=Any time
     *
     * $status
     * 1=paid
     * 2=unpaid
     * 3=deleted
     *************/
    if ($status!=null){
        if ($invoiceType==1 or $invoiceType==2){
            return Invoice::where([
                'year'=>$year,
                'class_id'=>$classId,
                'student_id'=>$studentId,
                'invoice_type'=>$invoiceType,
            ])->latest()->first();
        }elseif ($invoiceType==3 or $invoiceType==4){
            return Invoice::where([
                'year'=>$year,
                'class_id'=>$classId,
                'student_id'=>$studentId,
                'invoice_type'=>$invoiceType,
            ])->get();
        }
    }else{
        if ($invoiceType==1 or $invoiceType==2){
            return Invoice::where([
                'year'=>$year,
                'class_id'=>$classId,
                'student_id'=>$studentId,
                'invoice_type'=>$invoiceType,
                'status'=>$status,
            ])->latest()->first();
        }elseif ($invoiceType==3 or $invoiceType==4){
            return Invoice::where([
                'year'=>$year,
                'class_id'=>$classId,
                'student_id'=>$studentId,
                'invoice_type'=>$invoiceType,
                'status'=>$status,
            ])->get();
        }
    }
}

function createInvoiceNumber(){
    $id = count(Invoice::get(['id']))+1;
    $year = date('y');
    $month = date('m');
    $day = date('d');
    $invoiceNumber = $year.$month.$day.$id;
    return $invoiceNumber;
}

function newCreateInvoiceNumber(){
    $id = count(App\Models\NewPayment::get(['id']))+1;
    $year = date('y');
    $month = date('m');
    $day = date('d');
    $invoiceNumber = $year.$month.$day.$id;
    return $invoiceNumber;
}

function invoiceDelay($lastDate)
{
    $today = Carbon\Carbon::now();
    if ($today>$lastDate){
        return Carbon\Carbon::parse($lastDate)->diffInDays();
    }else{
        return 0;
    }
}

function invoiceDueDate($invoiceId)
{
    $invoice = Invoice::find($invoiceId);
    if ($invoice->invoice_type==3){
        return $invoice->deadline;
    }else{
        return Carbon\Carbon::parse($invoice->created_at)->addDays(30);
    }
}

function secondInvoiceDueDate($invoiceId)
{
    $invoice = Invoice::find($invoiceId);
    if ($invoice->invoice_type==3){
        return Carbon\Carbon::parse($invoice->deadline)->endOfMonth();
    }else{
        return Carbon\Carbon::parse($invoice->created_at)->addDays(30);
    }
}

function lateFee($invoiceId){
    $firstDueDate = invoiceDueDate($invoiceId);
    $secondDueDate = secondInvoiceDueDate($invoiceId);
    $today = Carbon\Carbon::now();
    if ($today>$firstDueDate and $today<$secondDueDate){
        return [
            'fine'=>500,
            'reference'=>'Crossed 1st Due Date'
        ];
    }elseif ($today>$secondDueDate){
        return [
            'fine'=>750,
            'reference'=>'Crossed 2nd Due Date'
        ];
    }else{
        return 0;
    }
}

function monthlyFee($year,$classId,$studentId){
    $fee = StudentMonthlyFee::where([
        'year'=>$year,
        'class_id'=>$classId,
        'student_id'=>$studentId,
        'status'=>1,
    ])->latest()->first();

    if (isset($fee)){
        return [
            'fee'=>$fee->monthly_fee,
            'discount'=>($fee->discount/100)*$fee->monthly_fee,
            'payable'=>$fee->payable,
        ];
    }else{
        return [
            'fee'=>0,
            'discount'=>0,
            'payable'=>0,
        ];
    }
}

function labFeeInfo($studentId,$classId,$year){
    $labFeeInfo = App\Models\LabFee::where([
        'class_id'=>$classId,
        'year'=>$year
    ])->latest()->first();

    if (isset($labFeeInfo)){
        $perMonthPerSubject = $labFeeInfo->amount;
    }else{
        $perMonthPerSubject = 0;
    }

    $studentsSubjects = App\Models\StudentClassSubject::where([
        'class_id'=>$classId,
        'student_id'=>$studentId,
    ])->get(['id','subject_id']);

    $labSubjects = [];
    foreach ($studentsSubjects as $studentSubject){
        $labSubject = App\Models\SubjectClass::where([
            'class_id'=>$classId,
            'subject_id'=>$studentSubject->subject_id,
            'status'=>1,
            'lab_status'=>1,
        ])->latest()->first();

        if (isset($labSubject)){
            $labSubjects[$labSubject->sub_code] = App\Models\Subject::where('id',$labSubject->subject_id)->first(['id','name']);
        }
    }

    return [
        'subjects'=>$labSubjects,
        'per_month_per_subject'=>$perMonthPerSubject,
        'lab_fee'=>count($labSubjects)*$perMonthPerSubject,
    ];
}

function stringToDate($dateString){
    $date = \Carbon\Carbon::parse($dateString);
    // Convert to SQL date format (Y-m-d)
    $sqlDate = $date->toDateString();
    return $sqlDate;
}

function endOfMonth($dateString){
    $dueDate = stringToDate($dateString);
    return Carbon\Carbon::parse($dueDate)->endOfMonth();
}

function OneTimeFeeCheck($data){
    $OneTimeFee = App\Models\StudentPaymentItem::where([
        'student_id'=>$data['student_id'],
        'class_id'=>$data['class_id'],
        'item_id'=>$data['item_id'],
    ])->first();

    if (isset($OneTimeFee)){
        return $OneTimeFee;
    }else{
        return false;
    }
}

function YearlyFeeCheck($data){
    $yearlyFee = App\Models\StudentPaymentItem::where([
        'student_id'=>$data['student_id'],
        'class_id'=>$data['class_id'],
        'year'=>$data['year'],
        'item_id'=>$data['item_id'],
    ])->first();

    if (isset($yearlyFee)){
        return $yearlyFee;
    }else{
        return false;
    }
}

function MonthlyFeeCheck($data){
    $itemId = Item::where([
        'name'=>'Tuition Fee',
        'status'=>1,
    ])->latest()->first()->id;


    $monthlyFee = App\Models\StudentPaymentItem::where([
        'student_id'=>$data['student_id'],
        'class_id'=>$data['class_id'],
        'year'=>$data['year'],
        'item_id'=>$itemId,
        'month_id'=>$data['month_id'],
    ])->first();

    if (isset($monthlyFee)){
        return $monthlyFee;
    }else{
        return false;
    }
}

function checkLateFee($studentPaymentItemId){
    $paymentItem = App\Models\StudentPaymentItem::find($studentPaymentItemId);
    if (isset($paymentItem) and $paymentItem->due_date!==null and $paymentItem->second_due_date!==null){
        $today = Carbon\Carbon::now();
        $lateFee = 0; $message = ''; $status = '';
        if ($today>$paymentItem->due_date and $today<$paymentItem->second_due_date){
            $paymentItem->late_fee = 500;
            $paymentItem->save();
            $message = '1st Due Date '.dateFormat($paymentItem->due_date,'jS F Y').' Crossed.<br> Late Fee - '.$paymentItem->late_fee.' Taka added';
            $status = 'Late';
        }
        elseif($today>=$paymentItem->second_due_date){
            $paymentItem->late_fee = 750;
            $paymentItem->save();
            $message = '2nd Due Date '.dateFormat($paymentItem->second_due_date,'jS F Y').' Crossed.<br> Late  Fee - '.$paymentItem->late_fee.' Taka added';
            $status = 'Very Late';
        }
        return [
            'late_fee'=>$paymentItem->late_fee,
            'message'=>$message,
            'status'=>'Late'
        ];
    }else{
        return [
            'late_fee'=>0,
            'message'=>'',
        ];
    }
}

function activeItems(){
    return Item::where(['status'=>1])->get(['id','name','billing_cycle']);
}

function studentPaymentItemStatus($id){
    $currentDate = Carbon\Carbon::now();
    $studentPaymentItem = App\Models\StudentPaymentItem::find($id);
    if ($studentPaymentItem->status==1){
        return ['status'=>'Paid', 'color'=>'green', 'bold'=>'bold'];
    }elseif ($studentPaymentItem->status==2){
        if ($studentPaymentItem->due_date === null){
            return ['status'=>'Unpaid', 'color'=>'black', 'bold'=>'bold'];
        }else{
            $paymentMonth = dateFormat($studentPaymentItem->due_date,'F');
            $currentMonth = dateFormat($currentDate,'F');
            if ($currentDate < $studentPaymentItem->due_date and $paymentMonth != $currentMonth){
//                return ['status'=>'Upcoming', 'color'=>'black', 'bold'=>'normal'];
                return ['status'=>'Unpaid', 'color'=>'black', 'bold'=>'bold'];
            }elseif ($currentDate < $studentPaymentItem->due_date and $paymentMonth == $currentMonth){
                return ['status'=>'Unpaid', 'color'=>'black', 'bold'=>'bold'];
            }elseif($currentDate > $studentPaymentItem->due_date and $currentDate < $studentPaymentItem->second_due_date){
                return ['status'=>'Late', 'color'=>'black', 'bold'=>'bold'];
            }elseif($currentDate > $studentPaymentItem->second_due_date){
                return ['status'=>'Very Late', 'color'=>'black', 'bold'=>'bold'];
            }
        }
    }
}

function classPerformanceTags(){
    return App\Models\ClassPerformanceTag::where('status',1)->get();
}

function studentClassPerformance($request,$studentId,$teacherId){
    $performance = App\Models\ClassPerformance::where([
        'student_id'=>$studentId,
        'class_id'=>$request->class_id,
        'subject_id'=>$request->subject_id,
        'date'=>$request->date,
        'teacher_id'=>$teacherId,
    ])->first();

//    return $request->date;

    if (isset($performance)){
        return $performance;
    }else{
        return null;
    }
}

function lastClassPerformance($studentId,$classId,$subjectId){
    $latestClass = App\Models\ClassPerformance::with([
        'tag'=>function ($query) {$query->select('id','name');}
    ])->where([
        'student_id'=>$studentId,
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
    ])->latest()->first();

    if (isset($latestClass)){
        return $latestClass;
    }else{
        return null;
    }
}

function classWorkByDate($classId,$subjectId,$date){
    $cw = App\Models\ClassWork::where([
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
        'date'=>$date,
        'status'=>1,
    ])->first();

    if (isset($cw)){
        return $cw;
    }else{
        return null;
    }
}

function homeWorkByDate($classId,$subjectId,$date){
    $hw = App\Models\HW::where([
        'class_id'=>$classId,
        'subject_id'=>$subjectId,
        'assignment_date'=>$date,
        'status'=>1,
    ])->first();

    if (isset($hw)){
        return $hw;
    }else{
        return null;
    }
}
