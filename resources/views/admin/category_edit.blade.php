@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" action="{{ route($category->id === null ? 'admin.category.store' : 'admin.category.update', $category->id) }}">
            @csrf

            @if($category->id !== null)
                @method('put')
            @endif

            <div class="">
                <h6>دسته جدید</h6>
            </div>

            <div class="row">
            <div class="pb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="" value="{{ old('name', $category->name) }}">
            </div>

            <div class="pb-3">
                <label for="slug" class="form-label">آدرس</label>
                <input dir="ltr" name="slug" type="text" class="form-control" id="slug" placeholder="" value="{{ old('slug', $category->slug) }}">
                <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
            </div>

            <div class="col-md-6 pb-3">
                <label for="image_label" class="form-label">عکس متناسب</label>
                <div class="input-group">
                    <input dir="ltr" readonly type="text" id="image_label" class="form-control" name="image"
                           aria-label="Image" aria-describedby="button-image"  value="{{old('image', $category->image)}}"
                           style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                    <button style="border-left: 1px solid #d2d6da !important;margin-bottom: 0" class="btn btn-outline-secondary" type="button" id="button-image">انتخاب فایل</button>
                </div>
            </div>

            <div class="col-md-6 pb-3">
                <label for="color" class="form-label">رنگ</label>
                <input name="color" type="color" class="form-control" id="color" style="width:50px; height: 40px" value="{{old('color', $category->color)}}">
            </div>

            <div class="col-md-6 pb-3">
                <label for="order" class="form-label">ترتیب</label>
                <input dir="ltr" name="order" type="number" class="form-control" id="order" placeholder="" value="{{ old('order', $category->order) }}">
            </div>

{{--            <div class="pb-3">--}}
{{--                <label for="icon" class="form-label">آیکن</label>--}}
{{--                <input name="icon" type="text" class="form-control" id="icon">--}}
{{--                <div id="defaultFormControlHelp" class="form-text">میتوانید آیکن را از این لیست انتخاب کنید.</div>--}}
{{--            </div>--}}


            <div class="pb-3">
                <label class="form-label mt-3">توضیحات</label>
                <textarea name="description" class="tinymce-editor-full">{!! old('description', $category->description) !!}</textarea>
            </div>

            <div class="mt-3">
                <div class="form-check form-check-linethrough">
                    <input value="0" name="in_menu" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                    <input value="1" name="in_menu" id="in_menu" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ old('in_menu', $category->in_menu) == false ?: 'checked' }}>
                    <label for="in_menu" class="me-4">در منو نمایش داده شود.</label>
                </div>
            </div>
            <div class="mt-3">
                <div class="form-check form-check-linethrough">
                    <input value="0" name="hidden" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                    <input value="1" name="hidden" id="hidden" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ old('hidden', $category->hidden) == false ?: 'checked' }}>
                    <label for="hidden" class="me-4">فقط در پکیج ها نمایش داده شود.</label>
                </div>
            </div>


            <div class="w-100 text-center">
                <button class="btn btn-primary btn-sm mt-3">ثبت</button>
            </div>
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
    @include('tinymce.config')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            });
        });

        // set file link
        function fmSetLink($url) {
            document.getElementById('image_label').value = $url;
        }
    </script>
@endsection
