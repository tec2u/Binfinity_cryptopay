@extends('layouts.header')
@section('content')
<style>
    @media (max-width: 720px) {
   .videodsh {
      width: 100%;
   }
}
</style>
<main id="main" class="main">
    @include('flash::message')
    <section id="herosection" style="backdrop-filter: blur(20px);filter: brightness(120%) grayscale(0%) saturate(120%); ">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                    <div class="text-center" style="margin: 0 auto;">
                    
                        <div class="mt-3">
                            <p class="pheroland" data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true">@lang('leadpage.home.landpagetxt')</p>
                            <h3 class=" hheroland fw-bold" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">@lang('leadpage.home.landpageh')</h3>
                        </div>
                        <div class="dropdown mt-3 mb-3">
                            <button class="btn dropdown-toggle btn-lang mx-auto" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                @lang('header.language')
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/setlocale/en"><img src="../assetsWelcome/images/flagunited-kingdom.png" style="width: 18px;margin-right:10px" alt="...">@lang('header.english')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/setlocale/es"><img src="../assetsWelcome/images/flagspain.png" style="width: 18px;margin-right:10px" alt="...">@lang('header.spanish')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/setlocale/de"><img src="../assetsWelcome/images/flaggermany.png" style="width: 18px;margin-right:10px" alt="...">@lang('header.german')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/setlocale/fr"><img src="../assetsWelcome/images/flagfrance.png" style="width: 18px;margin-right:10px" alt="...">@lang('header.french')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 mb-5">
                            <div>
                                <iframe class="videodsh" width="1000" height="700" src=@lang('videos.backoffice')>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection