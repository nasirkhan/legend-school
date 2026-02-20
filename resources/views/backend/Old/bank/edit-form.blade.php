<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Bank Edit Form <button onclick="showAddForm()" class="btn btn-sm btn-secondary">Add New</button></h5>
    <form class="" action="{{ route('bank-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <label class="sr-only" for="name">Bank Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" required>
            </div>

            <div class="col-lg-2">
                <label class="sr-only" for="name">Bank Code</label>
                <input type="text" name="code" class="form-control" id="name" placeholder="Enter Code" required>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col-lg-2">
                <div class="form-group row">
                    <div class="col"><button type="submit" class="btn btn-block btn-primary mr-2">Update</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
