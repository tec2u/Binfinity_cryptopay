@extends('adminlte::page')

@section('title', 'Active Members')

@section('content_header')
  <h4>
    @lang('admin.members.title')</h4>
@stop

@section('content')
  @include('flash::message')
  <div class="card">
    <div class="card-header">
      <div class="alignPackage">
        <h3>@lang('admin.members.title_2')</h3>
      </div>
    </div>
    <div class="card-body table-responsive">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <form action="{{ route('admin.users.searchUsers') }}" method="GET">
            @csrf
            <div class="input-group input-group-lg">
              <input type="text" name="search" class="form-control @error('search') is-invalid @enderror"
                placeholder="@lang('admin.members.search')">
              <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
              </span>
              @error('search')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </form>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="text-right">
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-lg dropdown-toggle dropdown-icon" data-toggle="dropdown"
                aria-expanded="false">
                @lang('admin.members.filter')
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item"
                  href="{{ route('admin.users.filter', ['parameter' => 'activated']) }}">@lang('admin.members.filterUser.active')Activated</a>
                <a class="dropdown-item"
                  href="{{ route('admin.users.filter', ['parameter' => 'desactivated']) }}">@lang('admin.members.filterUser.desactive')Desactivated</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
        <thead>
          <tr>
            <th>ID</th>
            <th>@lang('admin.members.memberlist.col1')</th>
            <th>@lang('admin.members.memberlist.col2')</th>
            <th>@lang('admin.members.memberlist.col3')</th>
            <th>@lang('admin.members.memberlist.col4')</th>
            {{-- <th>@lang('admin.members.memberlist.col5')</th> --}}
            <!-- <th>@lang('admin.members.memberlist.col6')</th>
                     <th>@lang('admin.members.memberlist.col7')</th> -->
            <th>@lang('admin.members.memberlist.col8')</th>
            <th>@lang('admin.members.memberlist.col9')</th>
          </tr>
          <tr class="warning no-result">
            <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <th>{{ $user->id }}</th>
              <td style="text-align: center; vertical-align: middle;">
                @if (!empty($user->image_path))
                  <img style="max-width: 100px" src="{{ asset('storage/' . $user->image_path) }}" />
                @else
                  <img style="max-width: 100px" src="../../../assetsWelcome/images/favicon.png" />
                @endif
              </td>
              <td><b>{{ $user->name }}</b><br>{{ $user->login }}<br>{{ $user->email }}</td>
              <td>{{ $user->telephone }}</td>
              <td>{{ number_format($user->getTotalBancoIndicacao() + $user->getTotalBancoILevel(), 2, ',', '.') }}</td>
              {{-- <td>{{number_format($user->getTotalBancoCurrent() + $user->getTotalBancoDaily(),2,",",".")}} </td> --}}
              <!-- <td>{{ $user->getDirectsActiveted($user->id) }}/{{ $user->getRede($user->id) }}</td> -->
              <!-- <td>{{ number_format($user->special_comission, 2, ',', '.') }} % @if ($user->special_comission_active == 1)
<i class="fa fa-check" style="color:green" aria-hidden="true"></i> @else<i class="fa fa-times" style="color: red" aria-hidden="true"></i>
  @endif
      </td> -->
              {{-- <td>
                @if ($user->getTypeActivated($user->id) == 'AllCards')
                  <button class="btn btn-success btn-sm m-0">@lang('admin.members.btn_active')</button>
                @elseif ($user->getTypeActivated($user->id) == 'PreRegistration')
                  <button class="btn btn-primary btn-sm m-0">@lang('admin.members.btn_PreRegistration')</button>
                @else
                  <button class="btn btn-danger btn-sm m-0">@lang('admin.members.btn_inactive')</button>
                @endif
              <td> --}}
              <td>
                @if ($user->activated == 1)
                  <button class="btn btn-success btn-sm m-0">@lang('admin.members.btn_active')</button>
                @else
                  <button class="btn btn-danger btn-sm m-0">@lang('admin.members.btn_inactive')</button>
                @endif
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    @lang('admin.members.btn_action')
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i
                          class="fa fa-eye"></i>&ensp;@lang('admin.members.active.view')</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.users.dashboard', ['id' => $user->id]) }}"><i
                          class="fa fa-home"></i>&ensp;@lang('admin.members.active.dashboard')</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.users.network', ['parameter' => $user->id]) }}"><i
                          class="fa fa-network-wired"></i>&ensp;@lang('admin.members.active.network')</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <!-- <li><a class="dropdown-item" href="{{ route('admin.users.specialcomission', ['id' => $user->id]) }}"><i class="fa fa-percent"></i>&ensp;@lang('admin.members.active.comission')</a></li> -->
                    {{-- <li><a class="dropdown-item" href="{{route('admin.users.ban', ['id' => $user->id])}}"><i class="fa fa-ban"></i>&ensp;@lang('admin.members.active.ban')</a></li> --}}
                    <li><a class="dropdown-item" href="{{ route('admin.users.inactive', ['id' => $user->id]) }}"><i
                          class="fa fa-power-off"></i>&ensp;@lang('admin.members.active.inactive')</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.users.activeUser', ['id' => $user->id]) }}"><i
                          class="fa fa-power-off"></i>&ensp;Active user</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <p>@lang('admin.members.memberlist.empty')</p>
          @endforelse
        </tbody>
      </table>
      <div class="card-footer clearfix py-3">
        {{ $users->links() }}
      </div>
    </div>

    {{-- <div class="card-footer clearfix py-3">
      <ul class="pagination pagination-sm m-0 float-right">
         <div class="card-footer clearfix py-3">
            {{$users->appends([
               'search'=>request()->get('search','')
            ])->links()}}
         </div>
      </ul>
   </div> --}}
  </div>
@stop
@section('css')
  <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
  <script>
    $('#flash-overlay-modal').modal();
  </script>
  <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
  <script>
    $(document).ready(function() {
      $(".search").keyup(function() {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {
          'containsi': function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "")
              .toLowerCase()) >= 0;
          }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
          $(this).attr('visible', 'false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).attr('visible', 'true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' item');

        if (jobCount == '0') {
          $('.no-result').show();
        } else {
          $('.no-result').hide();
        }
      });
    });
  </script>
@stop
