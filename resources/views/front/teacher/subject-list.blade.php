@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Class Schedule</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher-detail',['id'=>$teacher->id]) }}">Teacher's Portal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('teacher-subject-list',['id'=>$teacher->id,'sectionId'=>$sectionId]) }}">{{ 'Class Schedule' }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Class Schedule <a class="btn btn-sm btn-secondary" href="{{ route('section-wise-teacher') }}"><i class="fa fa-arrow-left"></i> Back</a></h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-bordered table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="">Sl</th>
                                <th colspan="">Class</th>
                                <th colspan="">Subject</th>
                                <th colspan="">Routine</th>
                                @if(Auth::user())
                                    <th class="text-center" style="width: 100px">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @php($sl=1)
                                @foreach($classSubjects as $classSubject)
                                    @php($schedules = teacherScheduleCheck($teacher->id,$classSubject->class_id,$classSubject->subject_id,siteInfo('running_year')))
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td style="text-align: left">{{ $classSubject->className->name }}</td>
                                        <td style="text-align: left">{{ $classSubject->subject->name }}</td>
                                        <td>
                                            <ul class="mb-0">
                                                @foreach($schedules as $schedule)
                                                    <li>
                                                        {{ $schedule->day->name }} :
                                                        {{ $schedule->period->name }}-({{ dateFormat($schedule->period->start,'g:i a') }} to {{ dateFormat($schedule->period->end,'g:i a') }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <button onclick="routineAddForm('{{ $teacher->id }}','{{ $classSubject->class_id }}',
                                            '{{ $classSubject->subject_id }}','{{ $classSubject->className->code }}','{{ $classSubject->subject->name }}')"
                                                    class="btn btn-sm btn-secondary"
                                            >
                                                <i class="fa fa-edit"></i> Set Routine
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
{{--                            @endif--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    @include('front.teacher.modal.routine-add-form')
@endsection

@section('script')
    @include('front.teacher.script')
@endsection
