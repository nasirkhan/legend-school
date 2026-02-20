<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Profession</th>
        <th>Description</th>
        <th>Thumbnail</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($testimonials as $testimonial)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $testimonial->name }}</td>
            <td>{{ $testimonial->profession }}</td>
            <td>{!! $testimonial->content !!}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ $testimonial->thumbnail != null? asset($testimonial->thumbnail) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ $testimonial->thumbnail != null? asset($testimonial->thumbnail) : '' }}" width="25">
                </a>
                {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                {{--                </a>--}}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $testimonial->status==1?'success':'danger' }} font-size-12">{{ $testimonial->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-testimonial-status',['id'=>$testimonial->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $testimonial->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $testimonial->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('testimonial-edit',['id'=>$testimonial->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('testimonial-delete',['id'=>$testimonial->id]) }}" onclick="return confirm('If you want to delete this page, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
