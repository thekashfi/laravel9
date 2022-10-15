@extends('layout')

@section('content')
    <section id="contact" class="contact-section pt-120 pb-150">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-lg-7">
                    <div class="section-title text-center mb-60">
                        <h1 class="wow fadeInUp mb-20" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">با ما در ارتباط باشید</h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            لورم ایپسوم متن تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع.
                        </p>
                    </div>
                </div>
            </div>
            <form action="{{ route('connect-us-save') }}" method="POST" id="contact-form" class="contact-form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input">
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-input" placeholder="نام شما">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input">
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-input" placeholder="ایمیل شما">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input">
                            <input type="text" name="number" value="{{ old('number') }}" id="number" class="form-input" placeholder="شماره تماس">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="single-input">
                            <textarea name="message" id="message" rows="8" class="form-input" placeholder="پیام‌تان را وارد نمایید.">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-btn text-center">
                            <button type="submit" class="main-btn btn-hover">ارسال پیام</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
