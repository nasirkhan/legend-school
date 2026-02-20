@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Class Schedules</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        @if(Auth::user())
                            <li class="breadcrumb-item"><a href="{{ route('teacher-detail',['id'=>$teacher->id]) }}">Teacher's Portal</a></li>
                        @else

                        @endif

                        <li class="breadcrumb-item">{{ 'Dashboard' }}</li>
                        <li class="breadcrumb-item active"><a href="{{ route('teacher-schedule') }}">Schedules</a></li>
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
            @php($days = activeDays())
            @foreach($teacher->sections as $section)

                @php($haveClasses = false)
                @foreach($section->classes as $class)
                    @php($routines = teacherRoutineCheck($teacher->id,$class->id))
                    @if(count($routines)>0)
                        @php($haveClasses = true)
                        @break
                    @endif
                @endforeach


                @if($haveClasses)
                    @php($periods = sectionWisePeriod($section->id))
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> {{ $section->name }}</h4>
                        </div>

                        <div class="card-body">
                            <div id="" class="table-responsive p-1">
                                <table id="" class="table table-sm table-bordered table-centered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($periods as $period)
                                            <th style="padding: 5px" class="text-center">
{{--                                                {{ $period->name }}<br>--}}
                                                {{ dateFormat($period->start,'g:i A') }} <br> to <br> {{ dateFormat($period->end,'g:i A') }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($days as $day)
                                        <tr class="{{ $day->name == date('l') ? 'bg-info text-light' : '' }}">
                                            <th style="padding: 5px; text-align: left">{{ $day->name }}</th>
                                            @foreach($periods as $period)
                                                @php($schedule = teacherSchedule($teacher->id,$day->id,$period->id))
                                                <td style="padding: 5px; text-align: center">
                                                    @if($period->code==='Tiffin')
                                                        {{ $period->name }}
                                                    @elseif((isset($schedule) and $period->code!=='Tiffin'))
                                                        {{ $schedule->className->name }}<br>
                                                        {{ $schedule->subject->name }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div> <!-- end col -->
    </div>
@endsection




