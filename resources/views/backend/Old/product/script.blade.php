<script>
    let dataTableOptions = {
        lengthChange: true,
        responsive: true,
        searching: true,
        paging: true,
        scrollY: !1,
        pageLength: 25,
        ordering:false,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
        dom: 'Blfrtip',
        buttons: [
            'colvis',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'MS Excel'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
    };
    $(document).ready(function() {
        var table = $('#datatable').DataTable(dataTableOptions);
    } );

    let data =  null, updatedData = null;

    function sweetAlert(title,text,icon,buttonText){
      Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'
      });
    }

    function edit(obj,sl) {
        data = JSON.parse(obj);
        console.log(data);
        $('#edit input[name=name]').val(data.name);
        // $('#edit select[name=type]').val(data.type);
        $('#edit select[name=category_id]').val(data.category_id);
        $('#edit select[name=brand_id]').val(data.brand_id);
        let subCategory = '<option value="'+data.sub_category_id+'">'+data.sub_category.name+'</option>';
        $('#edit select[name=sub_category_id]').empty().append(subCategory);
        $('#edit select[name=unit_id]').val(data.unit_id);
        $('#edit select[name=secondary_unit_id]').val(data.secondary_unit_id);
        $('#edit input[name=initial_quantity]').val(data.initial_quantity);
        $('#edit input[name=rate]').val(data.rate);
        $('#edit input[name=sale_rate]').val(data.sale_rate);
        $('#edit input[name=id]').val(data.id);
        $('#modal').modal('show');
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(data.name);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form select[name=category_id]").val(data.category_id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form select[name=category_id]").val(updatedData.category_id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    $("form#edit").submit(function (e) {
        e.preventDefault();
        $('.loader').show();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        let method = $(this).attr('method');
        $.ajax({
            type : method,
            url  : url,
            data : data,
            success: (response) => {
                $('#modal').modal('hide');
                $('#table').empty().append(response);
                $('#datatable').dataTable(dataTableOptions);
                $(".loader").hide();
            }
        }).then(()=>{
            Swal.fire({
                title: 'Success!',
                text: 'Product Updated Successfully',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    });

    function statusUpdateConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this product status ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Update'
        }).then((result) => {
            if (result.isConfirmed) {
                statusUpdate(id,sl);
            }
        });
    }

    function statusUpdate(id,sl) {
        $(".loader").show();
        $.get("{{ route('product-status-update') }}",{id:id,sl:sl}, (response)=>{
            $('#table').empty().append(response);
            $("#datatable").DataTable(dataTableOptions);
            $(".loader").hide();
        }).then((response)=>{
            Swal.fire('Message', 'Status updated successfully', 'success');
        });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this product ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                itemDelete(id,sl);
            }
        });
    }

    function itemDelete(id,sl) {
        $(".loader").show();
        $.get("{{ route('product-delete') }}",{id:id,sl:sl}, (response)=>{
            $('#table').empty().append(response);
            $("#datatable").DataTable(dataTableOptions);
            $(".loader").hide();
        }).then((response)=>{
            Swal.fire('Message', 'Product deleted successfully', 'success');
        });
    }

    function subCategory(){
        let categoryId = $("form select[name=category_id]").val();
        let options = '<option value="">--Select--</option>';
        if (categoryId){
            $('.loader').show();
            $.get("{{ route('get-sub-category') }}",{category_id:categoryId},(response)=>{
                $('.loader').hide();
                for (let i in response){
                    options += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                }
            }).then(()=>{
                $("form select[name=sub_category_id]").empty().append(options);
            });
        }
    }

    function salePriceUpdate(id){
        alert(id);
    }
</script>
