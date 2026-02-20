<div class="card-body" id="addForm">
    <h5 class="card-title text-primary font-weight-bold mb-3">Syllabus Edit Form</h5>
    <form class="" action="{{ route('teacher-syllabus-update',['id'=>$syllabus->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year">
{{--                    <select class="form-control" name="year" onchange="getTeacherClasses(this.value)">--}}
                        <option value="">--Select--</option>
                        @foreach(activeYears() as $year)
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    <select class="form-control" name="class_id" onchange="getTeacherSubject(this.value)">
                        <option value="">--Select--</option>
{{--                        @php($classes = teacherClass(Session::get('year'),Session::get('teacherId')))--}}
{{--                        @foreach($classes as $class)--}}
                        @foreach(activeAllClasses() as $class)
                            <option value="{{ $class->id }}" {{ $syllabus->exam->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg pr-lg-0 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subject</span>
                    </div>
                    <select name="subject_id" class="form-control" required>
                        <option value="">--Select--</option>
{{--                        @php($subjects = teacherClassSubject(Session::get('year'),Session::get('teacherId'),Session::get('class_id')))--}}
{{--                        @foreach($subjects as $subject)--}}
{{--                        @foreach($subjects as $subject)--}}
{{--                            <option value="{{ $subject->id }}" {{ Session::get('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>--}}
{{--                        @endforeach--}}

                        @foreach($classSubjects as $classSubject)
                            {{--                            <option value="{{ $subject->id }}" {{ Session::get('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>--}}
                            <option value="{{ $classSubject->subject_id }}" {{ $syllabus->subject_id == $classSubject->subject_id ? 'selected' : '' }}>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Exam</span>
                    </div>
                    <select name="exam_id" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" {{ $syllabus->exam_id == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <label>Syllabus Detail</label>
                <textarea class="summernote" name="syllabus_detail">{!! $syllabus->syllabus_detail !!}</textarea>
            </div>

            <div class="col-lg-8 pr-lg-0 mb-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Add/Change Revision Worksheet</span>
                    </div>
                    <input type="file" name="attachment_url" class="form-control"/>
                    @if(isset($syllabus->attachment_url))
                        <div class="input-group-append">
                        <span class="input-group-text">
                            <a target="_blank" href="{{ asset($syllabus->attachment_url) }}">Check Uploaded Worksheet</a>
                        </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save Changes</button>
            </div>

            <div class="col-lg-2">
                <a href="{{ route('syllabus-view-by-teacher') }}" class="btn btn-secondary btn-block"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </form>
</div>
