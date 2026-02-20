<script>
    function resultMetaInfoAdd(){
        $('.loader').show()

        let info = {
            exam_id:'{{ $exam->id }}',
            student_id:'{{ $student->id }}',
            no_of_class:Number($('#no_of_class').val()),
            no_of_class_present:Number($('#no_of_class_present').val()),
            ptm:Number($('#ptm').val()),
            ptm_attended:Number($('#ptm_attended').val())
        }

        $.get("{{ route('result-meta-add') }}",info,(response)=>{
            console.log(response)
            $('.loader').hide()
        });
    }

    function promotedToNextClass(){
        $('.loader').show()

        let info = {
            exam_id:'{{ $exam->id }}',
            student_id:'{{ $student->id }}',
            no_of_class:Number($('#no_of_class').val()),
            no_of_class_present:Number($('#no_of_class_present').val()),
            ptm:Number($('#ptm').val()),
            ptm_attended:Number($('#ptm_attended').val()),
            promoted_class_id:Number($('#promoted_class_id').val())
        }

        $.get("{{ route('result-meta-add') }}",info,(response)=>{
            console.log(response)
            $('.loader').hide()
        });
    }
</script>
