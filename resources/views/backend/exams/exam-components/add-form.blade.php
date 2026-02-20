<div class="card-body" id="addForm">
{{--<div class="card-body" id="">--}}
    <h5 class="card-title text-primary mb-3">Add New Component</h5>
    <form class="" action="{{ route('exam-component-save') }}" method="POST">
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

{{--            <div class="col-lg-3 pr-lg-0 mb-2">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Session</span>--}}
{{--                    </div>--}}
{{--                    <select class="form-control" name="session_id">--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        @foreach(activeSessions() as $session)--}}
{{--                            <option value="{{ $session->id }}">{{ $session->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

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
                    <select class="form-control" name="exam_id" onchange="getExamComponent()">
                        <option value="">--Select--</option>
                        @foreach(activeExams() as $exam)
                            <option value="{{ $exam->id }}" {{ Session::get('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
{{--            <div class="col-lg-3 pr-lg-0 mb-2">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Subject</span>--}}
{{--                    </div>--}}

{{--                    <select name="subject_id" class="form-control" onchange="getPaper()" required>--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        @foreach(activeSubjects() as $subject)--}}
{{--                            <option value="{{ $subject->subject_id }}" {{ Session::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>{{ $subject->name }} - {{ $subject->sub_code }}</option>--}}
{{--                            <option value="{{ $subject->subject_id }}" {{ Session::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>{{ $subject->subject->name }} - {{ $subject->sub_code }}</option>--}}
{{--                        @endforeach--}}

{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Comp.</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Write component name" required/>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" placeholder="Component code"/>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mark</span>
                    </div>
                    <input type="number" name="mark" step="1" min="0" class="form-control" placeholder="Component mark" required/>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Weight</span>
                    </div>
                    <input type="number" name="weight" min="0" step="1" class="form-control" placeholder="Component weight"/>
                </div>
            </div>
        </div>
        <div class="row">



{{--            <div class="col-lg-2 pr-lg-0">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">Serial</span>--}}
{{--                    </div>--}}
{{--                    <input type="number" name="sl" min="0" step="1" class="form-control" placeholder="1 or 2 etc." required/>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-lg-12">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
