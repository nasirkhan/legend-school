<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Title</th>
        <th class="text-center">Position</th>
        <th class="text-center">Thumbnail</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($popularECAs as $page)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $page->title }}</td>
            <td class="text-center">{{ $page->sl }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $page->thumbnail != null? asset($page->thumbnail) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $page->thumbnail != null? asset($page->thumbnail) : '' }}" width="25">
                </a>
                {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                {{--                </a>--}}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $page->status==1?'success':'danger' }} font-size-12">{{ $page->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-popular-class-status',['id'=>$page->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $page->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $page->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('popular-class-edit',['id'=>$page->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('popular-class-delete',['id'=>$page->id]) }}" onclick="return confirm('If you want to delete this item, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
