@if(count($students)>0)
    <table id="datatable_" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 30px">Sl.</th>
            <th>Stdn. ID</th>
            <th>Name</th>
            <th style="width: 100px">Report Card</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $studentClass)
            @php($student = $studentClass->student)
            @php($sl = $loop->iteration)

            <tr>
                <td class="pt-1 pb-1">{{ $sl }}</td>
                <td class="pt-1 pb-1">{{ $student->roll }}</td>
                <td class="pt-1 pb-1">{{ $student->name }}</td>
                <td class="pt-1 pb-1 text-center">
                    <a href="{{ route('student-report-card',[
    'student_id'=>$student->id, 'exam_id'=>$data->exam_id, 'class_id'=>$data->class_id,'year'=>$data->year
]) }}" target="_blank"
                       class="btn btn-sm btn-secondary">
                        <i class="fa fa-file-alt"></i>
                    </a>
                    <a href="{{ route('student-report-card-print',[
    'student_id'=>$student->id, 'exam_id'=>$data->exam_id, 'class_id'=>$data->class_id,'year'=>$data->year
]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                </td>
{{--                <td class="pt-1 pb-1">{{ $student->nick_name }}</td>--}}
{{--                <td class="pt-1 pb-1">{{ $student->mobile }}</td>--}}
{{--                <td class="text-center pt-1 pb-1">--}}
{{--                    <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">--}}
{{--                        <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">--}}
{{--                    </a>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <th class="" colspan="5">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg text-right">--}}
{{--                        <button type="submit" name="btn" value="save" class="btn btn-sm btn-block btn-success mr-lg-2"><i class="fa fa-save"></i> Save Result</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </th>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
    </table>
@else
    <h1 class="text-info text-center">Please select all field above to add result !!!</h1>
@endif

<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
