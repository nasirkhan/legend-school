<table class="student-info">
    <thead style="text-align: left">
    <tr>
        <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
        <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
        <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
    </tr>
    <tr>
        <td style="text-align: left"><b>Student ID:</b> {{ $student->roll }}</td>
        <td style="text-align: left" colspan="2"><b>Name:</b> {{ $student->name }}</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left"><b>Class:</b> {{ $exam->classInfo->code }}</td>
        <td style="text-align: left"><b>Section:</b> {{ $exam->classInfo->section->name }}</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left"><b>Parent-Teacher Meeting(PTM):</b> 1</td>
        <td style="text-align: left"><b>Attended:</b> 1</td>
    </tr>
    </thead>
</table>
