<div class="card-body" id="addForm">
    <h5 class="card-title text-primary font-weight-bold mb-3">Student Registration Form</h5>
    <form class="" action="{{ route('student-save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-10 col-md-9">
                <div class="row">
                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Full Name</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Write Full Name" required/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nick Name</span>
                            </div>
                            <input type="text" name="nick_name" class="form-control" placeholder="Write Nick Name"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Self Contact</span>
                            </div>
                            <input type="text" name="mobile" class="form-control" placeholder="01XXXXXXXXX"/>
                        </div>
                    </div>
                </div>
                <div class="row">
{{--                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text">School</span>--}}
{{--                            </div>--}}
{{--                            <select name="school_id" class="form-control" id="school_id" required>--}}
{{--                                <option value="">--Select--</option>--}}
{{--                                @foreach(activeSchools() as $school)--}}
{{--                                    <option value="{{ $school->id }}">{{ $school->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Section</span>
                            </div>
                            <select name="section_id" class="form-control" id="section_id" onchange="getClasses(this.value)" required>
                                <option value="">--Select--</option>
                                @foreach(activeSections() as $section)
                                    <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col col-lg-3 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Class</span>
                            </div>
                            <select name="class_id" class="form-control" id="class_id" required>
                                <option value="">--Select--</option>
                                @foreach(activeClasses() as $class)
                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col col-lg-5 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Self Email</span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Write Email Address"/>
                        </div>
                    </div>

                    {{--            <div class="col col-md-2">--}}
                    {{--                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>--}}
                    {{--            </div>--}}
                </div>
                <div class="row">


                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Father's Name</span>
                            </div>
                            <input type="text" name="father_name" class="form-control" placeholder="Write Father's Name"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Father's Mobile</span>
                            </div>
                            <input type="text" name="father_mobile" class="form-control" placeholder="01XXXXXXXXX" maxlength="11" min="11"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mother's Name</span>
                            </div>
                            <input type="text" name="mother_name" class="form-control" placeholder="Write Mother's Name"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mother's Mobile</span>
                            </div>
                            <input type="text" name="mother_mobile" class="form-control" placeholder="01XXXXXXXXX" maxlength="11" min="11"/>
                        </div>
                    </div>

                    <div class="col col-lg-8 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text" name="address" class="form-control" placeholder="Write Address Here"/>
                        </div>
                    </div>




                </div>
                <div class="row">
                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Date fo Birth</span>
                            </div>
                            <input type="date" name="date_of_birth" class="form-control" placeholder="Write Address Here"/>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="avatar" onchange="showImage(this, 'profile_photo')">
                                <label class="custom-file-label" for="inputGroupFile02" id="fileLabel">Choose Student Photo</label>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Joining Date</span>
                            </div>
                            <input type="date" name="join_date" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">AC. Year</span>
                            </div>
                            <select class="form-control" name="year" onchange="getFee()">
                                <option value="">--Select--</option>
                                @foreach(activeYears() as $year)
                                    <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Passport</span>
                            </div>
                            <input type="text" name="passport" class="form-control" placeholder="Write Passport Number">
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Blood Group</span>
                            </div>
                            <select class="form-control" name="blood_group">
                                <option value="">--Select--</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Monthly Fee</span>
                            </div>
                            <input type="number" name="monthly_fee" id="monthly_fee" class="form-control" onclick="this.select()" onkeyup="calc()" onchange="calc()" value="0" min="0" step="1"/>
                            <div class="input-group-append">
                                <span class="input-group-text">BDT</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Discount</span>
                            </div>
                            <input type="number" name="discount" id="discount" class="form-control" onclick="this.select()" onkeyup="calc()" onchange="calc()" value="0" min="0" step="1"/>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Payable</span>
                            </div>
                            <input type="number" name="monthly_payable" id="monthly_payable" class="form-control" value="0" min="0" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">BDT</span>
                            </div>
                        </div>
                    </div>



{{--                    <div class="col col-lg-4 col-md-6 pr-md-0 mb-3">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text">AC. Session</span>--}}
{{--                            </div>--}}
{{--                            <select class="form-control" name="session_id">--}}
{{--                                <option value="">--Select--</option>--}}
{{--                                @foreach(activeSessions() as $session)--}}
{{--                                    <option value="{{ $session->id }}">{{ $session->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col col-lg-4 col-md-6 mb-3 pr-md-0">
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
