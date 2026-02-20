<script>
    let updatedData = null;

    function edit(obj){
        let item = JSON.parse(obj.item);
        $("#addForm").hide()
        $("#editForm input[name='id']").val(item.id)
        $("#editForm input[name='name']").val(item.name)
        $("#editForm").show()
    }

    function editAfterUpdate(){
        let item = updatedData;
        $("#addForm").hide()
        $("#editForm input[name='id']").val(item.id)
        $("#editForm input[name='name']").val(item.name)
        $("#editForm").show()
    }

    function statusUpdateConfirmation(id,sl){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this Expense Item status ?",
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
      $.get("{{ route('expense-item-status-update') }}",{id:id,sl:sl}, (response)=>{
          // console.log(response);
          updatedData = response;

        let table = $("#datatable").DataTable();
        let temp = table.row((sl-1)).data();
        temp[0] = sl; temp[1] = response.name;
        temp[2] = '<span class="badge badge-pill badge-soft-'+response.badge+' font-size-12">'+response.badge_txt+'</span>';
        temp[3] = '<button onclick="statusUpdateConfirmation('+id+','+sl+')" class="mr-1 btn btn-sm btn-'+response.btn+'"><i class="fa fa-arrow-'+response.arrow+'"></i></button>' +
          '<button onclick="editAfterUpdate()" class="mr-1 btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>' +
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
            text: "Do you want to delete this Expense Item?",
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
        $.get("{{ route('expense-item-delete') }}",{id:id,sl:sl}, (response)=>{
            if (response.success){
                console.log(response);
                let table = $("#datatable").DataTable();
                table.row((sl-1)).remove().draw();
                $(".loader").hide();
            }
        }).then((response)=>{
            $(".loader").hide();
            Swal.fire(response.sa_title, response.sa_message, response.sa_icon);
        });
    }

    function detailExpenses(obj){
        $("#expenseDetailsModal span#item").text(obj.item)

        let table = `<table id="datatable_" class="table table-bordered table-sm dt-responsive mb-0">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 40px">Sl</th>
                            <th>Month</th>
                            <th>Account Holder</th>
                            <th>Bearer</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Media</th>
                            <th>Note</th>
                            <th class="text-right">Amount(Tk)</th>
                        </tr>
                        </thead>
                        <tbody>`

                        let totalAmount = 0
                        for (const expensesKey in obj.expenses) {
                            let expense = obj.expenses[expensesKey];
                            table += `<tr>
                            <td class="text-center">${Number(expensesKey)+1}</td>
                            <td>${expense.month.name} - ${expense.year}</td>
                            <td>${expense.account.name}</td>
                            <td>${expense.bearer}</td>
                            <td>${expense.contact_no}</td>
                            <td>${convertDateFormat(expense.created_at)}</td>
                            <td>${expense.payment_method==1? 'Cash' : 'Bank-'+expense.reference}</td>
                            <td>${expense.note !== null ? expense.note : ''}</td>
                            <td class="text-right">${numberWithCommas(expense.amount)}</td>
                        </tr>`
                            totalAmount += expense.amount
                        }
            table+=`</tbody>
                    <tfoot>
                    <tr>
                        <th colspan="8" class="text-center">Total</th>
                        <th class="text-right">${numberWithCommas(totalAmount)}</th>
                    </tr>
                    </tfoot>
                </table>`
        $("#expenseDetailsModal .modal-body").empty().append(table);
        $("#expenseDetailsModal").modal('show');
        // console.log(obj);
    }
</script>
