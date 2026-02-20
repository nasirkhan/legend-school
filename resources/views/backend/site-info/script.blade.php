<script>
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
      $("#editForm form input[name=property]").val(data.property);
      $("#editForm form input[name=value]").prop("type", data.type);
      if (data.type!='file'){
          $("#editForm form input[name=value]").val(data.value);
      }
      $("#editForm form input[name=id]").val(data.id);
      $("#editForm form input[name=sl]").val(sl);
    }

    function editFormAfterUpdate(){
      $("#addForm").hide();
      $("#editForm").show();
      $("#editForm form input[name=property]").val(updatedData.property);
      $("#editForm form input[name=value]").prop("type", updatedData.type);
      $("#editForm form input[name=value]").val(updatedData.value);
      $("#editForm form input[name=id]").val(updatedData.id);
      $("#editForm form input[name=sl]").val(updatedData.sl);
    }
</script>
