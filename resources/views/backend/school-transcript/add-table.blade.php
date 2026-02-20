@if(count($papers)>0)
    <table id="datatable_" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 30px">Sl.</th>
            <th>Stdn. ID</th>
            <th>Name</th>
{{--            <th>Nick Name</th>--}}
{{--            <th>Mobile</th>--}}
{{--            <th class="text-center" style="width: 100px">Photo</th>--}}
{{--            <th class="text-center" style="width: 180px">Mark out of {{ $mark }}</th>--}}
            @foreach($papers as $paper)
                <th class="text-center">{{ $paper->name }}({{ $paper->mark }})</th>
            @endforeach
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
                    {{--                <td class="pt-1 pb-1">{{ $student->nick_name }}</td>--}}
                    {{--                <td class="pt-1 pb-1">{{ $student->mobile }}</td>--}}
                    {{--                <td class="text-center pt-1 pb-1">--}}
                    {{--                    <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">--}}
                    {{--                        <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">--}}
                    {{--                    </a>--}}
                    {{--                </td>--}}

                    @foreach($papers as $paper)
                        @php($data->paper_id = $paper->id)
                        @php($result = resultCheck($data,$student->id))
                        <td class="pt-1 pb-1">
                            <input type="number" onblur="markCheck('{{ $paper->mark }}',this)"
                                   name="mark[{{ $student->id }}][{{ $paper->id }}]" min="0" step="0.01" max="{{ $paper->mark }}"
                                   onclick="this.select()" value="{{ $result!=null? $result->mark : '' }}"
                                   class="form-control text-center pt-1 pb-1" placeholder="{{ $paper->name }} mark" style="height: auto;" required/>
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th class="" colspan="{{ count($papers)+3 }}">
                <div class="row">
                    <div class="col-lg text-right">
                        <button type="submit" name="btn" value="save" class="btn btn-sm btn-block btn-success mr-lg-2"><i class="fa fa-save"></i> Save Result</button>
                    </div>
                </div>
            </th>
        </tr>
        </tfoot>
    </table>
@else
    <h1 class="text-info text-center">Please select all field above to add result !!!</h1>
@endif

<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
