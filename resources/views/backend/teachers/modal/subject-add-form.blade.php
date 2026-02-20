<div id="subjectAddForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 text-primary"><i class="fa fa-book"></i> Subject Allocation Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('teacher-class-subject-save') }}" method="POST">
                @csrf

                <div class="modal-body pb-0">
                    @foreach($classes as $class)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 15%">
                                        <span class="input-group-text">Class-{{ $class->code }}</span>
                                    </div>
                                    <select
                                        class="select2"
                                        multiple="multiple" data-placeholder="Select Subjects . . . "
                                        style="width: 85%"  name="subject[{{ $class->id }}][]"
                                    >
                                        <option value="">--Select--</option>
                                        @foreach($class->classSubjects as $subject)
                                            <option value="{{ $subject->pivot->subject_id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="id"/>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" ><i class="fa fa-recycle"></i> Reset</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> Save Change</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
