<script>
    let dataTableOptions = {
        lengthChange: true,
        responsive: true,
        searching: true,
        paging: true,
        scrollY: !1,
        pageLength: 25,
        ordering:false,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
        dom: 'Blfrtip',
        buttons: [
            'colvis',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'MS Excel'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
    };
    $(document).ready(function() {
        var table = $('#datatable').DataTable(dataTableOptions);
    } );

    let data =  null, updatedData = null;

    function sweetAlert(title,text,icon,buttonText){
      Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'
      });
    }

    function edit(obj) {
        data = JSON.parse(obj);
        $("#edit input[name=id]").val(data.id);
        $("#edit select[name=type]").val(data.type);
        $("#edit input[name=name]").val(data.name);
        $("#edit input[name=mobile]").val(data.mobile);
        $("#edit input[name=address]").val(data.address);
        $("#edit input[name=initial_balance]").val(data.initial_balance);
        $("#edit select[name=balance_type]").val(data.balance_type);
        $('#modal').modal('show');
    }

    $("form#edit").submit(function (e) {
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
                $('#modal').modal('hide');
                $('#table').empty().append(response);
                $("#datatable").DataTable(dataTableOptions);
                $(".loader").hide();
            }
        }).then(()=>{
            Swal.fire('Message', 'Client information updated', 'success');
        });
    });

    $("#addForm form").submit(function (e) {
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
          updatedData = response;
            console.log(response);

          $(".loader").hide();
          $("#addForm form").trigger('reset');
        }
      }).then((response)=>{
          $("#addForm form").trigger('reset');
          Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    });

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this client status ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes Update'
      }).then((result) => {
        if (result.isConfirmed) {
          statusUpdate(id,sl);
        }
      });
    }

    function statusUpdate(id,sl) {
      $(".loader").show();
      $.get("{{ route('client-status-update') }}",{id:id,sl:sl}, (response)=>{
        $('#table').empty().append(response);
        $("#datatable").DataTable(dataTableOptions);
        $(".loader").hide();
      }).then((response)=>{
        Swal.fire('Message', 'Client status updated', 'success');
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this client ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                itemDelete(id,sl);
            }
        });
    }

    function itemDelete(id,sl) {
        $(".loader").show();
        $.get("{{ route('client-delete') }}",{id:id,sl:sl}, (response)=>{
            $('#table').empty().append(response);
            $("#datatable").DataTable(dataTableOptions);
            $(".loader").hide();
        }).then((response)=>{
            Swal.fire('Message', 'Client deleted successfully', 'success');
        });
    }

    function invoiceDelete(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this transaction ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $(".loader").show();
                $.get("{{ route('client-invoice-delete') }}",{id:id}, (response)=>{
                    $("#table").empty().append(response);
                    $("#datatable").DataTable(dataTableOptions);
                    $(".loader").hide();
                }).then((response)=>{
                    Swal.fire('Message', 'Deleted Successfully', 'success');
                });
            }
        });
    }

    function cashCreditInvoiceDelete(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this transaction ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();
                $(".loader").show();
                $.get("{{ route('client-invoice-delete') }}",{id:id,location:'cash-credit',from:startDate,to:endDate}, (response)=>{
                    $("#table").empty().append(response);
                    $("#datatable").DataTable(dataTableOptions);
                    $(".loader").hide();
                }).then((response)=>{
                    Swal.fire('Message', 'Deleted Successfully', 'success');
                });
            }
        });
    }

    function client(){
        let clientType = $('.due select[name=client_type]').val();
        if (clientType){
            $('.loader').show();
            $.get("{{ route('get-client-for-due') }}",{client_type:clientType},(response)=>{
                $('.loader').hide();
                let options = '<option value="">--Select--</option>';
                for (let i in response){
                    options += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                }
                $('.due select[name=client_id]').empty().append(options);
            })
        }
        if(clientType=='Customer'){$('#amountTitle').text('Received');}
        else {$('#amountTitle').text('Paid');}
    }

    function clientBalance(){
        let clientId = $('.due select[name=client_id]').val();
        let clientType = $('.due select[name=client_type]').val();
        if (clientId){
            $('.loader').show();
            $.get("{{ route('client-balance') }}",{client_id:clientId,type:clientType},(response)=>{
                $('.loader').hide();
                $('.due input[name=past_balance]').val(response.amount)
                $('.past-balance-title').text(response.title);
            }).then(()=>{
                dueCalculate();
            });
        }
    }

    function paymentMedia(){
        let media = $('form select[name=payment_media]').val();
        if(media=='Bank'){
            $('#bank').show();
        }else {
            $('#bank').hide();
        }
    }

    function dueCalculate(){
        let previousBalance = Number($('.due input[name=past_balance]').val());
        let discount = Number($('.due input[name=discount]').val());
        let previousBalanceTitle = $('.past-balance-title').text();
        let clientType = $('.due select[name=client_type]').val();
        // let transportCost = Number($('form input[name=transport_cost]').val());
        // let labourCost = Number($('form input[name=labour_cost]').val());

        let amount = Number($('.due input[name=amount]').val());

        let discountedAmount = amount-discount;

        let newBalance = 0; let newBalanceTitle= '';

        if(clientType=='Customer'){
            if (previousBalanceTitle=='Debit'){
                newBalance = (previousBalance+discountedAmount);
                newBalance >=0? newBalanceTitle = 'Debit':newBalanceTitle = 'Credit';
            }else {
                newBalance = (previousBalance-discountedAmount);
                newBalance >=0? newBalanceTitle = 'Credit':newBalanceTitle = 'Debit';
            }
        }else if (clientType=='Supplier'){
            if (previousBalanceTitle=='Debit'){
                newBalance = (previousBalance-discountedAmount);
                newBalance >=0? newBalanceTitle = 'Debit':newBalanceTitle = 'Credit';
            }else {
                newBalance = (previousBalance+discountedAmount);
                newBalance >=0? newBalanceTitle = 'Credit':newBalanceTitle = 'Debit';
            }
        }

        $('.due input[name=new_balance]').val(Math.abs(newBalance));
        $('#newBalanceTitle').text(newBalanceTitle);
    }

    $('#startDate').change(()=>{let startDate = $('#startDate').val(); $('#printStartDate').val(startDate);});

    $('#endDate').change(()=>{let endDate = $('#endDate').val(); $('#printEndDate').val(endDate);});

    $("form#form").submit(function (e) {
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
                $('#table').empty().append(response);
                $('#datatable').dataTable(dataTableOptions);
                $(".loader").hide();
            }
        }).then(()=>{
            $("#addForm form").trigger('reset');
            Swal.fire('Message', 'Data loaded successfully', 'success');
        });
    });
</script>
