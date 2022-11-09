<!DOCTYPE html>
<html class="no-js" lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>منبع قرارداد</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('') }}/front-assets/img/favicon.svg" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/bootstrap-5.0.0-beta2.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/animate.css" />
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/main.css?v1.0" />
    <link rel="stylesheet" href="{{ url('') }}/front-assets/css/style.css?v1.0" />
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Variable-font-face.css" rel="stylesheet"
        type="text/css" />
    @yield('head')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous"> --}}
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
{{--    <div class="preloader">--}}
{{--        <div class="loader">--}}
{{--            <div class="spinner">--}}
{{--                <div class="spinner-container">--}}
{{--                    <div class="spinner-rotator">--}}
{{--                        <div class="spinner-left">--}}
{{--                            <div class="spinner-circle"></div>--}}
{{--                        </div>--}}
{{--                        <div class="spinner-right">--}}
{{--                            <div class="spinner-circle"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- preloader end -->


    <!-- ========================= header start ========================= -->
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('') }}">
                                <img src="{{ url('') }}/front-assets/img/logo/logo.svg" alt="Logo" />
                                <span class="logo-text pe-1">Raad Business</span>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav me-4">
                                    <li class="nav-item">
                                        <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "home" ) active @endif" href="{{ route('home') }}">خانه</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            دسته بندی ها
                                        </a>
                                        <ul class="dropdown-menu px-3 shadow rounded-3 border-0 text-end" aria-labelledby="navbarDropdown">
                                            @foreach(\App\Models\Category::query()->visible()->orderBy('order')->latest()->get() as $h_category)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('category', $h_category->slug) }}">{{ $h_category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @if(\App\Http\Controllers\IndexController::view('hasContract'))
                                        <li class="nav-item">
                                            <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "contracts" and request()->route('category') == "all" ) active @endif" href="{{ route('contracts' , 'all') }}">قرارداد ها</a>
                                        </li>
                                    @endif
                                    @if(\App\Http\Controllers\IndexController::view('hasPackage'))
                                        <li class="nav-item">
                                            <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "packages" and request()->route('category') == "all" ) active @endif" href="{{ route('packages' , 'all') }}">پکیج ها</a>
                                        </li>
                                    @endif
                                    @if(\App\Http\Controllers\IndexController::view('hasFile'))
                                        <li class="nav-item">
                                            <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "files" and request()->route('category') == "all" ) active @endif" href="{{ route('files' , 'all') }}">فایل ها</a>
                                        </li>
                                    @endif
                                    @foreach(\App\Models\Category::where('in_menu', true)->orderBy('order')->visible()->get() as $h_category)
                                        <li class="nav-item">
                                            <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "contracts" and request()->route('category') == $h_category->slug ) active @endif" href="{{ route('contracts', $h_category->slug) }}">{{ $h_category->name }}</a>
                                        </li>
                                    @endforeach
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="" href="">درخواست قرارداد</a>--}}
{{--                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "connectus" ) active @endif" href="{{ route('connectus') }}">ارتباط با ما</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "aboutus" ) active @endif" href="{{ route('aboutus') }}">درباره ما</a>--}}
{{--                                    </li>--}}

                                    @auth
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                منوی کاربری
                                            </a>
                                            <ul class="dropdown-menu px-3 shadow rounded-3 border-0 text-end" aria-labelledby="navbarDropdown">
                                                @if(auth()->user()->is_admin )
                                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">محیط ادمین</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                @endif
                                                <li><a class="dropdown-item" href="{{ route('payments') }}">قرارداد های من</a></li>
                                                <li><a class="dropdown-item" href="{{ route('payments_history') }}">فاکتور ها</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="{{ route('auth.logout') }}">خروج</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <div class="navbar-btn d-sm-inline-block">
                                                <a href="{{ route('auth.showLogin') }}" class="ud-main-btn ud-login-btn">
                                                ورود
                                                </a>
                                                /
                                                <a href="{{ route('auth.showLogin') }}" class="ud-main-btn ud-white-btn">
                                                ثبت نام
                                                </a>
                                            </div>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            <!-- navbar collapse -->
                        </nav>
                        <!-- navbar -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->
    </header>

    <div class="pt-100"></div>

    @if(Session::has('flash'))
        <div class="alert alert-success alert-dismissible border-0 fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Info" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {!! Session::get('flash') !!}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>اشکالات زیر را برطرف کنید:</strong>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    @yield('content')

    <!-- ========================= footer start ========================= -->
		<footer class="footer">
			<div class="container">
				<div class="widget-wrapper">
					<div class="row">
						<div class="col-xl-3 col-md-6">
							<div class="footer-widget">
								<div class="logo mb-35">
									<a href="{{ route('home') }}"> <img src="{{ url('') }}/front-assets/img/logo/logo.svg" alt=""> </a>
								</div>
								<p class="desc mb-35" style="text-align: justify">
                                    مجوعه راد بیزینس با سالها تجربه در زمینه های بیزینس کوچ و مشاوره کسب و کار، مهم ترین قراردادها، فرم ها و تعهدنامه ها رو برای شما عزیزان آماده کرده که یکی از دغدغه های بزرگ شماها رو رفع کرده باشه
                                </p>
								<ul class="socials">
									<li>
										<a href="https://telegram.me/raadbusiness"> <i class="lni lni-telegram-original"></i> </a>
									</li>
									<li>
										<a href="https://twitter.com/raadbusiness"> <i class="lni lni-twitter-filled"></i> </a>
									</li>
									<li>
										<a href="https://instagram.com/radbusiness"> <i class="lni lni-instagram-filled"></i> </a>
									</li>
									<li>
										<a href="https://youtube.com/channel/UCrDxtXwbiZ8rXuoK_nrsr5Q"> <i class="lni lni-youtube"></i> </a>
									</li>
									<!--<li>-->
									<!--	<a href="jvascript:void(0)"> <i class="lni lni-linkedin-original"></i> </a>-->
									<!--</li>-->
								</ul>
							</div>
						</div>

						<div class="col-xl-2 offset-xl-1 col-md-5 offset-md-1 col-sm-6">
							<div class="footer-widget">
								<h3>لینک ها</h3>
								<ul class="links">
									<li> <a href="{{ route('home') }}">صفحه اصلی</a> </li>

                                    @if(\App\Http\Controllers\IndexController::view('hasContract'))
                                        <li>
                                            <a class="" href="{{ route('contracts' , 'all') }}">قرارداد ها</a>
                                        </li>
                                    @endif

                                    @if(\App\Http\Controllers\IndexController::view('hasPackage'))
                                        <li>
                                            <a href="{{ route('packages' , 'all') }}">پکیج ها</a>
                                        </li>
                                    @endif
                                    @if(\App\Http\Controllers\IndexController::view('hasFile'))
                                        <li>
                                            <a href="{{ route('files' , 'all') }}">فایل ها</a>
                                        </li>
                                    @endif
                                    @auth
                                        <li><a href="{{ route('payments') }}">قرارداد های من</a></li>
                                        <li><a href="{{ route('payments_history') }}">فاکتور ها</a></li>
                                    @else
                                        <li>
                                            <a href="{{ route('auth.showLogin') }}">
                                                ورود
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.showLogin') }}">
                                                ثبت نام
                                            </a>
                                        </li>
                                    @endauth
                                    <li>
                                        <a class="" href="{{ route('aboutus') }}">درباره ما</a>
                                    </li>
                                    <li>
                                        <a class="" href="{{ route('connectus') }}">ارتباط با ما</a>
                                    </li>
								</ul>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 col-sm-6">
                            @if(\App\Http\Controllers\IndexController::view('hasCategory'))
                                <div class="footer-widget">
                                    <h3>دسته بندی ها</h3>
                                    <ul class="links">
                                        @foreach(\App\Models\Category::query()->visible()->orderBy('order')->limit(7)->latest()->get() as $h_category)
                                            <li>
                                                <a class="" href="{{ route('category', $h_category->slug) }}">{{ $h_category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
						</div>

						<div class="col-xl-3 col-md-6">
							<div class="footer-widget">
								<h3>ارتباط با ما</h3>
								<ul>
									<li>09170755215</li>
									<li>شیراز، بلوار مدرس، خیابان غدیر، خیابان شهید شجاعی، کوچه 14</li>
								</ul>
                                <h3 class="mb-3 mt-30">نمادها</h3>
								<div class="contact_map">
{{--									<div class="gmap_canvas">--}}
{{--										<iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" style="width: 100%;"></iframe>--}}
{{--									</div>--}}
                                    <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>

                                </div>
							</div>
						</div>

					</div>
				</div>

{{--				<div class="copy-right">--}}
{{--					<p>Design and Developed by <a href="https://uideck.com" rel="nofollow" target="_blank"> UIdeck </a></p>--}}
{{--				</div>--}}

			</div>
		</footer>
    <!-- ========================= footer end ========================= -->


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ url('') }}/front-assets/js/bootstrap-5.0.0-beta2.min.js"></script>
    <script src="{{ url('') }}/front-assets/js/count-up.min.js"></script>
    <script src="{{ url('') }}/front-assets/js/tiny-slider.js"></script>
    <script src="{{ url('') }}/front-assets/js/wow.min.js"></script>
    <script src="{{ url('') }}/front-assets/js/polifill.js"></script>
    <script src="{{ url('') }}/front-assets/js/main.js"></script>
</body>

</html>
