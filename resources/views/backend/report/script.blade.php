<script>
    $('#startDate').change(()=>{let startDate = $('#startDate').val();$('#printStartDate').val(startDate);});

    $('#endDate').change(()=>{let endDate = $('#endDate').val(); $('#printEndDate').val(endDate);});

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
                $(".loader").hide();
                // console.log(response);
                $('#table').empty().append(response);
                $('#datatable').dataTable(dataTableOptions);
            }
        }).then(()=>{
            Swal.fire('Message', 'Data loaded successfully', 'success');
        });
    });

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

    function getBatchWiseStudent(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        let batch_id = $('select[name=batch_id]').val();
        if (year && session_id && class_id && batch_id){
            $('.loader').show();
            $.get("{{ route('report') }}",{
                year:year, session_id:session_id, class_id:class_id, batch_id:batch_id, from:'payment', report_type:'batch-wise', type:'view'
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

    $('select[name=year]').change(()=>{let year = $('select[name=year]').val();$('#printYear').val(year);});
    $('select[name=session_id]').change(()=>{let sessionId = $('select[name=session_id]').val();$('#printSessionId').val(sessionId);});
    $('select[name=class_id]').change(()=>{let classId = $('select[name=class_id]').val();$('#printClassId').val(classId);});

    // function setClassId(e){
    //     $('#printClassId').val(e.val());
    // }

    $('select[name=batch_id]').change(()=>{let batchId = $('select[name=batch_id]').val();$('#printBatchId').val(batchId);});
</script>
