<script>
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
                batches += '<option value="all">All Sections</option>';
                $('#batch_id').empty().append(batches);
            });
        }else {
            $('#batch_id').empty().append(batches);
        }
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

    function getClassWiseStudent(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        if (year && section_id && class_id){
            $('.loader').show();
            $.get("{{ route('active-student') }}",{
                year:year, section_id:section_id, class_id:class_id, from:'class'
            },(response)=>{
                $('.loader').hide();
                console.log(response);
                $('#table').empty().append(response);

                {{--$.get("{{ route('active-student-title') }}",{--}}
                {{--    year:year, session_id:session_id, school_id:school_id, class_id:class_id, from:'school'--}}
                {{--},(response)=>{$(document).prop('title', response);});--}}

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
        if (year && session_id && class_id && batch_id){
            $('.loader').show();
            $.get("{{ route('active-student') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, from:'class'
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
