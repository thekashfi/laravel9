@extends('layout')

@section('content')

<section id="about" class="about-section pt-150">
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
                        <p>تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت</p>
                    </div>
                    <div class="accordion pb-15" id="accordionExample">
                        <div class="single-faq">
                            <button class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                تایپ به پایان رسد وزمان مورد نیاز شامل
                            </button>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="faq-content">
                                    حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                </div>
                            </div>
                        </div>
                        <div class="single-faq">
                            <button class="w-100 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت
                            </button>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="faq-content">
                                    تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت
                                </div>
                            </div>
                        </div>
                        <div class="single-faq">
                            <button class="w-100 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                شناخت فراوان جامعه و متخصصان را می طلبد
                            </button>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="faq-content">
                                    صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
