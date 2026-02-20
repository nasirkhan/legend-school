<script>
    // Clone invoice rows to other copies
    const originalRows = document.getElementById('invoice-rows').innerHTML;
    document.getElementById('invoice-rows-school').innerHTML = originalRows;
    document.getElementById('invoice-rows-bank').innerHTML = originalRows;

    function getClassWiseStudentInvoice(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        if (year && class_id){
            $(".loader").show()
            $.get("{{ route('class-wise-invoice-check') }}",{year,class_id},(response)=>{
                // console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            })
        }
    }

    function getFees(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        if (year && class_id){
            $(".loader").show()
            $.get("{{ route('get-fees') }}",{year,class_id},(response)=>{
                // console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
                $('#datatable').DataTable(dataTableOptions);
            })
        }
    }

    function getDueReport(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        if (year && class_id){
            $(".loader").show()
            $.get("{{ route('get-due-report') }}",{year,class_id},(response)=>{
                // console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
                $('#datatable').DataTable(dataTableOptions);
            })
        }
    }

    function getDueReportNew(){
        let year = $('select[name=year]').val()
        let class_id = $('select[name=class_id]').val()
        let item_id = $('select[name=item_id]').val()
        let month_id = $('select[name=month_id]').val()
        if (year && class_id && item_id){
            $(".loader").show()
            $.get("{{ route('get-due-report-new') }}",{year,class_id,item_id,month_id},(response)=>{
                // console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
                $('#datatable').DataTable(dataTableOptions);
            })
        }
    }

    function getStudentsForCreatingInvoice(){
        let year = $("select[name=year]").val()
        let item_id = $("select[name=item_id]").val()
        let month_id = $("select[name=month_id]").val()
        let class_id = $("select[name=class_id]").val()

        if (year && item_id && month_id && class_id){
            $(".loader").show()
            $.get("{{ route('get-students-for-creating-invoice') }}",{year,item_id,month_id,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            })
        }

    }

    function getInvoice(e){
        console.log(e.value)
    }

    function addToPayment(){
        let invoice_id = $("select[name=invoice_id]").val()
        if(invoice_id){
            $(".loader").show()
            $.get("{{ route('add-to-payment') }}",{invoice_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#paymentForm").empty().html(response)
            })
        }
    }

    function checkPayment(){
        let year = $("select[name=year]").val()
        let student_id = $("select[name=student_id]").val()
        if(year && student_id){
            $(".loader").show()
            $.get("{{ route('check-payment') }}",{year,student_id},(response)=>{
                // console.log(response)
                $(".loader").hide()
                $("#paymentForm").empty().html(response)
            })
        }
    }

    function getPaymentReport(){
        let from = $("input[name=from]").val()
        let to = $("input[name=to]").val()
        let class_id = $("select[name=class_id]").val()
        if(from && to && class_id){
            $(".loader").show()
            $.get("{{ route('get-payment-report') }}",{from,to,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            })
        }
    }

    function getPaymentReportNew(){
        let from = $("input[name=from]").val()
        let to = $("input[name=to]").val()
        let class_id = $("select[name=class_id]").val()
        if(from && to && class_id){
            $(".loader").show()
            $.get("{{ route('get-payment-report-new') }}",{from,to,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            })
        }
    }

    function getPaymentItem(){
        let year = $("select[name=year]").val()
        let class_id = $("select[name=class_id]").val()
        if(year && class_id){
            $(".loader").show()
            let option = `<option value="">--Select--</option>`
            $.get("{{ route('get-payment-item') }}",{year,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                for (let i = 0; i < response.length; i++) {
                    let item = response[i]
                    option += `<option value="${item.item_id}">${item.item.name}</option>`
                }
                $("select[name=item_id]").empty().html(option)
                // console.log(option)

            })
        }
    }

    function itemWisePaymentReport(){
        let year = $("select[name=year]").val()
        let item_id = $("select[name=item_id]").val()
        let class_id = $("select[name=class_id]").val()
        if(year && item_id && class_id){
            $(".loader").show()
            $.get("{{ route('item-wise-payment-report') }}",{year,item_id,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            })
        }
    }

    function classWiseDueReport(){
        let year = $("select[name=year]").val()
        let class_id = $("select[name=class_id]").val()
        if(year && class_id){
            $(".loader").show()
            $.get("{{ route('class-wise-due-report') }}",{year,class_id},(response)=>{
                console.log(response)
                $(".loader").hide()
                $("#table").empty().html(response)
            }).then(()=>{
                $('#datatable').DataTable(dataTableOptions);
            })
        }
    }
</script>
