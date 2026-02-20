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

    function getPaper(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        if(year && session_id && class_id && exam_id){
            $('.loader').show();
            $.get("{{ route('get-raw-papers') }}",{
                year:year, session_id:session_id, class_id:class_id, exam_id:exam_id
            },(response)=>{
                // console.log(response);
                $('.loader').hide();
                let options = '<option value="">--Select--</option>';
                for (const i in response) {
                    options += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                }
                $('select[name=paper_id]').empty().append(options);
            });
        }
    }

    function getBatchWiseStudent(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let batch_id = $('select[name=batch_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        let paper_id = $('select[name=paper_id]').val();
        if (year && session_id && class_id && batch_id && exam_id && paper_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, exam_id:exam_id, paper_id:paper_id, from:'add'
            },(response)=>{
                $('.loader').hide();
                $('#table').empty().append(response);
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

    $("#form").submit(function (e) {
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
                $(".loader").hide();
                if(response.success){
                    Swal.fire('Success','Result Submitted Successfully','success');
                }
            }
        });
    });

    function getExam(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();

        if(year && section_id && class_id){
            $('.loader').show();
            $.get("{{ route('get-raw-exams') }}",{
                year:year, section_id:section_id, class_id:class_id
            },(response)=>{
                $('.loader').hide();
                let options = '<option value="">--Select--</option>';
                for (const i in response) {
                    let exam = response[i];
                    options += '<option value="'+exam.id+'">'+exam.name+'</option>'
                }
                $('select[name=exam_id]').empty().append(options);
            });
        }
    }

    function getSubject(id){
        if(id){
            let subjects = '<option value="">--Select--</option>'
            $(".loader").show()
            $.get("{{ route('get-subject') }}",{class_id:id},(response)=>{
                $('.loader').hide()
                for (const i in response.subjects) {
                    let item = response.subjects[i]
                    subjects += `<option value="${item.subject_id}">${item.sub_code} - ${item.subject.name}</option>`
                }
                $("select[name=subject_id]").empty().append(subjects)
            })
        }
    }

    function markCheck(mark,e){
        let obtainMark = Number(e.value);
        let totalMark = Number(mark);
        if (obtainMark>totalMark){
            e.value = 0;
            e.select();
            // e.focus();
        }
    }

    function getClassWiseStudent(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        let subject_id = $('select[name=subject_id]').val();
        if (year && section_id && class_id && exam_id && subject_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, subject_id:subject_id, from:'add'
                // year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, from:'view'
            },(response)=>{
                console.log(response)
                $('.loader').hide();
                $('#table').empty().append(response);
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

    function getExamWiseResult(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        let subject_id = $('select[name=subject_id]').val();
        if (year && section_id && class_id && exam_id && subject_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, subject_id:subject_id, from:'view'
                // year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, from:'view'
            },(response)=>{
                console.log(response)
                $('.loader').hide();
                $('#table').empty().append(response);
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

    function getExamWiseOldResult(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        let subject_id = $('select[name=subject_id]').val();
        if (year && section_id && class_id && exam_id && subject_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, subject_id:subject_id, from:'old'
                // year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, from:'view'
            },(response)=>{
                console.log(response)
                $('.loader').hide();
                $('#table').empty().append(response);
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

    function getExamWiseResultForDelete(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        let subject_id = $('select[name=subject_id]').val();
        if (year && section_id && class_id && exam_id && subject_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, subject_id:subject_id, from:'delete'
                // year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, from:'view'
            },(response)=>{
                console.log(response)
                $('.loader').hide();
                $('#table').empty().append(response);
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

    function getReportCards(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let exam_id = $('select[name=exam_id]').val();
        if (year && section_id && class_id && exam_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, section_id:section_id, class_id:class_id, exam_id:exam_id, from:'report'
            },(response)=>{
                console.log(response)
                $('.loader').hide();
                $('#table').empty().append(response);
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

    function getMeritList(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let batch_id = 'all';
        let exam_id = $('select[name=exam_id]').val();
        if (year && session_id && class_id && batch_id && exam_id){
            $('.loader').show();
            $.get("{{ route('result-form') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, exam_id:exam_id, from:'merit'
            },(response)=>{
                $('.loader').hide();
                $('#table').empty().append(response);
                console.log(response);
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

    function clearTable(){
        $('#table').empty()
    }
</script>
