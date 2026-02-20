<script>
    $("select[name=sms_type]").change(function () {
        if ($(this).val()=='custom'){
            $("textarea[name=sms_body]").show();
            $("#batch").show();
            $("#exam").val(null).hide();
            $("#month").val(null).hide();
            if ($('select[name=class_id]')){getBatch();}
        } else if($(this).val()=='result') {
            $("textarea[name=sms_body]").hide();
            $("#batch").val(null).hide();
            $("#exam").show();
            $("#month").val(null).hide();
            if ($('select[name=class_id]')){getExam();}
        } else if ($(this).val()=='attendance'){
            $("textarea[name=sms_body]").hide();
            $("#batch").val(null).hide();
            $("#exam").val(null).hide();
            $("#month").show();
        }else {
            $("textarea[name=sms_body]").hide();
            $("#batch").show();
            $("#exam").val(null).hide();
            $("#month").val(null).hide();
        }
    });

    function charCounter(){
        let str = document.querySelector('.form textarea[name=sms_body]').value;
        let strLength = str.length;
        if (strLength>0){
            document.querySelector('#counter').innerText = 'Message Length: '+strLength;
        }else {
            document.querySelector('#counter').innerText = '';
        }
    }

    function getData(){
        let year = $("select[name=year]").val();
        let sessionId = $("select[name=session_id]").val();
        let smsType = $("select[name=sms_type]").val();
        let classId = $("select[name=class_id]").val();
        // let classId = e.value;
        if (year && sessionId && smsType && classId){
            if (smsType=='custom'){
                getBatch();
            }else if (smsType=='result'){
                getExam();
            }

        }
    }

    function getBatch(){
        let classId = $("select[name=class_id]").val();
        let batches = '<option value="">--Select--</option>';
        if (classId){
            $('.loader').show();
            $.get("{{ route('get-batch') }}",{class_id:classId},(response)=>{
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

    function getExam(){
        let year = $('select[name=year]').val();
        let session_id = $('select[name=session_id]').val();
        let class_id = $('select[name=class_id]').val();
        if(year && session_id && class_id){
            $('.loader').show();
            $.get("{{ route('get-raw-exams') }}",{
                year:year, session_id:session_id, class_id:class_id
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

    function getStudents(){
        let year = $("select[name=year]").val();
        let sessionId = $("select[name=session_id]").val();
        let smsType = $("select[name=sms_type]").val();
        let classId = $('select[name=class_id]').val();
        let obj = {
            year:year, session_id:sessionId, sms_type:smsType, class_id:classId
        };
        if (year && sessionId && smsType && classId){
            if (smsType=='custom'){
                let batchId = $('select[name=batch_id]').val();
                obj.batch_id =  batchId;
                if (batchId){
                    $(".loader").show();
                    $.get("{{ route('student-list-for-message') }}",obj,(response)=>{
                        $("#table").empty().append(response);
                        $(".loader").hide();
                        console.log(response);
                    });
                }else{
                    Swal.fire('Alert','Please select exam !!!','info');
                }
            }else if (smsType=='result'){
                let examId = $('select[name=exam_id]').val();
                obj.exam_id =  examId;
                if (examId){
                    $(".loader").show();
                    $.get("{{ route('student-list-for-message') }}",obj,(response)=>{
                        $("#table").empty().append(response);
                        $(".loader").hide();
                        console.log(response);
                    });
                }else{
                    Swal.fire('Alert','Please select exam !!!','info');
                }
            }else if(smsType=='attendance'){
                let monthId = $('select[name=month_id]').val();
                obj.month_id =  monthId;
                if (monthId){
                    $(".loader").show();
                    $.get("{{ route('student-list-for-message') }}",obj,(response)=>{
                        $("#table").empty().append(response);
                        $(".loader").hide();
                        console.log(response);
                    });
                }else{
                    Swal.fire('Alert','Please select month !!!','info');
                }
            }
        }else {
            Swal.fire('Alert','You have to select all fields !!!','info');
        }
    }
</script>
