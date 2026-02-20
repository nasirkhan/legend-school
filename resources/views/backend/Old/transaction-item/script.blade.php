<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable( {
            lengthChange: true,
            responsive: true,
            searching: true,
            paging: true,
            scrollY: !1,
            pageLength: 25,
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
        } );
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
      editForm(sl)
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form select[name=transaction_sector_id]").val(data.transaction_sector_id);
      $("#editForm form input[name=account_name]").val(data.account_name);
      $("#editForm form select[name=account_type]").val(data.account_type);
      $("#editForm form input[name=mobile]").val(data.mobile);
      $("#editForm form input[name=address]").val(data.address);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form select[name=transaction_sector_id]").val(updatedData.transaction_sector_id);
      $("#editForm form input[name=account_name]").val(updatedData.account_name);
      $("#editForm form input[name=account_type]").val(updatedData.account_type);
      $("#editForm form input[name=mobile]").val(updatedData.mobile);
      $("#editForm form input[name=address]").val(updatedData.address);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    $("#editForm form").submit(function (e) {
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
          updatedData = response;
          let table = $("#datatable").DataTable();
          let temp = table.row((response.sl-1)).data();
          let type = response.account_type == 'Debit'? 'ডেবিট' : 'ক্রেডিট';
          temp[0] = response.sl; temp[1] = response.sector.name; temp[2] = response.account_name; temp[3] = type;
          temp[4] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt +'</span>';
          temp[5] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
            '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
            '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
          table.row((response.sl-1)).data(temp).draw();

          $(".loader").hide();
          $("#editForm form").trigger('reset');
        }
      });
    });

    // $("#addForm form").submit(function (e) {
    //   e.preventDefault();
    //   $('.loader').show();
    //   let url = $(this).attr('action');
    //   let data = $(this).serialize();
    //   let method = $(this).attr('method');
    //   $.ajax({
    //     type : method,
    //     url  : url,
    //     data : data,
    //     success: (response) => {
    //         console.log(response);
    //
    //       updatedData = response;
    //       let table = $("#datatable").DataTable();
    //         let sl = '<td>'+response.sl+'</td>';
    //         let sector = '<td>'+response.sector.name+'</td>';
    //         let name = '<td>'+response.account_name+'</td>';
    //         let accountType = '<td>'+response.account_type+'</td>';
    //         let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
    //         let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
    //             '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
    //             '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';
    //
    //        let tr = table.row.add( [ sl, sector, name, accountType, status, action ] ).draw().node();
    //         table.column(4).nodes().to$().addClass('text-center');
    //         table.column(5).nodes().to$().addClass('text-right');
    //         $(tr).addClass('text-primary');
    //
    //       $(".loader").hide();
    //       $("#addForm form").trigger('reset');
    //     }
    //   });
    // });

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this unit status ?",
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
      $.get("{{ route('transaction-sector-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        temp[0] = sl; temp[1] = response.account_name;
        temp[2] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[3] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
          '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
          '<button onclick="itemDeleteConfirmation('+id+','+sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
        table.row((sl-1)).data(temp).draw();
        $(".loader").hide();
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this unit ?",
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
      $.get("{{ route('transaction-sector-delete') }}",{id:id,sl:sl}, (response)=>{
          if (response.success){
              console.log(response);
              let table = $("#datatable").DataTable();
              table.row((sl-1)).remove().draw();
              $(".loader").hide();
          }
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    $("#transaction_sector_id").change(function () {
        let sector = $(this).val();
        if (sector=='new'){
            $("#newSectorName").show();
        }else {
            $("#newSectorName").hide();
        }
    });
</script>
