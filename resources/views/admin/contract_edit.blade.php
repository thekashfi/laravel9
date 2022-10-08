@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post" action="{{ route($contract->id === null ? 'admin.contract.store' : 'admin.contract.update', $contract->id) }}">
            @csrf

            @if(! $contract->id === null)
                @method('put')
            @endif

            <div class="">
                <h6>قرارداد جدید</h6>
            </div>

            <div class="pb-3">
                <label for="name" class="form-label">نام</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $contract->name) }}">
            </div>

            <div class="pb-3">
                <label class="form-label mt-3">متن قرارداد</label>
                <textarea name="text" class="tinymce-editor">{!! old('text', $contract->text) !!}</textarea>
            </div>

            <div class="pb-3">
                <label class="form-label mt-3">توضیحات</label>
                <textarea name="description" class="tinymce-editor">{!! old('description', $contract->description) !!}</textarea>
            </div>

            <div class="pb-2">
                <label for="price" class="form-label mt-3">قیمت</label>
                <input name="price" type="number" class="form-control" id="price" value="{{old('price', $contract->price)}}">
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
