@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                    @if($category == "all")
                        <li class="breadcrumb-item px-0 active">پکیج ها</li>
                    @else
                        <li class="breadcrumb-item px-0 active"><a href="{{ route('category' , $category->slug) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item px-0">پکیج ها</li>
                    @endif
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">
                                <i class="lni lni-files"></i>
                                {{ $category != "all" ? 'پکیج های ' . $category->name : 'همه پکیج ها' }}
                            </h1>

                            <div class="row">
                                @foreach($packages as $package)
                                    <div class="col-xl-3 col-md-4 col-12 px-sm-2 px-1 mb-3">
                                        <div class="pricing-box w-100">
                                            <div class="single-pricing m-0">
                                                <div class="price-header text-center" style="height:200px; width:200px;">
                                                    <div class="shape">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                            <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="{{ $category != "all" ? $category->color : $package->category()->color }}{{--#{{ (['ECFAEB' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}--}}" />
                                                        </svg>
                                                    </div>
                                                    <div class="text">
                                                        <h3 class="package-name">{{ $package->name }}</h3>
                                                        <h2 class="price">{{ number_format($package->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                        @if ($package->price < $package->old_price)
                                                            <small class="text-decoration-line-through text-danger">{{ number_format($package->old_price, null, '.', ',') }}<span class="text-decoration-line-through toman">تومان</span></small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="content">
{{--                                                    {!! empty($package->summary) ? Str::limit(strip_tags($package->description), 100) : nl2br($package->summary) !!}--}}
                                                    {!! nl2br($package->summary) !!}
                                                </div>
                                                <div class="pricing-btn text-center mt-15">
                                                    <a href="{{ route('package', $package->slug) }}" class="main-btn btn-hover">مشاهده و خرید</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="accordion pb-15" id="accordionExample">
                            <div class="single-faq">
                                <button class="w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Which Service We Provide?
                                </button>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="faq-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                    </div>
                                </div>
                            </div>
                            <div class="single-faq">
                                <button class="w-100 text-start collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What I need to start design?
                                </button>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="faq-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
