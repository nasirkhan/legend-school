<script>
    function edit(trans,items){
        let transaction = JSON.parse(trans);
        let accounts = JSON.parse(items);

        $('#edit select[name=transaction_type]').val(transaction.transaction_type);
        $('#edit select[name=transaction_sector_id]').val(transaction.item.sector.id);
        $('#edit input[name=amount]').val(transaction.amount);
        $('#edit input[name=via]').val(transaction.via);
        $('#edit input[name=remark]').val(transaction.remark);
        $('#edit input[name=id]').val(transaction.id);
        let options = '';
        for (let i in accounts){
            options += '<option value="'+accounts[i].id+'">'+accounts[i].account_name+'</option>';
        }
        $('#edit select[name=transaction_item_id]').empty().append(options);
        $('#modal').modal('show');
    }

    function sectorWiseAccountList(){
        let transactionSectorId = $('form select[name=transaction_sector_id]').val();
        let options = '<option value="">--Select Account--</option>';
        if(transactionSectorId){
            $('.loader').show();
            $.get("{{ route('sector-wise-account-list') }}",{transaction_sector_id:transactionSectorId},(response)=>{
                $('.loader').hide();
                for (let i in response){
                    options += '<option value="'+response[i].id+'">'+response[i].account_name+'</option>';
                }
                $('form select[name=transaction_item_id]').empty().append(options);
            });
        }
    }

    function transactionDeleteConfirmation(id){
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
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();
                $.get("{{ route('transaction-delete') }}",{id:id,from:startDate,to:endDate}, (response)=>{
                    $("#table").empty().append(response);
                    let table = $("#datatable").DataTable(dataTableOptions);
                    $(".loader").hide();
                }).then(()=>{
                    Swal.fire('Message', 'Transaction Deleted Successfully', 'success');
                });
            }
        });
    }
</script>
