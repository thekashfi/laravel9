<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    var editorObject = tinymce.init({
        selector: 'textarea.tinymce-editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code table | customInsertButton',
        height : "200",
        setup: function (editor) {
            editor.ui.registry.addButton('customInsertButton', {
                text: 'افزودن',
                onAction: function (_) {
                    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no, width=0,height=0,left=-1000,top=-1000`;
                    let popup = window.open('{{route('admin.fillables')}}', 'test', params);
                }
            });
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
window.addEventListener("message", function(event) {
    if (typeof(event.data) === "string") {
        editorObject.then((result)=>{
            result[0].insertContent(event.data)
        });
    }
});

</script>
