@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" enctype="multipart/form-data" action="{{ route($file->id === null ? 'admin.file.store' : 'admin.file.update', $file->id) }}">
            @csrf

            @if($file->id !== null)
                @method('put')
            @endif

            <div class="">
                <h6>
                    @if ( $file->id === null )
                    فایل جدید
                    @else
                    ویرایش فایل {{ $file->name }}
                    @endif
                </h6>
            </div>

            <div class="row">


                <div class="col-md-6 pb-3">
                    <label for="name" class="form-label">نام</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $file->name) }}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="slug" class="form-label">آدرس</label>
                    <input dir="ltr" name="slug" type="text" class="form-control" id="slug" value="{{ old('slug', $file->slug) }}">
                    <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="price" class="form-label">مبلغ  تمام شده به تومان</label>
                    <input name="price" type="number" class="form-control" id="price" value="{{old('price', $file->price)}}">
                </div>
                <div class="col-md-6 pb-3">
                    <label for="old_price" class="form-label">مبلغ پیش از تخفیف به تومان</label>
                    <input name="old_price" type="number" class="form-control" id="old_price" value="{{old('old_price', $file->old_price)}}">
                </div>

                <div class="pb-3 col-md-6">
                    <label for="category_id" class="form-label">دسته بندی</label>
                    <select name="category_id[]" multiple class="form-select resize-vertical"  x-model="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id , old('category_id', optional($file->categories)->pluck('id')->toArray() ) ) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="image_label" class="form-label">فایل قرارداد</label>
                    <div class="input-group">
                        <input dir="ltr" readonly type="text" id="image_label" class="form-control" name="file"
                               aria-label="Image" aria-describedby="button-image"  value="{{old('file', $file->file)}}"
                               style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                        <button style="border-left: 1px solid #d2d6da !important;margin-bottom: 0" class="btn btn-outline-secondary" type="button" id="button-image">انتخاب فایل</button>
                    </div>
                    <div id="file" class="form-text">حتما در درایو local و پوشه private قرارگیرد!</div>
                </div>


                <div class="col-md-6 pb-3">
                    <label for="order" class="form-label">ترتیب</label>
                    <input dir="ltr" name="order" type="number" class="form-control" id="order" placeholder="" value="{{ old('order', $file->order) }}">
                </div>

                <div class="pb-3 col-md-6">
                    <div class="form-check form-check-linethrough">
                        <input value="0" name="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                        <input value="1" name="is_active" id="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ old('is_active', $file->is_active) == false ?: 'checked' }}>
                        <label for="is_active" class="me-4">قابل مشاهده در وبسایت</label>
                    </div>
                </div>

            </div>
            <div class="pb-3">
                <label for="summary" class="form-label">خلاصه</label>
                <textarea name="summary"  rows="4"   class="form-control" id="summary" >{{ old('summary', $file->summary) }}</textarea>
            </div>


            <div class="pb-3">
                <label class="form-label mt-3">توضیحات</label>
                <textarea name="description" class="tinymce-editor-full">{!! old('description', $file->description) !!}</textarea>
            </div>

            <div class="w-100 text-center">
                <button class="btn btn-primary btn-sm mt-3" type="submit">ثبت</button>
            </div>
        </form>
    </div>
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
