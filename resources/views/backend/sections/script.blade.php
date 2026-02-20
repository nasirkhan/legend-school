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
                console.log(response);
                updatedData = response;

                let table = $("#datatable").DataTable();
                let sl = '<td>'+response.sl+'</td>';
                let name = '<td>'+response.name+'</td>';
                let class_name = '<td></td>';
                let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
                let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';

                let tr = table.row.add( [ sl, name, class_name, status, action ] ).draw().node();
                table.column(3).nodes().to$().addClass('text-center');
                table.column(4).nodes().to$().addClass('text-right');
                $(tr).addClass('text-primary');

                $(".loader").hide();
                $("#addForm form").trigger('reset');
            }
        });
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
                let classes = '<ul>'

                for (let i = 0; i<response.classes.length; i++){
                    let item = response.classes[i]
                    classes +=`<li>${item.name}</li>`
                }

                classes += '</ul>'

                temp[0] = response.sl; temp[1] = response.name; temp[2] = classes;
                temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
                temp[4] = '<button onclick="classAddIntoSection('+response.id+','+response.sl+','+response.name+')" class="mr-1 btn btn-sm btn-secondary" title="Add Classes To The Section"><i class="fa fa-plus"></i></button>' +
                    '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
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
      $("#editForm form input[name=name]").val(data.name);
      $("#editForm form select[name=result_type]").val(data.result_type);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form select[name=result_type]").val(updatedData.result_type);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this section status ?",
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
      $.get("{{ route('section-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();

          let classes = '<ul>'

          for (let i = 0; i<response.classes.length; i++){
              let item = response.classes[i]
              classes +=`<li>${item.name}</li>`
          }

          classes += '</ul>'

        temp[0] = sl; temp[1] = response.name; temp[2] = classes;
        temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[4] = '<button onclick="classAddIntoSection('+response.id+','+response.sl+','+response.name+')" class="mr-1 btn btn-sm btn-secondary" title="Add Classes To The Section"><i class="fa fa-plus"></i></button>' +
            '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
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
            text: "Do you want to delete this section ?",
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
      $.get("{{ route('section-delete') }}",{id:id,sl:sl}, (response)=>{
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

    function classAddIntoSection(id,sl,name){
        let remDivCss = 'custom-control custom-checkbox  custom-checkbox-danger mb-2'
        let divCss = 'custom-control custom-checkbox  custom-checkbox-success mb-2'
        let inputCss = 'custom-control-input'
        let labelCss = 'custom-control-label'
        let usedClasses = ''
        let unusedClasses = ''
        $(".loader").show();
        $.get("{{ route('get-section-classes') }}",{id:id,sl:sl}, (response)=>{
            if (response.success){
                $(".loader").hide();
                for (let i = 0; i<response.result.length; i++){
                    let item = response.result[i]
                    unusedClasses += `
<div class="${divCss}">
<input type="checkbox" class="${inputCss}" id="unused-${item.id}" name="selected[${item.id}]">
<label class="${labelCss}" for="unused-${item.id}">${item.name}</label>
</div>`
                }

                for (let j = 0; j<response.selectedClasses.length; j++){
                    let selectedItem = response.selectedClasses[j]
                    usedClasses += `
<div class="${remDivCss}">
<input type="checkbox" class="${inputCss}" id="used-${selectedItem.id}" name="removed[${selectedItem.id}]">
<label class="${labelCss}" for="used-${selectedItem.id}">${selectedItem.name}</label>
</div>`
                }
                $('#classAddForm .modal-title').find('span').text(name)
                $('#classAddForm .modal-body').find('input[name=section_id]').val(id)
                $('#classAddForm .modal-body').find('#remove').html(usedClasses)
                $('#classAddForm .modal-body').find('#select').html(unusedClasses)
                $('#classAddForm').modal('show')

            }
        }).then((response)=>{
            // Swal.fire('Message', 'Data loaded successfully', 'success');
            // Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
        });
    }
</script>
