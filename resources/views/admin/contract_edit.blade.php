@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" enctype="multipart/form-data" action="{{ route($contract->id === null ? 'admin.contract.store' : 'admin.contract.update', $contract->id) }}">
            @csrf

            @if($contract->id !== null)
                @method('put')
            @endif

            <div class="">
                <h6>
                    @if ( $contract->id === null )
                        قرارداد جدید
                    @else
                        ویرایش قرارداد {{ $contract->name }}
                    @endif
                </h6>
            </div>

            <div class="row">


                <div class="col-md-6 pb-3">
                    <label for="name" class="form-label">نام</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $contract->name) }}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="slug" class="form-label">آدرس</label>
                    <input dir="ltr" name="slug" type="text" class="form-control" id="slug" value="{{ old('slug', $contract->slug) }}">
                    <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="price" class="form-label">مبلغ تمام شده به تومان</label>
                    <input name="price" type="number" class="form-control" id="price" value="{{old('price', $contract->price)}}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="old_price" class="form-label">مبلغ پیش از تخفیف به تومان</label>
                    <input name="old_price" type="number" class="form-control" id="old_price" value="{{old('old_price', $contract->old_price)}}">
                </div>

                <div class="pb-3 col-md-6">
                    <label for="category_id" class="form-label">دسته بندی</label>
                    <select name="category_id[]" multiple class="form-select resize-vertical" x-model="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id , old('category_id', optional($contract->categories)->pluck('id')->toArray() ) ) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-6 pb-3">
                    <label for="order" class="form-label">ترتیب</label>
                    <input dir="ltr" name="order" type="number" class="form-control" id="order" placeholder="" value="{{ old('order', $contract->order) }}">
                </div>

                <div class="col-md-6 mt-5">
                    <div class="form-check form-check-linethrough">
                        <input value="0" name="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="hidden">
                        <input value="1" name="is_active" id="is_active" class="form-check-input h-5 mt-0 rounded-circle border-dashed flex-none float-end" type="checkbox" {{ old('is_active', $contract->is_active) == false ?: 'checked' }}>
                        <label for="is_active" class="me-4">قابل مشاهده در وبسایت</label>
                    </div>
                </div>

            </div>
            <div class="pb-3">
                <label for="summary" class="form-label">خلاصه</label>
                <textarea name="summary"  rows="4"   class="form-control" id="summary" >{{ old('summary', $contract->summary) }}</textarea>
            </div>


            <div class="pb-3">
                <label class="form-label mt-3">توضیحات</label>
                <textarea name="description" class="tinymce-editor-full">{!! old('description', $contract->description) !!}</textarea>
            </div>

            <div class="pb-3">
                <label class="form-label mt-3">متن قرارداد</label>
                <textarea name="text" class="tinymce-editor">{!! old('text', $contract->text) !!}</textarea>
            </div>


            <div class="w-100 text-center">
                <button class="btn btn-primary btn-sm mt-3" type="submit">ثبت</button>
            </div>
        </form>
    </div>
@endsection

@section('head')
    @include('tinymce.config')
@endsection
