@extends('layout')

@section('content')
    @if( $category->description)
    <!-- ========================= hero-section start ========================= -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">
                            {{ $category->name }}
                        </h1>
                        <div class="wow fadeInUp" data-wow-delay=".6s">
                            {!! $category->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= hero-section end ========================= -->
    @endif
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="pricing-section">
        <div class="container">
            @if($packages->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5 text-center">
                            <h1 class="mb-25 text-primary">
                                <i class="lni lni-files"></i>
                                پکیج ها
                            </h1>
                        </div>
                        <div class="row">
                            @foreach($packages as $package)
                                <div class="col-xl-3 col-md-4 col-6 px-sm-2 px-1 mb-3">
                                    <div class="pricing-box w-100">
                                        <div class="single-pricing m-0">
                                            <div class="price-header text-center">
                                                <div class="shape">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                        <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#{{ (['ffeaea' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}" />
                                                    </svg>
                                                </div>
                                                <div class="text">
                                                    <h3 class="package-name">{{ $package->name }}</h3>
                                                    <h2 class="price">{{ number_format($package->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                    @if ($package->price < $package->old_price)
                                                        <small class="text-decoration-line-through">{{ number_format($package->old_price, null, '.', ',') }}<span class="text-decoration-line-through toman">تومان</span></small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="content">
                                                {!! empty($package->summary) ? Str::limit(strip_tags($package->description), 100) : nl2br($package->summary) !!}
                                            </div>
                                            <div class="pricing-btn text-center mt-15">
                                                <a href="{{ route('package', $package->slug) }}" class="main-btn btn-hover">مشاهده و خرید</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="view-all-btn text-center pt-30">
                            <a href="{{ route('packages', $category->slug) }}" class="main-btn btn-hover">لیست کلیه پکیج ها</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($contracts->count() > 0)
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5 text-center">
                            <h1 class="mb-25 text-primary">
                                <i class="lni lni-certificate"></i>
                                قرارداد ها
                            </h1>
                        </div>
                        <div class="row">
                            @foreach($contracts as $contract)
                                <div class="col-xl-3 col-md-4 col-6 px-sm-2 px-1 mb-3">
                                    <div class="pricing-box w-100">
                                        <div class="single-pricing m-0">
                                            <div class="price-header text-center">
                                                <div class="shape">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                        <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#{{ (['ffeaea' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}" />
                                                    </svg>
                                                </div>
                                                <div class="text">
                                                    <h3 class="package-name">{{ $contract->name }}</h3>
                                                    <h2 class="price">{{ number_format($contract->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                    @if ($contract->price < $contract->old_price)
                                                        <small class="text-decoration-line-through">{{ number_format($contract->old_price, null, '.', ',') }}<span class="text-decoration-line-through toman">تومان</span></small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="content">
                                                {!! empty($contract->summary) ? Str::limit(strip_tags($contract->description), 100) : nl2br($contract->summary) !!}
                                            </div>
                                            <div class="pricing-btn text-center mt-15">
                                                <a href="{{ route('contract', $contract->slug) }}" class="main-btn btn-hover">مشاهده و خرید</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="view-all-btn text-center pt-30">
                            <a href="{{ route('contracts', $category->slug) }}" class="main-btn btn-hover">لیست کلیه قرارداد ها</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($files->count() > 0)
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5 text-center">
                            <h1 class="mb-25 text-primary">
                                <i class="lni lni-zip"></i>
                                فایل ها
                            </h1>
                        </div>
                        <div class="row">
                            @foreach($files as $file)
                                <div class="col-xl-3 col-md-4 col-6 px-sm-2 px-1 mb-3">
                                    <div class="pricing-box w-100">
                                        <div class="single-pricing m-0">
                                            <div class="price-header text-center">
                                                <div class="shape">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                        <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#{{ (['ffeaea' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}" />
                                                    </svg>
                                                </div>
                                                <div class="text">
                                                    <h3 class="package-name">{{ $file->name }}</h3>
                                                    <h2 class="price">{{ number_format($file->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                    @if ($file->price < $file->old_price)
                                                        <small class="text-decoration-line-through">{{ number_format($file->old_price, null, '.', ',') }}<span class="text-decoration-line-through toman">تومان</span></small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="content">
                                                {!! empty($file->summary) ? Str::limit(strip_tags($file->description), 100) : nl2br($file->summary) !!}
                                            </div>
                                            <div class="pricing-btn text-center mt-15">
                                                <a href="{{ route('file', $file->slug) }}" class="main-btn btn-hover">مشاهده و خرید</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="view-all-btn text-center pt-30">
                            <a href="{{ route('files', $category->slug) }}" class="main-btn btn-hover">لیست کلیه فایل ها</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
