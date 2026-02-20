@php($teacherId = Session::get('teacherId'))

<table id="datatable_" class="table table-centered table-hover table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Class Performance</th>
    </tr>
    </thead>
    <tbody>
    @if(count($students)>0)
        @php($status = null) @php($sl = 0)
        @foreach($students as $classStudent)
            @php($student = $classStudent->student)

            @php($sl++)
            <tr>
                <td>{{ $sl }}</td>
                <td>{{ $student->name }}</td>
                <td>
{{--                    <select class="form-control" onchange="changeClassPerformance(this,'{{ $student->id }}')">--}}
                    <select class="form-control" name="performance[{{ $student->id }}]" required>
                        <option value="">--Select--</option>
                        @php($activity = studentClassPerformance($data,$student->id,$teacherId))
                        @foreach(classPerformanceTags() as $tag)
                            <option value="{{ $tag->id }}" {{ (isset($activity) and $activity->tag_id == $tag->id) ? 'selected' : ''  }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3">
                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light"><i class="fa fa-paper-plane"></i> Submit</button>
            </td>
        </tr>
    @endif
    </tbody>
</table>
{{--<script src="{{ asset('assets') }}/js/pages/datatables.init.js"></script>--}}
