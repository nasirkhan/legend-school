<table id="datatable_" class="table table-centered table-sm table-bordered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th style="width: 95px">Mobile</th>
        <th class="text-center" style="width: 40px">Photo</th>
        @foreach(months() as $month)
            <th class="text-center" style="width: 66px">{{ $month->code }}</th>
        @endforeach
        <th class="text-right">Due</th>
    </tr>
    </thead>
    <tbody>
    @php($totalDue = 0) @php($totalReceived = 0)
    @foreach($students as $student)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center p-1">{{ $sl }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->mobile }}</td>
            <td class="text-center p-1">
                <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                </a>
            </td>
            @php($studentDue=0)
            @foreach(months() as $month)
                @php($check = paymentCheck($data,$month->id,$student->id))
                @if($check=='Due')
                    @php($studentDue += $student->monthly_payable)
                    <td class="text-center"><span class="text-danger">{{ $check }}</span></td>
                @elseif($check=='Leave')
                    <td class="text-center p-1"><span class="text-info">{{ $check }}</span></td>
                @elseif($check=='N/A')
                    <td class="text-center p-1"><span class="">{{ $check }}</span></td>
                @else
                    <td class="text-center p-1"><span class="">{{ $check }}</span></td>
                @endif
            @endforeach
            <td class="text-right p-1 {{ $studentDue>0 ? 'text-danger':'' }}">{{ numberFormat($studentDue) }}</td>
        </tr>
    @endforeach
    </tbody>

    @if(count($students)>0)
        <tfoot>
        <tr class="">
            <th class="text-center text-primary" colspan="2" rowspan="2">Total </th>
            <th class="text-center text-success" colspan="2">Received </th>
            @foreach(months() as $month)
                @php($monthlyReceived = monthlyPaymentCheck($data,$month->id)->sum('received'))
                @php($totalReceived += $monthlyReceived)
                <th class="text-center text-success" style="width: 60px">{{ numberFormat($monthlyReceived) }}</th>
            @endforeach
            <th class="text-right text-success">{{ numberFormat($totalReceived) }}</th>
        </tr>

        <tr class="">
            <th class="text-center text-danger" colspan="2">Due </th>
            @foreach(months() as $month)
                @php($monthlyDue = monthlyDueCheck($data,$month->id))
                @php($totalDue += $monthlyDue)
                <th class="text-center text-danger" style="width: 60px">{{ numberFormat($monthlyDue) }}</th>
            @endforeach
            <th class="text-right text-danger">{{ numberFormat($totalDue) }}</th>
        </tr>
        </tfoot>
    @endif
</table>
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>

