jQuery(document).ready(function() {
    $(".summernote").summernote({
        height: 190,
        minHeight: null,
        maxHeight: null,
        focus: true,
        codemirror: { // codemirror options
            theme: 'monokai'
          }
    }), $(".inline-editor").summernote({
        airMode: true,
    })
}), window.edit = function() {
    $(".click2edit").summernote()
}, window.save = function() {
    $(".click2edit").summernote("destroy")
};
