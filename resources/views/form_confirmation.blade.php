@extends('layout')

@section('content')
    <section class="bg-image">
        <div class="d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-11 ">
                        <div>
                            <div class="card-body p-5">
                                <h3 class="text-uppercase text-center mb-3">مشخصات را تایید کنید</h3>
                                <div class="alert alert-warning">
                                    توجه داشته باشید که مقادیر وارد شده در متن قرارداد، قرار خواهد گرفت و قابلیت ویرایش ندارد!
                                </div>
                                <form class="row g-3" action="{{ route('generate' , [$order->uuid, $item->id]) }}" method="POST">
                                    @csrf
                                    @foreach($fillables as $fillable)
                                        <div class="col-6">
                                            <strong class="form-label">{{ $fillable->name }}:</strong>
                                            <input type="hidden" value="{{ $values[$fillable->id] ?? '' }}" name="custom[{{ $fillable->id }}]">
                                            <span>{{ $values[$fillable->id] ?? "--" }}</span>
                                       </div>
                                    @endforeach
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">تایید و دانلود</button>
                                        <button type="button" onclick="document.getElementById('resetForm').submit();" class="btn btn-warning">بازگشت و تصحیح</button>
                                    </div>
                                </form>
                                <form id="resetForm" action="{{ route('form' , [$order->uuid, $item->id]) }}" method="POST">
                                    @csrf
                                    @foreach($fillables as $fillable)
                                            <input type="hidden" value="{{ $values[$fillable->id] ?? '' }}" name="custom[{{ $fillable->id }}]">
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ url('') }}/js/jquery.min.js"></script>
    <script src="{{ url('') }}/js/persian-date.min.js"></script>
    <script src="{{ url('') }}/js/persian-datepicker.min.js"></script>
    <script>
        $('.persian_date_picker').persianDatepicker({
            initialValueType: 'persian',
            format: 'L'
        });
    </script>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('') }}/css/persian-datepicker.min.css" />
@endsection
