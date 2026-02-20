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
</script>
