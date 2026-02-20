{{--<div class="card-body" id="addForm">--}}
<div class="card-body" id="">
    <h5 class="card-title text-primary mb-3">Syllabus Edit Form</h5>
    <form class="" action="{{ route('syllabus-update',['id'=>$currentSyllabus->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year">
                        <option value="">--Select--</option>
                        @foreach(activeYears() as $year)
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Section</span>
                    </div>
                    <select class="form-control" name="section_id" onchange="getClasses(this.value)">
                        <option value="">--Select--</option>
                        @foreach(activeSections() as $section)
                            <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    <select class="form-control" name="class_id" onchange="getExam(this.value); getSubject(this.value)">
                        <option value="">--Select--</option>
                        @foreach(activeClasses() as $class)
                            <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Exam</span>
                    </div>
                    <select class="form-control" name="exam_id" onchange="getSyllabus()">
                        <option value="">--Select--</option>
                        @foreach(activeExams() as $exam)
                            <option value="{{ $exam->id }}" {{ Session::get('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subject</span>
                    </div>

                    <select name="subject_id" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach(activeSubjects() as $subject)
                            <option value="{{ $subject->subject_id }}" {{ Session::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>{{ $subject->name }} - {{ $subject->sub_code }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Exam Date</span>
                    </div>
                    <input type="date" name="exam_date" value="{{ $currentSyllabus->exam_date }}" class="form-control" required/>
                </div>
            </div>

            <div class="col-lg-6 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Revision Worksheet</span>
                    </div>
                    <input type="file" name="attachment_url" class="form-control" />
                    @if(isset($currentSyllabus->attachment_url))
                        <div class="input-group-append">
                            <span class="input-group-text"><a target="_blank" href="{{ asset($currentSyllabus->attachment_url) }}">Check</a></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12 mb-3">
                <textarea class="summernote" name="syllabus_detail">{!! $currentSyllabus->syllabus_detail !!}</textarea>
            </div>


            <div class="col-lg-12">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </div>
    </form>
</div>
