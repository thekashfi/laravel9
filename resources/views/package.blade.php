@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                    @if ( $package->category()->hidden )
                        <li class="breadcrumb-item px-0"><a href="{{ route('packages' , 'all') }}">فایل ها</a></li>
                    @else
                        <li class="breadcrumb-item px-0"><a
                                href="{{ route('category' , $package->category()->slug) }}">{{ $package->category()->name }}</a>
                        </li>
                        <li class="breadcrumb-item px-0"><a href="{{ route('packages', $package->category()->slug) }}">پکیج
                                ها</a></li>
                    @endif
                    <li class="breadcrumb-item px-0 active" aria-current="page">{{ $package->name }}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">
                                <i class="lni lni-files" style="margin-left: 15px;"></i>
                                {{ $package->name }}
                            </h1>
                            @if(! empty($package->image))
                                <img src="{{ $package->image }}" class="w-100" alt="{{ $package->name }}">
                            @endif
                            @if($package->slogan1)
                                <h3 class="border- mt-3 p-3 "
                                    style="background-color: #FFA200; color:black; border-radius: 12px;">{{ $package->slogan1 }}
                                    </h2>
                                    @endif
                                    @if($package->slogan2)
                                        <h3 class="border- mt-3 p-3 "
                                            style="background-color: #FFA200; color:black;  border-radius: 12px;">
                                            {{ $package->slogan2 }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="about-img w-100">
                        <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="single-pricing">
                                <div class="accordion" id="accordionExample">
                                    @foreach($items as $key => $item)
                                        @if( ! $item['category']->hidden )
                                            <div class="mt-4">
                                                <h2 class="accordion-header" id="heading{{$key}}"
                                                    style="background-color:green; border-radius:6px;">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}"
                                                            aria-expanded="false" aria-controls="collapse{{$key}}"
                                                            style="color:black; background-color:green; border-radius:6px;">
                                                        تعداد {{ $item['category']->name }}‌ها: {{ $item['count'] }} عدد
                                                    </button>
                                                </h2>
                                                <div id="collapse{{$key}}" class="accordion-collapse collapse"
                                                     aria-labelledby="heading{{$key}}"
                                                     data-bs-parent="#accordionExample">
                                                    <div class="accordion-body"
                                                         style="background-color:lightgreen; border-radius:6px;">
                                                        <ul class="content">
                                                            @foreach($item['contracts'] as $contract)
                                                                <li>
                                                                    @if( $contract->is_active )
                                                                        <a href="{{ route('contract' , $contract->slug) }}"
                                                                           target="_blank">
                                                                            {{ $contract->name }}
                                                                        </a>
                                                                    @else
                                                                        {{ $contract->name }}
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                            @foreach($item['files'] as $file)
                                                                <li>
                                                                    @if( $file->is_active )
                                                                        <a href="{{ route('file' , $file->slug) }}"
                                                                           target="_blank">
                                                                            {{ $file->name }}
                                                                        </a>
                                                                    @else
                                                                        {{ $file->name }}
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                @foreach($items as $key => $item)
                                    @if($item['category']->hidden)
                                        <div style='display: flex; flex-direction: row;'>
                                            <lottie-player
                                                src="https://assets7.lottiefiles.com/packages/lf20_wrbylkbm.json"
                                                background="transparent" speed="1" style="width: 90px; height: 90px;"
                                                loop autoplay>
                                            </lottie-player>

                                            <h2 style="vertical-align: bottom; color:#957f47;padding-top: 2rem!important;">
                                                {{ $item['category']->name }}
                                            </h2>
                                            <div>
                                                <lottie-player
                                                    src="https://assets2.lottiefiles.com/packages/lf20_7imyxpi7.json"
                                                    background="transparent" speed="1"
                                                    style="width: 80px; height: 80px;margin-top: 2rem!important;" loop
                                                    autoplay></lottie-player>
                                            </div>

                                        </div>
                                        @foreach($item['contracts'] as $contract)
                                            @if( $contract->is_active )
                                                <a href="{{ route('contract' , $contract->slug) }}"
                                                   target="_blank" class="w-100">
                                                    <h3 class="border- mt-3 p-3 w-100"
                                                        style="background-color: red; color:black;  border-radius: 12px;">
                                                        {{ $contract->name }}
                                                        <br>
                                                        به ارزش:
                                                        {{ number_format($contract->price, null, '.', ',') }}
                                                        تومان
                                                    </h3>
                                                </a>
                                            @else
                                                <h3 class="border- mt-3 p-3"
                                                    style="background-color: red; color:black;  border-radius: 12px;">
                                                    {{ $contract->name }}
                                                    <br>
                                                    به ارزش:
                                                    {{ number_format($contract->price, null, '.', ',') }}
                                                    تومان
                                                </h3>
                                            @endif
                                        @endforeach
                                        @foreach($item['files'] as $file)
                                            @if( $file->is_active )
                                                <a href="{{ route('file' , $file->slug) }}"
                                                   target="_blank" class="w-100">
                                                    <h3 class="border- mt-3 p-3 w-100"
                                                        style="background-color: red; color:black;  border-radius: 12px;">
                                                        {{ $file->name }}
                                                        <br>
                                                        به ارزش:
                                                        {{ number_format($file->price, null, '.', ',') }}
                                                        تومان
                                                    </h3>
                                                </a>
                                            @else
                                                <h3 class="border- mt-3 p-3"
                                                    style="background-color: red; color:black;  border-radius: 12px;">
                                                    {{ $file->name }}
                                                    <br>
                                                    به ارزش:
                                                    {{ number_format($file->price, null, '.', ',') }}
                                                    تومان
                                                </h3>
                                            @endif
                                        @endforeach

                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-2 text-center">



                <div style='display: flex; flex-direction: row;'>
                    <div class="col-md-3 col-sm-12 col-xs-3 mt-5"></div>
                    <lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_9mxfay17.json"
                                   background="transparent" speed="1" style="width: 40px; height: 40px;" loop autoplay>
                    </lottie-player>
                    <h3>
                        شاید از خودت بپرسی چرا باید این محصول رو بخرم؟
                    </h3>
                    <div class="col-md-3 col-sm-12 col-xs-3 mt-5"></div>
                </div>

                <div style='display: flex; flex-direction: row;'>
                    <div class="col-md-3 col-sm-12 col-xs-3 mt-5"></div>
                    <lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_9mxfay17.json"
                                   background="transparent" speed="1" style="width: 40px; height: 40px;" loop autoplay>
                    </lottie-player>
                    <h3>
                        یا این محصول چه مشکلی رو حل میکنه؟
                    </h3>
                    <div class="col-md-3 col-sm-12 col-xs-3 mt-5"></div>
                </div>


                <div class="about-img w-100">
                    <lottie-player src="{{asset('assets/anim/arrow_down.json')}}" background="transparent" speed="1"
                                   style="width: 150px; height: 150px;margin: auto;" loop autoplay></lottie-player>

            <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                <div class="single-pricing" style="background-color:#FFA200;">
                    {!! $package->description !!}
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 mt-5" style="margin: auto;">
            <div class="m-auto mb-5  text-center">
                <div class="alert alert-danger" style="background-color:red;">
                    <p style="color:#eeeeee;">قیمت محصول (پکیج کامل با هدایای ویژه)</p>
                </div>
                @if ($package->price < $package->old_price)
                    <!-- <strong>این پکیج شامل {{ number_format($package->old_price - $package->price, null, '.', ',') }} تومان تخفیف می باشد.</strong> -->
                    <!-- <div class="text-danger text-decoration-line-through"> -->
                    <!-- قیمت قبلی: {{ number_format($package->old_price, null, '.', ',') }}<span class="toman text-decoration-line-through">تومان</span> -->
                    <!-- </div> -->
                    <div>
                        <del style='color:red;'>
                            <p style='color:black; font-size:18px;'>
                                {{ number_format($package->old_price, null, '.', ',') }}تومان</p>
                        </del>
                    </div>
                @endif
                <span class="toman"
                      style='font-size:26px; color:red;'>{{ number_format($package->price, null, '.', ',') }}تومان</span>

                <div class="pricing-btn text-center mt-3">
                    <a href="{{ route('buyPackage', $package->slug) }}" class="w-100 main-btn btn-hover"
                       style="background-color:#FFA200; color:#000000;">خرید و دانلود</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection

@section('js')
    <script
        src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
    </script>
@endsection
