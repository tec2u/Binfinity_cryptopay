@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>Wallets</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <form action="{{ route('wallets.store') }}" method="post" class="d-flex">
                    @csrf
                    {{-- <input type="hidden" name="coin" value="USDT_TRC20"> --}}
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

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">address</th>
                      <th scope="col">coin</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wallets as $item)
                      <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->coin }}</td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
