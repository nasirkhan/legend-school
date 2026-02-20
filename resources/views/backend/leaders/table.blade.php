<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Short Description</th>
        <th>Thumbnail</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($leaders as $leader)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $leader->name }}</td>
            <td>{{ $leader->designation }}</td>
            <td>{!! $leader->short_description !!}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $leader->thumbnail != null? asset($leader->thumbnail) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $leader->thumbnail != null? asset($leader->thumbnail) : '' }}" width="25">
                </a>
                {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                {{--                </a>--}}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $leader->status==1?'success':'danger' }} font-size-12">{{ $leader->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-leader-status',['id'=>$leader->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $leader->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $leader->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('leader-edit',['id'=>$leader->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('leader-delete',['id'=>$leader->id]) }}" onclick="return confirm('If you want to delete this page, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
