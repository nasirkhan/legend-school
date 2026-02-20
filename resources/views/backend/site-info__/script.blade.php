<script>
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
      $("#editForm form input[name=property]").val(data.property);
      if (data.type!='textarea'){
          $("#editForm form input[name=value]").prop("type", data.type);
          $("#editor").hide();
      }else {
          $("#editor").show();
      }

      if (data.type!='file'){
          if (data.type!='textarea'){
              $("#editForm form input[name=value]").val(data.value);
          }else {
              $("#editForm form input[name=value]").val('value');
              $("#editForm form input[name=value]").prop("readonly", true);
              $("#editForm form .note-editable").html(data.value);
          }
      }
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=property]").val(updatedData.property);
      $("#editForm form input[name=value]").prop("type", updatedData.type);
      $("#editForm form input[name=value]").val(updatedData.value);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    // $("#editForm form").submit(function (e) {
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
    //       updatedData = response;
    //       let table = $("#datatable").DataTable();
    //       let temp = table.row((response.sl-1)).data();
    //       temp[0] = response.sl; temp[1] = response.name; temp[2] = response.code;
    //       temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
    //       temp[4] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
    //         '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
    //         '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
    //       table.row((response.sl-1)).data(temp).draw();
    //
    //       $(".loader").hide();
    //       $("#editForm form").trigger('reset');
    //     }
    //   });
    // });

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
    //       updatedData = response;
    //       let table = $("#datatable").DataTable();
    //         let sl = '<td>'+response.sl+'</td>';
    //         let brand = '<td>'+response.name+'</td>';
    //         let code = '<td>'+response.code+'</td>';
    //         let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
    //         let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
    //             '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
    //             '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';
    //
    //        let tr = table.row.add( [ sl, brand, code, status, action ] ).draw().node();
    //         table.column(3).nodes().to$().addClass('text-center');
    //         table.column(4).nodes().to$().addClass('text-right');
    //         $(tr).addClass('text-primary');
    //
    //       $(".loader").hide();
    //       $("#addForm form").trigger('reset');
    //     }
    //   });
    // });

    {{--function statusUpdateConfirmation(id,sl){--}}
    {{--  Swal.fire({--}}
    {{--    title: 'Are you sure?',--}}
    {{--    text: "Do you want to update this Brand status ?",--}}
    {{--    icon: 'warning',--}}
    {{--    showCancelButton: true,--}}
    {{--    confirmButtonColor: '#3085d6',--}}
    {{--    cancelButtonColor: '#d33',--}}
    {{--    confirmButtonText: 'Yes Update'--}}
    {{--  }).then((result) => {--}}
    {{--    if (result.isConfirmed) {--}}
    {{--      statusUpdate(id,sl);--}}
    {{--    }--}}
    {{--  });--}}
    {{--}--}}

    {{--function statusUpdate(id,sl) {--}}
    {{--  $(".loader").show();--}}
    {{--  $.get("{{ route('brand-status-update') }}",{id:id,sl:sl}, (response)=>{--}}
    {{--    updatedData = response;--}}
    {{--    let table = $("#datatable").DataTable();--}}
    {{--    let temp = table.row((sl-1)).data();--}}
    {{--    temp[0] = sl; temp[1] = response.name; temp[2] = response.code;--}}
    {{--    temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';--}}
    {{--    temp[4] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +--}}
    {{--      '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +--}}
    {{--      '<button class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';--}}
    {{--    table.row((sl-1)).data(temp).draw();--}}
    {{--    $(".loader").hide();--}}
    {{--  }).then((response)=>{--}}
    {{--    Swal.fire(response.sa_title, response.sa_message, response.sa_icon);--}}
    {{--  });--}}
    {{--}--}}

    {{--function itemDeleteConfirmation(id,sl){--}}
    {{--    Swal.fire({--}}
    {{--        title: 'Are you sure?',--}}
    {{--        text: "Do you want to delete this brand ?",--}}
    {{--        icon: 'warning',--}}
    {{--        showCancelButton: true,--}}
    {{--        confirmButtonColor: '#3085d6',--}}
    {{--        cancelButtonColor: '#d33',--}}
    {{--        confirmButtonText: 'Yes Delete'--}}
    {{--    }).then((result) => {--}}
    {{--        if (result.isConfirmed) {--}}
    {{--            itemDelete(id,sl);--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

    {{--function itemDelete(id,sl) {--}}
    {{--  $(".loader").show();--}}
    {{--  $.get("{{ route('brand-delete') }}",{id:id,sl:sl}, (response)=>{--}}
    {{--      if (response.success){--}}
    {{--          console.log(response);--}}
    {{--          let table = $("#datatable").DataTable();--}}
    {{--          table.row((sl-1)).remove().draw();--}}
    {{--          $(".loader").hide();--}}
    {{--      }--}}
    {{--  }).then((response)=>{--}}
    {{--    Swal.fire(response.sa_title, response.sa_message, response.sa_icon);--}}
    {{--  });--}}
    {{--}--}}
</script>
