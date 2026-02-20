<div class="modal-content">
    <form id="edit" action="{{ route('product-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id"/>
        <div class="modal-header">
            <h5 class="modal-title mb-0 text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Product Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-0">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Category</span>
                            </div>
                            <select name="category_id" class="form-control" onchange="subCategory()" required>
                                <option value="">--Select--</option>
                                @foreach(categories() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sub Category</span>
                            </div>
                            <select name="sub_category_id" class="form-control" required>
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Company</span>
                        </div>
                        <select name="brand_id" class="form-control" required>
                            <option value="">--Select--</option>
                            @foreach(brands() as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="" placeholder="Product Name">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Purchase Unit</span>
                            </div>
                            <select name="unit_id" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach(units() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sale Unit</span>
                            </div>
                            <select name="secondary_unit_id" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach(units() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Initial Stock</span>
                            </div>
                            <input type="text" name="initial_quantity" class="form-control" value="" placeholder="Initial Stock">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Unit Cost Price</span>
                            </div>
                            <input type="text" name="rate" class="form-control" value="" placeholder="Unit Cost Price">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Unit Sale Price</span>
                            </div>
                            <input type="text" name="sale_rate" class="form-control" onclick="this.select()" value="" placeholder="Unit Sale Price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        </div>
    </form>
</div>
