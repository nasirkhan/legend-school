<div class="card-body" id="addForm">
    <h5 class="card-title text-primary font-weight-bold mb-3">HW Add Form <a href="{{ route('class-wise-hw-list') }}" class="btn btn-primary btn-sm"> Go To Home Work List</a></h5>
    <form class="" action="{{ route('hw-save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-3 mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year">
                        <option value="">--Select--</option>
                        @foreach(activeYears() as $year)
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 mb-3 pr-lg-0">
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

            <div class="col-lg-3 mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    {{--                            <select class="form-control" name="class_id" onchange="getExam()">--}}
                    <select class="form-control" name="class_id" onchange="getSubject(this.value)">
                        <option value="">--Select--</option>
                        @foreach(activeClasses() as $class)
                            <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subject</span>
                    </div>

                    <select name="subject_id" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach(activeSubjects() as $subject)
                            <option value="{{ $subject->subject_id }}">{{ $subject->name }} - {{ $subject->sub_code }}</option>
                            {{--                            <option value="{{ $subject->subject_id }}" {{ Session::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>{{ $subject->subject->name }} - {{ $subject->sub_code }}</option>--}}
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-9 mb-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">HW Title</span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="HW Title" required/>
                </div>
            </div>

            <div class="col-lg-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Submission Date</span>
                    </div>
                    <input type="date" name="submission_date" class="form-control"/>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <label>HW Detail Description</label>
                <textarea class="summernote" name="hw_detail"></textarea>
            </div>

            <div class="col-lg-9 pr-lg-0 mb-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Attachment</span>
                    </div>
                    <input type="file" name="attachment_url" class="form-control"/>
                </div>
            </div>

            <div class="col-lg-3">
                <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </div>
    </form>
</div>
