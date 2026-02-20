<div class="modal-header">
    <h5 class="modal-title mb-0 text-primary" id="exampleModalLabel">
        <i class="fa fa-edit"></i>
        Attendance Report of - {{ $student->name }}({{ $student->nick_name }})
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body pb-0 pt-1">
    <table class="table table-borderless table-sm mb-1">
        <tr>
            <th>School : {{ $student->school->name }}</th>
            <th class="text-center">Class: {{ $student->classInfo->name }}</th>
            <th class="text-center">Batch: {{ $student->batch->name }}</th>
            <th class="text-right">Mobile: {{ $student->mobile }}</th>
        </tr>
    </table>

    <table class="table table-bordered table-sm mb-2">
        <thead>
        <tr>
            <th class="text-center">Sl.</th>
            <th class="text-center">Date</th>
            <th class="text-center">Input Date & Time</th>
            <th class="text-center">Status</th>
        </tr>
        </thead>
        <tbody>
        @php($totalPresent = 0) @php($totalAbsent = 0)
        @foreach($attendances as $attendance)
            <tr class="{{ $attendance->status == 1 ? '' : 'text-danger' }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ dateFormat($attendance->date,'d-M-Y') }}</td>
                <td class="text-center">{{ dateFormat($attendance->created_at,'d-M-Y h:i:s A') }}</td>
                <td class="text-center">{{ $attendance->status == 1 ? 'Present' : 'Absent' }}</td>
            </tr>
            @if($attendance->status == 1)
                @php($totalPresent++)
            @else
                @php($totalAbsent++)
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2" class="text-primary pl-3">Total Class : {{ $totalPresent+$totalAbsent }}</th>
            <th class="text-success text-center">Present : {{ $totalPresent }}</th>
            <th class="text-danger text-center">Absent : {{ $totalAbsent }}</th>
        </tr>
        </tfoot>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
</div>

