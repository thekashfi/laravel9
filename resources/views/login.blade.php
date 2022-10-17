@extends('layout')

@section('content')
    <section class="bg-image">
        <div class="d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div>
                            <div class="card-body p-5">
                                <h3 class="text-uppercase text-center mb-2">ثبت نام / ورود</h3>
                                <form method="post" action="{{ request()->has('redirectTo') ? route('auth.login' , ['redirectTo' => request()->redirectTo]) : route('auth.login') }}">
                                    @csrf

                                    <div class="form-outline mb-3">
                                        <label class="form-label mb-1" for="form3Example1cg">شماره تلفن</label>
                                        <input type="tel" value="{{ old('phone') }}" name="phone" id="form3Example1cg" class="form-control form-control" dir="ltr"/>
                                    </div>

{{--                                    <div class="form-check d-flex justify-content-center mb-3">--}}
{{--                                        <input class="form-check-input ms-2" type="checkbox" value="" id="form2Example3cg"/>--}}
{{--                                        <label class="form-check-label" for="form2Example3g">--}}
{{--                                            <a href="#" class="text-body"><u>قوانین و مقرارت</u></a> را میپذیرم--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn main-btn btn-hover px-5 py-3">ثبت نام / ورود</button>
                                    </div>

{{--                                    <p class="text-center text-muted mt-3 mb-0">حساب کاربری دارید؟? <a href="#" class="fw-bold text-body"><u>وارد شوید</u></a></p>--}}

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
