@php($transcriptId = null)
@php($transcript = transcriptChecker($currentExam->id))
@if($transcript !== false)
    @php($transcriptId = $transcript->id)
@endif
@if(count($exams)>0)
    <table id="datatable_" class="table table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 30px">Sl.</th>
            <th class="">Exam Name</th>
{{--            <th class="text-center">Total Mark</th>--}}
            <th class="text-center">Select</th>
            <th class="text-center">Forward Marks</th>
            <th class="text-center">Transcript Serial</th>
        </tr>
        </thead>
        <tbody>
        @php($i = null)
        @foreach($exams as $exam)
            @php($transcriptRule = transcriptRuleChecker($transcriptId,$exam->id))
            <tr>
                <td>{{ $i = $loop->iteration }}</td>
                <td>{{ $exam->name }}</td>
{{--                <td class="text-center">{{ $exam->components->sum('mark') }}</td>--}}
                <td class="text-center">
                    <input type="checkbox" {{ $transcriptRule? 'checked' : '' }}
                           name="past_exams[{{ $exam->id }}]"
                           id="past_exams_{{ $exam->id }}"
                    />
                </td>
                <td>
                    <input type="text" value="{{ $transcriptRule? $transcriptRule->forward_mark : '' }}"
                           name="forward_marks[{{ $exam->id }}]"
                           class="form-control text-center"
                           id="forward_marks_{{ $exam->id }}"
                    />
                </td>
                <td>
                    <input type="text" value="{{ $transcriptRule? $transcriptRule->serial : '' }}"
                           name="serial[{{ $exam->id }}]"
                           class="form-control text-center"
                           id="serial_{{ $exam->id }}"
                    />
                </td>
            </tr>
        @endforeach

        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $currentExam->name }}</td>
{{--            <td class="text-center">{{ $currentExam->components->sum('mark') }}</td>--}}
            <td class="text-center">Selected</td>
            <td>
                <input type="text" required
                       name="forward_marks[{{ $currentExam->id }}]" value="{{ $transcript !== false ? $transcript->forward_mark : '' }}"
                       class="form-control text-center"
                       id="forward_marks_{{ $currentExam->id }}"
                />
                <input type="hidden" name="current_exam_id" value="{{ $currentExam->id }}"/>
            </td>
            <td class="text-center">{{ $i }}</td>
        </tr>

        <tr>
            <td colspan="6">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Save Change</button>
            </td>
        </tr>
        </tbody>
    </table>
@else
    <h1 class="text-info text-center">Please select all field above to view result !!!</h1>
@endif
