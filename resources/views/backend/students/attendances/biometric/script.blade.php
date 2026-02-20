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

    function getClassWiseAttendanceReport(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        let from = $('input[name=from]').val()
        let to = $('input[name=to]').val()
        if (!year || !class_id || !from || !to) {return false;}
        $('.loader').show()
        try {
            $.get("{{ route('biometric-attendance-report') }}",{year,class_id,from,to},(response)=>{
                console.log(response)
                $("#table").empty().html(response)
                $('.loader').hide()
            })
        }catch (e) {
            console.log(e)
        }

        {{--window.location.replace( "{{ route('biometric.attendance.report') }}?year="+year+"&class_id="+class_id)--}}
    }
</script>
