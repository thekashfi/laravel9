@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" enctype="multipart/form-data" action="{{ route($package->id === null ? 'admin.package.store' : 'admin.package.update', $package->id) }}">
            @csrf

            @if($package->id !== null)
                @method('put')
            @endif

            <div class="">
                <h6>
                    @if ( $package->id === null )
                        پکیج جدید
                    @else
                        ویرایش پکیج {{ $package->name }}
                    @endif
                </h6>
            </div>

            <div class="row">


                <div class="col-md-6 pb-3">
                    <label for="name" class="form-label">نام</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $package->name) }}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="slug" class="form-label">آدرس</label>
                    <input dir="ltr" name="slug" type="text" class="form-control" id="slug" value="{{ old('slug', $package->slug) }}">
                    <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="price" class="form-label">مبلغ تمام شده به تومان</label>
                    <input name="price" type="number" class="form-control" id="price" value="{{old('price', $package->price)}}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="old_price" class="form-label">مبلغ پیش از تخفیف به تومان</label>
                    <input name="old_price" type="number" class="form-control" id="old_price" value="{{old('old_price', $package->old_price)}}">
                </div>

                <div class="pb-3 col-md-6">
                    <label for="category_id" class="form-label">دسته بندی</label>
                    <select name="category_id" class="form-select"  x-model="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', optional($package->category)->id) == $category->id  ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-3 col-md-6 pt-4">
                    <div class="form-check form-check-linethrough">
                        <input value="0" name="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                        <input value="1" name="is_active" id="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ $package->is_active == false ?: 'checked' }}>
                        <label for="is_active" class="me-4">قابل مشاهده در وبسایت</label>
                    </div>
                </div>

            </div>
            <div class="pb-3">
                <label for="summary" class="form-label">خلاصه</label>
                <textarea name="summary"  rows="4"   class="form-control" id="summary" >{{ old('summary', $package->summary) }}</textarea>
            </div>


            <div class="pb-3">
                <label class="form-label mt-3">توضیحات</label>
                <textarea name="description" class="tinymce-editor-full">{!! old('description', $package->description) !!}</textarea>
            </div>


            <div class="row">
                <div class="pb-3 col-md-6">
                    <label for="contracts" class="form-label">قرارداد ها</label>
                    <select name="contracts[]" multiple class="form-select"  x-model="contracts" id="contracts">
                        @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}"
                                {{ in_array($contract->id , old('contracts',optional($package->contracts)->pluck('id')->toArray() ) ) ? 'selected' : '' }}>
                                {{ $contract->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="pb-3 col-md-6">
                    <label for="file_ids" class="form-label">فایل ها</label>
                    <select name="file_ids[]" multiple class="form-select"  x-model="file_ids" id="file_ids">
                        @foreach($files as $file)
                            <option value="{{ $file->id }}"
                                {{ in_array($file->id , old('file_ids', optional($package->files)->pluck('id')->toArray() ) ) ? 'selected' : '' }}>
                                {{ $file->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
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
