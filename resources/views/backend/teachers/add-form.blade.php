<div class="card-body" id="addForm">
    <h5 class="card-title text-primary font-weight-bold mb-3">Teacher Registration Form</h5>
    <form class="" action="{{ route('teacher-save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-10 col-md-9">
                <div class="row">
                    <div class="col col-lg-8 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Full Name</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Write Full Name" required/>
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
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
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
                            <input type="text" name="mobile" class="form-control" placeholder="Write Contact NUmber"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email Address</span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Write Email Address"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Passport No.</span>
                            </div>
                            <input type="text" name="passport" class="form-control" placeholder="Optional"/>
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="col col-lg-8 col-md-6 pr-md-0  mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text" name="address" class="form-control" placeholder="Write Address Here"/>
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
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
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
                <img width="100%" class="img-thumbnail" id="profile_photo" src="{{ asset('assets/images/user-avatar.png') }}" alt="Image Not Found">
            </div>
        </div>
    </form>
</div>
