<script>
    let dataTableOptions = {
        lengthChange: true,
        responsive: true,
        searching: true,
        paging: true,
        scrollY: !1,
        pageLength: 25,
        ordering: false,
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

    function edit(obj,sl) {
      data = JSON.parse(obj);
      editForm(sl)
    }

    function editForm(sl){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(data.name);
      $("#editForm form input[name=code]").val(data.code);
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=name]").val(updatedData.name);
      $("#editForm form input[name=code]").val(updatedData.code);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }

    $("#editForm form").submit(function (e) {
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
          let table = $("#datatable").DataTable();
          let temp = table.row((response.sl-1)).data();
          temp[0] = response.sl; temp[1] = response.name; temp[2] = response.code;
          temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
          temp[4] = '<button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
            '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
            '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
          table.row((response.sl-1)).data(temp).draw();

          $(".loader").hide();
          $("#editForm form").trigger('reset');
        }
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
          // let table = $("#datatable").DataTable();
          //   let sl = '<td>'+response.sl+'</td>';
          //   let brand = '<td>'+response.name+'</td>';
          //   let code = '<td>'+response.code+'</td>';
          //   let status = '<td class="text-center"><span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span></td>';
          //   let action = '<td class="text-right"><button onclick="statusUpdateConfirmation('+response.id+','+response.sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
          //       '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
          //       '<button onclick="itemDeleteConfirmation('+response.id+','+response.sl+')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button></td>';
          //
          //  let tr = table.row.add( [ sl, brand, code, status, action ] ).draw().node();
          //   table.column(3).nodes().to$().addClass('text-center');
          //   table.column(4).nodes().to$().addClass('text-right');
          //   $(tr).addClass('text-primary');

            console.log(response);

          $(".loader").hide();
          $("#addForm form").trigger('reset');
        }
      }).then((response)=>{
          $("#addForm form").trigger('reset');
          Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
          // Swal.fire({
          //     text:response.sa_message,
          //     icon: response.sa_icon,
          //     target: '#custom-target',
          //     customClass: {
          //         container: 'position-absolute'
          //     },
          //     toast: true,
          //     position: 'center-center'
          // });
      });
    });

    function statusUpdateConfirmation(id,sl){
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this Brand status ?",
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
      $.get("{{ route('brand-status-update') }}",{id:id,sl:sl}, (response)=>{
        updatedData = response;
        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        temp[0] = sl; temp[1] = response.name; temp[2] = response.code;
        temp[3] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[4] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
          '<button onclick="editFormAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
          '<button class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>';
        table.row((sl-1)).data(temp).draw();
        $(".loader").hide();
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
      });
    }

    function itemDeleteConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this brand ?",
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
      $.get("{{ route('brand-delete') }}",{id:id,sl:sl}, (response)=>{
          if (response.success){
              console.log(response);
              let table = $("#datatable").DataTable();
              table.row((sl-1)).remove().draw();
              $(".loader").hide();
          }
      }).then((response)=>{
        Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
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
