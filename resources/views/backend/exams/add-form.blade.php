{{--<div class="card-body" id="addForm">--}}
<div class="card-body" id="">
    <h5 class="card-title text-primary mb-3">Add New Exam</h5>
    <form class="" action="{{ route('exam-save') }}" method="POST">
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
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
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
                            <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    <select class="form-control" name="class_id" onchange="getExam()">
{{--                    <select class="form-control" name="class_id">--}}
                        <option value="">--Select--</option>
                        @foreach(activeClasses() as $class)
                            <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Exam</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Write exam name" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Result Type</span>
                    </div>

                    <select class="form-control" name="result_type">
                        <option value="">--Select--</option>
                        <option value="c">Component Wise</option>
                        <option value="p">Paper Wise</option>
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
{{--                        <option value="a">Auto Calculate</option>--}}
{{--                        <option value="m">Manual Input</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <input type="hidden" name="hw_mark" value="m">

{{--            <div class="col-lg pr-lg-0">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">CW Mark</span>--}}
{{--                    </div>--}}

{{--                    <select class="form-control" name="cw_mark">--}}
{{--                        <option value="">--Select--</option>--}}
{{--                        <option value="a">Auto Calculate</option>--}}
{{--                        <option value="m">Manual Input</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <input type="hidden" name="cw_mark" value="m">

            <div class="col-lg">
                <div class="row">
                    <div class="col-lg-8 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Comment</span>
                            </div>

                            <select class="form-control" name="comment">
                                <option value="">--Select--</option>
                                <option value="y">Yes</option>
                                <option value="n">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
