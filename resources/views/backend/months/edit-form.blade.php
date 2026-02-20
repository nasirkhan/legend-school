<div class="card-body" id="editForm" style="">
    <h5 class="card-title text-primary mb-3">Month Edit Form</h5>
    <form class="" action="{{ route('month-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month Name</span>
                    </div>
                    <input type="text" name="name" placeholder="Enter name" class="form-control" required/>
                </div>
            </div>

            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month Code</span>
                    </div>
                    <input type="text" name="code" placeholder="Enter code" class="form-control" required/>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
