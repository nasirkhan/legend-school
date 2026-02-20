<div id="routineAddForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 text-primary"><i class="fa fa-book"></i>
                    Class: <span id="className"></span>,
                    Subject: <span id="subjectName"></span>,
                    Period Allocation Form
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('teacher-class-schedule-save') }}" method="POST">
                @csrf

                <div class="modal-body pb-0">
                    @foreach($days as $day)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $day->name }}</span>
                                    </div>
                                    <select class="form-control" name="period[{{ $day->id }}]">
                                        <option value="">--Select--</option>
                                        @foreach($periods as $period)
                                            <option value="{{ $period->id }}">
                                                {{ $period->name }} : {{ dateFormat($period->start,'g:i a') }} to {{ dateFormat($period->end,'g:i a') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="teacher_id"/>
                    <input type="hidden" name="class_id"/>
                    <input type="hidden" name="subject_id"/>
                    <input type="hidden" name="year" value="{{ siteInfo('running_year') }}"/>
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
