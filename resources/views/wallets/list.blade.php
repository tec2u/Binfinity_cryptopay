@extends('layouts.header')
@section('content')
  <style>
    .card {
      box-sizing: border-box;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 300px;
    }

    .card img {
      width: 100px;
      margin: 1rem auto;
      /* border-bottom: 4px solid rgb(255, 0, 0); */
    }

    h2 {
      margin: 10px 0;
    }

    h4 {
      padding-left: 20px;
      padding-right: 20px;
      font-size: 12px;
    }

    h5 {
      margin: 30px;
      font-size: 12px;
    }

    button {
      margin: 20px;
      padding: 10px 20px;
      background-color: transparent;
      /* color: #ff0000; */
      border-radius: 50px;
      /* border: 2px solid rgb(255, 3, 3); */
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0071C1;
      color: white;
    }

    .container-cards {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem
    }

    .option-coin {
      display: flex;
      width: 100%;
      align-items: center;
      gap: .5rem;
      border-top: #cccccc70 1px solid;
      cursor: pointer;
    }


    .option-coin:hover {
      background-color: #ececec;
    }

    .option-coin img {
      width: 50px;
    }

    .modal-body {
      display: flex;
      flex-direction: column;
      gap: .5rem;
    }

    .no-style {
      border: none;
      background-color: transparent !important;
      margin: 0 !important;
      color: black !important;
    }

    .container-wallet {
      width: 350px;
      background-color: #fff;
      border-radius: 10px;
      padding: 1rem;
      border: #ccc 1px solid;
      height: fit-content;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .container-wallet .wallet-header {
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgb(216, 216, 216);
    }

    .wallet-header img {
      width: 25px;
    }

    .wallet-header div,
    .wallet-header form {
      display: flex;
      align-items: center;
      gap: .5rem;
    }


    .wallet-main {
      width: 90%;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      /* gap: .1rem; */
      align-items: center;
      text-align: center;
      background-color: #F8F8FA;
      padding: 1rem 0;
    }

    .wallet-main div {
      display: flex;
      align-items: flex-start;
      gap: .2rem;
    }

    .wallet-main div span {
      font-weight: 800;
    }

    .wallet-footer {
      width: 100%;
      display: flex;
    }

    .wallet-footer div {
      width: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .wallet-footer span {
      color: #9CA3AF;
      font-size: .7rem;
      font-weight: 400;
    }

    .wallet-footer strong {
      color: #545557;
      font-size: .8rem;
      font-weight: 600;
    }

    .wallet-footer .left {
      border-right: 1px solid rgb(216, 216, 216);
    }

    .wallet-footer .right {
      border-left: 1px solid rgb(216, 216, 216);
    }
  </style>

  <main id="main" class="main">

    <div class="modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Choose coin</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @foreach ($icons as $chave => $valor)
              <button data-bs-target="#exampleModalToggle2" data-coin="{{ $chave }}" data-coin-choose="true"
                data-bs-toggle="modal" class="no-style">
                <div class="option-coin">
                  <img src="{{ $valor }}" alt="">
                  <strong>{{ $chave }}</strong>
                </div>
              </button>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
      tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Name of the group <span
                id="coin-choosed-span"></span></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('wallets.store') }}" method="post" id="form-criar">
              @csrf
              <input type="hidden" id="coin-choosed" name="coin" required>

              <div class="mb-3">
                <label for="basic-url" class="form-label">Write name for you wallets group</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">Name:</span>
                  <input type="text" name="name" class="form-control" id="basic-url" required
                    aria-describedby="basic-addon3 basic-addon4">
                </div>
                <div class="form-text" id="basic-addon4"></div>
              </div>

              <br>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" form="form-criar" style="color:white" class="btn btn-warning">Create</button>
            <button class="btn btn-primary" data-bs-target="#exampleModal" data-bs-toggle="modal">Back to
              first</button>
          </div>
        </div>
      </div>
    </div>


    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="d-flex" style="justify-content: space-between;padding: 0.1rem 1rem;align-items: center;">
                <h1>Wallets</h1>
                <h3 class="card-title"> <button type="button" class="btn btn-warning" style="color:white"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">New
                    +</button>
                </h3>
              </div>

              <div class="container-cards  my-3" style="overflow-x: auto;border-top: #0071C1 1px solid">



                @foreach ($wallets as $chave => $valor)
                  @if (isset($icons[$chave]))
                    <div class="container-wallet">
                      <div class="wallet-header">
                        <div>
                          <img src="{{ $icons[$chave] }}" alt="">
                          <strong>{{ $valor->name ?? $chave }}</strong>
                        </div>
                        <div class="form-check form-switch">
                          <form class="form-check form-switch" action="{{ route('wallets.editActive') }}" method="post"
                            id="form-active-{{ $chave }}">
                            @csrf
                            <input type="hidden" name="coin" value="{{ $chave }}">
                            <input class="form-check-input" type="checkbox" role="switch"
                              id="flexSwitchCheckChecked{{ $chave }}"
                              @if ($valor[0]->active) checked @endif>
                          </form>
                        </div>
                      </div>
                      <div class="wallet-main">
                        <span style="color: #9CA3AF">Balance</span>
                        <div>
                          <strong>{{ $moviment[$chave]['dep'] - $moviment[$chave]['saq'] }}</strong>
                          <span style="font-size: .7rem">{{ $chave }}</span>
                        </div>
                        <span style="color: #0071C1">~${{ $moviment[$chave]['dep'] - $moviment[$chave]['saq'] }}</span>
                      </div>
                      <div class="wallet-footer">
                        <div class="left">
                          <span>Last Update</span>
                          <strong>{{ date('d/m/Y', strtotime($valor[0]->updated_at)) }}</strong>
                        </div>
                        <div class="right">
                          <span>Last Transaction</span>
                          <strong>{{ $valor->lastT }} <strong style="font-size: .5rem"> {{ $chave }}
                            </strong></strong>
                        </div>
                      </div>
                    </div>

                    {{-- <div class="card">
                      <span>{{ count($valor) }} / 10</span>
                      <img src="{{ $icons[$chave] }}" alt="CR7">
                      <h1>. . . .</h1>
                      <h2>{{ $chave }}</h2> --}}
                    {{-- <h4>1501510.52 / 2840498.01</h4> --}}
                    {{-- <button>{{ $moviment[$chave]['dep'] }} / {{ $moviment[$chave]['saq'] }}</button>
                    </div> --}}
                  @endif

                  <script>
                    document.getElementById("flexSwitchCheckChecked{{ $chave }}").addEventListener('click', function() {
                      document.getElementById("form-active-{{ $chave }}").submit();
                    });
                  </script>
                @endforeach



              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    var buttons = document.querySelectorAll('[data-coin-choose="true"]');

    // Adiciona um evento de clique a cada botão
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Obtém o valor do atributo "data-coin-value" do botão clicado
        var coinValue = this.getAttribute('data-coin');
        console.log(coinValue);

        // Define o valor do input com o ID "coin-choosed" com base no valor obtido
        document.getElementById("coin-choosed").value = coinValue;
        document.getElementById("coin-choosed-span").innerText = coinValue;
      });
    });
  </script>
@endsection
