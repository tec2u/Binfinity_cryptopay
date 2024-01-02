@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">@lang('user.change_password')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">@lang('user.password')</h3>
                </div>
                <form class="row gx-3 gy-2 align-items-center p-5" action="{{ route('users.change.password') }}"
                  method="POST">
                  @csrf
                  @method('PUT')
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="old_password" name="old_password"
                      placeholder="@lang('user.current_password')">
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="@lang('user.new_password')">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="@lang('user.confirm_password')">
                    </div>
                  </div>
                  <div class="col-md-4 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill up font">
                      @lang('user.change_password')
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
