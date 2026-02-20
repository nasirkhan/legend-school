{{--<div class="card-body" id="addForm">--}}
<div class="card-body" id="">
    <h5 class="card-title text-primary mb-3">Add New Exam</h5>
    <form class="" action="{{ route('exam-update') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year">
                        <option value="">--Select--</option>
                        @foreach(activeYears() as $year)
                            <option value="{{ $year->year }}" {{ $currentExam->year == $year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Section</span>
                    </div>
                    <select class="form-control" name="section_id" onchange="getClasses(this.value)">
                        <option value="">--Select--</option>
                        @foreach(activeSections() as $section)
                            <option value="{{ $section->id }}" {{ $currentExam->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    {{--                            <select class="form-control" name="class_id" onchange="getExam()">--}}
                    <select class="form-control" name="class_id">
                        <option value="">--Select--</option>
                        @foreach($currentExam->classInfo->section->classes as $class)
                            <option value="{{ $class->id }}" {{ $currentExam->class_id==$class->id? 'selected':'' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Exam</span>
                    </div>
                    <input type="text" name="name" value="{{ $currentExam->name }}" class="form-control" placeholder="Write exam name" required/>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $currentExam->id }}">
        </div>

        <div class="row">
            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Result Type</span>
                    </div>

                    <select class="form-control" name="result_type">
                        <option value="">--Select--</option>
                        <option value="c" {{ $currentExam->result_type=='c' ? 'selected' : '' }}>Component Wise</option>
                        <option value="p" {{ $currentExam->result_type=='p' ? 'selected' : '' }}>Paper Wise</option>
                    </select>
                </div>
            </div>
{{--            <div class="col-lg pr-lg-0">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">HW Mark</span>--}}
{{--                    </div>--}}

{{--                    <select class="form-control" name="hw_mark">--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        <option value="a" {{ $currentExam->hw_mark=='a' ? 'selected' : '' }}>Auto Calculate</option>--}}
{{--                        <option value="m" {{ $currentExam->hw_mark=='m' ? 'selected' : '' }}>Manual Input</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <input type="hidden" name="hw_mark" value="{{ $currentExam->hw_mark }}">

{{--            <div class="col-lg pr-lg-0">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">CW Mark</span>--}}
{{--                    </div>--}}

{{--                    <select class="form-control" name="cw_mark">--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        <option value="a" {{ $currentExam->cw_mark=='a' ? 'selected' : '' }}>Auto Calculate</option>--}}
{{--                        <option value="m" {{ $currentExam->cw_mark=='m' ? 'selected' : '' }}>Manual Input</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <input type="hidden" name="cw_mark" value="{{ $currentExam->cw_mark }}">

            <div class="col-lg">
                <div class="row">
                    <div class="col-lg-8 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Comment</span>
                            </div>

                            <select class="form-control" name="comment">
                                <option value="">--Select--</option>
                                <option value="y" {{ $currentExam->comment=='y' ? 'selected' : '' }}>Yes</option>
                                <option value="n" {{ $currentExam->comment=='n' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
{{--                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>--}}
            </div>
        </div>
    </form>
</div>
