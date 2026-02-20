<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($images as $image)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $image->title }}</td>
            <td>{{ $image->description }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $image->url != null? asset($image->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $image->url != null? asset($image->url) : '' }}" width="25">
                </a>
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $image->status==1?'success':'danger' }} font-size-12">{{ $image->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-gallery-image-status',['id'=>$image->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $image->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $image->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('gallery-image-edit',['id'=>$image->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('gallery-image-delete',['id'=>$image->id]) }}" onclick="return confirm('If you want to delete this page, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
