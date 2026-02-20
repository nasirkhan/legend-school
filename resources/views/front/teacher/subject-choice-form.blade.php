@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Subject Choice</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Student Area</a></li>
                        <li class="breadcrumb-item active">Subject Choice</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <form action="" method="">
                @csrf
                <table class="table table-bordered">
                    <tr class="text-primary">
                        <th>Subject List for Class {{ $class->name }}</th>
                        <th class="text-center">Select</th>
                    </tr>
                    @foreach($class->subjects as $subject)
                    <tr>
                        <th>{{ $subject->name }}</th>
                        <td class="text-center"><input type="checkbox" name="subject[{{ $subject->id }}]"></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Save Selected Subject</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
