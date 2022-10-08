@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post">

            <div class="">
                <h6>دسته فو</h6>
            </div>

            <div class="pb-3">
                <label for="defaultFormControlInput" class="form-label">نام</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
            </div>

            <div class="pb-3">
                <label for="defaultFormControlInput" class="form-label">آیکن</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
                <div id="defaultFormControlHelp" class="form-text">میتوانید آیکن را از این لیست انتخاب کنید.</div>
            </div>

            <textarea id="mytextarea">Hello, World!</textarea>

            <div class="mt-3">
                <div class="form-check form-check-linethrough">
                    <input class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" checked="checked">
                    <p class="me-4">در منو نمایش داده شود.</p>
                </div>
            </div>


            <div class="w-100 text-center">
                <button class="btn btn-primary btn-sm mt-3">ثبت</button>
            </div>
        </form>
    </div>

    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection

@section('head')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
