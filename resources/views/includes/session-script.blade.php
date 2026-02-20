<script>
    $('select[name=year]').change(()=>{
        let year =  $('select[name=year]').val();
        $('.loader').show();
        $.get("{{ route('set-year') }}",{year:year},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=session_id]').change(()=>{
        let session_id =  $('select[name=session_id]').val();
        $('.loader').show();
        $.get("{{ route('set-session') }}",{session_id:session_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=section_id]').change(()=>{
        let section_id =  $('select[name=section_id]').val();
        $('.loader').show();
        $.get("{{ route('set-section') }}",{section_id:section_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=class_id]').change(()=>{
        let class_id =  $('select[name=class_id]').val();
        $('.loader').show();
        $.get("{{ route('set-class-id') }}",{class_id:class_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=next_class_id]').change(()=>{
        let next_class_id =  $('select[name=next_class_id]').val();
        $('.loader').show();
        $.get("{{ route('set-next-class-id') }}",{next_class_id:next_class_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=next_year]').change(()=>{
        let next_year =  $('select[name=next_year]').val();
        $('.loader').show();
        $.get("{{ route('set-next-year') }}",{next_year:next_year},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=subject_id]').change(()=>{
        let subject_id =  $('select[name=subject_id]').val();
        $('.loader').show();
        $.get("{{ route('set-subject-id') }}",{subject_id:subject_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=exam_id]').change(()=>{
        let exam_id =  $('select[name=exam_id]').val();
        $('.loader').show();
        $.get("{{ route('set-exam-id') }}",{exam_id:exam_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=used_for]').change(()=>{
        let used_for =  $('select[name=used_for]').val();
        $('.loader').show();
        $.get("{{ route('set-used-for') }}",{used_for:used_for},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=item_id]').change(()=>{
        let item_id =  $('select[name=item_id]').val();
        $('.loader').show();
        $.get("{{ route('set-item-id') }}",{item_id:item_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=month_id]').change(()=>{
        let month_id =  $('select[name=month_id]').val();
        $('.loader').show();
        $.get("{{ route('set-month-id') }}",{month_id:month_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=billing_cycle]').change(()=>{
        let billing_cycle =  $('select[name=billing_cycle]').val();
        $('.loader').show();
        $.get("{{ route('set-billing-cycle') }}",{billing_cycle:billing_cycle},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('input[name=from]').change(()=>{
        let from =  $('input[name=from]').val();
        $('.loader').show();
        $.get("{{ route('set-from') }}",{from:from},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('input[name=to]').change(()=>{
        let to =  $('input[name=to]').val();
        $('.loader').show();
        $.get("{{ route('set-to') }}",{to:to},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=beneficiary_type_id]').change(()=>{
        let beneficiary_type_id =  $('select[name=beneficiary_type_id]').val();
        $('.loader').show();
        $.get("{{ route('set-beneficiary-type-id') }}",{beneficiary_type_id:beneficiary_type_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=expense_item_id]').change(()=>{
        let expense_item_id =  $('select[name=expense_item_id]').val();
        $('.loader').show();
        $.get("{{ route('set-expense-item-id') }}",{expense_item_id:expense_item_id},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    $('select[name=transaction_type]').change(()=>{
        let transaction_type =  $('select[name=transaction_type]').val();
        $('.loader').show();
        $.get("{{ route('set-transaction-type') }}",{transaction_type:transaction_type},(response)=>{
            console.log(response);
            $('.loader').hide();
        });
    });

    function convertTo12HourFormat(time24) {
        // Split the time into hours, minutes, and seconds
        let [hours, minutes] = time24.split(":");

        // Convert hours to a number
        hours = parseInt(hours, 10);

        // Determine if it's AM or PM
        const period = hours >= 12 ? "pm" : "am";

        // Convert to 12-hour format
        hours = hours % 12 || 12;

        // Return formatted time
        return `${hours}:${minutes} ${period}`;
    }

    function convertDateFormat(datetimeStr) {
        // Create a Date object from the input string
        const dateObj = new Date(datetimeStr);

        // Extract hours and minutes
        let hours = dateObj.getHours();
        const minutes = String(dateObj.getMinutes()).padStart(2, '0');

        // Determine AM or PM
        const period = hours >= 12 ? "pm" : "am";

        // Convert to 12-hour format
        hours = hours % 12 || 12;

        // Extract date in YYYY-MM-DD format
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(dateObj.getDate()).padStart(2, '0');

        const dateStr = `${day}/${month}/${year}`;

        // Return formatted date and time
        return `${dateStr}`;
        // return `${dateStr} ${hours}:${minutes} ${period}`;
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
