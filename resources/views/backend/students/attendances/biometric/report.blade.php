<table class="table table-bordered table-sm">
    <thead>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Std. ID</th>
        <th>Date & Time</th>
        <th class="text-center">Status</th>
    </tr>
    </thead>

    <tbody>
    @foreach($classStudents as $classStudent)
        @if(count($classStudent->punches)>0)
            @php($rowSpan=count($classStudent->punches)+1)
        @else
            @php($rowSpan=1)
        @endif

        <tr>
            <td rowspan="{{ $rowSpan }}">{{ $loop->iteration }}</td>
            <td rowspan="{{ $rowSpan }}">{{ $classStudent->student->name }}</td>
            <td rowspan="{{ $rowSpan }}">{{ $classStudent->student->roll }}</td>
            @if(count($classStudent->punches)==0)
            <td></td>
            <td></td>
            @endif

        </tr>
        @if(count($classStudent->punches)>0)
            @foreach($classStudent->punches as $punch)
                <tr>
                    <td class="text-{{ $punch->txt == 'entered' ? 'success' : 'danger' }}">{{ dateFormat($punch->punched_at,'jS M-Y h:i:s A') }}</td>
                    <td class="text-center text-capitalize">
                        <span style="font-size: 11px" class="badge badge-pill badge-soft-{{ $punch->txt == 'entered' ? 'success' : 'danger' }}">{{ $punch->txt }}</span>
                    </td>
                </tr>
            @endforeach
        @endif
    @endforeach
    </tbody>
</table>
