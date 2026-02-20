<script>
    function hwUploadForm(subject,title){
        $('#hwUploadForm').find("#subject").text(subject)
        $('#hwUploadForm').find("#title").text(title)
        $('#hwUploadForm').modal('show')
    }

    $(document).ready(function () {
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);  // Create a FormData object
            let fileInput = $('#file')[0].files[0];

            // Show progress bar
            $('#progressDiv').show();

            $.ajax({
                url: "{{ route('student-home-work-upload') }}",  // Your Laravel route for file upload
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();

                    // Track the progress of the upload
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            let percentComplete = Math.round((e.loaded / e.total) * 100);

                            // Update the progress bar
                            $('#progressBar').css('width', percentComplete + '%');
                            $('#progressText').text(percentComplete + '% uploaded');

                            if (percentComplete === 100) {
                                $('#progressText').text('Processing...');
                            }
                        }
                    });

                    return xhr;
                },
                success: function (response) {
                    // Handle the response after successful upload
                    $('#progressText').text('File uploaded successfully!');
                    location.reload()
                    // setTimeout(()=>{
                    //     $('#progressDiv').hide();
                    //     },3000)
                },
                error: function (xhr, status, error) {
                    // Handle the error case
                    $('#progressText').text('Error during upload: ' + error);
                    if (xhr.status===400){
                        $('#progressText').text('No file was chosen');
                        $('#progressText').css('color', 'red');
                    }
                }
            });
        });
    });

</script>
