<div id="studentEditForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <form action="{{ route('private-student-update') }}" method="post" style="width: 100%">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 text-primary"><i class="fa fa-user-check"></i> Student Info Correction<span id="title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Candidate Name</span>
                        </div>
                        <input name="name" type="text" class="form-control" required placeholder="Write candidate name here"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Academic Session</span>
                        </div>
                        <select class="form-control pl-2" name="year">
                            <option value="">--Select--</option>
                            @foreach(activeYears() as $year)
                                <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>
                                    {{ $year->year }} - {{ $year->year+1 }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Candidate Number</span>
                        </div>
                        <input name="candidate_no" type="text" class="form-control" required placeholder="Write candidate number here"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend" style="width: 10%">
                            <span class="input-group-text" style="width: 100%">Subject</span>
                        </div>
                        <select class="select2 form-control" multiple="multiple"  name="subject_id[]" required style="width: 90%">
                            <option value="">--Select--</option>
                            @foreach(activeSubjects(1) as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->sub_code }} : {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date of Birth</span>
                        </div>
                        <input name="date_of_birth" type="date" class="form-control" required/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date of Admission to School</span>
                        </div>
                        <input name="date_of_admission" type="date" class="form-control" required/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date of Graduation</span>
                        </div>
                        <input name="date_of_graduation" type="date" class="form-control" required/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nationality</span>
                        </div>
                        <input name="nationality" type="text" class="form-control" required placeholder="Write candidate nationality here"/>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Passport Number(Optional)</span>
                        </div>
                        <input name="passport" type="text" class="form-control" placeholder="Write candidate passport no. here"/>
                    </div>

                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
