<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Exam Paper Edit Form</h5>
    <form class="" action="{{ route('paper-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-10 pr-lg-0 mb-3">
                <div class="row">
                    <div class="col-lg pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Comp.</span>
                            </div>
                            <input type="text" name="name" class="form-control" id="name_edit" placeholder="Write component name" required/>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Code</span>
                            </div>
                            <input type="text" name="code" class="form-control" id="code_edit" placeholder="Component code"/>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mark</span>
                            </div>
                            <input type="number" name="mark" class="form-control" id="mark_edit" placeholder="Component mark" required/>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Weight</span>
                            </div>
                            <input type="number" name="weight" class="form-control" id="mark_edit" placeholder="Component Weight" required/>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Serial</span>
                            </div>
                            <input type="number" name="serial" class="form-control" id="mark_edit" placeholder="1 or 2 etc." required/>
                        </div>
                    </div>

                    <input type="hidden" name="id"> <input type="hidden" name="sl">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="row">
                    <div class="col-lg pr-lg-1"><button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button></div>
                    <div class="col-lg pl-lg-1">
                        <button type="button" class="btn btn-block btn-secondary" onclick="showAddForm()">
                            <i class="fa fa-arrow-circle-left"></i> Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
