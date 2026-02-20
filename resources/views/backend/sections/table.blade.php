<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Section</th>
        <th>Classes</th>
        <th>Teachers</th>
        <th>Result Type</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sections as $section)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $section->name }}</td>
            <td>
                <ul class="mb-0">
                    @foreach($section->classes as $class)
                        <li>{{ $class->name }}</li>
                    @endforeach
                </ul>

            </td>

            <td>
                <ul class="mb-0">
                    @foreach($section->teachers as $teacher)
                        <li>{{ $teacher->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                @if($section->result_type=='n') Normal @endif
                @if($section->result_type=='a') Average @endif
                @if($section->result_type=='w') Weighted Average @endif
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $section->status==1?'success':'danger' }} font-size-12">{{ $section->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="classAddIntoSection('{{ $section->id }}','{{ $sl }}','{{ $section->name }}')" class="btn btn-sm btn-secondary" title="Add Classes To The Section">
                    <i class="fa fa-plus"></i>
                </button>

                <button onclick="statusUpdateConfirmation('{{ $section->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $section->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $section->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $section }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $section->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
