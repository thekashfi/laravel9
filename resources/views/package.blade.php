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
                      <li class="breadcrumb-item px-0"><a href="{{ route('category' , $package->category()->slug) }}">{{ $package->category()->name }}</a></li>
                      <li class="breadcrumb-item px-0"><a href="{{ route('packages', $package->category()->slug) }}">پکیج ها</a></li>
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
                                <h3 class="border- mt-3 p-3 text-danger" style="background-color: #eeeeee;border-radius: 12px;">{{ $package->slogan1 }}</h2>
                            @endif
                            @if($package->slogan2)
                                <h3 class="border- mt-3 p-3 text-danger" style="background-color: #eeeeee;border-radius: 12px;">{{ $package->slogan2 }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="about-img w-100">
                        <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="single-pricing">
                                <div class="accordion" id="accordionExample">
                                    @foreach($items  as $key => $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$key}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                                تعداد {{ $item['category']->name }}‌ها: {{ $item['count'] }} عدد
                                            </button>
                                        </h2>
                                        <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="content">
                                                    @foreach($item['contracts'] as $contract)
                                                        <li>
                                                            @if( $contract->is_active )
                                                                <a href="{{ route('contract' , $contract->slug) }}" target="_blank">
                                                                    {{ $contract->name }} @if( $item['category']->hidden )(به ارزش: {{ number_format($contract->old_price, null, '.', ',') }}<span class="toman">تومان</span>)@endif
                                                                </a>
                                                            @else
                                                                {{ $contract->name }} @if( $item['category']->hidden )(به ارزش: {{ number_format($contract->old_price, null, '.', ',') }}<span class="toman">تومان</span>)@endif
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    @foreach($item['files'] as $file)
                                                        <li>
                                                            @if( $file->is_active )
                                                                <a href="{{ route('file' , $file->slug) }}" target="_blank">
                                                                    {{ $file->name }} @if( $item['category']->hidden )(به ارزش: {{ number_format($file->old_price, null, '.', ',') }}<span class="toman">تومان</span>)@endif
                                                                </a>
                                                            @else
                                                                {{ $file->name }} @if( $item['category']->hidden )(به ارزش: {{ number_format($file->old_price, null, '.', ',') }}<span class="toman">تومان</span>)@endif
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    شاید از خودت بپرسی چرا باید این محصول رو بخرم؟ یا این محصول چه مشکلی رو حل میکنه؟
                    <div class="about-img w-100">
                        <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="single-pricing">
                                {!! $package->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 mt-5">
                    <div class="alert alert-success m-auto mb-5">
                    @if ($package->price < $package->old_price)
                            <strong>این پکیج شامل {{ number_format($package->old_price - $package->price, null, '.', ',') }} تومان تخفیف می باشد.</strong>
                            <div class="text-danger text-decoration-line-through">
                            قیمت قبلی: {{ number_format($package->old_price, null, '.', ',') }}<span class="toman text-decoration-line-through">تومان</span>
                            </div>
                    @endif
                        قیمت فعلی :  {{ number_format($package->price, null, '.', ',') }}<span class="toman">تومان</span>

                        <div class="pricing-btn text-center mt-3">
                            <a href="{{ route('buyPackage', $package->slug) }}" class="w-100 main-btn btn-hover">خرید</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
