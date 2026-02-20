<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Period</h5>
    <form class="" action="{{ route('period-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Section</span>
                    </div>
                    <select class="form-control" name="section_id" required>
                        <option value="">--Select--</option>
                        @foreach(activeSections() as $section)
                            <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-lg-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Period Name" required>
                </div>
            </div>

            <div class="col col-lg-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Period Code" required>
                </div>
            </div>

            <div class="col col-lg-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Start</span>
                    </div>
                    <input type="time" name="start" class="form-control" id="start" value="{{ old('start') }}" required>
                </div>
            </div>

            <div class="col col-lg-2 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">End</span>
                    </div>
                    <input type="time" name="end" class="form-control" id="end" value="{{ old('end') }}" required>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
