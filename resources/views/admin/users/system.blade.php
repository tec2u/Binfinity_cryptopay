@extends('adminlte::page')

@section('title', 'System config')

@section('content_header')
  <div class="alignHeader">
    <h4>@lang('admin.members.active.system_conf')</h4>
  </div>
@stop

@section('content')
  @include('flash::message')
  <div class="card">
    <div class="card-body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <form action="{{ route('admin.settings.upsystemconfig') }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  {{-- <label for="inputState5">@lang('admin.members.allow_reports')</label> --}}
                  <div class="input-group">
                    <select id="is_allowed_btn_box" name="is_allowed_btn_box"
                      class="form-control form-control-lg @error('is_allowed_btn_box') is-invalid @enderror">
                      @if (isset($system->is_allowed_btn_box) && $system->is_allowed_btn_box == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <button type="submit" class="btn btn-warning">@lang('admin.myinfo.save')</button>
            </form>
          </div>
        </div>


      </div>

    </div>
  </div>

  <div class="alignHeader">
    <h4>Config payment system</h4>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <form action="{{ route('admin.settings.upsystemconfigPay') }}" method="POST">
              @csrf
              @method('PUT')
              <select id="is_allowed_btn_box" name="is_allowed_btn_box" style="display: none"
                class="form-control form-control-lg @error('is_allowed_btn_box') is-invalid @enderror">
                @if (isset($system->is_allowed_btn_box) && $system->is_allowed_btn_box == 1)
                  <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                  <option value="0">@lang('admin.whitelist.table.desactive')</option>
                @else
                  <option value="1">@lang('admin.whitelist.table.active')</option>
                  <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                @endif
              </select>
              <div class="form-row">
                <div class="col-md-6 mb-6">
                  <label for="inputState5" style="color: red">SYSTEM</label>
                  <div class="input-group">
                    <select id="all" name="all"
                      class="form-control form-control-lg @error('all') is-invalid @enderror">
                      @if (isset($system->all) && $system->all == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-6 mb-6">
                  <label for="inputState5">API</label>
                  <div class="input-group">
                    <select id="api" name="api"
                      class="form-control form-control-lg @error('api') is-invalid @enderror">
                      @if (isset($system->api) && $system->api == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-6 mb-6">
                  <label for="inputState5 danger">APP</label>
                  <div class="input-group">
                    <select id="app" name="app"
                      class="form-control form-control-lg @error('app') is-invalid @enderror">
                      @if (isset($system->app) && $system->app == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-6 mb-6">
                  <label for="inputState5">NODE</label>
                  <div class="input-group">
                    <select id="node" name="node"
                      class="form-control form-control-lg @error('node') is-invalid @enderror">
                      @if (isset($system->node) && $system->node == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-6 mb-6">
                  <label for="inputState5 danger">INVOICE INTERNAL</label>
                  <div class="input-group">
                    <select id="internal" name="internal"
                      class="form-control form-control-lg @error('internal') is-invalid @enderror">
                      @if (isset($system->internal) && $system->internal == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-6 mb-6">
                  <label for="inputState5">INVOICE EXTERNAL</label>
                  <div class="input-group">
                    <select id="external" name="external"
                      class="form-control form-control-lg @error('external') is-invalid @enderror">
                      @if (isset($system->external) && $system->external == 1)
                        <option value="1" selected>@lang('admin.whitelist.table.active')</option>
                        <option value="0">@lang('admin.whitelist.table.desactive')</option>
                      @else
                        <option value="1">@lang('admin.whitelist.table.active')</option>
                        <option value="0" selected>@lang('admin.whitelist.table.desactive')</option>
                      @endif
                    </select>
                  </div>
                </div>
              </div>

              <hr class="my-4" />
              <button type="submit" class="btn btn-warning">@lang('admin.myinfo.save')</button>
            </form>
          </div>
        </div>


      </div>

    </div>
  </div>
@stop
@section('css')
  <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
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
