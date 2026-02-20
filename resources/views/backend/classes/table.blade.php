<table id="datatable" class="table table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Class</th>
        <th>Subjects</th>
        <th class="text-center">Status</th>
        <th class="text-right" style="width: 80px">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($classes as $class)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>
                {{ $class->name }}
                @if(isset($class->labFee))
                    <br><strong>(Lab Fee : {{ numberFormat($class->labFee->amount) }} Tk. Per Subject)</strong>
                    <br>
                    <button onclick="subjectLab({
                    'class_id' : '{{ $class->id }}',
                    'class_name' : '{{ $class->name }}',
                    'subjects' : JSON.stringify({{ $class->subjects }})
                    })" class="btn btn-sm btn-primary">
                        Subjects
                    </button>

                @endif
            </td>
            <td>
                <ol class="mb-0">
{{--                    @foreach($class->classSubjects as $subject)--}}
                    @foreach($class->subjects as $subject)
                        <li>{{ $subject->subject->name }} - {{ $subject->sub_code }} - {{ $subject->id }}</li>
                    @endforeach
                </ol>
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $class->status==1?'success':'danger' }} font-size-12">{{ $class->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="subjectAddIntoClass('{{ $class->id }}','{{ $sl }}','{{ $class->name }}')" class="btn btn-sm btn-secondary btn-block mb-1">
                    Subjects
                    <i class="fa fa-book"></i>
                </button>

                <button onclick="statusUpdateConfirmation('{{ $class->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $class->status==1?'success':'warning' }} btn-block mb-1">
                    {{ $class->status==1?'Deactivate':'Activate' }}
                    <i class="fa fa-arrow-{{ $class->status==1?'up':'down' }}"></i>
                </button>


                <button onclick="edit('{{ $class }}','{{ $sl }}')" class="btn btn-sm btn-primary btn-block mb-1">
                    Edit
                    <i class="fa fa-edit"></i>
                </button>

                <button onclick="itemDeleteConfirmation('{{ $class->id }}','{{ $sl }}')" class="btn btn-sm btn-danger btn-block" id="sa-params">
                    Delete
                    <i class="fa fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
