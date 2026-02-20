<form action="{{ route('send-password-to-mother') }}" method="post">
    @csrf
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th style="width: 30px">Sl.</th>
            <th>Name</th>
            <th>Stdn. ID</th>
            <th>Password</th>
            <th>Mother Mob.</th>
            <th class="text-center" style="width: 80px">
                <input type="checkbox" id="all">
            </th>
        </tr>
        </thead>
        <tbody>

        @if(count($students)>0)
            @foreach($students as $classStudent)
                @php($student = $classStudent->student)
                @php($sl = $loop->iteration)
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->roll }}</td>
                    <td>{{ $student->password }}</td>
                    <td>{{ $student->mother_mobile }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="check" name="student_id[{{ $student->roll }}]" value="{{ $student->password }}">
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>

        @if(count($students)>0)
            <tfoot>
            <tr>
                <th colspan="6">
                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light mr-1"><i class="fa fa-paper-plane"></i> Send Password</button>
                </th>
            </tr>
            </tfoot>
        @endif
    </table>
</form>


<script>
    document.getElementById('all').onclick = function() {
        var checkboxes = document.getElementsByClassName('check');

        for (var i in checkboxes) {
            checkboxes[i].checked = this.checked;
        }
    }
</script>
