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

    $diretos_qr = Illuminate\Support\Facades\DB::select('SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=? and level_from=1;', [$user_id]);
    $diretos = isset($diretos_qr[0]->{'total'}) ? $diretos_qr[0]->{'total'} : 0;

    $indiretos_qr = Illuminate\Support\Facades\DB::select("SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=? and level_from>1 and level_from<'6';", [$user_id]);
    $indiretos = isset($indiretos_qr[0]->{'total'}) ? $indiretos_qr[0]->{'total'} : 0;

    $totalMembros = $diretos;

    $directVolume = Illuminate\Support\Facades\DB::select('SELECT sum(score) as total FROM historic_score where user_id=? and level_from=1', [$user_id]);
    $directVolume = isset($directVolume[0]->{'total'}) ? $directVolume[0]->{'total'} : 0;

    $indirectVolume = Illuminate\Support\Facades\DB::select("SELECT sum(score) as total FROM historic_score where user_id=? and level_from>1 and level_from<'6'", [$user_id]);
    $indirectVolume = isset($indirectVolume[0]->{'total'}) ? $indirectVolume[0]->{'total'} : 0;

    $totalVolume = $directVolume;

    $personalVolume = Illuminate\Support\Facades\DB::select('SELECT sum(score) as total FROM historic_score where user_id=? and level_from=0', [$user_id]);
    $personalVolume = isset($personalVolume[0]->{'total'}) ? $personalVolume[0]->{'total'} : 0;

    $totalComission = Illuminate\Support\Facades\DB::select('SELECT sum(price) FROM node_orders where id_user=? and type=1', [$user_id]);
    $totalComission = isset($totalComission[0]->{'sum(price)'}) ? $totalComission[0]->{'sum(price)'} : 0;

    $availableComission = Illuminate\Support\Facades\DB::select('select sum(price) from banco where user_id=?', [$user_id]);
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




      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text">TOTAL TRANSACTIONS</span>
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
            <div class="col-12">
              <div class="info-box mb-4 shadow c1">
                <span class="info-box-icon"><i class="bi bi-star-fill"></i></span>
                <div class="info-box-content font">
                  <span class="info-box-text up font">@lang('home.referral_link')</span>
                  <div class="row">
                    <div class="col-10">
                      <div class="input-group mb-3 font">
                        <input type="text" class="form-control" id="referral"
                          value="https://cryptopay.binfinitybank.com/indication/{{ auth()->user()->login }}/register">
                        <button class="up btn btn-dark orderbtn linkcopy px-4" type="button"
                          onclick=" FunctionCopy2()">Copy</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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


          </div>

          <div class="container-fluid" style="display: none;">
            <section class="bg-white">
              <!-- Start: 1 Row 2 Columns  -->
              <div class="container-fluid px-0">
                <div class="row m-0">
                  <div class="col-12 px-0 mb-3 ">
                    <img src="../../assetsWelcome/images/bghome.png" class="w-100" />
                  </div>



                </div>
                <div class="row mt-5 align-items-center">


                </div>
              </div>
              <!-- End: 1 Row 2 Columns  -->
            </section>
            <section class="bg-white">
              <!-- Start: 1 Row 2 Columns  -->
              <div class="container-fluid">
                <div class="row py-3 align-items-center">
                  <div class="col-md-6 order-md-last" style="text-align: center; min-height: 400px align-middle">

                  </div>

                </div>
              </div>
              <!-- End: 1 Row 2 Columns   -->
            </section>
          </div>



        </div>
      </div>
      </div>
    </section>
    <!-- Modal para exibir a imagem em tela cheia -->

  </main>
  <script>
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
@endsection
