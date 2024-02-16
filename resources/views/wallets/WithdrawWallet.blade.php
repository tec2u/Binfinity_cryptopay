@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>Wallets Withdraw</h1>
              <div class="card shadow my-3" style="overflow-x: auto">
                <div class="card-header bbcolorp">
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">address</th>
                      <th scope="col">coin</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($coins as $item)
                      <form action="{{ route('wallets.WithdrawWalletStore') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $item }}" name="coin">
                        <tr>
                          <th scope="row"></th>
                          <td><input type="text" name="address" id=""
                              value="{{ $walletbyCoin[$item] ?? '' }}"></td>
                          <td>{{ $item }}</td>
                          <td> <button type="submit" style="color:white" class="btn btn-warning">Save</button> </td>
                        </tr>
                      </form>
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
