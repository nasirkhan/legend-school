<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\PredictedGrade;
use App\Models\PrivateStudent;
use App\Models\SubjectClass;
use App\Models\TranscriptMark;
use App\Models\TranscriptSubject;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class AcademicTranscriptController extends Controller
{
    public function schoolTranscript(Request $request){
        if (Auth::user()){
            if ($request->from=='regular'){
                Alert::info('Message','This page is not ready yet !!!');
                return back();
            }else if($request->from=='private'){
                $year = Session::get('year');
                if (!isset($year)){
                    Session::put('year',date('Y'));
                }
                $year = Session::get('year');
                $students = PrivateStudent::with('subjects')->where(['year'=>$year])->get()->sortByDesc('id');
                return view('backend.school-transcript.private.private-student',['students'=>$students]);
            }
        }else{
            return 'Access denied';
        }
    }

    public function privateStudentSave(Request $request){
        if ($request->post()){
            $student = new PrivateStudent();
            $student->name = $request->name;
            $student->year = $request->year;
            $student->candidate_no = $request->candidate_no;
            $student->date_of_birth = $request->date_of_birth;
            $student->date_of_admission = $request->date_of_admission;
            $student->date_of_graduation = $request->date_of_graduation;
            $student->nationality = $request->nationality;
            $student->passport = $request->passport;
            $student->creator = user()->name;
            $student->save();
            $studentId = $student->id;

            if (count($request->subject_id)>0){
                foreach ($request->subject_id as $value){
                    $ts = new TranscriptSubject();
                    $ts->student_id = $studentId;
                    $ts->subject_id = $value;
                    $ts->save();
                }
            }

            Alert::success('Student Added Successfully','Message');
            return back();
        }
    }

    public function privateStudentUpdate(Request $request){
        if ($request->post() and Auth::user()){

//            return $request->all();

            $student = PrivateStudent::find($request->id);

            $student->name = $request->name;
            $student->year = $request->year;
            $student->candidate_no = $request->candidate_no;
            $student->date_of_birth = $request->date_of_birth;
            $student->date_of_admission = $request->date_of_admission;
            $student->date_of_graduation = $request->date_of_graduation;
            $student->nationality = $request->nationality;
            $student->passport = $request->passport;
            $student->creator = user()->name;
            $student->save();

            if (count($request->subject_id)>0){
                $oldTs = TranscriptSubject::where('student_id',$request->id)->get();
                foreach ($oldTs as $oldT){$oldT->delete();}

                foreach ($request->subject_id as $value){
                    $ts = new TranscriptSubject();
                    $ts->student_id = $request->id;
                    $ts->subject_id = $value;
                    $ts->save();
                }
            }

            Alert::success('Student Info Updated Successfully','Message');
            return back();
        }else{
            return 'Access Denied';
        }
    }


    public function transcriptMarkSave(Request $request){
        if ($request->post() and Auth::user()){

            $studentId = $request->id;

            foreach ($request->g_xi_pre_quali_marks as $subjectId => $value){
                if ($value=== null){continue;}
                $mark = checkTranscriptMark($studentId,$subjectId,'XI','pq');

                if (isset($mark) and $value==0){$mark->delete(); continue;}

                if (!isset($mark)){$mark = new TranscriptMark();}
                $mark->student_id = $studentId;
                $mark->subject_id = $subjectId;
                $mark->grade = 'XI';
                $mark->exam = 'pq';
                $mark->mark = $value;
                $mark->creator = user()->name;
                $mark->save();
            }

            foreach ($request->g_xi_quali_marks as $subjectId => $value){
                if ($value=== null){continue;}
                $mark = checkTranscriptMark($studentId,$subjectId,'XI','q');

                if (isset($mark) and $value==0){$mark->delete(); continue;}

                if (!isset($mark)){$mark = new TranscriptMark();}
                $mark->student_id = $studentId;
                $mark->subject_id = $subjectId;
                $mark->grade = 'XI';
                $mark->exam = 'q';
                $mark->mark = $value;
                $mark->creator = user()->name;
                $mark->save();
            }
            foreach ($request->g_xii_pre_quali_marks as $subjectId => $value){
                if ($value=== null){continue;}
                $mark = checkTranscriptMark($studentId,$subjectId,'XII','pq');

                if (isset($mark) and $value==0){$mark->delete(); continue;}

                if (!isset($mark)){$mark = new TranscriptMark();}
                $mark->student_id = $studentId;
                $mark->subject_id = $subjectId;
                $mark->grade = 'XII';
                $mark->exam = 'pq';
                $mark->mark = $value;
                $mark->creator = user()->name;
                $mark->save();
            }
            foreach ($request->g_xii_quali_marks as $subjectId => $value){
                if ($value=== null){continue;}
                $mark = checkTranscriptMark($studentId,$subjectId,'XII','q');

                if (isset($mark) and $value==0){$mark->delete(); continue;}

                if (!isset($mark)){$mark = new TranscriptMark();}
                $mark->student_id = $studentId;
                $mark->subject_id = $subjectId;
                $mark->grade = 'XII';
                $mark->exam = 'q';
                $mark->mark = $value;
                $mark->creator = user()->name;
                $mark->save();
            }
            Alert::toast('Mark Updated','success');
            return back();
        }else{
            return 'Access denied';
        }
    }

    public function cambridgeMarkSave(Request $request){
        if ($request->post() and Auth::user()){
            $studentId = $request->id;
            foreach ($request->caie_marks as $subjectId => $value) {
                if ($value === null) {continue;}
                $mark = checkTranscriptMark($studentId, $subjectId, 'AS', 'f');

                if (isset($mark) and $value==0){$mark->delete(); continue;}

                if (!isset($mark)){$mark = new TranscriptMark();}
                $mark->student_id = $studentId;
                $mark->subject_id = $subjectId;
                $mark->grade = 'AS';
                $mark->exam = 'f';
                $mark->mark = $value;
                $mark->creator = user()->name;
                $mark->save();
            }

            foreach ($request->predicted_grades as $subjectId => $value) {
                if ($value === null) {continue;}
                $grade = checkPredictedGrade($studentId,$subjectId);

                if (isset($grade) and $value==0){$grade->delete(); continue;}

                if (!isset($grade)){$grade = new PredictedGrade();}
                $grade->student_id = $studentId;
                $grade->subject_id = $subjectId;
                $grade->grade_point = $value;
                $grade->creator = user()->name;
                $grade->save();
            }

            Alert::toast('Mark Updated','success');
            return back();
        }
    }

    public function privateStudentTranscript($id){
        $student = PrivateStudent::with('subjects')->find($id);

        $classId = ClassName::where('code','12')->first()->id;


        $class = ClassName::with([
            'classSubjects'=>function($query){$query->select(['name','sub_code','subject_id','class_id'])->orderBy('sub_code');}
        ])->find($classId);

        $subjects = $class->classSubjects;

        return view('backend.school-transcript.private.private-student-transcript',[
            'student'=>$student, 'subjects'=>$subjects
        ]);
    }

    public function privateStudentTranscriptPrint($id){
        $student = PrivateStudent::with('subjects')->find($id);

        $classId = ClassName::where('code','12')->first()->id;

        $class = ClassName::with([
            'classSubjects'=>function($query){$query->select(['name','sub_code','subject_id','class_id'])->orderBy('sub_code');}
        ])->find($classId);

        $subjects = $class->classSubjects;

        return view('backend.school-transcript.private.private-student-printable-transcript',[
            'student'=>$student, 'subjects'=>$subjects
        ]);
    }
}
