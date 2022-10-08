@extends('admin.layout')

@section('content')
    <div class="card mb-4 p-3">

        <form method="post">

            <div class="">
                <h6>قرارداد فو</h6>
            </div>

            <div class="pb-3">
                <label for="defaultFormControlInput" class="form-label">نام قرارداد</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>

            @include('tinymce.editor')

            <div class="pb-3">
                <label for="defaultFormControlInput" class="form-label mt-3">قیمت</label>
                <input type="number" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
            </div>

            <div class="w-100 text-center">
                <button class="btn btn-primary btn-sm mt-3">ثبت</button>
            </div>
        </form>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    @include('tinymce.config')
@endsection
