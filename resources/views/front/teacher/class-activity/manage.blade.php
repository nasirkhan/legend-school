@extends('front.teacher.profile.master')

@section('content')
    <form action="{{ route('student-class-activity-update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-11 pr-lg-0">
                                <div class="row">
                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">AC. Year</span>
                                            </div>
                                            <select class="form-control" name="year">
                                                <option value="">--Select--</option>
                                                @foreach(activeYears() as $year)
                                                    <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Section</span>
                                            </div>
                                            <select class="form-control" name="section_id" id="section_id" onchange="getClasses(this.value)">
                                                <option value="">--Select-- </option>
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
                                            <select class="form-control" name="class_id" onchange="getSubjects()">
                                                <option value="">--Select--</option>
                                                @foreach(activeClasses() as $class)
                                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Subject</span>
                                            </div>
                                            <select class="form-control" name="subject_id">
                                                <option value="">--Select--</option>
                                                @foreach($classSubjects as $classSubject)
                                                    <option value="{{ $classSubject->subject_id }}" {{ Session::get('subject_id') == $classSubject->subject_id ? 'selected' : '' }}>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Date</span>
                                            </div>
                                            <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" onclick="getClassWiseStudent()" class="btn btn-block btn-primary"><i class="fa fa-list-alt"></i> Get</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="table" class="table-responsive p-1">
                            @include('front.teacher.class-activity.students')
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </form>
@endsection

@section('script')
    @include('front.teacher.class-activity.script')
@endsection
