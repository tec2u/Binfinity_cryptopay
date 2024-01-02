@extends('layouts.header')
@section('content')
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <style>
    .swal2-popup,
    .swal2-modal,
    .swal2-show {
      /* max-height: 40vh !important; */
      width: fit-content !important;
      padding: 0;
    }

    .swal2-container img {
      width: 400px !important;
      max-height: 300px !important;
    }
  </style>
  @php

    $user_id = ucwords(auth()->user()->id);

    $diretos_qr = Illuminate\Support\Facades\DB::select("SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=$user_id and level_from=1;");
    $diretos = isset($diretos_qr[0]->{'total'}) ? $diretos_qr[0]->{'total'} : 0;

    $indiretos_qr = Illuminate\Support\Facades\DB::select("SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=$user_id and level_from>1 and level_from<'6';");
    $indiretos = isset($indiretos_qr[0]->{'total'}) ? $indiretos_qr[0]->{'total'} : 0;

    $totalMembros = $diretos + $indiretos;

    $directVolume = Illuminate\Support\Facades\DB::select("SELECT sum(score) as total FROM historic_score where user_id=$user_id and level_from=1");
    $directVolume = isset($directVolume[0]->{'total'}) ? $directVolume[0]->{'total'} : 0;

    $indirectVolume = Illuminate\Support\Facades\DB::select("SELECT sum(score) as total FROM historic_score where user_id=$user_id and level_from>1 and level_from<'6'   ");
    $indirectVolume = isset($indirectVolume[0]->{'total'}) ? $indirectVolume[0]->{'total'} : 0;

    $totalVolume = $indirectVolume + $directVolume;

    $personalVolume = Illuminate\Support\Facades\DB::select("SELECT sum(score) as total FROM historic_score where user_id=$user_id and level_from=0");
    $personalVolume = isset($personalVolume[0]->{'total'}) ? $personalVolume[0]->{'total'} : 0;

    $totalComission = Illuminate\Support\Facades\DB::select("select sum(price) from banco where user_id=$user_id and price>0");
    $totalComission = isset($totalComission[0]->{'sum(price)'}) ? $totalComission[0]->{'sum(price)'} : 0;

    $availableComission = Illuminate\Support\Facades\DB::select("select sum(price) from banco where user_id=$user_id");
    $availableComission = isset($availableComission[0]->{'sum(price)'}) ? $availableComission[0]->{'sum(price)'} : 0;

  @endphp
  <script>
    $(function() {
      'use strict'
      var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
      var salesChartData = {
        labels: {
          !!$label!!
        },
        datasets: [{
            label: 'Balance Entries',
            backgroundColor: 'rgba(255,160,25,0.9)',
            borderColor: 'rgba(255,160,25,0.8)',
            pointRadius: false,
            pointColor: '#ffa019',
            pointStrokeColor: 'rgba(255,160,25,1)',
            pointHighlightFill: '#ffa019',
            pointHighlightStroke: 'rgba(255,160,25,1)',
            data: {
              !!$data!!
            }
          },
          {
            label: 'Balance Out',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: {
              !!$datasaida!!
            }
          }
        ]
      }
      var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
      }
      var salesChart = new Chart(
        salesChartCanvas, {
          type: 'line',
          data: salesChartData,
          options: salesChartOptions
        }
      )
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData = {
        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
        datasets: [{
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        }]
      }
      var pieOptions = {
        legend: {
          display: false
        }
      }
      var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
      })

      $('#world-map-markers').mapael({
        map: {
          name: 'usa_states',
          zoom: {
            enabled: true,
            maxLevel: 10
          }
        }
      })
    })

    $(function() {

      $('#carouselEcommerc img:eq(0)').addClass("ativo").show();
      setInterval(slide, 5000);

      function slide() {

        //Se a proxima imagem existir
        if ($('.ativo').next().length) {

          $('.ativo').removeClass("ativo").next().addClass("ativo");

        } else { //Se for a ultima img do carrosel

          $('.ativo').removeClass("ativo");
          $('#carouselEcommerc img:eq(0)').addClass("ativo");

        }

      }
    });
  </script>

  <script>
    function FunctionCopy1() {

      var copyText = document.getElementById("landing");


      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      navigator.clipboard.writeText(copyText.value);

      // alert("Copied the text: " + copyText.value);
    }

    function FunctionCopy2() {

      var copyText = document.getElementById("referral");


      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      navigator.clipboard.writeText(copyText.value);

      // alert("Copied the text: " + copyText.value);
    }
  </script>

  <style>
    .txtcolor {
      color: #fff;
    }

    .card_color {
      background-image: url(images/bg_box.png), linear-gradient(to right, #4a76b8, #6f42c1);
      background-size: contain;
    }

    .card_text {
      color: #fff;
    }

    .txt-video {
      font-size: 20px !important;
      text-transform: uppercase;
      font-weight: bold !important;
    }


    @media (max-width: 575px) {
      .respon {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
    }

    .video {
      aspect-ratio: 16 / 9;
      width: 80%;
      display: block;

    }

    @media (max-width: 420px) {
      .video {
        width: 100%;
      }
    }

    .img-home {
      max-width: 80%;
      border-radius: 50%;
    }

    .img-home-1 {
      max-width: 90%;
      border-radius: 50%;
    }
  </style>

  <main id="main" class="main mt-0">
    @include('flash::message')



    <section id="home" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row mb-3">
            <img src='/images/banner1.jpg' style='width:100%'>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="info-box mb-4 shadow c1">
          <span class="info-box-icon"><i class="bi bi-star-fill"></i></span>
          <div class="info-box-content font">
            <span class="info-box-text up font">@lang('home.referral_link')</span>
            <div class="row">
              <div class="col-10">
                <div class="input-group mb-3 font">
                  <input type="text" class="form-control" id="referral"
                    value="http://register.ai-nextlevel.com/{{ auth()->user()->login }}">
                  <button class="up btn btn-dark orderbtn linkcopy px-4" type="button"
                    onclick=" FunctionCopy2()">Copy</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text">TOTAL COMMISSION</span>
                <span class="info-box-number card_text">{{ number_format($totalComission, 2, ',', '.') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-trophy-fill card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text">TOTAL REFFERALS</span>
                <span class="info-box-number card_text">{{ $totalMembros }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow elevation c1 card_color">
              <span class="info-box-icon "><i class="bi bi-caret-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text">GROUP VOLUME</span>
                <span class="info-box-number card_text">{{ number_format($totalVolume, 2, ',', '.') }}</span>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-md-8 columncardr p-5">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="/images/video 1 english.mp4" sandbox="" frameborder="0"
                  allow="accelerometer; encrypted-media; gyroscope;autoplay; muted;" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-md-4 columncardr p-5">
              <h2 class="mb-3  txt-video">
                VIDEO 1 Welcome to A.I. NEXT LEVEL CLUB <br />
              </h2>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-md-8 columncardr p-5">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="/images/VIDEO 2 AI English.mp4" sandbox="" frameborder="0"
                  allow="accelerometer; encrypted-media; gyroscope;autoplay; muted;" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-md-4 columncardr p-5">
              <h2 class="mb-3  txt-video">
                VIDEO 2 Set up your broker account & how to pay your profit order <br />
              </h2>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-md-8 columncardr p-5">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="/images/Video 3 Affiliate.mp4" sandbox="" frameborder="0"
                  allow="accelerometer; encrypted-media; gyroscope;autoplay; muted;" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-md-4 columncardr p-5">
              <h2 class="mb-3  txt-video">
                VIDEO 3 Additional income through referral program <br />
              </h2>
            </div>
          </div>
          <div class="mb-3">
            <script type="text/javascript">
              DukascopyApplet = {
                "type": "chart",
                "params": {
                  "showUI": true,
                  "showTabs": true,
                  "showParameterToolbar": true,
                  "showOfferSide": true,
                  "allowInstrumentChange": true,
                  "allowPeriodChange": true,
                  "allowOfferSideChange": true,
                  "showAdditionalToolbar": true,
                  "showDetachButton": true,
                  "presentationType": "candle",
                  "axisX": true,
                  "axisY": true,
                  "legend": true,
                  "timeline": true,
                  "showDateSeparators": true,
                  "showZoom": true,
                  "showScrollButtons": true,
                  "showAutoShiftButton": true,
                  "crosshair": true,
                  "borders": false,
                  "theme": "Pastelle",
                  "uiColor": "#000",
                  "availableInstruments": "l:",
                  "instrument": "EUR/USD",
                  "period": "7",
                  "offerSide": "BID",
                  "timezone": 0,
                  "live": true,
                  "panLock": false,
                  "width": "100%",
                  "height": "500",
                  "adv": "popup"
                }
              };
            </script>
            <script type="text/javascript" src="https://freeserv-static.dukascopy.com/2.0/core.js"></script>
          </div>

          {{-- <div class="col-12">
                        <div class="info-box">
                            <video  muted loop class=" d-block w-100" alt="...">
                                <source src="../videos/Design sem nome (4).mp4" type="video/mp4">
                            </video>
                            <img src="assets/img/heroimg.png" class="img-fluid" style="height:100%;">
                        </div>
                    </div> --}}

          <!--
                                                      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                                          <div class="carousel-indicators">
                                                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                          </div>
                                                          <div class="carousel-inner">
                                                              <div class="carousel-item active">
                                                                  <div class="row">
                                                                      <div class="col-12 col-sm-6 col-md-4">
                                                                          <script type="text/javascript">
                                                                            DukascopyApplet = {
                                                                              "type": "chart",
                                                                              "params": {
                                                                                "showUI": false,
                                                                                "showTabs": false,
                                                                                "showParameterToolbar": false,
                                                                                "showOfferSide": false,
                                                                                "allowInstrumentChange": false,
                                                                                "allowPeriodChange": false,
                                                                                "allowOfferSideChange": false,
                                                                                "showAdditionalToolbar": false,
                                                                                "showDetachButton": true,
                                                                                "presentationType": "line",
                                                                                "axisX": true,
                                                                                "axisY": true,
                                                                                "legend": true,
                                                                                "timeline": false,
                                                                                "showDateSeparators": false,
                                                                                "showZoom": false,
                                                                                "showScrollButtons": false,
                                                                                "showAutoShiftButton": false,
                                                                                "crosshair": true,
                                                                                "borders": false,
                                                                                "theme": "Pastelle",
                                                                                "uiColor": "#000",
                                                                                "availableInstruments": "l:",
                                                                                "instrument": "BTC/USD",
                                                                                "period": "7",
                                                                                "offerSide": "BID",
                                                                                "timezone": 0,
                                                                                "live": true,
                                                                                "panLock": false,
                                                                                "width": "100%",
                                                                                "height": "300",
                                                                                "adv": "popup"
                                                                              }
                                                                            };
                                                                          </script>
                                                                          <script type="text/javascript" src="https://freeserv-static.dukascopy.com/2.0/core.js"></script>
                                                                      </div>
                                                                      <div class="col-12 col-sm-6 col-md-4">
                                                                          <script type="text/javascript">
                                                                            DukascopyApplet = {
                                                                              "type": "chart",
                                                                              "params": {
                                                                                "showUI": false,
                                                                                "showTabs": false,
                                                                                "showParameterToolbar": false,
                                                                                "showOfferSide": false,
                                                                                "allowInstrumentChange": false,
                                                                                "allowPeriodChange": false,
                                                                                "allowOfferSideChange": false,
                                                                                "showAdditionalToolbar": false,
                                                                                "showDetachButton": true,
                                                                                "presentationType": "line",
                                                                                "axisX": true,
                                                                                "axisY": true,
                                                                                "legend": true,
                                                                                "timeline": false,
                                                                                "showDateSeparators": false,
                                                                                "showZoom": false,
                                                                                "showScrollButtons": false,
                                                                                "showAutoShiftButton": false,
                                                                                "crosshair": true,
                                                                                "borders": false,
                                                                                "theme": "Pastelle",
                                                                                "uiColor": "#000",
                                                                                "availableInstruments": "l:",
                                                                                "instrument": "ETH/USD",
                                                                                "period": "7",
                                                                                "offerSide": "BID",
                                                                                "timezone": 0,
                                                                                "live": true,
                                                                                "panLock": false,
                                                                                "width": "100%",
                                                                                "height": "300",
                                                                                "adv": "popup"
                                                                              }
                                                                            };
                                                                          </script>
                                                                          <script type="text/javascript" src="https://freeserv-static.dukascopy.com/2.0/core.js"></script>
                                                                      </div>
                                                                      <div class="col-12 col-sm-6 col-md-4">
                                                                          <script type="text/javascript">
                                                                            DukascopyApplet = {
                                                                              "type": "chart",
                                                                              "params": {
                                                                                "showUI": false,
                                                                                "showTabs": false,
                                                                                "showParameterToolbar": false,
                                                                                "showOfferSide": false,
                                                                                "allowInstrumentChange": false,
                                                                                "allowPeriodChange": false,
                                                                                "allowOfferSideChange": false,
                                                                                "showAdditionalToolbar": false,
                                                                                "showDetachButton": true,
                                                                                "presentationType": "line",
                                                                                "axisX": true,
                                                                                "axisY": true,
                                                                                "legend": true,
                                                                                "timeline": false,
                                                                                "showDateSeparators": false,
                                                                                "showZoom": false,
                                                                                "showScrollButtons": false,
                                                                                "showAutoShiftButton": false,
                                                                                "crosshair": true,
                                                                                "borders": false,
                                                                                "theme": "Pastelle",
                                                                                "uiColor": "#000",
                                                                                "availableInstruments": "l:",
                                                                                "instrument": "LTC/USD",
                                                                                "period": "7",
                                                                                "offerSide": "BID",
                                                                                "timezone": 0,
                                                                                "live": true,
                                                                                "panLock": false,
                                                                                "width": "100%",
                                                                                "height": "300",
                                                                                "adv": "popup"
                                                                              }
                                                                            };
                                                                          </script>
                                                                          <script type="text/javascript" src="https://freeserv-static.dukascopy.com/2.0/core.js"></script>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="carousel-item">
                                                                  <div class="row">
                                                                      <div class="col-12 col-sm-6 col-md-4">
                                                                          <div class="info-box mb-4 shadow c1 card_color">
                                                                              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
                                                                              <div class="info-box-content font">
                                                                                  <span class="info-box-text card_text">Total MAM balance</span>
                                                                                  <span class="info-box-number card_text">{{ number_format($user->getTotalBancoIndicacaoDirectIndirect(), 2, ',', '.') }}</span>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                              <span class="visually-hidden">Previous</span>
                                                          </button>
                                                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                              <span class="visually-hidden">Next</span>
                                                          </button>
                                                      </div> -->
          <div class="row">
            @foreach ($images as $image)
              <div class="col-md-2 col-lg col-sm col-xs-8">
                <div class="card text-center">
                  <h4>{{ date('m/d/Y ', strtotime($image->date)) }}</h4>
                  <img src="{{ asset('storage/' . $image->path) }}" alt="Image" class="img-fluid image-modal"
                    data-toggle="modal" data-target="#imageModal">
                </div>
              </div>
            @endforeach
          </div>



          <div class="col-12 col-sm-6 col-md-3">
            <div style="width: 100%;" id="quotesWidgetChart"></div>
            <script async type="text/javascript" data-type="quotes-widget" src="https://c.mql5.com/js/widgets/quotes/widget.js?v=1">
                            {
                                "type": "chart",
                                "filter": "EURGBP",
                                "period": "D1",
                                "width": "100%",
                                "height": 200,
                                "id": "quotesWidgetChart"
                            }
                        </script>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div style="width: 100%;" id="quotesWidgetChart1"></div>
            <script async type="text/javascript" data-type="quotes-widget" src="https://c.mql5.com/js/widgets/quotes/widget.js?v=1">
                            {
                                "type": "chart",
                                "filter": "EURJPY",
                                "period": "D1",
                                "width": "100%",
                                "height": 200,
                                "id": "quotesWidgetChart1"
                            }
                        </script>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div style="width: 100%;" id="quotesWidgetChart2"></div>
            <script async type="text/javascript" data-type="quotes-widget" src="https://c.mql5.com/js/widgets/quotes/widget.js?v=1">
                            {
                                "type": "chart",
                                "filter": "XAUUSD",
                                "period": "D1",
                                "width": "100%",
                                "height": 200,
                                "id": "quotesWidgetChart2"
                            }
                        </script>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div style="width: 100%;" id="quotesWidgetChart3"></div>
            <script async type="text/javascript" data-type="quotes-widget" src="https://c.mql5.com/js/widgets/quotes/widget.js?v=1">
                            {
                                "type": "chart",
                                "filter": "GBPUSD",
                                "period": "D1",
                                "width": "100%",
                                "height": 200,
                                "id": "quotesWidgetChart3"
                            }
                        </script>
          </div>

          <!-- <div class="col-12">
                                                          <div id="carouselEcommerc" class="carousel slide" data-bs-ride="carousel" style="z-index: 1;">

                                                              <div class="carousel-inner">
                                                                  @foreach ($packages as $package)
  <div style="display:none"> {{ $existe = 1 }} </div>
                                                                  <div class="carousel-item @if ($loop->index == 0) active @endif">
                                                                      <div class="h-100">
                                                                          <div class="row d-flex justify-content-center align-items-center h-100">
                                                                              <div class="col col-lg-12 mb-4 mb-lg-0">
                                                                                  <div class="card mb-3" style="border-radius: .5rem;">
                                                                                      <div class="row g-0">
                                                                                          <div class="col-md-6 gradient-custom text-center text-white">
                                                                                              <img src="{{ asset('storage/' . $package->package->img) }}" alt="" class="img-fluid mt-5" style="width: 50%" />
                                                                                              {{-- <h5>Marie Horwitz</h5>
                                                                <p>Web Designer</p>
                                                                <i class="far fa-edit mb-5"></i> --}}
                                                                                          </div>
                                                                                          <div class="text-center col-md-6 mt-0 txtcolor" style="background-image: linear-gradient(to right, rgb(0, 0, 0), rgb(28, 28, 28));">
                                                                                              <div class="card-body p-4">
                                                                                                  <h3>@lang('home.info')</h3>
                                                                                                  <hr class="mt-0 mb-4">
                                                                                                  <div class="row pt-1">
                                                                                                      <div class="col-6 mb-3">
                                                                                                          <h6>@lang('home.name_card')</h6>
                                                                                                          <p class="text-muted">
                                                                                                              {{ $package->package->name }}
                                                                                                          </p>
                                                                                                      </div>
                                                                                                      <div class="col-6 mb-3">
                                                                                                          <h6>@lang('home.kyc')</h6>
                                                                                                          <p class="text-muted">@lang('home.pending')</p>
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="row pt-1">
                                                                                                      <div class="col-6 mb-3">
                                                                                                          <h6>@lang('home.value')</h6>
                                                                                                          <p class="text-muted">$
                                                                                                              {{ number_format($package->price, 2, ',', '.') }}
                                                                                                          </p>
                                                                                                      </div>
                                                                                                      <div class="col-6 mb-3">
                                                                                                          <h6>@lang('home.acquisition_date')</h6>
                                                                                                          <p class="text-muted">
                                                                                                              {{ date('d/m/Y', strtotime($package->created_at)) }}
                                                                                                          </p>
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>

                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
  @endforeach
                                                              </div>
                                                              @if (!empty($existe))
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselEcommerc" data-bs-slide="prev">
                                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                  <span class="visually-hidden">@lang('home.previous')</span>
                                                              </button>
                                                              <button class="carousel-control-next" type="button" data-bs-target="#carouselEcommerc" data-bs-slide="next">
                                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                  <span class="visually-hidden">@lang('home.next')</span>
                                                              </button>
  @endif

                                                          </div>

                                                      </div> -->

          <!-- @if (auth()->user()->isAllowed())
  -->
          <!-- <div class="col-12 col-sm-6 col-md-6">
                                                                                      <div class="info-box mb-4 shadow elevation c1">
                                                                                          <span class="info-box-icon">
                                                                                              <i class="bi bi-people-fill"></i>
                                                                                          </span>

                                                                                          <div class="info-box-content font">
                                                                                              <span class="info-box-text">@lang('home.people_for_next_levels')</span>
                                                                                              <span class="info-box-number">150</span>
                                                                                              <div class="progress">
                                                                                                  <div class="progress-bar" style="width: 70%; background-color: #111111;"></div>
                                                                                              </div>
                                                                                              <span class="progress-description">
                                                                                                  70% @lang('home.people_next_levels_in') 200
                                                                                              </span>
                                                                                          </div>

                                                                                      </div>
                                                                                  </div> -->

          <!-- <div class="col-12 col-sm-6 col-md-4">
                                                          <div class="info-box mb-4 shadow c1 card_color">
                                                              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text card_text">Total MAM balance</span>
                                                                  <span class="info-box-number card_text">{{ number_format($user->getTotalBancoIndicacaoDirectIndirect(), 2, ',', '.') }}</span>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12 col-sm-6 col-md-4">
                                                          <div class="info-box mb-4 shadow c1 card_color">
                                                              <span class="info-box-icon"><i class="bi bi-trophy-fill card_text"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text card_text">Your Equity</span>
                                                                  <span class="info-box-number card_text">{{ $user->getPoll($user->id) }}</span>
                                                              </div>

                                                          </div>
                                                      </div> -->

          <!-- <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow c1">
                                                              <span class="info-box-icon"><i class="bi bi-star-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.pool_commission')</span>
                                                                  <span class="info-box-number">{{ number_format($user->getTotalBancoPool(), 2, ',', '.') }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-credit-card-2-back-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.cardactive_details')</span>
                                                                  <span class="info-box-number">{{ $user->getCards($user->id) }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-reception-4"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.redetotal_details')</span>
                                                                  <span class="info-box-number">{{ $user->getRede($user->id) }}</span>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-person-plus-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.active_referrals')</span>
                                                                  <span class="info-box-number">{{ $user->getRedePackages($user->id) }}</span>
                                                              </div>
                                                          </div>
                                                      </div> -->

          <!-- <div class="col-12 col-sm-6 col-md-4">
                                                          <div class="info-box mb-4 shadow elevation c1 card_color">
                                                              <span class="info-box-icon "><i class="bi bi-caret-up card_text"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text card_text">Daily Profit</span>
                                                                  <span class="info-box-number card_text">{{ number_format($bonusdaily, 2, ',', '.') }}</span>
                                                              </div>
                                                          </div>
                                                      </div> -->
          <!-- <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-person-plus-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.active_referrals')</span>
                                                                  <span class="info-box-number">{{ $user->getRedePackages($user->id) }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-person-plus-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('network.PreRegistration')</span>
                                                                  <span class="info-box-number">{{ $user->getRedeAdessao($user->id) }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-display"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.landing_details')</span>
                                                                  <span class="info-box-number">Active</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow elevation c1">
                                                              <span class="info-box-icon "><i class="bi bi-person-fill"></i></span>
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.user_details')</span>
                                                                  @if ($user->getTypeActivated($user->id) == 'AllCards')
  <span class="info-box-number">@lang('network.active')</span>
@elseif ($user->getTypeActivated($user->id) == 'PreRegistration')
  <span class="info-box-number">@lang('network.PreRegistration')</span>
@else
  <span class="info-box-number">@lang('network.inactive')</span>
  @endif
                                                              </div>
                                                          </div>
                                                      </div> -->
          <!--
  @endif -->


          <!-- <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow c1 btcolor3">
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.current_package')</span>
                                                                  {{-- <span class="info-box-number">{{$carrer->name}}</span> --}}
                                                              </div>
                                                          </div>
                                                      </div> -->

          <!-- <div class="clearfix hidden-md-up"></div> -->
          <!-- <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow c1 btcolor1">
                                                              <div class="info-box-content font col-8">
                                                                  <span class="info-box-text">@lang('home.current_rank')</span>
                                                                  {{-- <span class="info-box-number">{{$carrer->name}}</span> --}}
                                                              </div>
                                                              <div class="info-box-content font col-4">
                                                                  {{-- <img src="{{asset('storage/pin/'.$carrer->pin)}}" alt="pin" class="rounded-circle"> --}}
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow c1 btcolor2">
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.membership_status')</span>
                                                                  @if ($user->activated == 1)
  <span class="info-box-number">@lang('home.active')</span>
@else
  <span class="info-box-number">@lang('home.disabled')</span>
  @endif
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="col-12 col-sm-6 col-md-3">
                                                          <div class="info-box mb-4 shadow c1 btcolor4">
                                                              <div class="info-box-content font">
                                                                  <span class="info-box-text">@lang('home.inactive_users')</span>
                                                                  @if ($inactiverights > 0)
  <span class="info-box-number text-danger">{{ $inactiverights }}</span>
@else
  <span class="info-box-number">{{ $inactiverights }}</span>
  @endif
                                                              </div>
                                                          </div>
                                                      </div> -->
        </div>
        <!--
                                          <div class="col-12">
                                              <div class="info-box mb-4 shadow c1">
                                                  <span class="info-box-icon"><i class="bi bi-send-fill"></i></span>
                                                  <div class="info-box-content font">
                                                      <span class="info-box-text">@lang('home.landing_page_link')</span>
                                                      <div class="row">
                                                          <div class="col-10">
                                                              <div class="input-group mb-3">
                                                                  <input type="text" class="form-control" id="landing" value="https://landingpage.tigerinvestments.com/{{ auth()->user()->login }}">
                                                                  <button class=" btn btn-dark orderbtn linkcopy px-4" type="button" onclick="FunctionCopy1()">Copy</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div> -->


        <!-- <div class="row mb-3">
                                                                          <div class="card shadow my-3">
                                                                              <div class="card-header bbcolorp">
                                                                                  <h3 class="card-title"> @lang('home.latest_orders')</h3>
                                                                              </div>
                                                                              <div class="card-body table-responsive p-0">
                                                                                  <table class="table table-hover text-nowrap">
                                                                                      <thead>
                                                                                          <tr>
                                                                                              <th>@lang('home.name')</th>
                                                                                              <th>@lang('home.img')</th>
                                                                                              <th>@lang('home.product_price')</th>
                                                                                              {{-- <th>@lang('home.daily_return')</th>
                                        <th>@lang('home.yearly_return_coin')</th>
                                        <th>@lang('home.total_return_coin')</th>
                                        <th>@lang('home.steaking_period')</th>
                                        <th>@lang('home.capping_coin')</th>
                                        <th>@lang('home.expected_total_return')</th> --}}
                                                                                              <th>@lang('home.date')</th>
                                                                                              <th>@lang('home.payment_status')</th>
                                                                                          </tr>
                                                                                      </thead>
                                                                                      <tbody>
                                                                                          @forelse($orderpackages as $orderpackage)
  <tr>
                                                                                              <th>{{ $orderpackage->package->name }}</th>
                                                                                              <td class="tdimg">
                                                                                                  <img style="max-width: 100px" src="{{ asset('storage/' . $orderpackage->package->img) }}" />
                                                                                              </td>
                                                                                              <td>$ {{ $orderpackage->price }}</td>
                                                                                              {{-- <td>{{$orderpackage->package->daily_returns}}</td>
                                <td>{{$orderpackage->package->yaerly_returns}}</td>
                                <td>{{$orderpackage->package->total_returns}}</td>
                                <td>{{$orderpackage->package->period_days}} Months</td>
                                <td>{{$orderpackage->package->capping_coin}}</td>
                                <td>{{number_format($orderpackage->package->packageTotal($orderpackage->package->id),2, ',', '.')}} </td> --}}
                                                                                              <td>{{ date('d/m/Y', strtotime($orderpackage->created_at)) }}</td>
                                                                                              <td>
                                                                                                  @if ($orderpackage->payment_status == 1)
  <span class="rounded-pill bg-success px-4 py-1">@lang('home.paid')</span>
@elseif($orderpackage->payment_status == 2)
  <span class="rounded-pill bg-warning px-4 py-1">@lang('home.cancelled')</button>
@else
  <span class="rounded-pill bg-primary px-4 py-1">@lang('home.waiting')</span>
  @endif
                                                                                              </td>
                                                                                          </tr>
                            @empty
                                                                                          <p>@lang('home.you_dont_have_any_packages_registered')</p>
  @endforelse
                                                                                      </tbody>
                                                                                  </table>
                                                                              </div>
                                                                          </div>
                                                                      </div> -->
        <div class="container-fluid" style="display: none;">
          <section class="bg-white">
            <!-- Start: 1 Row 2 Columns  -->
            <div class="container-fluid px-0">
              <div class="row m-0">
                {{-- <div class="col-12 px-0 mb-3 ">
                            <img src="../../assetsWelcome/images/bghome.png" class="w-100" />
                        </div> --}}

                <!-- <div class="col-12 m-0 p-0">
                                                                      <div class="my-5">
                                                                          <div class="w-100">
                                                                              <iframe class="video" src=@lang('videos.backoffice') frameborder="0" allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                                                          </div>
                                                                      </div>
                                                                  </div> -->

                <div class=" col-12">
                  <h5 class="text-center text-black-50 w-75 m-auto py-4">
                    Fx Winning has purchased Client Money Insurance (CMI) on behalf of our clients and is a member of a
                    network of responsible global financial service providers offering additional layers of security.
                  </h5>
                </div>
              </div>
              <div class="row mt-5 align-items-center">
                <div class="col-md-6 " style="text-align: center; min-height: 400px align-middle">
                  <div class="d-flex align-items-center divimg">
                    <img class="img-home" data-aos="fade-right" data-aos-duration="1800" data-aos-once="true"
                      src="/images/AI-NEXT LEVEL.mp4" width="600px" height="350px" style="margin: auto" />
                  </div>
                </div>
                <div class="col-md-6 columncardr p-5">
                  <h2 class="mb-3 fw-bold">
                    PLATFORMS
                    TRADE ANYTIME, FROM ANYWHERE <br />
                  </h2>
                  <p class="text-black-50">

                    MetaTrader 5 is a Multi Asse platform. It allows to trade currencies, bonds, indices, stocks, crypto
                    currencies, etc. FxWinning offers you the most powerful and unique platform to make your life easier
                    when trading. It allows 4 execution modes: instant, by request, market and exchange execution. It
                    supports 2 market orders, 6 pending orders and 2 stop orders. </p>
                  <!-- <p class="text-black-50 mb-5">
                                                                  @lang('home.refer_2')
                                                              </p> -->
                  <!-- <table class="table table-bordered table-hover">
                                                                  <thead class="table-dark text-center">
                                                                      <tr>
                                                                          <th scope="col">@lang('home.member_type')</th>
                                                                          <th scope="col ">@lang('home.commission_pay')</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody class=" text-center">
                                                                      <tr>
                                                                          <th scope="row">CLASSIC</th>
                                                                          <td>$44.78</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">VIP</th>
                                                                          <td>$67.28</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">VIP PREMIUM</th>
                                                                          <td>$104.83</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">PLATINUM</th>
                                                                          <td>$174.83</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">PLATINUM ELITE</th>
                                                                          <td>$349.83</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">DIAMOND</th>
                                                                          <td>$1,748.25</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">DIAMOND ELITE</th>
                                                                          <td>$4,875.00</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th scope="row">DIAMOND VIP</th>
                                                                          <td>$5,737.50</td>
                                                                      </tr>
                                                                  </tbody>

                                                              </table>
                                                              {{-- <a class="btn btn-dark orderbtn orderbtnmarginsm" role="button" href="{{ route('packages.index') }}">@lang('leadpage.card.cards.btn')</a> --}} -->
                </div>
              </div>
            </div>
            <!-- End: 1 Row 2 Columns  -->
          </section>
          <section class="bg-white">
            <!-- Start: 1 Row 2 Columns  -->
            <div class="container-fluid">
              <div class="row py-3 align-items-center">
                <div class="col-md-6 order-md-last" style="text-align: center; min-height: 400px align-middle">
                  <div class="d-flex align-items-center divimg">
                    <img class="img-home-1" data-aos="fade-left" data-aos-duration="1800" data-aos-once="true"
                      src="assetsWelcome/images/foto-1.jpg?h=fed495f0f7405973d010a91bbae969d2" width="600px"
                      height="350px" style="margin: auto" />
                  </div>
                </div>
                <div class="col-md-6 columncardr py-5">
                  <h2 class="mb-3 fw-bold">

                    MAM / PAMM ACCOUNTS
                    <br />
                  </h2>
                  <p class="text-black-50 mb-5">
                    Multi-Account Manager / Percentage Allocation Management Module Manage
                    The FxWinning Multiple Account manager allows you to manage your clients' money with sophisticated
                    methods, real-time reports of commissions and operational performance.
                  </p>
                  <h6>
                    The Software is perfect for traders or fund managers who use Expert Advisors (EA) and improves the
                    functionality of the platform, since it allows managing many accounts from the same interface.
                    Thousands of accounts can be traded with a single click and with virtually no additional latency.
                  </h6>
                  <!-- <ul class="list-unstyled text-start mb-5">
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw1')
                                                                      <br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw2')&nbsp;<br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw3')<br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw4')<br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw5')<br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw6')<br />
                                                                  </li>
                                                                  <li class="text-black-50 mb-1">
                                                                      <i class="la la-chevron-circle-right"></i>&nbsp;
                                                                      @lang('home.rw7')<br />
                                                                  </li>

                                                              </ul>
                                                              {{-- <a class="btn btn-dark orderbtn orderbtnmarginsm" role="button" href="{{ route('packages.index') }}">@lang('leadpage.card.cards.btn')</a> --}}-->
                </div>
              </div>
            </div>
            <!-- End: 1 Row 2 Columns   -->
          </section>
        </div>
        <!-- <div class="row mb-3">
                                                          <div class="col-md-12">
                                                              <div class="card shadow">
                                                                  <div class="card-header">
                                                                      <h5 class="card-title">@lang('home.movement_in_the_last_30_days')</h5>
                                                                      <div class="card-tools">
                                                                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                              <i class="fas fa-minus"></i>
                                                                          </button>
                                                                          <div class="btn-group">
                                                                              <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                                                  <i class="fas fa-wrench"></i>
                                                                              </button>
                                                                              <div class="btn-group">
                                                                                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                                                      <i class="fas fa-wrench"></i>
                                                                                  </button>
                                                                                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                      <a href="#" class="dropdown-item">@lang('home.action')</a>
                                                                                      <a href="#" class="dropdown-item">@lang('home.another_action')</a>
                                                                                      <a href="#" class="dropdown-item">@lang('home.something_else_here')</a>
                                                                                      <a class="dropdown-divider"></a>
                                                                                      <a href="#" class="dropdown-item">@lang('home.separated_link')</a>
                                                                                  </div>
                                                                              </div>
                                                                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                                  <i class="fas fa-times"></i>
                                                                              </button>
                                                                          </div>
                                                                      </div>

                                                                      <div class="card-body">
                                                                          <div class="row mb-3">
                                                                              <div class="col-md-12">
                                                                                  <p class="text-center">
                                                                                      <strong>@lang('home.sales'): {{ date('j M, Y', strtotime('-30 days', strtotime(date('d/m/Y')))) }} - {{ date('j M, Y') }}</strong>
                                                                                  </p>
                                                                                  <div class="chart">
                                                                                      <div class="chartjs-size-monitor">
                                                                                          <div class="chartjs-size-monitor-expand">
                                                                                              <div class=""></div>
                                                                                          </div>
                                                                                          <div class="chartjs-size-monitor-shrink">
                                                                                              <div class=""></div>
                                                                                          </div>
                                                                                          <canvas id="salesChart" height="180" style="height: 180px; display: block; width: 581px;" width="581" class="chartjs-render-monitor"></canvas>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>

                                                                          </div>

                                                                          <div class="card-footer">
                                                                              <div class="row mb-3">
                                                                                  <div class="col-sm-3 col-6">
                                                                                      <div class="description-block border-right">
                                                                                          <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                                                                          <h5 class="description-header">{{ number_format($totalbanco, 2, ',', '.') }} </h5>
                                                                                          <span class="description-text">@lang('home.total_bonuses')</span>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-sm-3 col-6">
                                                                                      <div class="description-block border-right">
                                                                                          <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i></span>
                                                                                          <h5 class="description-header">{{ number_format($pontos, 2, ',', '.') }} </h5>
                                                                                          <span class="description-text">@lang('home.total_volume')</span>
                                                                                      </div>

                                                                                  </div>

                                                                                  <div class="col-sm-3 col-6">
                                                                                      <div class="description-block border-right">
                                                                                          <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                                                                          <h5 class="description-header">{{ number_format($bonusdaily, 2, ',', '.') }} </h5>
                                                                                          <span class="description-text">@lang('home.daily_comissions')</span>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-sm-3 col-6">
                                                                                      <div class="description-block">
                                                                                          <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i></span>
                                                                                          <h5 class="description-header">{{ number_format(abs($saque), 2, ',', '.') }} </h5>
                                                                                          <span class="description-text">@lang('home.total_withdrawal')</span>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div> -->

        <!-- <div class="row mb-3">
                                                                              <div class="col-md-8">
                                                                                  <div class="row mb-3">
                                                                                      <div class="col-md-6">

                                                                                          <div class="card direct-chat direct-chat-warning shadow">
                                                                                              <div class="card-header">
                                                                                                  <h3 class="card-title">Direct Chat</h3>
                                                                                                  <div class="card-tools">
                                                                                                      <span title="3 New Messages" class="badge badge-warning">3</span>
                                                                                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                                          <i class="fas fa-minus"></i>
                                                                                                      </button>
                                                                                                      <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                                                                                          <i class="fas fa-comments"></i>
                                                                                                      </button>
                                                                                                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                                                          <i class="fas fa-times"></i>
                                                                                                      </button>
                                                                                                  </div>
                                                                                              </div>

                                                                                              <div class="card-body">

                                                                                                  <div class="direct-chat-messages">

                                                                                                      <div class="direct-chat-msg">
                                                                                                          <div class="direct-chat-infos clearfix">
                                                                                                              <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                                                                              <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                                                                                          </div>

                                                                                                          <img class="direct-chat-img" src="../images/logo-removebg-preview.png" alt="message user image">

                                                                                                          <div class="direct-chat-text">
                                                                                                              Is this template really for free? That's unbelievable!
                                                                                                          </div>
                                                                                                      </div>

                                                                                                      <div class="direct-chat-msg right">
                                                                                                          <div class="direct-chat-infos clearfix">
                                                                                                              <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                                                                              <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                                                                                          </div>
                                                                                                          <img class="direct-chat-img" src="../images/logo-removebg-preview.png" alt="message user image">
                                                                                                          <div class="direct-chat-text">
                                                                                                              You better believe it!
                                                                                                          </div>
                                                                                                      </div>

                                                                                                      <div class="direct-chat-msg">
                                                                                                          <div class="direct-chat-infos clearfix">
                                                                                                              <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                                                                              <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                                                                                          </div>
                                                                                                          <img class="direct-chat-img" src="../images/logo-removebg-preview.png" alt="message user image">
                                                                                                          <div class="direct-chat-text">
                                                                                                              Working with AdminLTE on a great new app! Wanna join?
                                                                                                          </div>
                                                                                                      </div>

                                                                                                      <div class="direct-chat-msg right">
                                                                                                          <div class="direct-chat-infos clearfix">
                                                                                                              <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                                                                              <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                                                                                          </div>
                                                                                                          <img class="direct-chat-img" src="../images/logo-removebg-preview.png" alt="message user image">
                                                                                                          <div class="direct-chat-text">
                                                                                                              I would love to.
                                                                                                          </div>
                                                                                                      </div>
                                                                                                  </div>


                                                                                                  <div class="direct-chat-contacts">
                                                                                                      <ul class="contacts-list">
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          Count Dracula
                                                                                                                          <small class="contacts-list-date float-right">2/28/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">How have you been? I was...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          Sarah Doe
                                                                                                                          <small class="contacts-list-date float-right">2/23/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">I will be waiting for...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          Nadia Jolie
                                                                                                                          <small class="contacts-list-date float-right">2/20/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">I'll call you back at...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          Nora S. Vans
                                                                                                                          <small class="contacts-list-date float-right">2/10/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">Where is your new...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          John K.
                                                                                                                          <small class="contacts-list-date float-right">1/27/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">Can I take a look at...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                          <li>
                                                                                                              <a href="#">
                                                                                                                  <img class="contacts-list-img" src="../images/logo-removebg-preview.png" alt="User Avatar">
                                                                                                                  <div class="contacts-list-info">
                                                                                                                      <span class="contacts-list-name">
                                                                                                                          Kenneth M.
                                                                                                                          <small class="contacts-list-date float-right">1/4/2015</small>
                                                                                                                      </span>
                                                                                                                      <span class="contacts-list-msg">Never mind I found...</span>
                                                                                                                  </div>
                                                                                                              </a>
                                                                                                          </li>
                                                                                                      </ul>
                                                                                                  </div>
                                                                                              </div>

                                                                                              <div class="card-footer">
                                                                                                  <form action="#" method="post">
                                                                                                      <div class="input-group">
                                                                                                          <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                                                                          <span class="input-group-append">
                                                                                                              <button type="button" class="btn btn-warning">Send</button>
                                                                                                          </span>
                                                                                                      </div>
                                                                                                  </form>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>

                                                                                      <div class="col-md-6">
                                                                                          <div class="card shadow">
                                                                                              <div class="card-header">
                                                                                                  <h3 class="card-title">Latest Joining</h3>
                                                                                                  <div class="card-tools">
                                                                                                      <span class="badge badge-danger">8 New Members</span>
                                                                                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                                          <i class="fas fa-minus"></i>
                                                                                                      </button>
                                                                                                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                                                          <i class="fas fa-times"></i>
                                                                                                      </button>
                                                                                                  </div>
                                                                                              </div>

                                                                                              <div class="card-body p-0">
                                                                                                  <ul class="users-list clearfix">
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Alexander Pierce</a>
                                                                                                          <span class="users-list-date">Today</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Norman</a>
                                                                                                          <span class="users-list-date">Yesterday</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="d../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Jane</a>
                                                                                                          <span class="users-list-date">12 Jan</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">John</a>
                                                                                                          <span class="users-list-date">12 Jan</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Alexander</a>
                                                                                                          <span class="users-list-date">13 Jan</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Sarah</a>
                                                                                                          <span class="users-list-date">14 Jan</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Nora</a>
                                                                                                          <span class="users-list-date">15 Jan</span>
                                                                                                      </li>
                                                                                                      <li>
                                                                                                          <img src="../images/logo-removebg-preview.png" alt="User Image">
                                                                                                          <a class="users-list-name" href="#">Nadia</a>
                                                                                                          <span class="users-list-date">15 Jan</span>
                                                                                                      </li>
                                                                                                  </ul>

                                                                                              </div>

                                                                                              <div class="card-footer text-center">
                                                                                                  <a href="javascript:">View All Users</a>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="card shadow">
                                                                                      <div class="card-header border-transparent">
                                                                                          <h3 class="card-title">Latest Orders</h3>
                                                                                          <div class="card-tools">
                                                                                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                                  <i class="fas fa-minus"></i>
                                                                                              </button>
                                                                                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                                                  <i class="fas fa-times"></i>
                                                                                              </button>
                                                                                          </div>
                                                                                      </div>

                                                                                      <div class="card-body p-0">
                                                                                          <div class="table-responsive">
                                                                                              <table class="table m-0">
                                                                                                  <thead>
                                                                                                      <tr>
                                                                                                          <th>Order ID</th>
                                                                                                          <th>Item</th>
                                                                                                          <th>Status</th>
                                                                                                          <th>Popularity</th>
                                                                                                      </tr>
                                                                                                  </thead>
                                                                                                  <tbody>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                                                                          <td>Junior Pkg</td>
                                                                                                          <td><span class="badge badge-success">Pending</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                                                                          <td>Master Pkg</td>
                                                                                                          <td><span class="badge badge-warning">Pending</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                                                          <td>Master Pkg</td>
                                                                                                          <td><span class="badge badge-danger">Processing</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                                                          <td>Senior Pkg</td>
                                                                                                          <td><span class="badge badge-info">Processing</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                                                                          <td>Senior Pkg</td>
                                                                                                          <td><span class="badge badge-warning">Pending</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                                                                          <td>Master Pkg</td>
                                                                                                          <td><span class="badge badge-danger">Pending</span></td>
                                                                                                          <td>
                                                                                                              <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                                                                                          </td>
                                                                                                      </tr>
                                                                                                  </tbody>
                                                                                              </table>
                                                                                          </div>
                                                                                      </div>

                                                                                      <div class="card-footer clearfix">
                                                                                          <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                                                                                          <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>

                                                                              <div class="col-md-4">
                                                                                  <div class="info-box mb-3 shadow elevation-3 boxinfo">
                                                                                      <span class="info-box-icon"><i class="bi bi-list-columns-reverse"></i></span>
                                                                                      <div class="info-box-content font">
                                                                                          <span class="info-box-text">Inventory</span>
                                                                                          <span class="info-box-number">5,200</span>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="info-box mb-3 shadow boxinfo">
                                                                                      <span class="info-box-icon"><i class="bi bi-chat-left-fill"></i></span>
                                                                                      <div class="info-box-content font">
                                                                                          <span class="info-box-text">Mentions</span>
                                                                                          <span class="info-box-number">92,050</span>
                                                                                      </div>

                                                                                  </div>

                                                                                  <div class="info-box mb-3 shadow boxinfo">
                                                                                      <span class="info-box-icon"><i class="bi bi-box-fill"></i></span>
                                                                                      <div class="info-box-content font">
                                                                                          <span class="info-box-text">Downloads</span>
                                                                                          <span class="info-box-number">114,381</span>
                                                                                      </div>

                                                                                  </div>

                                                                                  <div class="info-box mb-3 shadow boxinfo">
                                                                                      <span class="info-box-icon"><i class="bi bi-send-fill"></i></span>
                                                                                      <div class="info-box-content font">
                                                                                          <span class="info-box-text">Direct Messages</span>
                                                                                          <span class="info-box-number">163,921</span>
                                                                                      </div>

                                                                                  </div>

                                                                                  <div class="card shadow">
                                                                                      <div class="card-header">
                                                                                          <h3 class="card-title">Recently Added Products</h3>
                                                                                          <div class="card-tools">
                                                                                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                                  <i class="fas fa-minus"></i>
                                                                                              </button>
                                                                                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                                                  <i class="fas fa-times"></i>
                                                                                              </button>
                                                                                          </div>
                                                                                      </div>

                                                                                      <div class="card-body p-0">
                                                                                          <ul class="products-list product-list-in-card pl-2 pr-2">
                                                                                              <li class="item">
                                                                                                  <div class="product-img">
                                                                                                      <img src="../images/logo-removebg-preview.png" alt="Product Image" class="img-size-50">
                                                                                                  </div>
                                                                                                  <div class="product-info">
                                                                                                      <a href="javascript:void(0)" class="product-title">Junior Pkg
                                                                                                          <span class="badge badge-warning float-right">$1800</span></a>
                                                                                                      <span class="product-description">
                                                                                                          Descricao.
                                                                                                      </span>
                                                                                                  </div>
                                                                                              </li>
                                                                                              <li class="item">
                                                                                                  <div class="product-img">
                                                                                                      <img src="../images/logo-removebg-preview.png" alt="Product Image" class="img-size-50">
                                                                                                  </div>
                                                                                                  <div class="product-info">
                                                                                                      <a href="javascript:void(0)" class="product-title">Starter Pkg
                                                                                                          <span class="badge badge-info float-right">$700</span></a>
                                                                                                      <span class="product-description">
                                                                                                          Descricao.
                                                                                                      </span>
                                                                                                  </div>
                                                                                              </li>
                                                                                              <li class="item">
                                                                                                  <div class="product-img">
                                                                                                      <img src="../images/logo-removebg-preview.png" alt="Product Image" class="img-size-50">
                                                                                                  </div>
                                                                                                  <div class="product-info">
                                                                                                      <a href="javascript:void(0)" class="product-title">
                                                                                                          Senior Pkg <span class="badge badge-danger float-right">
                                                                                                              $350
                                                                                                          </span>
                                                                                                      </a>
                                                                                                      <span class="product-description">
                                                                                                          Descricao.
                                                                                                      </span>
                                                                                                  </div>
                                                                                              </li>
                                                                                              <li class="item">
                                                                                                  <div class="product-img">
                                                                                                      <img src="../images/logo-removebg-preview.png" alt="Product Image" class="img-size-50">
                                                                                                  </div>
                                                                                                  <div class="product-info">
                                                                                                      <a href="javascript:void(0)" class="product-title">Master Pkg
                                                                                                          <span class="badge badge-success float-right">$399</span></a>
                                                                                                      <span class="product-description">
                                                                                                          Descricao.
                                                                                                      </span>
                                                                                                  </div>
                                                                                              </li>

                                                                                          </ul>
                                                                                      </div>

                                                                                      <div class="card-footer text-center">
                                                                                          <a href="javascript:void(0)" class="uppercase">View All Products</a>
                                                                                      </div>

                                                                                  </div>

                                                                              </div>

                                                                          </div> -->


      </div>
      </div>
      </div>
    </section>
    <!-- Modal para exibir a imagem em tela cheia -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            aa<img src="" alt="Image" class="img-fluid" id="modalImage" style="width: 100%;">
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    // Quando o usuário clica na imagem, exibe o modal com a imagem em tela cheia
    $('.image-modal').click(function() {
      var imageUrl = $(this).attr('src');
      $('#modalImage').attr('src', imageUrl);
      $('#imageModal').modal('show');
    });
  </script>
  <script>
    if (screen.width > 810) {
      var widthImage = 810;
      var heightImage = widthImage / 1.787;
    } else {
      var widthImage = screen.width;
      var heightImage = screen.width / 1.787;
    }
  </script>

  @php

    $user_id = ucwords(auth()->user()->id);

    $diretos_qr = Illuminate\Support\Facades\DB::select("SELECT count(*) as total FROM orders_package where user_id=$user_id and package_id=20 and status=0 limit 1;");
    $diretos = isset($diretos_qr[0]->{'total'}) ? $diretos_qr[0]->{'total'} : 0;

    if ($diretos > 0) {
    }

  @endphp


  @if (isset($n_pago) && $n_pago == true)
    <script>
      setTimeout(() => {
        Swal.fire({
          "title": "",
          "text": "",
          "width": widthImage,
          "heightAuto": true,
          "padding": "1.25rem",
          "showConfirmButton": true,
          "showCloseButton": false,
          "timerProgressBar": false,
          "customClass": {
            "container": null,
            "popup": null,
            "header": null,
            "title": null,
            "closeButton": null,
            "icon": null,
            "image": null,
            "content": null,
            "input": null,
            "actions": null,
            "confirmButton": null,
            "cancelButton": null,
            "footer": null
          },
          "imageUrl": "/images/alert.jpg",

          "imageAlt": "",
          "animation": false
        });
      }, 7000);
    </script>
  @endif


@endsection
