@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('contracts') }}">قرارداد ها</a></li>
                  <li class="breadcrumb-item px-0"><a href="{{ route('contracts', $contract->category->slug) }}">قرارداد های مشاوره</a></li>
                  <li class="breadcrumb-item px-0 active" aria-current="page">{{ $contract->name }}</li>
                </ol>
              </nav>
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">{{ $contract->name }}</h1>
                            {!! $contract->description !!}
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
                <div class="col-lg-4 text-center">
                    <div class="about-img">
                        {{-- <img src="{{ url('') }}/bliss/img/about/about-img.svg" alt="about"> --}}
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
                                        <h3 class="package-name">تومان</h3>
                                    </div>
                                </div>
                                <ul class="content">
                                    <li>به همراه توضیحات کامل و کافی و وافی</li>
                                    <li>پشتیبانی یکماهه</li>
                                    <li><strong>امکان فلان</strong></li>
                                    <li>ویژگی بیسان</li>
                                    <li>بهترین قرارداد</li>
                                    <li>برترین محصول سال</li>
                                </ul>
                                <div class="pricing-btn text-center">
{{--                                    <a onclick='this.style.display = "none"; document.querySelector("#dl").classList.remove("d-none");' class="main-btn btn-hover">خرید</a>--}}
                                    <a href="{{ route('form', $contract->slug) }}" class="main-btn btn-success btn-hover">دانلود</a>
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
