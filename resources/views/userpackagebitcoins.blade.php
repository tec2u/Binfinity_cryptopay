@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="myinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">@lang('user.my_information')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">@lang('user.info')</h3>
                </div>
                <form class="row g-3 p-5" action="{{ route('users.update', ['id' => $user->id]) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.name')<span style="color: brown">*</span></label>
                    <input type="name" class="form-control" id="name" required name="name"
                      value="{{ $user->name }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.last_name')<span style="color: brown">*</span></label>
                    <input type="name" class="form-control" id="last_name" required name="last_name"
                      value="{{ $user->last_name }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">Birthday<span style="color: brown">*</span></label>
                    <input type="date" class="form-control" id="birthday" required name="birthday"
                      value="{{ $user->birthday }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">City<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="city" required name="city"
                      value="{{ $user->city }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.address1')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="address1" required name="address1"
                      value="{{ $user->address1 }}">
                  </div>
                  < class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.address2')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="address2" required name="address2"
                      value="{{ $user->address2 }}">
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
    function authChange() {
      document.querySelector('#password').style.display = 'block';
      document.querySelector('#confirm_password').style.display = 'block';
      document.querySelector('#change_bt').style.display = 'none';
    }
  </script>
@endsection
