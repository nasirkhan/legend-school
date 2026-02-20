{{--<div class="card-body" id="editForm">--}}
<div class="card-body" id="">
    <h5 class="card-title text-primary font-weight-bold mb-3">Teacher Profile Edit Form
        <a href="{{ route('teachers') }}" class="btn btn-sm btn-secondary">
            <i class="fa fa-arrow-circle-left"></i> Back
        </a>
    </h5>
    <form class="" action="{{ route('teacher-update',['id'=>$teacher->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-10 col-md-9">
                <div class="row">
                    <div class="col col-lg-8 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Full Name</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" placeholder="Write Full Name" required/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <select class="form-control" name="designation_id" required>
                                <option value="">--Select--</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}" {{ $teacher->designation_id == $designation->id? 'selected' : '' }}>{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 col-md-6 mb-3 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Contact No.</span>
                            </div>
                            <input type="text" name="mobile" value="{{ $teacher->mobile }}" class="form-control" placeholder="Write Contact NUmber"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email Address</span>
                            </div>
                            <input type="email" name="email" value="{{ $teacher->email }}" class="form-control" placeholder="Write Email Address"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Passport No.</span>
                            </div>
                            <input type="text" name="passport" value="{{ $teacher->passport }}" class="form-control" placeholder="Optional"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg-8 col-md-6 pr-md-0  mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text" name="address" value="{{ $teacher->address }}" class="form-control" placeholder="Write Address Here"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="avatar" onchange="showImage(this, 'profile_photo')">
                                <label class="custom-file-label" for="inputGroupFile02" id="fileLabel">Choose Teacher Photo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg-8 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sections</span>
                            </div>
                            <select class="select2 form-control select2-multiple" name="sections[]" multiple="multiple" data-placeholder="Select Sections">
                                @foreach($sections as $section)
                                    @php($st = teacherSectionCheck($teacher->id,$section->id))
                                    <option value="{{ $section->id }}" {{ isset($st)? 'selected' : '' }}>{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="row">
                            <div class="col pr-1">
                                <button type="submit" class="btn btn-block btn-info mr-1"><i class="fa fa-save"></i> Save Info</button>
                            </div>
                            <div class="col pl-1">
                                <button type="reset" class="btn btn-block btn-warning"><i class="fa fa-recycle"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <img width="100%" class="img-thumbnail" id="profile_photo" src="{{ $teacher->photo != null ? asset($teacher->photo) : asset('assets/images/user-avatar.png') }}" alt="Image Not Found">
            </div>
        </div>
    </form>
</div>

