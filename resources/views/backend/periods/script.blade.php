<script>
    let data =  null, updatedData = null;

    $("#addForm form").submit(function (e) {
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

                // console.log(response)

                updatedData = response;
                let table = $("#datatable").DataTable();
                let sl = '<td>'+response.sl+'</td>';
                let section = '<td>'+response.section.name+'</td>';
                let name = '<td>'+response.name+'</td>';
                let code = '<td>'+response.code+'</td>';
                let start = '<td>'+convertTo12HourFormat(response.start)+'</td>';
                let end = '<td>'+convertTo12HourFormat(response.end)+'</td>';
                let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
                let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';

                let tr = table.row.add( [ sl, section, name, code, start, end, status, action ] ).draw().node();
                table.column(6).nodes().to$().addClass('text-center');
                table.column(7).nodes().to$().addClass('text-right');
                $(tr).addClass('text-primary');

                $(".loader").hide();
                $("#addForm form").trigger('reset');
            }
        });
    });

    const formatter = new Intl.DateTimeFormat('en-US', {
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
    });

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
                temp[0] = response.sl; temp[1] = response.section.name; temp[2] = response.name; temp[3] = response.code;
                temp[4] = convertTo12HourFormat(response.start); temp[5] = convertTo12HourFormat(response.end);
                temp[6] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
                temp[7] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
                table.row((response.sl-1)).data(temp).draw();

                $(".loader").hide();
                $("#editForm form").trigger('reset');
            }
        });
    });

    function edit(obj,sl) {
      data = JSON.parse(obj);
      editForm(sl)
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form select[name=section_id]").val(data.section_id);
      $("#editForm form input[name=name]").val(data.name);
      $("#editForm form input[name=code]").val(data.code);
      $("#editForm form input[name=start]").val(data.start);
      $("#editForm form input[name=end]").val(data.end);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form select[name=section_id]").val(data.section_id);
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form input[name=code]").val(updatedData.code);
      $("#editForm form input[name=start]").val(data.start);
      $("#editForm form input[name=end]").val(data.end);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this day status ?",
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
      $.get("{{ route('period-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        // temp[0] = sl; temp[1] = response.name; temp[2] = response.code;
        // temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        // temp[4] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
        //   '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
        //   '<button class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
        // table.row((sl-1)).data(temp).draw();


          temp[0] = response.sl; temp[1] = response.section.name; temp[2] = response.name; temp[3] = response.code;
          temp[4] = convertTo12HourFormat(response.start); temp[5] = convertTo12HourFormat(response.end);
          temp[6] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
          temp[7] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
              '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
              '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
          table.row((response.sl-1)).data(temp).draw();

        $(".loader").hide();
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this day ?",
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
      $.get("{{ route('day-delete') }}",{id:id,sl:sl}, (response)=>{
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
