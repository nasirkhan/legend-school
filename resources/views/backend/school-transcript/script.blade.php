<script>
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

    function clearTable(){
        $('#table').empty()
    }

    function privateStudentAddForm(){
        $("#studentAddForm").modal('show')
        // $('.loader').show()
    }

    function privateStudentEditForm(str){
        let obj = JSON.parse(str)
        $("#studentEditForm input[name=id]").val(obj.id)
        $("#studentEditForm input[name=name]").val(obj.name)
        $("#studentEditForm select[name=year]").val(obj.year)
        $("#studentEditForm input[name=candidate_no]").val(obj.candidate_no)
        $("#studentEditForm input[name=date_of_birth]").val(obj.date_of_birth)
        $("#studentEditForm input[name=date_of_admission]").val(obj.date_of_admission)
        $("#studentEditForm input[name=date_of_graduation]").val(obj.date_of_graduation)
        $("#studentEditForm input[name=nationality]").val(obj.nationality)
        $("#studentEditForm input[name=passport]").val(obj.passport)

        let subjects = obj.subjects;
        let subjectId = [];
        for (let key in subjects){
            subjectId.push(subjects[key].subject_id);
        }
        $("#studentEditForm form .select2").val(subjectId).trigger("change");

        $("#studentEditForm").modal('show')
    }
</script>
