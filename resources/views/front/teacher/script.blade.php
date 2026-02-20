<script>
    function routineAddForm(teacherId,classId,subjectId,className,subjectName){
        $('#routineAddForm #className').text(className)
        $('#routineAddForm #subjectName').text(subjectName)
        $('#routineAddForm input[name=teacher_id]').val(teacherId)
        $('#routineAddForm input[name=class_id]').val(classId)
        $('#routineAddForm input[name=subject_id]').val(subjectId)
        $('#routineAddForm').modal('show')
    }
</script>
