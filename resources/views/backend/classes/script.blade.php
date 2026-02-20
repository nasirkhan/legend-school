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
                updatedData = response;
                let table = $("#datatable").DataTable();
                let sl = '<td>'+response.sl+'</td>';
                let name = '<td>'+response.name+'</td>';
                let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
                let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';

                let tr = table.row.add( [ sl, name, status, action ] ).draw().node();
                table.column(2).nodes().to$().addClass('text-center');
                table.column(3).nodes().to$().addClass('text-right');
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

    function edit(obj,sl) {
      data = JSON.parse(obj);
      editForm(sl)
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(data.name);
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

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this class status ?",
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
      $.get("{{ route('class-status-update') }}",{id:id,sl:sl}, (response)=>{
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
            text: "Do you want to delete this class ?",
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
      $.get("{{ route('class-delete') }}",{id:id,sl:sl}, (response)=>{
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

    function subjectAddIntoClass(id,sl,name){
        let remDivCss = 'custom-control custom-checkbox  custom-checkbox-danger mb-2'
        let divCss = 'custom-control custom-checkbox  custom-checkbox-success mb-2'
        let inputCss = 'custom-control-input'
        let labelCss = 'custom-control-label'
        let usedSubjects = ''
        let usedSubjectCodes = ''
        let unusedSubjects = ''
        let unusedSubjectCode = ''
        $(".loader").show();
        $.get("{{ route('get-class-subjects') }}",{id:id,sl:sl}, (response)=>{
            if (response.success){
                $(".loader").hide();
                for (let i in response.unused){
                    let item = response.unused[i]
                    unusedSubjects += `
<div class="${divCss}">
<input type="checkbox" class="${inputCss}" id="unused-${item.id}" name="selected[${item.id}]">
<label class="${labelCss}" for="unused-${item.id}">${item.name}</label>-<input type="text" style="width: 110px" class="border border-secondary rounded px-2" name="selected_code[${item.id}]" placeholder="Subject Code"/>
</div>`
                }

                for (let j in response.used){
                    let selectedItem = response.used[j]
                    usedSubjects += `
<div class="${remDivCss}">
<input type="checkbox" class="${inputCss}" id="used-${selectedItem.subject_class_id}" name="removed[${selectedItem.subject_class_id}]">
<label class="${labelCss}" for="used-${selectedItem.subject_class_id}">${selectedItem.name} - ${selectedItem.sub_code}</label>
<input type="text" style="width: 120px" class="border border-secondary rounded px-2" name="used_subject_code[${selectedItem.subject_class_id}]" value="" placeholder="New Sub Code"/>
</div>`
                }
                $('#subjectAddForm .modal-title').find('span').text(name)
                $('#subjectAddForm .modal-body').find('input[name=class_id]').val(id)
                $('#subjectAddForm .modal-body').find('#remove').html(usedSubjects)
                $('#subjectAddForm .modal-body').find('#select').html(unusedSubjects)
                $('#subjectAddForm').modal('show')
            }
        }).then((response)=>{
            // Swal.fire('Message', 'Data loaded successfully', 'success');
            // Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
        });
    }

    function subjectLab(obj){
        let class_id = obj.class_id;
        let class_name = obj.class_name;
        let class_subjects = JSON.parse(obj.subjects);
        $("#labSubjectAddForm .modal-title").find('span').text(class_name)
        $("#labSubjectAddForm .modal-body").find('input[name=class_id]').val(class_id)
        // console.log

        let subjects = ``

        for (const subjectsKey in class_subjects) {
            let class_subject = class_subjects[subjectsKey]
            subjects +=
                `<div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" ${class_subject.lab_status==1?'checked':''} class="" name="class_subject_id[]" value="${class_subject.id}">
                        </span>
                    </div>
                    <input type="text" class="form-control bg-white" value="${class_subject.subject.name}" readonly>
                </div>`
        }

        $('#labSubjectAddForm #labSelect').html(subjects)
        $('#labSubjectAddForm').modal('show')
    }
</script>

