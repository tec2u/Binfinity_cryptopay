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
  </style>

  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>Wallets</h1>
              <div class="card-header bbcolorp">
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
                </form>
                </h3>
              </div>
              <div class="container-cards shadow my-3" style="overflow-x: auto">

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

                @foreach ($wallets as $chave => $valor)
                  @if (isset($icons[$chave]))
                    <div class="card">
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
@endsection
