<script>
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

    function getExam(){
        let year = $('select[name=year]').val();
        let class_id = $('select[name=class_id]').val();
        if(year && class_id){
            $('.loader').show();
            $.get("{{ route('exam-list-by-teacher') }}",{
                year:year, class_id:class_id
            },(response)=>{
                console.log(response)
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
</script>
