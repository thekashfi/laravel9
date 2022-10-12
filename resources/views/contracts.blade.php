@extends('layout')

@section('content')
    <!-- ========================= about-section start ========================= -->
    <section id="about" class="about-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item px-0"><a href="{{ route('home') }}">خانه</a></li>
                    @if(! $category)
                        <li class="breadcrumb-item px-0 active">قرارداد ها</li>
                    @else
                        <li class="breadcrumb-item px-0"><a href="{{ route('contracts') }}">قرارداد ها</a></li>
                        <li class="breadcrumb-item px-0 active">{{ $category->name }}</li>
                    @endif
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content mb-50">
                        <div class="section-title mb-50 ps-lg-5">
                            <h1 class="mb-25">قرارداد های مشاوره</h1>

                            <div class="row">
                                @foreach($contracts as $contract)
                                    <div class="col-xl-3 col-md-4 col-6 px-sm-2 px-1 mb-3">
                                        <a href="{{ route('contract', $contract->slug) }}">
                                            <div class="single-service h-100">
                                                <div class="content position-relative">
                                                    <h3 class="mb-3" class="mb-3">{{ $contract->name }}</h3>
                                                    <p class="mb-3 text-secondary">
                                                        {{ empty($contract->summary) ? Str::limit(strip_tags($contract->description), 100) : $contract->summary }}
                                                    </p>
                                                    <h2 class="price price-badge">{{ number_format($contract->price, null, '.', ',') }}<span class="toman">تومان</span></h2>
                                                </div>
                                            </div>
                                        </a>
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
                        <a href="javascript:void(0)" class="main-btn btn-hover">pagination buttons here</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= about-section end ========================= -->
@endsection
