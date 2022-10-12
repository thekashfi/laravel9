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

            <div class="pb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="" value="{{ old('name', $category->name) }}">
            </div>

            <div class="pb-3">
                <label for="slug" class="form-label">آدرس</label>
                <input name="slug" type="text" class="form-control" id="slug" placeholder="" value="{{ old('slug', $category->slug) }}">
                <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
            </div>

{{--            <div class="pb-3">--}}
{{--                <label for="icon" class="form-label">آیکن</label>--}}
{{--                <input name="icon" type="text" class="form-control" id="icon">--}}
{{--                <div id="defaultFormControlHelp" class="form-text">میتوانید آیکن را از این لیست انتخاب کنید.</div>--}}
{{--            </div>--}}

            <div class="mt-3">
                <div class="form-check form-check-linethrough">
                    <input value="0" name="in_menu" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                    <input value="1" name="in_menu" id="in_menu" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ $category->in_menu == false ?: 'checked' }}>
                    <label for="in_menu" class="me-4">در منو نمایش داده شود.</label>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin" defer></script>
@endsection
