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
{{--                <th class="text-left">Required</th>--}}
                <th class="text-center">{{ $paper->name }}({{ $paper->mark }})</th>
                <th class="text-right">Skip</th>
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
                        <td class="pt-1 pb-1" colspan="2">
                            <div class="input-group">
{{--                                <div class="input-group-prepend">--}}
{{--                                    <span class="input-group-text">--}}
{{--                                        <input type="radio" checked--}}
{{--                                               name="skip_able[{{ $student->id }}][{{ $paper->id }}]"--}}
{{--                                               onclick="requiredOrSkip('{{ $student->id }}','{{ $paper->id }}',1)"--}}
{{--                                        />--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                                <input type="number" onblur="markCheck('{{ $paper->mark }}',this)"
                                       name="mark[{{ $student->id }}][{{ $paper->id }}]" min="0" step="0.01" max="{{ $paper->mark }}"
                                       onclick="this.select()" value="{{ $result!=null? $result->mark : '' }}"
                                       class="form-control text-center pt-1 pb-1 mark-{{ $student->id }}-{{ $paper->id }}" placeholder="{{ $paper->name }} mark" style="height: auto;"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <input
                                            type="checkbox" {{ ($result!=null and $result->skippable)? 'checked' : '' }}
                                            name="skip_able[{{ $student->id }}][{{ $paper->id }}]"
                                            onclick="requiredOrSkip('{{ $student->id }}','{{ $paper->id }}')"
                                            class="skippable-{{ $student->id }}-{{ $paper->id }}"

                                        />
                                    </span>
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th class="" colspan="{{ (count($papers)*2) + 3 }}">
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

<script>
    function requiredOrSkip(studentId,paperId){
       const element = document.querySelector(`.skippable-${studentId}-${paperId}`)
        if(element.checked){
            document.querySelector(`.mark-${studentId}-${paperId}`).required = false
            document.querySelector(`.mark-${studentId}-${paperId}`).value = null
        }else {
            document.querySelector(`.mark-${studentId}-${paperId}`).required = true
        }
        // if (status === 1){
        //     element.required = true
        // }else{
        //     element.required = false
        // }

        // console.log('ok')
        // if (element.attributes['required']){
        //     console.log('yes')
        // }else{
        //     console.log('No')
        // }

    }
</script>
