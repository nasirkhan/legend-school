<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    @if(count($students)>0)
        @if($from=='school')
            <tr>
                <th colspan="2">Year : <span class="font-weight-light">{{ $queries['year'] }}</span></th>
                <th>Session : <span class="font-weight-light">{{ $queries['session'] }}</span></th>
                <th>School : <span class="font-weight-light">{{ $queries['school'] }}</span></th>
                <th colspan="2">Class : <span class="font-weight-light">{{ $queries['class'] }}</span></th>
            </tr>
        @elseif($from=='class')
            <tr>
                <th colspan="2">Year : <span class="font-weight-light">{{ $queries['year'] }}</span></th>
                <th>Session : <span class="font-weight-light">{{ $queries['session'] }}</span></th>
                <th colspan="2">Class : <span class="font-weight-light">{{ $queries['class'] }}</span></th>
                <th colspan="2">Section : <span class="font-weight-light">{{ $queries['batch'] }}</span></th>
            </tr>
        @endif
    @endif


    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Nick Name</th>
        <th>Mobile</th>
{{--        @if($from == 'class') <th>School</th> @endif--}}
        <th class="text-center" style="width: 100px">Photo</th>
        <th class="text-center" style="width: 80px">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->nick_name }}</td>
            <td>{{ $student->mobile }}</td>

{{--            @if($from == 'class') <td>{{ isset($student->school)? $student->school->name : 'Not Found' }}</td> @endif--}}
{{--            <td class="text-center"><img height="30 px" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" alt="Not Found"></td>--}}
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                </a>
{{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
{{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
{{--                </a>--}}
            </td>
            <td class="text-center">
                <a target="_blank" href="{{ route('student-detail',['id'=>$student->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
            </td>
{{--            <td class="text-center">--}}
{{--                <span class="badge badge-pill badge-soft-{{ $student->status==1?'success':'danger' }} font-size-12">{{ $student->status==1?'Active':'Close' }}</span>--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                <button onclick="statusUpdateConfirmation('{{ $student->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $student->status==1?'success':'warning' }}">--}}
{{--                    <i class="fa fa-arrow-{{ $student->status==1?'up':'down' }}"></i>--}}
{{--                </button>--}}
{{--                <button onclick="edit('{{ $student }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                <button onclick="itemDeleteConfirmation('{{ $student->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--            </td>--}}
        </tr>
    @endforeach
    </tbody>
</table>

{{--<script src="{{ asset('assets') }}/js/pages/datatables.init.js"></script>--}}
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
