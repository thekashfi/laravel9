@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" enctype="multipart/form-data" action="{{ route($contract->id === null ? 'admin.contract.store' : 'admin.contract.update', $contract->id) }}">
            @csrf

            @if($contract->id !== null)
                @method('put')
            @endif

            <div class="">
                <h6>قرارداد جدید</h6>
            </div>

            <div class="row">


                <div class="col-md-6 pb-3">
                    <label for="name" class="form-label">نام</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $contract->name) }}">
                </div>

                <div class="col-md-6 pb-3">
                    <label for="slug" class="form-label">آدرس</label>
                    <input name="slug" type="text" class="form-control" id="slug" value="{{ old('slug', $contract->slug) }}">
                    <div id="optionsHelp" class="form-text">نام انگلیسی برای استفاده در url صفحه</div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="price" class="form-label">مبلغ به تومان</label>
                    <input name="price" type="number" class="form-control" id="price" value="{{old('price', $contract->price)}}">
                </div>

                <div class="pb-3 col-md-6">
                    <label for="category_id" class="form-label">دسته بندی</label>
                    <select name="category_id" class="form-select"  x-model="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id') == $category->id || optional($contract->category)->id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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
