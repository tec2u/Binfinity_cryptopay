@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>MT4 Server Configuration</h1>
              @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title">Input Login Number and Login Password below</h3>
                </div>
                @php
                  $user_id = ucwords(auth()->user()->id);
                  $pedido = Illuminate\Support\Facades\DB::select("SELECT *  FROM orders_package where id=$orderpackage->id and user_id=$user_id");
                  if (!isset($pedido)) {
                      echo '<script>
                        window.location = "/home";
                      </script>';
                  }
                @endphp
                <form class="row gx-3 gy-2 align-items-center p-5"
                  action="{{ route('packages.change_userpassword', ['id' => $orderpackage->id]) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="old_password" name="login_number"
                      placeholder="Login Number" value="{{ $pedido[0]->{'user'} }}">
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" id="password" name="login_password"
                        placeholder="Login Password" value="{{ $pedido[0]->{'pass'} }}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" id="server" name="server" placeholder="server"
                        value="{{ $pedido[0]->{'server'} }}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      PrintScreen of the server configuration email: </br>
                      <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                  </div>
                  </br></br>
                  <div class="col-md-12">
                    <img src="/images/printscreen/{{ $pedido[0]->{'printscreen'} }}" alt="Profile"
                      style='max-width:500px'>
                  </div>
                  <div class="col-md-12 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill">
                      Update MT4 Account
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    $(window).load(function() {
      $('#flash-overlay-modal').modal('show');
    });

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
@endsection
