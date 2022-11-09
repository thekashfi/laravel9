@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('category' , $package->category()->slug) }}">{{ $package->category()->name }}</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('packages', $package->category()->slug) }}">پکیج ها</a></li>
                  <li class="breadcrumb-item px-0 active" aria-current="page">{{ $package->name }}</li>
                </ol>
              </nav>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">
                                <i class="lni lni-files" style="margin-left: 15px;"></i>
                                {{ $package->name }}
                            </h1>
                            @if(! empty($package->image))
                                <img src="{{ $package->image }}" class="w-75" alt="{{ $package->name }}">
                            @endif
                            @if($package->slogan1)
                                <h2 class="border- mt-2 p-3 text-danger" style="background-color: #eeeeee;border-radius: 12px;">{{ $package->slogan1 }}</h2>
                            @endif
                            @if($package->slogan2)
                                <h2 class="border- mt-2 p-3 text-danger" style="background-color: #eeeeee;border-radius: 12px;">{{ $package->slogan2 }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="about-img">
                        <div class="pricing-box tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="single-pricing">
                                <div class="accordion" id="accordionExample">
                                    @foreach($items  as $key => $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$key}}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                                تعداد {{ $item['category']->name }}ها: {{ $item['count'] }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="content">
                                                    @foreach($item['contracts'] as $contract)
                                                        <li>
                                                            @if( $contract->is_active )
                                                                <a href="{{ route('contract' , $contract->slug) }}" target="_blank">
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
                                                                <a href="{{ route('file' , $file->slug) }}" target="_blank">
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {!! $package->description !!}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="price-header">
                        <div class="shape">
                            <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#ced7ff"></path>
                            </svg>
                        </div>
                        <div class="text">
                            <h2 class="price">{{ number_format($package->price, null, '.', ',') }}</h2>
                            <h3 class="package-name ">تومان</h3>
                        </div>
                    </div>
                    @if ($package->price < $package->old_price)
                        <div class="alert alert-success">
                            <strong>این پکیج شامل {{ number_format($package->old_price - $package->price, null, '.', ',') }} تومان تخفیف می باشد.</strong>
                            <br> قیمت قبلی: {{ number_format($package->old_price, null, '.', ',') }}<span class="toman">تومان</span>
                        </div>
                    @endif
                    <div class="pricing-btn text-center">
                        <a href="{{ route('buyPackage', $package->slug) }}" class="main-btn btn-hover">خرید</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
