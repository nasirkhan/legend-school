@if(count($papers)>0)

    <h4>Total Paper : {{ count($papers) }}, Mark Inserted : {{ $resultCount }}</h4>

    @if($resultCount> count($papers))
        <a href="{{ route('delete-result',[
    'exam_id'=>$data->exam_id, 'subject_id'=>$data->subject_id
]) }}" onclick="return confirm('are you sure to delete this result')" class="btn btn-danger">
            <i class="fa fa-trash-alt"></i> Delete Result
        </a>
    @endif

    <table id="datatable_" class="table table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 30px">Sl.</th>
            <th>Stdn. ID</th>
            <th>Name</th>
{{--            @foreach($papers as $paper)--}}
            @foreach($singleResult as $item)
                    @php($paper = $item->paper)
                <th class="text-center">{{ $paper->name }}({{ $paper->mark }})</th>
            @endforeach
            <th class="text-center">Total({{ $totalMark = $papers->sum('mark') }})</th>
            <th class="text-center">Average(%)</th>
            <th class="text-center">Grade</th>
        </tr>
        </thead>
        <tbody>
        @php($status = null) @php($sl = 0)
        @foreach($students as $studentClass)
            @php($student = $studentClass->student)

            @if($data->section_id==3)
                @php($status = subjectCheck($student->id,$data->class_id,$data->subject_id))
            @else
                @php($status = true)
            @endif

            @if($status === true)
                @php($sl++)
                <tr>
                    <td class="pt-1 pb-1">{{ $sl }}</td>
                    <td class="pt-1 pb-1">{{ $student->roll }}</td>
                    <td class="pt-1 pb-1">{{ $student->name }}</td>
                    @php($totalMarkObtained = 0)
{{--                    @foreach($papers as $paper)--}}
                    @foreach($singleResult as $item)
                        @php($paper = $item->paper)
                        @php($data->paper_id = $paper->id)
                        @php($result = resultCheck($data,$student->id))
                        <td class="pt-1 pb-1 text-center">{{ isset($result)? numberFormat($result->mark,2) : '' }}</td>
                        @php($totalMarkObtained += isset($result)? $result->mark : 0)
                    @endforeach
                    <td class="text-center">{{ numberFormat($totalMarkObtained,2) }}</td>
                    <td class="text-center">{{ $average = avearge($totalMarkObtained,$totalMark,2) }}</td>
                    <td class="text-center">{{ grade($average) }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@else
    <h1 class="text-info text-center">Please select all field above to view result !!!</h1>
@endif

<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
