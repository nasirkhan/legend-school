<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\ClassTeachersComment;
use App\Models\ECAActivity;
use App\Models\ECAType;
use App\Models\Exam;
use App\Models\ExamComponent;
use App\Models\OtherAttendance;
use App\Models\Paper;
use App\Models\Result;
use App\Models\ResultMeta;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectClass;
use App\Models\Transcript;
use App\Models\TranscriptRule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ResultController extends Controller
{
    public function index($from){
        if ($from=='add'){return view('backend.exams.results.add-form',['students'=>[],'from'=>$from, 'papers'=>[]]);}
        elseif ($from=='view'){return view('backend.exams.results.view-form',['students'=>[],'from'=>$from, 'mark'=>null]);}
        elseif ($from=='old'){return view('backend.exams.results.old-view-form',['students'=>[],'from'=>$from, 'mark'=>null]);}
        elseif ($from=='delete'){return view('backend.exams.results.delete-form',['students'=>[],'from'=>$from, 'mark'=>null]);}
        elseif ($from=='merit'){return view('backend.exams.results.merit-form',['students'=>[],'from'=>$from, 'mark'=>null]);}
    }

    public function form(Request $request){
        if ($request->ajax()){
            if ($request->from=='add'){
                $students = classAndBatchWiseStudents($request);
                if ($request->section_id == 1 or $request->section_id == 2){
                    $papers = ExamComponent::where(['exam_id'=>$request->exam_id, 'status'=>1])->get();
                }elseif ($request->section_id == 3){
                    $papers = Paper::where(['exam_id'=>$request->exam_id, 'subject_id' =>$request->subject_id, 'status'=>1])->get();
                }
                return view('backend.exams.results.add-table',['students'=>$students, 'data'=>$request, 'papers'=>$papers]);
            }
            elseif ($request->from=='report'){
                $students = classAndBatchWiseStudents($request);
                return view('backend.exams.results.report-card-table',['students'=>$students, 'data'=>$request]);
            }

            elseif ($request->from=='view'){
                $students = classAndBatchWiseStudents($request);
                if ($request->section_id == 1 or $request->section_id == 2){
                    $papers = ExamComponent::where(['exam_id'=>$request->exam_id, 'status'=>1])->get();
                }elseif ($request->section_id == 3){
                    $papers = Paper::where(['exam_id'=>$request->exam_id, 'subject_id' =>$request->subject_id, 'status'=>1])->get();
                }

                $exam = Exam::with('classInfo')->find($request->exam_id);
                $subject = Subject::find($request->subject_id);

                return view('backend.exams.results.view-table',['students'=>$students, 'data'=>$request, 'papers'=>$papers, 'exam'=>$exam, 'subject'=>$subject]);
            }

            elseif ($request->from=='old'){
                $students = classAndBatchWiseStudents($request,4);

//                return $students;

                if ($request->section_id == 1 or $request->section_id == 2){
                    $papers = ExamComponent::where(['exam_id'=>$request->exam_id, 'status'=>1])->get();
                }elseif ($request->section_id == 3){
                    $papers = Paper::where(['exam_id'=>$request->exam_id, 'subject_id' =>$request->subject_id, 'status'=>1])->get();
                }

                $exam = Exam::with('classInfo')->find($request->exam_id);
                $subject = Subject::find($request->subject_id);

                return view('backend.exams.results.old-view-table',['students'=>$students, 'data'=>$request, 'papers'=>$papers, 'exam'=>$exam, 'subject'=>$subject]);
            }

            elseif ($request->from=='delete'){
                $students = classAndBatchWiseStudents($request);
                if ($request->section_id == 1 or $request->section_id == 2){
                    $papers = ExamComponent::where(['exam_id'=>$request->exam_id, 'status'=>1])->get();
                }elseif ($request->section_id == 3){
                    $papers = Paper::where(['exam_id'=>$request->exam_id, 'subject_id' =>$request->subject_id, 'status'=>1])->get();
                }

                $results = Result::with('paper')->where(['exam_id'=>$request->exam_id,'subject_id'=>$request->subject_id,'skippable'=>0])->get()->groupBy('student_id');

                $resultCount = 0; $singleResult = [];
                foreach ($results as $result){
                    $resultCount = count($result);
                    $singleResult = $result;
                    break;
                }

                return view('backend.exams.results.delete-table',[
                    'students'=>$students,
                    'data'=>$request,
                    'papers'=>$papers,
                    'resultCount'=>$resultCount,
                    'singleResult'=>$singleResult
                ]);
            }

            elseif ($request->from=='merit'){
                $merits = meritList($request->exam_id);

                $students = classAndBatchWiseStudents($request);
                $attendances = OtherAttendance::where(['table'=>'Exam', 'row_id'=>$request->exam_id])->get();
                $papers = Paper::where(['exam_id'=>$request->exam_id,'status'=>1])->get();
                return view('backend.exams.results.merit-table',['merits'=>$merits, 'attendances'=>$attendances ,'data'=>$request, 'papers'=>$papers]);
            }
        }
    }

    public function store(Request $request){
//        return $request->all();
        $skips = $request->skip_able;

        if (isset($request->mark)){
            foreach ($request->mark as $studentId => $marks){
                foreach ($marks as $paperId => $mark){

                    $result = Result::where([
                        'exam_id'=>$request->exam_id,
                        'subject_id'=>$request->subject_id,
                        'paper_id'=>$paperId,
                        'student_id'=>$studentId
                    ])->first();

                    if (isset($skips[$studentId][$paperId])){
                        if (isset($result)){
                            $result->mark = 0;
                            $result->skippable = true;
                            $result->creator_id = user()->id;
                            $result->save();
                        }else{
                            $result = new Result();
                            $result->exam_id = $request->exam_id;
                            $result->subject_id = $request->subject_id;
                            $result->paper_id = $paperId;
                            $result->student_id = $studentId;
                            $result->mark = 0;
                            $result->skippable = true;
                            $result->creator_id = user()->id;
                            $result->save();
                        }

                        continue;
                    }

                    if (isset($result)){
                        $result->skippable = false;
                        $result->mark = $mark;
                        $result->creator_id = user()->id;
                        $result->save();
                    }else{
                        $result = new Result();
                        $result->exam_id = $request->exam_id;
                        $result->subject_id = $request->subject_id;
                        $result->paper_id = $paperId;
                        $result->student_id = $studentId;
                        $result->skippable = false;
                        $result->mark = $mark;
                        $result->creator_id = user()->id;
                        $result->save();
                    }
                }
            }

            return response()->json([
                'success'=>true
            ]);
        }else{
            Alert::toast('Result must not be empty','info');
            return back();
        }
        return $request->all();

    }

    public function reportCardForm(){
        return view('backend.exams.results.report-card-form');
    }

    public function studentReportCard(Request $request){
//        return $request;
        $exam = Exam::with(['classInfo'])->find($request->exam_id);

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$request->class_id,
            'status'=>1
        ])->get(['id','class_id','subject_id','sub_code','status'])->sortBy('sub_code');

        $comment = ClassTeachersComment::where([
            'student_id'=>$request->student_id,
            'exam_id'=>$request->exam_id
        ])->first();

        $resultMeta = resultMeta($request->exam_id,$request->student_id);

        $sc = $this->ecaType(1);
        $lc = $this->ecaType(2);
        $sic = $this->ecaType(3);
        $cpac = $this->ecaType(4);
        $csc = $this->ecaType(5);
        $ac = $this->ecaType(6);
        $tic = $this->ecaType(7);
        $olmp = $this->ecaType(8);

        if ($exam->classInfo->section_id == 1 or $exam->classInfo->section_id == 2){
            return view('backend.exams.results.report-card',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'components'=>$exam->components,
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }else{
            return view('backend.exams.results.senior-report-card',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }
    }

    public function studentReportCardPrint(Request $request){
        $exam = Exam::with(['classInfo'])->find($request->exam_id);

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])->where([
            'class_id'=>$request->class_id,
            'status'=>1
        ])->get(['id','class_id','subject_id','sub_code','status'])->sortBy('sub_code');

        $comment = ClassTeachersComment::where([
            'student_id'=>$request->student_id,
            'exam_id'=>$request->exam_id
        ])->first();

        $resultMeta = resultMeta($request->exam_id,$request->student_id);

        $sc = $this->ecaType(1);
        $lc = $this->ecaType(2);
        $sic = $this->ecaType(3);
        $cpac = $this->ecaType(4);
        $csc = $this->ecaType(5);
        $ac = $this->ecaType(6);
        $tic = $this->ecaType(7);
        $olmp = $this->ecaType(8);

        if ($exam->classInfo->section_id == 1 or $exam->classInfo->section_id == 2){
            return view('backend.exams.results.report-card-print',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'components'=>$exam->components,
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }else{
            return view('backend.exams.results.senior-report-card-print',[
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }
    }

    protected function ecaType($id){
        return ECAType::with([
            'items'=>function($query){$query->where(['status'=>1])->select(['id','eca_type_id','name','code']);}
        ])->where([
            'id'=>$id,
            'status'=>1
        ])->first(['id','name','code','status']);
    }

    public function classTeacherCommentSave(Request $request){
        if ($request->post()){
            if (isset($request->comment)){
                $comment = ClassTeachersComment::where([
                    'student_id'=>$request->student_id,
                    'exam_id'=>$request->exam_id
                ])->first();

                if (!isset($comment)){
                    $comment = new ClassTeachersComment();
                }

                $comment->exam_id = $request->exam_id;
                $comment->student_id = $request->student_id;
                $comment->comment = $request->comment;
                $comment->creator_id = user()->id;
                $comment->save();
            }

            if (isset($request->eca_grade)){
                foreach ($request->eca_grade as $ecaItemId => $value ){
                    $activity = ECAActivity::where([
                        'student_id'=>$request->student_id,
                        'exam_id'=>$request->exam_id,
                        'eca_item_id'=>$ecaItemId
                    ])->first();
                    if ($value != null){
                        if (!isset($activity)){$activity = new ECAActivity();}
                        $activity->student_id = $request->student_id;
                        $activity->exam_id = $request->exam_id;
                        $activity->eca_item_id = $ecaItemId;
                        $activity->grade = $value;
                        $activity->creator_id = user()->id;
                        $activity->save();
                    }else{
                        if (isset($activity)){$activity->delete();}
                    }
                }
            }

            Alert::toast('Comment Saved.','success');
            return back();
        }
    }

    public function academicTranscriptSettingsForm(){
        return view('backend.exams.academic-transcript.setting-form');
    }

    public function getExamListForTranscriptSettings(Request $request){
        if ($request->ajax()){
            if ($request->section_id==1 || $request->section_id==2){
                $exams = Exam::with('components')->where([
                    'year'=>$request->year,
                    'section_id'=>$request->section_id,
                    'class_id'=>$request->class_id,
                    'status'=>1
                ])->where('id','!=',$request->exam_id)->get();

                $currentExam = Exam::with('components')->find($request->exam_id);

                return view('backend.exams.academic-transcript.setting-table',[
                    'exams'=>$exams, 'currentExam'=>$currentExam
                ]);
            }elseif ($request->section_id==3){
                $exams = Exam::where([
                    'year'=>$request->year,
                    'section_id'=>$request->section_id,
                    'class_id'=>$request->class_id,
                    'status'=>1
                ])->where('id','!=',$request->exam_id)->get();

                $currentExam = Exam::find($request->exam_id);


                return view('backend.exams.academic-transcript.senior-setting-table',[
                    'exams'=>$exams, 'currentExam'=>$currentExam
                ]);
            }
        }
    }

    public function transcriptSettingSave(Request $request){
        if ($request->post()){

            $forwardMarks = $request->forward_marks;

            $transcript = Transcript::where('exam_id',$request->current_exam_id)->first();
            if (!isset($transcript)){
                $transcript = new Transcript();
            }
            $transcript->exam_id = $request->current_exam_id;
            $transcript->forward_mark = $forwardMarks[$request->current_exam_id];
            $transcript->creator_id = user()->id;
            $transcript->save();

            $transcriptId = $transcript->id;

            $rules = TranscriptRule::where([
                'transcript_id'=>$transcriptId
            ])->get();

            if (count($rules)>0){
                foreach ($rules as $rule){ $rule->delete(); }
            }

            $pastExams = $request->past_exams;

            if (count($pastExams)>0){
                foreach ($pastExams as $id => $pastExam){
                    $rule = new TranscriptRule();
                    $rule->transcript_id = $transcriptId;
                    $rule->exam_id = $id;
                    $rule->forward_mark = $request->forward_marks[$id];
                    $rule->serial = $request->serial[$id];
                    $rule->save();
                }
            }

            return response()->json([
                'success'=>true
            ]);

            Alert::toast('success','Rule added successfully');
            return back();
        }
    }

    public function studentAcademicTranscriptPrint(Request $request){

//        return 'Hello';

        $transcript = Transcript::with(['exam','rules'])->find($request->transcript_id);

        $exam = Exam::with(['classInfo'])->find($transcript->exam_id);

        $classSubjects = SubjectClass::with([
            'subject'=>function($query){$query->select(['id','name','status']);}
        ])
            ->where(['class_id'=>$exam->class_id, 'status'=>1])
            ->get(['id','class_id','subject_id','sub_code','status'])
            ->sortBy('sub_code');

        $resultMeta = resultMeta($transcript->exam_id,$request->student_id);

        $comment = ClassTeachersComment::where([
            'student_id'=>$request->student_id,
            'exam_id'=>$transcript->exam_id
        ])->first();

        $sc = $this->ecaType(1);
        $lc = $this->ecaType(2);
        $sic = $this->ecaType(3);
        $cpac = $this->ecaType(4);
        $csc = $this->ecaType(5);
        $ac = $this->ecaType(6);
        $tic = $this->ecaType(7);
        $olmp = $this->ecaType(8);

        $request->exam_id = $transcript->exam_id;
        $request->class_id = $exam->class_id;

        if ($exam->section_id == 1 or $exam->section_id == 2){
//            return 'Hello';

            return view('backend.exams.results.transcript-print',[
                'transcript'=>$transcript,
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'components'=>$exam->components,
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }else{

//            $papers = papers($exam->id,16,90);

            return view('backend.exams.results.senior-transcript-print',[
                'transcript'=>$transcript,
                'exam'=>$exam, 'classSubjects'=>$classSubjects,
                'student'=>Student::find($request->student_id),
                'data'=>$request, 'comment'=>$comment, 'meta'=>$resultMeta,
                'sc'=>$sc, 'lc'=>$lc, 'sic'=>$sic, 'cpac'=>$cpac, 'csc'=>$csc, 'ac'=>$ac, 'tic' =>$tic, 'olmp'=>$olmp
            ]);
        }
    }

    public function deleteResult(Request $request){
        $results = Result::where([
            'exam_id'=>$request->exam_id, 'subject_id'=>$request->subject_id
        ])->get();

        foreach ($results as $result){
            $result->delete();
        }

        Alert::success('Message','Result Deleted Successfully');
        return back();
    }


    public function resultMetaAdd(Request $request){
        if ($request->ajax()){
            $meta = ResultMeta::where([
                'exam_id'=>$request->exam_id,
                'student_id'=>$request->student_id
            ])->first();

            if (!isset($meta)){
                $meta = new ResultMeta();
                $meta->exam_id = $request->exam_id;
                $meta->student_id = $request->student_id;
            }

            $meta->no_of_class = $request->no_of_class;
            $meta->no_of_class_present = $request->no_of_class_present;
            $meta->ptm = $request->ptm;
            $meta->ptm_attended = $request->ptm_attended;

            if (isset($request->promoted_class_id)){
                $meta->promo_status = 1;
                $meta->promoted_class_id = $request->promoted_class_id;
            }

            $meta->save();
            return response()->json([
                'status'=>'success'
            ]);
        }
    }
}
