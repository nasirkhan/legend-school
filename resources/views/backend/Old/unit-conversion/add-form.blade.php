<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Unit Conversion Rule Add Form</h5>
    <form class="" action="{{ route('unit-conversion-save') }}" method="POST">
        @csrf
        <div class="row mb-2">
            <div class="col-lg-8 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 60px;">From </span>
                    </div>
                    <select name="from" id="from" class="form-control" required>
                        <option value="">--Select--</option>
                        @foreach(units() as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-2 pr-md-0">
                <button type="button" id="add" class="btn btn-block btn-secondary"><i class="fa fa-plus"></i> Add Item</button>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

        <div id="items">
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text" style="width: 80px;">To Unit</span>--}}
{{--                        </div>--}}
{{--                        <select name="unit[]" class="form-control" required>--}}
{{--                            <option value="">--Select--</option>--}}
{{--                            @foreach(units() as $unit)--}}
{{--                                <option value="{{ $unit->id }}">{{ $unit->code }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <input type="number" name="factor[]" min="0" step="0.00000000001" placeholder="Factor" class="form-control">--}}
{{--                    </div>--}}
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
        let from = $("#from").val();
        let item = '<div class="row item mb-2" style="position:relative;" id="row'+index+'"><button type="button" onclick="deleteItem('+index+')" class="row-delete-btn">&times;</button>'+
            '<div class="col-12"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="width: 60px;">To </span></div>'+
            '<select name="unit[]" class="form-control" required><option value="">--Select--</option>'+
            @foreach(units() as $unit)
                '<option value="{{ $unit->id }}">{{ $unit->name }}</option>'+
            @endforeach
                '</select>'+
            '<input type="number" name="factor[]" min="0" step="0.00000000001" placeholder="Factor" class="form-control" required>'+
            '</div></div></div>';
        if(from){
            $("#items").append(item);
        }else {
            alert('From Unit Must Be Selected !!!');
        }
    }

    function deleteItem(rowIndex){
        $("#row"+rowIndex).remove();
    }
</script>
