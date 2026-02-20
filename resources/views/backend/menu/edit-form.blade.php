<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Menu Edit Form</h5>
    <form class="" action="{{ route('menu-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Menu Title</span>
                    </div>
                    <input type="text" name="name" placeholder="Enter Menu Title" class="form-control" required/>
                </div>
            </div>
            <div class="col col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Position</span>
                    </div>
                    <input type="number" name="position" placeholder="Menu Position" class="form-control" required/>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
