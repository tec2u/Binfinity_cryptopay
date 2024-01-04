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
                <div class="col-6">
                  Please do the payment of {{ $orderpackage->price }} USD IN BTC ({{ $value_btc ?? '' }})
                  {{-- TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF --}}
                  {{-- <div class="card-body table-responsive p-0 col-6">
                                        <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF'>
                                    </div> --}}
                  <br>
                  <form action="{{ route('packages.payCrypto') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                    <input type="hidden" value="{{ $orderpackage->price }}" name="price">
                    <select class="form-select" aria-label="Default select example" name="method" required>
                      <option value="" selected>Choose method</option>
                      {{-- <option value="BTC">BTC</option> --}}
                      <option value="TRC20">USDT TRC20</option>
                    </select>
                    <button type="submit" class="btn btn-success" style="margin-top: 1rem">Pay</button>
                  </form>
                </div>
                </br></br>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
