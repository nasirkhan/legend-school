<script>
    let updatedData = {}

    function edit(obj){
        let item = JSON.parse(obj.item);
        $("#addForm").hide()
        $("#editForm input[name='id']").val(item.id)
        $("#editForm select[name='year']").val(item.year)
        $("#editForm select[name='class_id']").val(item.class_id)
        $("#editForm select[name='item_id']").val(item.item_id)
        $("#editForm input[name='amount']").val(item.amount)
        $("#editForm").show()
    }

    function editAfterUpdate(id){
        let item = updatedData[id];
        $("#addForm").hide()
        $("#editForm input[name='id']").val(item.id)
        $("#editForm select[name='year']").val(item.year)
        $("#editForm select[name='class_id']").val(item.class_id)
        $("#editForm select[name='item_id']").val(item.item_id)
        $("#editForm input[name='amount']").val(item.amount)
        $("#editForm").show()
    }

    function statusUpdateConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this transaction item status ?",
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
      $.get("{{ route('class-wise-item-status-update') }}",{id:id,sl:sl}, (response)=>{
          // console.log(response);
          updatedData[id] = response.item;
          // console.log(response.item);

        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();

        temp[4] = `<span class="${response.badge_classes}">${response.status}</span>`;
        temp[5] = `<button onclick="statusUpdateConfirmation(${id},${sl})" class="mr-1 ${response.btn_classes}"><i class="${response.fa_classes}"></i> </button>` +
          '<button onclick="editAfterUpdate('+id+')" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
          `<button onclick="itemDeleteConfirmation(${id},${sl})" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>`;

        table.row((sl-1)).data(temp).draw();
        $(".loader").hide();
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Transaction Item from this class?",
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
        $.get("{{ route('class-wise-item-delete') }}",{id:id,sl:sl}, (response)=>{
            if (response.success){
                console.log(response);
                let table = $("#datatable").DataTable();
                table.row((sl-1)).remove().draw();
                $(".loader").hide();
            }
        }).then((response)=>{
            $(".loader").hide();
            Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
        });
    }

    function classWiseItems(e){
        let year = $("select[name=year]").val();
        let class_id = e.value;
        if (class_id && year){
            $(".loader").show();
            $.get("{{ route('get-class-wise-items') }}",{year:year,class_id:class_id}, (response)=>{
                // console.log(response);
                // console.log('Yes');
                $("#table").empty().html(response);
                $("#datatable").dataTable(dataTableOptions);
            })
        }
    }
</script>
