<script>
    function getClassWiseStudent(){
        let year = $('select[name=year]').val();
        let class_id = $('select[name=class_id]').val();
        let next_class_id = $('select[name=next_class_id]').val();
        let next_year = $('select[name=next_year]').val();

        if(year && class_id && next_class_id && next_year){
            $('.loader').show();
            $.ajax({
                url: "{{ route('student-list-for-promotion') }}",
                type: "GET",
                data: {
                    year: year,
                    class_id: class_id,
                    next_class_id: next_class_id,
                    next_year: next_year,
                },
                success: function (response) {
                    console.log(response);
                    $('.loader').hide();
                    $('#table').empty().html(response);
                }
            })
        }else {
            alert('Please fill all field');
        }
    }

    function itemWiseDiscountCalculate(student_id,class_item_id){
        //Collect all information
        let checkBoxes = document.getElementsByClassName('checked-'+student_id);
        let itemsDiscountElements = document.getElementsByClassName('item_discount_'+student_id);
        let chargesElements = document.getElementsByClassName('amount-'+student_id);
        //Calculate all collected information
        let totalCharge = 0; let totalDiscount = 0;
        for (let i = 0; i < checkBoxes.length; i++) {
            let checkbox = checkBoxes[i];
            let charge = chargesElements[i];
            if(checkbox.checked===true){
                totalDiscount += Number(itemsDiscountElements[i].value);
                totalCharge += Number(charge.innerHTML);
            }else {
                //Set discount to null if the field is not checked
                itemsDiscountElements[i].value = null;
            }
        }
        //Replace previous information with new information
        let studentChargeElement = document.getElementById('total_amount_'+student_id);
        studentChargeElement.innerHTML = totalCharge;
        let studentDiscountElement = document.getElementById('discount_'+student_id);
        studentDiscountElement.value = totalDiscount;
        let studentReceivableElement = document.getElementById('receivable_'+student_id);
        studentReceivableElement.value = totalCharge-totalDiscount;

        return true;
    }

    function checkAll(e){
        let students = document.getElementsByClassName('stdn');
        if (students.length>0){
            if (e.checked===true){
                for (let i = 0; i < students.length; i++) {
                    let student = students[i];
                    student.checked = true;
                }
            }else {
                for (let i = 0; i < students.length; i++) {
                    let student = students[i];
                    student.checked = false;
                }
            }
        }
    }

</script>
