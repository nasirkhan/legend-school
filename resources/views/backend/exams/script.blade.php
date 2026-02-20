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
                let code = '<td>'+response.code+'</td>';
                let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
                let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';

                let tr = table.row.add( [ sl, name, code, status, action ] ).draw().node();
                table.column(2).nodes().to$().addClass('text-center');
                table.column(3).nodes().to$().addClass('text-center');
                table.column(4).nodes().to$().addClass('text-right');
                $(tr).addClass('text-primary');

                $(".loader").hide();
                $("#addForm form input[name=code]").val(null);
                $("#addForm form input[name=name]").val(null);
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
                temp[0] = response.sl; temp[1] = response.name; temp[2] = response.code;
                temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
                temp[4] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
                    '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
                    '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
                table.row((response.sl-1)).data(temp).draw();

                $(".loader").hide();
                $("#editForm form input[name=name]").val(null);
                $("#editForm form input[name=code]").val(null);
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
      $("#editForm form select[name=year]").val(data.year);
      $("#editForm form select[name=session_id]").val(data.session_id);
      $("#editForm form select[name=class_id]").val(data.class_id);
      $("#editForm form input[name=name]").val(data.name);
      $("#editForm form input[name=code]").val(data.code);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form input[name=code]").val(updatedData.code);
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

    {{--function statusUpdate(id,sl) {--}}
    {{--  $(".loader").show();--}}
    {{--  $.get("{{ route('exam-status-update') }}",{id:id,sl:sl}, (response)=>{--}}
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
      $.get("{{ route('exam-delete') }}",{id:id,sl:sl}, (response)=>{
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

    function getExam(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        if(year && section_id && class_id){
            $('.loader').show();
            $.get("{{ route('get-exams') }}",{
                year:year, section_id:section_id, class_id:class_id
            },(response)=>{
                console.log(response);
                console.log('Changed');
                $('.loader').hide();
                $('#table').empty().append(response);
                $('#datatable').dataTable(dataTableOptions);
            });
        }
    }

    function getExamEdit(){
        let year = $('#year_edit').val();
        let session_id = $('#session_id_edit').val();
        let class_id = $('#class_id_edit').val();
        if(year && session_id && class_id){
            $('.loader').show();
            $.get("{{ route('get-exams') }}",{
                year:year, session_id:session_id, class_id:class_id
            },(response)=>{
                console.log(response);
                $('.loader').hide();
                $('#table').empty().append(response);
                $('#datatable').dataTable(dataTableOptions);
            });
        }
    }

    function showAddForm(){
        $("#addForm").show();
        $("#editForm").hide();
    }

    function getClasses(id){
        if(id){
            $('.loader').show()
            let classes = '<option value="">--Select--</option>'
            $.get("{{ route('get-classes') }}",{id:id},(response)=>{
                $('.loader').hide()
                // console.log(response)
                for (const i in response) {
                    let item = response[i]
                    classes += `<option value="${item.id}">${item.name}</option>`
                }

                $('select[name=class_id]').empty().append(classes)
            })
        }
    }
</script>
