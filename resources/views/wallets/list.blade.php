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
              {{-- <div class="card-header bbcolorp"> 
                <form action="{{ route('wallets.store') }}" method="post" class="d-flex">
                  @csrf
                  <select name="coin" id="">
                    <option value="USDT_TRC20">USDT_TRC20</option>
                    <option value="TRX">TRX</option>
                    <option value="ETH">ETH</option>
                    <option value="BITCOIN">BITCOIN</option>
                    <option value="USDT_ERC20">USDT_ERC20</option>
                  </select>
                  <h3 class="card-title"><button type="submit" style="color:white" class="btn btn-warning">New
                      +</button>
                    </h3>
                  </form>
              </div> --}}
              <div class="container-cards  my-3" style="overflow-x: auto;border-top: #0071C1 1px solid">




                {{-- <table class="table" style="overflow-x: auto">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">address</th>
                      <th scope="col">coin</th>
                    </tr>
                  </thead>
                  <tbody style="overflow-x: scroll">
                    @foreach ($wallets as $item)
                      <tr style="overflow-x: scroll">
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->coin }}</td>
                      </tr>
                    @endforeach

                  </tbody>
                </table> --}}

                {{-- <div class="container-wallet">
                  <div class="wallet-header"></div>
                  <div class="wallet-main"></div>
                  <div class="wallet-footer"></div>
                </div> --}}

                @foreach ($wallets as $chave => $valor)
                  @if (isset($icons[$chave]))
                    <div class="card">
                      <span>{{ count($valor) }} / 10</span>
                      <img src="{{ $icons[$chave] }}" alt="CR7">
                      <h1>. . . .</h1>
                      <h2>{{ $chave }}</h2>
                      {{-- <h4>1501510.52 / 2840498.01</h4> --}}
                      <button>{{ $moviment[$chave]['dep'] }} / {{ $moviment[$chave]['saq'] }}</button>
                    </div>
                  @endif
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
    console.log(buttons);

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
