<table id="datatable_" class="table table-sm table-hover table-bordered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th class="" style="">Subject</th>
{{--        <th class="text-center">Code</th>--}}
        <th class="text-center" style="width: 100px">Exam Date</th>
        <th class="text-center" >Syllabus</th>
        <th class="text-center">R.W</th>
{{--        <th class="text-center">Status</th>--}}
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($syllabi as $syllabus)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $syllabus->subject->name }}</td>
            <td class="">{{ dateFormat($syllabus->exam_date,'d-M-Y') }}</td>
            <td class="">
                {!! $syllabus->syllabus_detail !!}
            </td>
            <td class="text-center">
                @if(isset($syllabus->attachment_url))
                    <a target="_blank" href="{{ asset($syllabus->attachment_url) }}">Open</a>
                @endif
            </td>
{{--            <td class="text-center">--}}
{{--                <span class="badge badge-pill badge-soft-{{ $syllabus->status==1?'success':'danger' }} font-size-12">{{ $syllabus->status==1?'Published':'Unpublished' }}</span>--}}
{{--            </td>--}}
            <td class="text-right">
                <a href="{{ route('syllabus-status-update',['id'=>$syllabus->id]) }}"
                   class="btn btn-sm btn-block btn-{{ $syllabus->status==1?'success':'warning' }}"
                   title="{{ $syllabus->status==1?'Un-Publish':'Publish' }}"
                >
                    <i class="fa fa-arrow-{{ $syllabus->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('syllabus-edit',['id'=>$syllabus->id]) }}" class="btn btn-sm btn-block btn-primary"><i class="fa fa-edit"></i></a>
                <button onclick="itemDeleteConfirmation('{{ $syllabus->id }}','{{ $sl }}')" class="btn btn-sm btn-block btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
