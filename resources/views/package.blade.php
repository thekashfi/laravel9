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
                            {!! $package->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
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
                                <ul class="content">
                                    <li>
                                        موارد موجود در پکیج:
                                    </li>


                                    <div class="accordion" id="accordionExample">
                                        @foreach(array_merge($package->contracts->map(function($item){return $item->packageCategory();}) , $package->contracts->map(function($item){return $item->packageCategory();}) ) as $contract)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Accordion Item #1
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @foreach($package->contracts as $contract)
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
                                    @foreach($package->files as $file)
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
                                <div class="pricing-btn text-center">
                                    <a href="{{ route('buyPackage', $package->slug) }}" class="main-btn btn-hover">خرید</a>
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
