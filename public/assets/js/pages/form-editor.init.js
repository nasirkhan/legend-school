// $(document).ready(function(){0<$("#elm1").length&&tinymce.init({selector:"textarea#elm1",height:300,plugins:["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",style_formats:[{title:"Bold text",inline:"b"},{title:"Red text",inline:"span",styles:{color:"#ff0000"}},{title:"Red header",block:"h1",styles:{color:"#ff0000"}},{title:"Example 1",inline:"span",classes:"example1"},{title:"Example 2",inline:"span",classes:"example2"},{title:"Table styles"},{title:"Table row 1",selector:"tr",classes:"tablerow1"}]}),$(".summernote").summernote({height:300,minHeight:null,maxHeight:null,focus:!0})});
var gArrayFonts = ['Solaimanlipi','Arial','Arial Black','Cosmic Sans MS','Courier New','Helvetica','Impact','Tahoma','Times New Roman','Verdana','Poppins'];
$(document).ready(function () {
    0 < $("#elm1").length &&
    tinymce.init({
        selector: "textarea#elm1",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor",
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            { title: "Bold text", inline: "b" },
            { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
            { title: "Red header", block: "h1", styles: { color: "#ff0000" } },
            { title: "Example 1", inline: "span", classes: "example1" },
            { title: "Example 2", inline: "span", classes: "example2" },
            { title: "Table styles" },
            { title: "Table row 1", selector: "tr", classes: "tablerow1" },
        ],
    }),
        $(".summernote").summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: !0,
            fontNames: gArrayFonts,
            fontNamesIgnoreCheck: gArrayFonts,
            fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22' , '24', '28', '32', '36', '40', '48','72'],
            // followingToolbar: false,
            toolbar: [
                //     // [groupName, [list of button]]
                ['style'],
                ['style', ['clear', 'bold', 'italic', 'underline']],
                ['fontstyle',['strikethrough', 'superscript', 'subscript','fontname','fontsize','fontsizeunit']],
                ['color', ['color','forecolor','backcolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert',['table','link','picture','video','hr']],
                ['misc',['undo','redo','fullscreen','codeview','help']],
            ],
            placeholder: null,
            dialogsInBody: true,
        });
});
