<table id="datatable" class="table table-bordered table-hover table-centered dt-responsive mb-0">
    <thead>
    <tr>
        <th>Sl</th>
{{--        <th>Year</th>--}}
{{--        <th class="text-center">Session</th>--}}
{{--        <th class="text-center">Class</th>--}}
        <th class="">Class</th>
        <th class="">Exam</th>
{{--        <th class="">Code</th>--}}
        <th class="">Res. Type</th>
{{--        <th class="">HW</th>--}}
{{--        <th class="">CW</th>--}}
        <th class="text-center">Comment</th>
{{--        <th class="text-center">Code</th>--}}
        <th class="text-center">Mark <br> Input</th>
        <th class="text-center">Pub <br> Status</th>
        <th class="text-center">Promo. <br>Status</th>
        <th class="text-center">Status</th>
        <th class="text-center">Show <br> Stnds</th>
        <th class="text-center">Exam <br> Schedule</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>

{{--    @php($classLoop = 1)--}}
{{--    @foreach($classes as $class)--}}
{{--        @php($classExams = exam('2024',$class->id))--}}
{{--        <tr>--}}
{{--            <td>{{ $classLoop++ }}</td>--}}
{{--            <td>{{ $class->name }}</td>--}}
{{--            <td>{{ count($classExams) }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}


    @foreach($exams as $exam)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
{{--            <td>{{ $exam->year }}</td>--}}
{{--            <td>{{ $exam->session->name }}</td>--}}
{{--            <td>{{ $exam->classInfo->name }}</td>--}}
            <td>{{ $exam->classInfo->name }}</td>
            <td>{{ $exam->name }}</td>
{{--            <td>{{ $exam->code }}</td>--}}
            <td>
                {{ $exam->result_type=='c' ? 'Component Wise' : '' }}
                {{ $exam->result_type=='p' ? 'Paper Wise' : '' }}
            </td>
{{--            <td>--}}
{{--                {{ $exam->hw_mark=='a' ? 'Auto' : '' }}--}}
{{--                {{ $exam->hw_mark=='m' ? 'Manual' : '' }}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {{ $exam->cw_mark=='a' ? 'Auto' : '' }}--}}
{{--                {{ $exam->cw_mark=='m' ? 'Manual' : '' }}--}}
{{--            </td>--}}
            <td class="text-center">
                {{ $exam->comment=='y' ? 'Yes' : '' }}
                {{ $exam->comment=='n' ? 'No' : '' }}
            </td>
{{--            <td class="text-center">{{ $exam->code }}</td>--}}
            <td class="text-center">
                <a href="{{ route('mark-input-status-update',['id'=>$exam->id]) }}" class="btn btn-sm btn-{{ $exam->input_status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $exam->input_status==1?'up':'down' }}"></i>
                    {{ $exam->input_status==1?'Open':'Close' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->input_status==1?'success':'danger' }} font-size-12">{{ $exam->input_status==1?'Open':'Close' }}</span>--}}
            </td>
            <td class="text-center">
                <a href="{{ route('publication-status-update',['id'=>$exam->id]) }}" class="btn btn-sm btn-{{ $exam->publication_status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $exam->publication_status==1?'up':'down' }}"></i>
                    {{ $exam->publication_status==1?'Pubed':'Unpubed' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->publication_status==1?'success':'danger' }} font-size-12">{{ $exam->publication_status==1?'Published':'Unpublished' }}</span>--}}
            </td>
            <td class="text-center">
                <a href="{{ route('need-promotional-status-update',['id'=>$exam->id]) }}" class="btn btn-sm btn-{{ $exam->need_promo_status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $exam->need_promo_status==1?'up':'down' }}"></i>
                    {{ $exam->need_promo_status==1?'Yes':'No' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->status==1?'success':'danger' }} font-size-12">{{ $exam->status==1?'Active':'Close' }}</span>--}}
            </td>
            <td class="text-center">
                <a href="{{ route('exam-status-update',['id'=>$exam->id]) }}"
                   class="btn btn-sm btn-{{ $exam->status==1?'success':'warning' }}"
                   title="Exam Status"
                >
                    <i class="fa fa-arrow-{{ $exam->status==1?'up':'down' }}"></i>
                    {{ $exam->status==1?'Active':'Close' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->status==1?'success':'danger' }} font-size-12">{{ $exam->status==1?'Active':'Close' }}</span>--}}
            </td>

            <td class="text-center">
                <a href="{{ route('exam-show-to-student',['id'=>$exam->id]) }}"
                   class="btn btn-sm btn-{{ $exam->show_student==1?'success':'warning' }}"
                   title="Show on Student Profile"
                >
                    <i class="fa fa-arrow-{{ $exam->show_student==1?'up':'down' }}"></i>
                    {{ $exam->show_student==1?'Yes':'No' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->status==1?'success':'danger' }} font-size-12">{{ $exam->status==1?'Active':'Close' }}</span>--}}
            </td>

            <td class="text-center">
                <a href="{{ route('exam-schedule-status-update',['id'=>$exam->id]) }}"
                   class="btn btn-sm btn-{{ $exam->schedule_status==1?'success':'warning' }}"
                   title="Show on Student Profile"
                >
                    <i class="fa fa-arrow-{{ $exam->schedule_status==1?'up':'down' }}"></i>
                    {{ $exam->schedule_status==1?'Published':'Unpublished' }}
                </a>
{{--                <span class="badge badge-pill badge-soft-{{ $exam->status==1?'success':'danger' }} font-size-12">{{ $exam->status==1?'Active':'Close' }}</span>--}}
            </td>
            <td class="text-right">
{{--                <button onclick="statusUpdateConfirmation('{{ $exam->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $exam->status==1?'success':'warning' }}">--}}
{{--                    <i class="fa fa-arrow-{{ $exam->status==1?'up':'down' }}"></i>--}}
{{--                </button>--}}
                <a href="{{ route('exam-edit',['id'=>$exam->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
{{--                <button onclick="edit('{{ $exam }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                <button onclick="itemDeleteConfirmation('{{ $exam->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
