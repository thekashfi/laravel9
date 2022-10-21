@extends('layout')

@section('content')
    <!-- ========================= hero-section start ========================= -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="wow fadeInLeft" data-wow-delay=".2s">لورم ایپسوم متن</span>
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">
                            تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                            تکنولوژی مورد نیاز و کاربردهای متنوع.
                        </p>

                        @if(\App\Http\Controllers\IndexController::view('hasContract'))
                            <a href="{{ route('contracts' , 'all') }}" class="main-btn btn-hover wow fadeInUp"
                               data-wow-delay=".6s">دیدن
                                نمونه قرارداد ها
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ url('') }}/front-assets/img/hero/hero-img.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= hero-section end ========================= -->

    @if(\App\Http\Controllers\IndexController::view('hasPackage'))
    <!-- ========================= client-logo-section start ========================= -->
    <section id="pricing" class="pricing-section pt-150">
        <div class="container">
            <div class="row">

                <div class="col-xxl-6 col-xl-5 col-lg-8">
                    <div class="pricing-content">
                        <div class="image">
                            <img src="{{ url('') }}/front-assets/img/pricing/pricing-shape.svg" alt="آخرین پکیج های ما">
                        </div>
                        <div class="section-title">
                            <h1 class="mb-20 wow fadeInUp" data-wow-delay=".2s">آخرین پکیج های ما</h1>
                            <p class="wow fadeInUp" data-wow-delay=".4s">پکیج ها برای شرکت ها مناسب می باشد تا قرارداد های مرتبط به حوضه کاری را هم زمان خریداری کنند.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-7" style="direction: ltr;text-align: left;">
                    <div class="pricing-active-wrapper">
                        <div class="pricing-active">
                            @foreach($packages as $package)

                                <div class="pricing-box">
                                    <div class="single-pricing"  style="direction: rtl;text-align: right;">
                                        <div class="price-header">
                                            <div class="shape">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="142.92" height="137" viewBox="0 0 142.92 137">
                                                    <path id="Path_751" data-name="Path 751" d="M17.065-3.312C-5.734,33.7-93.2,35.845-114.171-.154S-89.6-110.3-45.837-111.307C-2.071-112.381,39.864-40.384,17.065-3.312Z" transform="translate(119.436 111.319)" fill="#{{ (['ffeaea' ,'ffefff' , 'ced7ff'])[rand(0,2)] }}" />
                                                </svg>
                                            </div>
                                            <div class="text">
                                                <h3 class="package-name">{{ $package->name }}</h3>
                                                <h2 class="price">{{ number_format($package->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                            </div>
                                        </div>
                                        <div class="content">
                                            {!! empty($package->summary) ? Str::limit(strip_tags($package->description), 100) : nl2br($package->summary) !!}
                                        </div>
                                        <div class="pricing-btn text-center">
                                            <a href="{{ route('package', $package->slug) }}" class="main-btn btn-hover">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

{{--            <div class="view-all-btn text-center pt-30 mb-5">--}}
{{--                <a href="{{ route('packages' , 'all') }}" class="main-btn btn-hover">همه پکیج ها</a>--}}
{{--            </div>--}}
    <!-- ========================= client-logo-section end ========================= -->
    @endif

    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section img-bg pt-100 pb-100 mt-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img mb-50">
                        <img src="{{ url('') }}/front-assets/img/about/about-img.svg" alt="about">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50">
                            <h1 class="mb-25">حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد</h1>
                            <p>تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ
                                پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در
                                ارائه راهکارها و شرایط سخت</p>
                        </div>
                        <div class="accordion pb-15" id="accordionExample">
                            <div class="single-faq">
                                <button class="w-100" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    تایپ به پایان رسد وزمان مورد نیاز شامل
                                </button>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="faq-content">
                                        حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا
                                        مورد استفاده قرار گیرد.
                                    </div>
                                </div>
                            </div>
                            <div class="single-faq">
                                <button class="w-100 collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت
                                </button>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-bs-parent="#accordionExample">
                                    <div class="faq-content">
                                        تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان
                                        را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص
                                        طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید
                                        داشت
                                    </div>
                                </div>
                            </div>
                            <div class="single-faq">
                                <button class="w-100 collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    شناخت فراوان جامعه و متخصصان را می طلبد
                                </button>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                     data-bs-parent="#accordionExample">
                                    <div class="faq-content">
                                        صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                                        در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای
                                        متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد
                                        گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('aboutus') }}" class="main-btn btn-hover">درباره ما</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->


    @if(\App\Http\Controllers\IndexController::view('hasCategory'))
        <!-- ========================= service-section start ========================= -->
        <section id="service" class="service-section img-bg pt-100 pb-100 mt-150">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-10">
                        <div class="section-title text-center mb-50">
                            <h1>دسته بندی ها</h1>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($categories as $category)
                        <a class="col-xl-3 col-md-6" href="{{ route('category', $category->slug) }}">
                            <div class="single-service py-4">
                                <div class="content">
                                    <h3>{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="view-all-btn text-center pt-30">
                    @if(\App\Http\Controllers\IndexController::view('hasContract'))
                        <a href="{{ route('contracts' , 'all') }}" class="main-btn btn-hover">همه قرارداد ها</a>
                    @elseif(\App\Http\Controllers\IndexController::view('hasPackage'))
                            <a href="{{ route('packages' , 'all') }}" class="main-btn btn-hover">همه پکیج ها</a>
                    @elseif(\App\Http\Controllers\IndexController::view('hasFile'))
                            <a href="{{ route('files' , 'all') }}" class="main-btn btn-hover">همه فایل ها</a>
                    @endif
                </div>
            </div>
        </section>
        <!-- ========================= service-section end ========================= -->
    @endif

    <!-- ========================= counter-up-section start ========================= -->
    {{--		<section class="counter-up-section pt-150">--}}
    {{--			<div class="container">--}}
    {{--				<div class="row">--}}
    {{--					<div class="col-lg-6">--}}
    {{--						<div class="counter-up-content mb-50">--}}
    {{--							<div class="section-title mb-40">--}}
    {{--								<h1 class="mb-20 wow fadeInUp" data-wow-delay=".2s">Why we are the best, Why you hire?</h1>--}}
    {{--								<p class="wow fadeInUp" data-wow-delay=".4s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>--}}
    {{--							</div>--}}
    {{--							<div class="counter-up-wrapper">--}}
    {{--								<div class="row">--}}
    {{--									<div class="col-lg-6 col-sm-6">--}}
    {{--										<div class="single-counter">--}}
    {{--											<div class="icon color-1">--}}
    {{--												<i class="lni lni-emoji-smile"></i>--}}
    {{--											</div>--}}
    {{--											<div class="content">--}}
    {{--												<h1 id="secondo1" class="countup" cup-end="3642" cup-append=" ">3642</h1>--}}
    {{--												<span>Happy client</span>--}}
    {{--											</div>--}}
    {{--										</div>--}}
    {{--									</div>--}}
    {{--									<div class="col-lg-6 col-sm-6">--}}
    {{--										<div class="single-counter">--}}
    {{--											<div class="icon color-2">--}}
    {{--												<i class="lni lni-checkmark"></i>--}}
    {{--											</div>--}}
    {{--											<div class="content">--}}
    {{--												<h1 id="secondo2" class="countup" cup-end="5436" cup-append=" ">5436</h1>--}}
    {{--												<span>Project done</span>--}}
    {{--											</div>--}}
    {{--										</div>--}}
    {{--									</div>--}}
    {{--									<div class="col-lg-6 col-sm-6">--}}
    {{--										<div class="single-counter">--}}
    {{--											<div class="icon color-3">--}}
    {{--												<i class="lni lni-world"></i>--}}
    {{--											</div>--}}
    {{--											<div class="content">--}}
    {{--												<h1 id="secondo3" class="countup" cup-end="642" cup-append="K">642</h1>--}}
    {{--												<span>Live Design</span>--}}
    {{--											</div>--}}
    {{--										</div>--}}
    {{--									</div>--}}
    {{--									<div class="col-lg-6 col-sm-6">--}}
    {{--										<div class="single-counter">--}}
    {{--											<div class="icon color-4">--}}
    {{--												<i class="lni lni-users"></i>--}}
    {{--											</div>--}}
    {{--											<div class="content">--}}
    {{--												<h1 id="secondo4" class="countup" cup-end="42" cup-append=" ">42</h1>--}}
    {{--												<span>Creative designer's</span>--}}
    {{--											</div>--}}
    {{--										</div>--}}
    {{--									</div>--}}
    {{--								</div>--}}
    {{--							</div>--}}
    {{--						</div>--}}
    {{--					</div>--}}
    {{--					<div class="col-xl-6 col-lg-6">--}}
    {{--						<div class="counter-up-img mb-50">--}}
    {{--							<img src="{{ url('') }}/front-assets/img/counter-up/counter-up-img.svg" alt="">--}}
    {{--						</div>--}}
    {{--					</div>--}}
    {{--				</div>--}}
    {{--			</div>--}}
    {{--		</section>--}}

    <section class="cta-section img-bg pt-110 pb-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title mb-50">
                        <h1 class="mb-20 wow fadeInUp" data-wow-delay=".2s">قرارداد مد نظرتان یافت نشد؟</h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s">با ما در ارتباط باشید تا از خدمات مشاوره حقوقی و
                            راهنمایی‌های بیشتر بهرمند شوید.</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="cta-btn text-lg-end mb-50">
                        <a href="{{ route('connectus') }}" class="main-btn btn-hover text-uppercase">تماس با گروه وکالتی
                            ما</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= cta-section end ========================= -->
@endsection
