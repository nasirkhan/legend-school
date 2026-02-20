<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Title</th>
        <th>Description</th>
        <th>Page Link</th>
        <th>Photo</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slides as $slide)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $slide->title }}</td>
            <td>{{ $slide->description }}</td>
            <td>{{ $slide->slide_link }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $slide->url != null? asset($slide->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $slide->url != null? asset($slide->url) : '' }}" width="25">
                </a>
                {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                {{--                </a>--}}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $slide->status==1?'success':'danger' }} font-size-12">{{ $slide->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-slide-status',['id'=>$slide->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $slide->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $slide->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('slide-edit',['id'=>$slide->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('slide-delete',['id'=>$slide->id]) }}" onclick="return confirm('If you want to delete this slide, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
