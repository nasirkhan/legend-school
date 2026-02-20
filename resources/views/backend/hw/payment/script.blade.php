<script>
    $("#form").submit(function (e) {
        e.preventDefault();
        let receipt_no = $('input[name=receipt_no]').val();
        if (receipt_no == '' || receipt_no == null){
            Swal.fire('Error','Receipt No. Can Not Be Empty !!!','error');
            return false;
        }

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
                    let months = '<th class="" style="width: 90px; background-color: #eff2f7">Months</th>';

                    for (let i = 0; i<response.attendances.length; i++){
                        let month = response.attendances[i].month;
                        let attendance = response.attendances[i];

                        months += '<td><div class="custom-control custom-checkbox custom-checkbox-success present">'+
                            '<input type="checkbox" onclick="calculate()" id="attendance'+attendance.id+'" name="attendances['+attendance.id+']" class="custom-control-input month-count"/>'+
                            '<label class="custom-control-label" for="attendance'+attendance.id+'">'+month.code+'</label>'+
                            '</div></td>';
                    }
                    $('#months').empty().append(months);
                    $('input[name=receipt_no]').val('');
                    Swal.fire('Success','Payment Recorded Successfully','success');
                }else {
                    Swal.fire('Error','Month Can Not Be Empty !!!','error');
                }
            }
        });
    });

    function paymentFormFillUp(e){
        if (e.value){
            $('.loader').show();
            $.get("{{ route('payment-form-fill-up') }}",{ student_id: e.value },(response)=>{
                $('.loader').hide();
                // console.log(response);
                let student = response.student;
                $('input[name=monthly_fee]').val(student.monthly_fee);
                $('input[name=monthly_discount]').val(student.discount);
                $('select[name=school_id]').val(student.school_id);
                $('select[name=class_id]').val(student.class_id);

                let months = '<th class="" style="width: 90px; background-color: #eff2f7">Months</th>';

                for (let i = 0; i<response.attendances.length; i++){
                    let month = response.attendances[i].month;
                    let attendance = response.attendances[i];

                    months += '<td><div class="custom-control custom-checkbox custom-checkbox-success present">'+
                        '<input type="checkbox" onclick="calculate()" id="attendance'+attendance.id+'" name="attendances['+attendance.id+']" class="custom-control-input month-count"/>'+
                        '<label class="custom-control-label" for="attendance'+attendance.id+'">'+month.code+'</label>'+
                        '</div></td>';
                }
                $('#months').empty().append(months);
            });
        }else {
            $('button[type=reset]').click();
            $('#months').empty().append('<th class="" style="width: 90px; background-color: #eff2f7">Months</th><td></td>');
        }
    }

    function calculate(){
        let monthlyFee = $('input[name=monthly_fee]').val();
        let monthlyDiscount = $('input[name=monthly_discount]').val();
        let monthlyPayable = Number(monthlyFee)-Number(monthlyDiscount);
        let totalPayable = 0;
        let months = $('.month-count');
        for (let i = 0; i<months.length; i++) {
            let month = months[i];
            if(month.checked) {
                totalPayable += monthlyPayable;
            }
        }
        $('input[name=received]').val(totalPayable);
        $('input[name=receipt_no]').focus();
    }
</script>
