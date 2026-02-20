<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable( {
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
      editForm(sl);
    }

    function showAddForm(){
        $("#addForm").show();
        $("#editForm").hide();
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form select[name=bank_id]").val(data.bank_id);
      $("#editForm form input[name=ac_name]").val(data.ac_name);
      $("#editForm form input[name=ac_no]").val(data.ac_no);
      $("#editForm form input[name=branch]").val(data.branch);
      $("#editForm form input[name=address]").val(data.address);
      $("#editForm form input[name=contact_no]").val(data.contact_no);
      $("#editForm form input[name=initial_balance]").val(data.initial_balance);
        $("#editForm form select[name=balance_type]").val(data.type);
        $("#editForm form input[name=last_transaction_date]").val(data.last_transaction_date);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
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
          temp[0] = response.sl; temp[1] = response.name;
          temp[2] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
          temp[3] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
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
    //
    //       updatedData = response;
    //       let table = $("#datatable").DataTable();
    //         let sl = '<td>'+response.sl+'</td>';
    //         let bank = '<td>'+response.bank.code+'</td>';
    //         let accountName = '<td>'+response.ac_name+'</td>';
    //         let accountNumber = '<td>'+response.ac_no+'</td>';
    //         let branch = '<td>'+response.branch+'</td>';
    //         let address = '<td>'+response.address+'</td>';
    //         let contactNo = '<td>'+response.contact_no+'</td>';
    //         let debit = ''; let credit = '';
    //         if (response.type=='Debit'){
    //             debit = '<td>'+response.initial_balance+'</td>';
    //             credit = '<td></td>';
    //         }else {
    //             debit = '<td></td>';
    //             credit = '<td>'+response.initial_balance+'</td>';
    //         }
    //         let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
    //         let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
    //             '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
    //             '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';
    //
    //        let tr = table.row.add( [ sl,bank,accountName,accountNumber,branch,address,contactNo,debit,credit,status,action ] ).draw().node();
    //         table.column(7).nodes().to$().addClass('text-right');
    //         table.column(8).nodes().to$().addClass('text-right');
    //        table.column(9).nodes().to$().addClass('text-center');
    //         table.column(10).nodes().to$().addClass('text-right');
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
        text: "Do you want to update this category status ?",
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
      $.get("{{ route('bank-account-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        temp[0] = sl; temp[1] = response.name;
        temp[2] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[3] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
          '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
          '<button class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
        table.row((sl-1)).data(temp).draw();
        $(".loader").hide();
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this category ?",
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
      $.get("{{ route('bank-account-delete') }}",{id:id,sl:sl}, (response)=>{
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
</script>
