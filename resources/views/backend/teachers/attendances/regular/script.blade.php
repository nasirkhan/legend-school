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
                $('#batch_id').empty().append(batches);
            });
        }else {
            $('#batch_id').empty().append(batches);
        }
    }

    function getSubject(e){
        let class_id = e.value;
        let subjects = '<option value="">--Select--</option>';
        if (class_id){
            $('.loader').show();
            $.get("{{ route('get-subject') }}",{class_id:class_id},(response)=>{
                $('.loader').hide();
                for (let i in response.subjects){
                    subjects += '<option value="'+response.subjects[i].id+'">'+response.subjects[i].name+'</option>'
                }
                $('#subject_id').empty().append(subjects);
            });
        }else {
            $('#subject_id').empty().append(subjects);
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
            $.get("{{ route('attendance-form') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, date:date, from:'regular', type:'add'
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

    let totalPresent = 0; let totalAbsent = 0;

    function attendanceCount(id,status){
        if (status=='present'){
            let elem = document.getElementById('present'+id);
            if(!elem.checked){totalPresent++; totalAbsent--; elem.checked = true;}
        }else{
            let elem = document.getElementById('absent'+id);
            if(!elem.checked){totalPresent--; totalAbsent++; elem.checked = true;}
        }
        document.getElementById('studentPresent').innerText = totalPresent;
        document.getElementById('studentAbsent').innerText = totalAbsent;
    }

    function getBatchWiseAttendanceReport(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let batch_id = $('select[name=batch_id]').val();
        let from = $('input[name=from]').val();
        let to = $('input[name=to]').val();
        if (year && session_id && class_id && batch_id && from && to){
            $('.loader').show();
            $.get("{{ route('attendance-form') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, start:from, end:to, from:'regular', type:'view'
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

    function attendanceDetail(obj){
        $('.loader').show();
        $.get('{{ route('attendance-detail') }}',obj,(response)=>{
            $('.loader').hide();
            console.log(response);
            $('#modal .modal-content').empty().append(response);
            $('#modal').modal('show');
        });
    }
</script>
