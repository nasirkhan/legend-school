<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    @if(count($students)>0)
        @if($from=='class')
            <tr>
                <th colspan="3">Year : <span class="font-weight-light">{{ $queries['year'] }}</span></th>
                <th colspan="4">Section : <span class="font-weight-light">{{ $queries['section'] }}</span></th>
                <th colspan="3">Class : <span class="font-weight-light">{{ $queries['class'] }}</span></th>
            </tr>
        @endif
    @endif


    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>BG</th>
        <th>Stdn. ID</th>
        <th>Password</th>
        <th>Self Mob.</th>
        <th>Mother Mob.</th>
        <th>Father Mob.</th>
        <th class="text-center" style="width: 100px">Photo</th>
        <th class="text-center" style="width: 80px">Option</th>
    </tr>
    </thead>
    <tbody>
    @if(count($students)>0)
        @foreach($students as $classStudent)
            @php($student = $classStudent->student)
            @php($sl = $loop->iteration)
            <tr>
                <td>{{ $sl }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->blood_group }}</td>
                <td>{{ $student->roll }}</td>
                <td>{{ $student->password }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->mother_mobile }}</td>
                <td>{{ $student->father_mobile }}</td>
                <td class="text-center">
                    <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                        <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                    </a>
                </td>
                {{--            <td class="text-center">--}}
                {{--                <a target="_blank" href="{{ route('student-detail',['id'=>$student->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>--}}
                {{--                <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                {{--                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>--}}
                {{--            </td>--}}
                {{--            <td class="text-center">--}}
                {{--                <span class="badge badge-pill badge-soft-{{ $student->status==1?'success':'danger' }} font-size-12">{{ $student->status==1?'Active':'Close' }}</span>--}}
                {{--            </td>--}}

                <td class="text-center">
                    {{--                <a title="Download Photo" href="{{ asset($student->photo->url) }}" download class="btn btn-sm btn-info"><i class="fa fa-download"></i></a>--}}



                    <a
                        target="_blank"
                        title="Invoice Creation"
                        href="{{ route('invoice-creation-for-student',[
                                'id'=>$student->id, 'class_id'=>$classStudent->class_id, 'year'=>$classStudent->year
                            ]) }}"
                        class="btn btn-sm btn-info">
                        <i class="fa fa-file-alt"></i>
                    </a>

                    <a target="_blank" href="{{ route('student-payment-report',[
    'student_id'=>$student->id, 'class_id'=>$classStudent->class_id, 'year'=>$classStudent->year
]) }}" class="btn btn-sm btn-success" title="Payment Report">
                        <i class="fa fa-dollar-sign"></i>
                    </a>

                    <a target="_blank" title="Detail" href="{{ route('student-information',['id'=>$student->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                    <a target="_blank" title="Edit" href="{{ route('student-edit',['id'=>$student->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="itemDeleteConfirmation('{{ $student->id }}','{{ $sl }}')"><i class="fa fa-trash-alt"></i></button>
                </td>

                {{--            <td class="text-right">--}}
                {{--                <button onclick="statusUpdateConfirmation('{{ $student->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $student->status==1?'success':'warning' }}">--}}
                {{--                    <i class="fa fa-arrow-{{ $student->status==1?'up':'down' }}"></i>--}}
                {{--                </button>--}}
                {{--                <button onclick="edit('{{ $student }}','{{ $sl }}')" class="btn btn-sm btn-primary">--}}
                {{--                    <i class="fa fa-edit"></i>--}}
                {{--                </button>--}}
                {{--                <button onclick="itemDeleteConfirmation('{{ $student->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params">--}}
                {{--                    <i class="fa fa-trash-alt"></i>--}}
                {{--                </button>--}}
                {{--            </td>--}}
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

{{--<script src="{{ asset('assets') }}/js/pages/datatables.init.js"></script>--}}
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
