@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                      <li class="breadcrumb-item px-0"><a
                              href="{{ route('category' , $contract->category()->slug) }}">{{ $contract->category()->name }}</a>
                      </li>
                      <li class="breadcrumb-item px-0"><a href="{{ route('contracts', $contract->category()->slug) }}">قرارداد
                              ها</a></li>
                      <li class="breadcrumb-item px-0 active" aria-current="page">{{ $contract->name }}</li>
                  </ol>
              </nav>
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">
                                <i class="lni lni-certificate" style="margin-left: 15px;"></i>
                                {{ $contract->name }}
                            </h1>
                            {!! $contract->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="about-img">
                        <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="single-pricing">
                                <div class="price-header">
                                    <div class="shape">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                            <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#ced7ff"></path>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <h2 class="price">{{ number_format($contract->price, null, '.', ',') }}</h2>
                                        <h3 class="package-name ">تومان</h3>
                                    </div>
                                </div>
                                @if ($contract->price < $contract->old_price)
                                    <div class="alert alert-success">
                                        <strong>این قرارداد شامل {{ number_format($contract->old_price - $contract->price, null, '.', ',') }} تومان تخفیف می باشد.</strong>
                                        <br> قیمت قبلی: {{ number_format($contract->old_price, null, '.', ',') }}<span class="toman">تومان</span>
                                    </div>
                                @endif
                                <ul class="content">
                                    <li>دسترسی آسان</li>
                                    <li>پشتیبانی یکماهه</li>
                                    <li><strong>امکان ویرایش</strong></li>
                                    <li>بدون تاریخ انقضا</li>

                                </ul>
                                <div class="pricing-btn text-center">
                                    @auth
                                        @if ($contract->isBought(auth()->user()))
                                            <a href="{{ route('payments' , ['contract' => $contract->id]) }}" class="main-btn btn-success btn-hover">دانلود</a>
                                        @else
                                            <a href="{{ route('buy', $contract->slug) }}" class="main-btn btn-hover">خرید</a>
                                        @endif
                                    @else
                                        <a href="{{ route('buy', $contract->slug) }}" class="main-btn btn-hover">خرید</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
