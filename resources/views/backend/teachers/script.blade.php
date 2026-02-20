<script>
    let data =  null, updatedData = null;

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
                temp[0] = response.sl; temp[1] = response.class_name; temp[2] = response.name;
                temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
                temp[4] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
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
      $("#editForm form select[name=class_id]").val(data.class_id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form select[name=class_id]").val(updatedData.class_id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this sub batch status ?",
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
      $.get("{{ route('batch-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        temp[0] = sl; temp[1] = response.class_name; temp[2] = response.name;
        temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[4] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
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
            text: "Do you want to delete this Teacher ?",
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
      $.get("{{ route('teacher-delete') }}",{id:id,sl:sl}, (response)=>{
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

    function getBatch(e){
        let class_id = e.value;
        let batches = '<option value="">--Select--</option>';
        if (class_id){
            $('.loader').show();
            $.get("{{ route('get-batch') }}",{class_id:class_id},(response)=>{
                $('.loader').hide();
                for (let i in response.batches){
                    batches += '<option value="'+response.batches[i].id+'">'+response.batches[i].name+'</option>'
                }
                $('#batch_id').empty().append(batches);
                $('#monthly_fee').val(response.className.monthly_fee);
                calc();
            });
        }else {
            $('#batch_id').empty().append(batches);
        }
    }

    function calc(){
        let monthly_fee = $('#monthly_fee').val();
        let discount = $('#discount').val();
        let payable = (Number(monthly_fee) - Number(discount));
        $('#monthly_payable').val(payable);
    }

    function subjectAllocationForm(id){
        $('#subjectAddForm input[name=id]').val(id)
        $('#subjectAddForm').modal('show')
    }

    function routineAddForm(teacherId,classId,subjectId,className,subjectName){
        $('#routineAddForm #className').text(className)
        $('#routineAddForm #subjectName').text(subjectName)
        $('#routineAddForm input[name=teacher_id]').val(teacherId)
        $('#routineAddForm input[name=class_id]').val(classId)
        $('#routineAddForm input[name=subject_id]').val(subjectId)
        $('#routineAddForm').modal('show')
    }

    function loginInfoReset(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Create/Reset this teacher's Login Info ?"+id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I do'
        }).then((result) => {
            if (result.isConfirmed) {
                $(".loader").show();
                $.get("{{ route('create-teacher-login-info') }}",{id:id}, (response)=>{
                    if (response.success){
                        console.log(response);
                        $(".loader").hide();
                    }
                }).then((response)=>{
                    $(".loader").hide();
                    // toastr["success"]("Message Sent")
                    Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
                });
            }
        });
    }
</script>

<script>
    //Image Show Before Upload Start
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            if (fileName){
                $('#fileLabel').html(fileName);
            }
        });
    });

    function showImage(data, imgId){
        if(data.files && data.files[0]){
            var obj = new FileReader();

            obj.onload = function(d){
                var image = document.getElementById(imgId);
                image.src = d.target.result;
            };
            obj.readAsDataURL(data.files[0]);
        }
    }
    //Image Show Before Upload End
</script>
