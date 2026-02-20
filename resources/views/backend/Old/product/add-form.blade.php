<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">
        Add New Product
    </h5>
    <form class="" action="{{ route('product-save') }}" method="POST">
        @csrf

        <div class="row mb-2">
            <div class="col-lg-3 pr-lg-0">
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

            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sub-Category</span>
                    </div>
                    <select name="sub_category_id" class="form-control" required>
                        <option value="">--Select--</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0">
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

            <div class="col-lg-3">
                <div class="row">
                    <div class="col pr-lg-0"><button type="button" id="add" class="btn btn-block btn-secondary"><i class="fa fa-plus"></i> Add Item</button></div>
                    <div class="col"><button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button></div>
                </div>
            </div>
        </div>

{{--        <div class="row mb-2">--}}

{{--            <div class="col-lg-4 pr-lg-0">--}}
{{--                <label class="sr-only" for="name">ক্যাটাগরি </label>--}}
{{--                <select name="category_id" class="form-control" onchange="subCategory()" required>--}}
{{--                    <option value="">--ক্যাটাগরি সিলেক্ট--</option>--}}
{{--                    @foreach(categories() as $category)--}}
{{--                        <option value="{{ $category->id }}">ক্যাটাগরি: {{ $category->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="col-lg-4 pr-lg-0">--}}
{{--                <label class="sr-only" for="name">সাব ক্যাটাগরি </label>--}}
{{--                <select name="sub_category_id" class="form-control" required>--}}
{{--                    <option value="">--সাব ক্যাটাগরি সিলেক্ট--</option>--}}
{{--                    @foreach(brands() as $brand)--}}
{{--                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="col col-md-2 pr-md-0">--}}
{{--                <button type="button" id="add" class="btn btn-block btn-secondary"><i class="fa fa-plus"></i> নতুন আইটেম</button>--}}
{{--            </div>--}}
{{--            <div class="col col-md-2">--}}
{{--                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> সেভ করুন</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div id="items">
{{--            <div class="row">--}}
{{--                <div class="col-lg-8 pr-lg-0">--}}
{{--                    <input type="text" name="name[]" placeholder="Name" class="form-control" required/>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4">--}}
{{--                    <select name="unit[]" class="form-control" required>--}}
{{--                        <option value="">--Select Unit of Measurement--</option>--}}
{{--                        @foreach(units() as $unit)--}}
{{--                            <option value="{{ $unit->id }}">Unit: {{ $unit->code }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </form>
</div>

<script>
    let index = 0;
    document.querySelector("#add").addEventListener('click',addItem);

    function addItem(){
        index++;
        let categoryId = $("form select[name=category_id]").val();
        let subCategoryId = $("form select[name=sub_category_id]").val();
        let brandId = $("form select[name=brand_id]").val();
        let item = '<div class="row mb-2 item" style="position:relative;" id="row'+index+'">' +
            '<button type="button" onclick="deleteItem('+index+')" class="row-delete-btn">&times;</button>' +

            '<div class="col-lg-4 pr-lg-0"><input type="text" name="name[]" placeholder="Product Name" class="form-control" required/></div>'+
            '<div class="col-lg-2 pr-lg-0"><input type="number" min="0" step="0.001" name="quantity[]" placeholder="Present Stock" class="form-control" required/></div>'+
            '<div class="col-lg-2 pr-lg-0"><input type="number" min="0" step="0.01" name="rate[]" placeholder="Rate" class="form-control" required/></div>'+

            '<div class="col-lg-2 pr-lg-0">'+
            '<select name="unit[]" class="form-control" required>'+
            '<option value="">--1st Unit--</option>'+
            @foreach(units() as $unit)
                '<option value="{{ $unit->id }}">1st Unit: {{ $unit->name }}</option>'+
            @endforeach
                '</select>'+
            '</div>'+

            '<div class="col-lg-2">'+
            '<select name="secondary_unit[]" class="form-control" required>'+
            '<option value="">--2nd Unit--</option>'+
            @foreach(units() as $unit)
                '<option value="{{ $unit->id }}">2nd Unit: {{ $unit->name }}</option>'+
            @endforeach
                '</select>'+
            '</div>'+

            '</div>';
        if(categoryId && subCategoryId && brandId){
            $("#items").append(item);
        }else {
            alert('Please select all field correctly !!!');
        }
    }

    /*
    function addItem(){
        index++;
        let categoryId = $("form select[name=category_id]").val();
        let subCategoryId = $("form select[name=sub_category_id]").val();
        let item = '<div class="row mb-2 item" style="position:relative;" id="row'+index+'">' +
            '<button type="button" onclick="deleteItem('+index+')" class="row-delete-btn">&times;</button>' +

            '<div class="col-lg-6 pr-lg-0"><input type="text" name="name[]" placeholder="পন্যের নাম" class="form-control" required/></div>'+

            '<div class="col-lg-3">'+
            '<select name="unit[]" class="form-control" required>'+
            '<option value="">--সিলেক্ট ১ম একক--</option>'+
                @foreach(units() as $unit)
                '<option value="{{ $unit->id }}">একক: {{ $unit->code }}</option>'+
                @endforeach
            '</select>'+
            '</div>'+

            '<div class="col-lg-3">'+
            '<select name="secondary_unit[]" class="form-control" required>'+
            '<option value="">--সিলেক্ট ২য় একক--</option>'+
                @foreach(units() as $unit)
                '<option value="{{ $unit->id }}">২য় একক: {{ $unit->code }}</option>'+
                @endforeach
            '</select>'+
            '</div>'+

            '</div>';
        if(categoryId && subCategoryId){
            $("#items").append(item);
        }else {
            alert('সকল ফিল্ড ঠিকমত সিলেক্ট করুন !!!');
        }
    }

    */

    function deleteItem(rowIndex){
        $("#row"+rowIndex).remove();
    }

    function category(rowIndex){
        let categoryId = $("#category"+rowIndex).val();
        if(categoryId){
            $('.loader').show();
            $.get("{{ route('get-sub-category') }}",{category_id:categoryId},(response)=>{
                $('.loader').hide();
                let options = '<option value="">--Sub Category--</option>'
                for (let item in response){
                    options += '<option value="'+response[item].id+'">'+response[item].name+'</option>';
                }
                $("#subCategory"+rowIndex).empty().append(options);
            });
        }

    }
</script>
