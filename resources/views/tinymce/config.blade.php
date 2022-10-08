<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    var editorObject = tinymce.init({
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table customInsertButton customDateButton',
        setup: function (editor) {

            console.log(editor);
            editor.ui.registry.addButton('customInsertButton', {
                text: 'My Button',
                onAction: function (_) {
                    // editor.insertContent('&nbsp;<strong>It\'s my button!</strong>&nbsp;');
                    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
width=0,height=0,left=-1000,top=-1000`;

                    let popup = window.open('{{route('admin.fillables')}}', 'test', params);
                    // popup.document.write("");

                    // window.open('http://google.com');
                }
            });

            var toTimeHtml = function (date) {
                return '<time datetime="' + date.toString() + '">' + date.toDateString() + '</time>';
            };

            editor.ui.registry.addButton('customDateButton', {
                icon: 'insert-time',
                tooltip: 'Insert Current Date',
                disabled: true,
                onAction: function (_) {
                    editor.insertContent(toTimeHtml(new Date()));
                },
                onSetup: function (buttonApi) {
                    var editorEventCallback = function (eventApi) {
                        buttonApi.setDisabled(eventApi.element.nodeName.toLowerCase() === 'time');
                    };
                    editor.on('NodeChange', editorEventCallback);

                    /* onSetup should always return the unbind handlers */
                    return function (buttonApi) {
                        editor.off('NodeChange', editorEventCallback);
                    };
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
