@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('category' , $package->category->slug) }}">{{ $package->category->name }}</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('packages', $package->category->slug) }}">پکیج ها</a></li>
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
                            {!! $package->description !!}
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
                                        <h2 class="price">{{ number_format($package->price, null, '.', ',') }}</h2>
                                        <h3 class="package-name">تومان</h3>
                                    </div>
                                </div>
                                <ul class="content">
                                    <li>
                                        موارد موجود در پکیج:
                                    </li>
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
