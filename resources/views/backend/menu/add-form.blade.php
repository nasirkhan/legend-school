<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Menu</h5>
    <form class="" action="{{ route('menu-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Menu Title</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Menu Title" required>
                </div>
            </div>

            <div class="col col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Position</span>
                    </div>
                    <input type="number" name="position" placeholder="Menu Position" class="form-control" value="{{ old('position') }}" required/>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
