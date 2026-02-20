var gArrayFonts = ['Solaimanlipi','Arial','Arial Black','Cosmic Sans MS','Courier New','Helvetica','Impact','Tahoma','Times New Roman','Verdana','Poppins'];
$(document).ready(function () {
    $(".mini-editor").summernote({
        height: 70,
        width:220,
        minHeight: null,
        maxHeight: 220,
        focus: !0,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['insert',['table']],
            ['misc',['fullscreen','codeview','help']],
        ],
        placeholder: null,
        dialogsInBody: true,
    });
});
