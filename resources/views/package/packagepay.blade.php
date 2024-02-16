@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>ORDER PAYMENT</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title"></h3>
                </div>
                <div class="card-header py-3">

                  <div class="card-tools">
                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3"
                        placeholder="@lang('package.search')">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                </br>
                <div class="col-12">
                  @if (session('error'))
                    <div class="alert alert-warning">
                      {{ session('error') }}, create in <a style="color:blue" href="{{ route('wallets.index') }}">LINK</a>
                    </div>
                  @endif

                  @if ($orderpackage->payment_status == 1)
                    Payed
                  @else
                    @if (!isset($orderpackage->price_crypto) && isset($moedas))
                      Please do the payment of {{ $orderpackage->price }}
                      <br>
                      <br>
                      @foreach ($moedas as $chave => $valor)
                        USD IN <strong> {{ $chave }} ({{ $valor ?? '' }})</strong>
                        <br>
                      @endforeach
                    @else
                      Please do the payment of {{ $orderpackage->price }} USD IN <strong>{{ $wallet->coin ?? '' }}
                        ({{ $value_btc ?? '' }})</strong>
                    @endif
                  @endif

                  {{-- TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF --}}
                  {{-- <div class="card-body table-responsive p-0 col-6">
                                        <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF'>
                                    </div> --}}
                  <br>

                  @if (!isset($orderpackage->price_crypto))
                    <form action="{{ route('packages.payCrypto') }}" method="POST">
                      @csrf
                      <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                      @foreach ($moedas as $chave => $valor)
                        <input type="hidden" value="{{ $valor }}" name="{{ $chave }}">
                      @endforeach
                      <input type="hidden" value="{{ $orderpackage->price }}" name="price">
                      <select class="form-select" aria-label="Default select example" name="method" required>
                        <option value="" selected>Choose method</option>
                        {{-- <option value="BITCOIN">BTC</option> --}}
                        <option value="USDT_ERC20">USDT ERC20</option>
                        <option value="TRX">TRX</option>
                        {{-- <option value="ETH">ETH</option> --}}
                        <option value="USDT_TRC20">USDT TRC20</option>
                      </select>
                      <button type="submit" class="btn btn-success" style="margin-top: 1rem">Choose</button>
                    </form>
                  @else
                    {{-- <br> --}}
                    {{-- <button type="button" class="btn btn-warning" style="margin-top: 1rem; color:white">Pending</button> --}}
                    <button type="button" class="btn btn-warning" style="color:white" data-bs-toggle="modal"
                      data-bs-target="#exampleModal">
                      See wallet
                    </button>
                  @endif
                </div>
                </br></br>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Wallet coin {{ $wallet->coin ?? '' }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <strong>Wallet address:
            <p style="overflow-x: auto">
              {{ $wallet->address ?? '' }}
            </p>
          </strong>
          <br>
          <div class="card-body table-responsive p-0 col-6">
            <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $wallet->address ?? '' }}'>
          </div>
          <br>
          <strong>Price in crypto ({{ $wallet->coin ?? '' }}): {{ $orderpackage->price_crypto ?? '' }}</strong>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
