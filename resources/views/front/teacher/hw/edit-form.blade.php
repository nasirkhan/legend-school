<div class="card-body" id="addForm">
    <h5 class="card-title text-primary font-weight-bold mb-3">HW Edit Form</h5>
    <form class="" action="{{ route('teacher-hw-update',['id'=>$hw->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year" onchange="getTeacherClasses(this.value)">
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
                            <option value="{{ $class->id }}" {{ $hw->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
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
                            <option value="{{ $classSubject->subject_id }}" {{ $hw->subject_id == $classSubject->subject_id ? 'selected' : '' }}>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Ass. Date</span>
                    </div>
                    <input type="date" name="assignment_date" value="{{ dateFormat($hw->assignment_date,'Y-m-d') }}" class="form-control"/>
                </div>
            </div>

            <div class="col-lg mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sub. Date</span>
                    </div>
                    <input type="date" name="submission_date" value="{{ dateFormat($hw->submission_date,'Y-m-d') }}" class="form-control"/>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">HW Title</span>
                    </div>
                    <input type="text" name="title" value="{{ $hw->title }}" class="form-control" placeholder="HW Title" required/>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <label>HW Detail Description</label>
                <textarea class="summernote" name="hw_detail">{!! $hw->hw_detail !!}</textarea>
            </div>

            <div class="col-lg-8 pr-lg-0 mb-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Add/Change Attachment</span>
                    </div>
                    <input type="file" name="attachment_url" class="form-control"/>
                    @if(isset($hw->attachment_url))
                        <div class="input-group-append">
                        <span class="input-group-text">
                            <a target="_blank" href="{{ asset($hw->attachment_url) }}">Check Uploaded Attachment</a>
                        </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save Changes</button>
            </div>

            <div class="col-lg-2">
                <a href="{{ route('teacher-class-wise-hw-list') }}" class="btn btn-secondary btn-block"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </form>
</div>
