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

    function getDailyAcademicReport(){
        let year = $('select[name=year]').val();
        let section_id = $('select[name=section_id]').val();
        let class_id = $('select[name=class_id]').val();
        let date = $('input[name=date]').val();
        if (year && section_id && class_id && date){
            $('.loader').show();
            $.get("{{ route('get-daily-academic-report') }}",{
                year:year, section_id:section_id, class_id:class_id, date:date , from:'class'
            },(response)=>{
                $('.loader').hide();
                console.log(response);
                $('#table').empty().append(response);
            })
        }else{
            Swal.fire('Alert','You have to select all fields !!!','info');
        }
    }
</script>
