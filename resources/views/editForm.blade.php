@extends('layout')

@section('content')
    <section class="bg-image">
        <div class="d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-11 ">
                        <div>
                            <div class="card-body p-5">
                                <h3 class="text-uppercase text-center mb-2">متن قرارداد را تنظیم کنید.</h3>
                                <form class="row g-3" action="{{ route('form_confirmation' , [$order->uuid , $item->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3 col-md-12">
                                        <textarea name="html" class="tinymce-editor-full">{!! old('html', $html) !!}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('head')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce-editor-full', // Replace this CSS selector to match the placeholder element for TinyMCE
            directionality : 'rtl',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media codesample table charmap hr nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            height : "600",
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: 'oxide',
            content_css:'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        });
    </script>
    <style>
        .tox .tox-promotion {
            display: none !important;
        }
        .tox .tox-statusbar__branding svg {
            display: none !important;
        }
    </style>
@endsection
