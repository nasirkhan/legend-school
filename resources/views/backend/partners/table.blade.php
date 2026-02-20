<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th class="text-center">Thumbnail</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($partners as $partner)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $partner->name }}</td>

            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $partner->thumbnail != null? asset($partner->thumbnail) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $partner->thumbnail != null? asset($partner->thumbnail) : '' }}" width="25">
                </a>
                {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                {{--                </a>--}}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $partner->status==1?'success':'warning' }} font-size-12">{{ $partner->status==1?'Published':'Unpublished' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-partner-status',['id'=>$partner->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $partner->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $partner->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('partner-edit',['id'=>$partner->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('partner-delete',['id'=>$partner->id]) }}" onclick="return confirm('If you want to delete this item, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
