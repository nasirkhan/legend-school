<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Section Edit Form</h5>
    <form class="" action="{{ route('batch-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Class</span>
                    </div>
                    <select name="class_id" class="form-control" id="class_id" required>
                        <option value="">--Select--</option>
                        @foreach(classes() as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Section Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Enter Section Name" required>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
