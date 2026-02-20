<table id="" class="table table-nowrap table-bordered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Subject</th>
        <th class="text-center">Performance</th>
        <th>Class Work</th>
        <th>Home Work</th>
{{--        <th class="text-center" style="width: 90px">Detail</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($classSubjects as $classSubject)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>
            <td class="text-center">
                @if($classSubject->performance)
                    <span class="badge badge-soft-success badge-pill" style="font-size: small">Done</span> <br>
                    {{ $classSubject->performance->teacher->name }}
                @else

                @endif
            </td>

            <td>
                @if($classSubject->cw)
                    @php($cw = $classSubject->cw)
                    <span class="font-weight-bold">Chapter: </span>{{ $cw->chapter }} <br>
                    {!! $cw->cw_detail !!}
                    @if($cw->attachment_url)
                        <a href="{{ asset($cw->attachment_url) }}">Attachment</a>
                    @endif
                @else

                @endif
            </td>

            <td>
                @if($classSubject->hw)
                    @php($hw = $classSubject->hw)
                    <span class="font-weight-bold">Title: </span>{{ $hw->title }} <br>
                    {!! $hw->hw_detail !!}
                    @if($hw->attachment_url)
                        <a href="{{ asset($hw->attachment_url) }}">Attachment</a>
                    @endif
                @endif
            </td>

{{--            <td>--}}
{{--                @if($classSubject->performance)--}}
{{--                    <a href="" class="btn btn-sm btn-secondary">--}}
{{--                        <i class="fa fa-eye"></i> Detail--}}
{{--                    </a>--}}
{{--                @else--}}

{{--                @endif--}}
{{--            </td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
