@extends('layout')

@section('content')
    <section class="bg-image">
        <div class="d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-11 ">
                        <div>
                            <div class="card-body p-5">
                                <h3 class="text-uppercase text-center mb-2">مشخصات را وارد کنید</h3>
                                <form class="row g-3" action="{{ route('generate' , $order->uuid) }}" method="POST">
                                    @csrf
                                    @foreach($fillables as $fillable)
{{--                                        <div class="col-md-12">--}}
{{--                                            <label for="inputEmail4" class="form-label">Email</label>--}}
{{--                                            <input type="email" class="form-control" id="inputEmail4">--}}
{{--                                        </div>--}}
                                        @switch($fillable->type)
                                            @case('select')
                                                <div class="mb-3 col-md-6">
                                                    <label for="{{ $fillable->id }}" class="form-label">{{ $fillable->name }}</label>
                                                    <select name="custom[{{ $fillable->id }}]" id="{{ $fillable->id }}" class="form-select" size="3" x-model="type">
                                                        @foreach(json_decode($fillable->options) as $key => $option)
                                                            <option value="{{ $option }}" @selected(old("custom.$fillable->id") === $option)>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if($fillable->description) <div id="rulesHelp" class="form-text">{{ $fillable->description }}</div> @endif
                                                </div>
                                            @break

                                            @case('date_solar')
                                                <div class="col-6">
                                                    <label for="{{ $fillable->id }}" class="form-label">{{ $fillable->name }}</label>
                                                    <input type="text" class="form-control persian_date_picker" id="{{ $fillable->id }}" value="{{ old("custom.$fillable->id") }}" name="custom[{{ $fillable->id }}]">
                                                    @if($fillable->description) <div id="rulesHelp" class="form-text">{{ $fillable->description }}</div> @endif
                                                </div>
                                                @break
                                            @case('textarea')
                                                <div class="col-6">
                                                    <label for="{{ $fillable->id }}" class="form-label">{{ $fillable->name }}</label>
                                                    <textarea class="form-control" id="{{ $fillable->id }}" name="custom[{{ $fillable->id }}]">{{ old("custom.$fillable->id") }}</textarea>
                                                    @if($fillable->description) <div id="rulesHelp" class="form-text">{{ $fillable->description }}</div> @endif
                                                </div>
                                            @break

                                            @default
                                                <div class="col-6">
                                                    <label for="{{ $fillable->id }}" class="form-label">{{ $fillable->name }}</label>
                                                    <input type="{{ $fillable->type }}" class="form-control" id="{{ $fillable->id }}" value="{{ old("custom.$fillable->id") }}" name="custom[{{ $fillable->id }}]">
                                                    @if($fillable->description) <div id="rulesHelp" class="form-text">{{ $fillable->description }}</div> @endif
                                                </div>
                                        @endswitch
                                    @endforeach
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                    </div>
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
