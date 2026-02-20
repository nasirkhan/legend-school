<script>
    let data =  null, updatedData = null;

    // $("#editForm form").submit(function (e) {
    //     e.preventDefault();
    //     $('.loader').show();
    //     let url = $(this).attr('action');
    //     let data = $(this).serialize();
    //     let method = $(this).attr('method');
    //     $.ajax({
    //         type : method,
    //         url  : url,
    //         data : data,
    //         success: (response) => {
    //             updatedData = response;
    //             let table = $("#datatable").DataTable();
    //             let temp = table.row((response.sl-1)).data();
    //             temp[0] = response.sl; temp[1] = response.class_name; temp[2] = response.name;
    //             temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
    //             temp[4] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
    //                 '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
    //                 '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
    //             table.row((response.sl-1)).data(temp).draw();
    //
    //             $(".loader").hide();
    //             $("#editForm form").trigger('reset');
    //         }
    //     });
    // });
    //
    // function edit(obj,sl) {
    //   data = JSON.parse(obj);
    //   editForm(sl)
    // }
    //
    // function editForm(sl){
    //   $("#addForm").hide();
    //   $("#editForm").show();
    //   $("#editForm form input[name=name]").val(data.name);
    //   $("#editForm form input[name=id]").val(data.id);
    //   $("#editForm form select[name=class_id]").val(data.class_id);
    //   $("#editForm form input[name=sl]").val(sl);
    // }
    //
    // function editFormAfterUpdate(){
    //   $("#addForm").hide();
    //   $("#editForm").show();
    //   $("#editForm form input[name=name]").val(updatedData.name);
    //   $("#editForm form input[name=id]").val(updatedData.id);
    //   $("#editForm form select[name=class_id]").val(updatedData.class_id);
    //   $("#editForm form input[name=sl]").val(updatedData.sl);
    // }

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

    {{--function statusUpdate(id,sl) {--}}
    {{--  $(".loader").show();--}}
    {{--  $.get("{{ route('batch-status-update') }}",{id:id,sl:sl}, (response)=>{--}}
    {{--    updatedData = response;--}}
    {{--    let table = $("#datatable").DataTable();--}}
    {{--    let temp = table.row((sl-1)).data();--}}
    {{--    temp[0] = sl; temp[1] = response.class_name; temp[2] = response.name;--}}
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

    function getTeacherClasses(year){
        if(year){
            $('.loader').show()
            let classes = '<option value="">--Select--</option>'
            $.get("{{ route('get-teacher-classes') }}",{year:year},(response)=>{
                $('.loader').hide()
                console.log(response)
                for (const i in response) {
                    let item = response[i]
                    classes += `<option value="${item.id}">${item.name}</option>`
                }

                $('select[name=class_id]').empty().append(classes)
            })
        }
    }

    function getTeacherSubject(id){
        let year = $('select[name=year]').val();
        if(year && id){
            let subjects = '<option value="">--Select--</option>'
            $(".loader").show()
            $.get("{{ route('get-teacher-subject') }}",{year:year, class_id:id},(response)=>{
                $('.loader').hide()
                // console.log(response)
                for (const i in response) {
                    let item = response[i]
                    // subjects += `<option value="${item[0].subject_id}">${item[0].subject.name}</option>`
                    subjects += `<option value="${item.id}">${item.name}</option>`
                }
                $("select[name=subject_id]").empty().append(subjects)
            })
        }
    }

    function getSubjectHomeWorks(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        let subject_id = $('select[name=subject_id]').val()
        let options = '<option value="">--Select--</option>'
        if (year && class_id && subject_id){
            $('.loader').show()
            $.get("{{ route('get-my-subject-hw') }}",{year:year, class_id:class_id,subject_id:subject_id},(response)=>{
                for (const responseKey in response) {
                    let item = response[responseKey];
                    options += `<option value="${item.id}">${item.title}</option>`
                }
                $('select[name=hw_id]').empty().append(options)
                // console.log(response)
                $('.loader').hide()
            })
        }
    }

    function getStudentHWByTeacher(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        let subject_id = $('select[name=subject_id]').val()
        let hw_id = $('select[name=hw_id]').val()
        if (year && class_id && subject_id && hw_id){
            $('.loader').show()
            $.get("{{ route('get-my-students-hw') }}",{year:year, class_id:class_id,subject_id:subject_id,hw_id:hw_id},(response)=>{
                // let studentHomeWorks = response.student_home_works;
                // for (const key in studentHomeWorks) {
                //     let item = studentHomeWorks[key]
                // }
                console.log(response)
                $('#table').empty().append(response)
                $('.loader').hide()
            })
        }else {
            alert('Please select all option above')
        }
    }

    function getReturnedHWByTeacher(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        let subject_id = $('select[name=subject_id]').val()
        let hw_id = $('select[name=hw_id]').val()
        if (year && class_id && subject_id && hw_id){
            $('.loader').show()
            $.get("{{ route('students-returned-hw-by-teacher') }}",{year:year, class_id:class_id,subject_id:subject_id,hw_id:hw_id},(response)=>{
                // let studentHomeWorks = response.student_home_works;
                // for (const key in studentHomeWorks) {
                //     let item = studentHomeWorks[key]
                // }
                console.log(response)
                $('#table').empty().append(response)
                $('.loader').hide()
            })
        }else {
            alert('Please select all option above')
        }
    }

    function getSubjects(){
        $('.loader').show()
        let subjects = '<option value="">--Select--</option>'
        $.get("{{ route('get-subject-for-class-activity') }}",
            {
                year:$('select[name=year]').val(),
                class_id:$('select[name=class_id]').val()
            },
            (response)=>{
                $('.loader').hide()
                // console.log(response)
                for (const i in response) {
                    let subject = response[i].subject
                    subjects += `<option value="${subject.id}">${response[i].sub_code} : ${subject.name}</option>`
                }

                $('select[name=subject_id]').empty().append(subjects)
            })
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
