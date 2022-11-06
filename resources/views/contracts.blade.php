@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                    @if($category == "all")
                        <li class="breadcrumb-item px-0 active">قرارداد ها</li>
                    @else
                        <li class="breadcrumb-item px-0 active"><a href="{{ route('category' , $category->slug) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item px-0">قرارداد ها</li>
                    @endif
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">
                                <i class="lni lni-certificate"></i>
                                {{ $category != "all" ? '' . $category->name : 'همه قرارداد ها' }}
                            </h1>

                            <div class="row">
                                @foreach($contracts as $contract)
                                    <div class="col-xl-3 col-md-4 col-12 px-sm-2 px-1 mb-3">
                                        <div class="pricing-box w-100">
                                            <div class="single-pricing m-0">
                                                <div class="price-header text-center">
                                                    <div class="shape">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                            <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="{{ $contract->category->color }}{{--#{{ (['ECFAEB' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}--}}" />
                                                        </svg>
                                                    </div>
                                                    <div class="text">
                                                        <h3 class="package-name">{{ $contract->name }}</h3>
                                                        <h2 class="price">{{ number_format($contract->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                        @if ($contract->price < $contract->old_price)
                                                            <small class="text-decoration-line-through text-danger">{{ number_format($contract->old_price, null, '.', ',') }}<span class="text-decoration-line-through toman">تومان</span></small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="content">
{{--                                                    {!! empty($contract->summary) ? Str::limit(strip_tags($contract->description), 100) : nl2br($contract->summary) !!}--}}
                                                    {!! nl2br($contract->summary) !!}
                                                </div>
                                                <div class="pricing-btn text-center mt-15">
                                                    <a href="{{ route('contract', $contract->slug) }}" class="main-btn btn-hover">مشاهده و خرید</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
