<script>
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

    function getClassWiseStudent(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let subject_id = $('select[name=subject_id]').val();
        if (year && section_id && class_id && subject_id){
            $('.loader').show();
            $.get("{{ route('active-student-for-class-activity') }}",{
                year:year, section_id:section_id, class_id:class_id, subject_id:subject_id ,from:'class'
            },(response)=>{
                $('.loader').hide();
                console.log(response);
                $('#table').empty().append(response);
            }).then((response)=>{
                //
            });
        }else{
            alert('Please select all fields');
            // Swal.fire('Alert','You have to select all fields !!!','info');
        }
    }

    function getClassWiseStudentForPasswordSend(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        if (year && section_id && class_id){
            $('.loader').show();
            $.get("{{ route('active-student-for-password') }}",{
                year:year, section_id:section_id, class_id:class_id, from:'class'
            },(response)=>{
                $('.loader').hide();
                console.log(response);
                $('#table').empty().append(response);

            });
        }else{
            Swal.fire('Alert','You have to select all fields !!!','info');
        }
    }

    function getBatchWiseStudent(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let batch_id = $('select[name=batch_id]').val();
        let date = $('input[name=date]').val();
        if (year && session_id && class_id && batch_id && date){
            $('.loader').show();
            $.get("{{ route('active-student') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, date:date, from:'class'
            },(response)=>{
                $('.loader').hide();
                console.log(response);
                $('#table').empty().append(response);

                $.get("{{ route('active-student-title') }}",{
                    year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, from:'class'
                },(response)=>{$(document).prop('title', response);});

            }).then((response)=>{
                $('#datatable').DataTable(dataTableOptions);
                $(".image-popup-no-margins").magnificPopup({
                    type: "image",
                    closeOnContentClick: !0,
                    closeBtnInside: !1,
                    fixedContentPos: !0,
                    mainClass: "mfp-no-margins mfp-with-zoom",
                    image: { verticalFit: !0 },
                    zoom: { enabled: !0, duration: 300 },
                });
            });
        }else{
            Swal.fire('Alert','You have to select all fields !!!','info');
        }
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this student from this class ?",
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
        $.get("{{ route('student-delete') }}",{id:id,sl:sl}, (response)=>{
            if (response.success){
                // console.log(response.data);
                // let table = $("#datatable").DataTable();
                // table.row((sl-1)).remove().draw();
                getClassWiseStudent()
                $(".loader").hide();
            }
        }).then((response)=>{
            Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
        });
    }
</script>
