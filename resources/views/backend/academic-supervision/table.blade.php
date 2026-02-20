<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Subject</th>
        <th>Performance</th>
        <th>Class Work</th>
        <th>Home Work</th>
        <th>Detail</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $classStudent)
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
        </tr>
    @endforeach
    </tbody>
</table>
