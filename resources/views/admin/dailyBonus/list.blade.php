@extends('adminlte::page')

@section('title', 'Bonus Configuration')

@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">
        <h3>
            Config Percentage
            {{-- @lang('admin.unilevel.title') --}}
        </h3>
    </div>
    {{-- <div class="col-sm-12 col-md-4">
        <div class="text-left">
            <a href="{{route('admin.bonus-daily.create')}}" class="btn btn-lg bg-success" title="Create Configuration">
    <i class="fas fa-plus-circle"></i> @lang('admin.unilevel.titlecreate')
    </a>
</div>
</div> --}}
<div class="card-body table-responsive">
    <div class="form-group float-left">
        <a href="{{route('admin.bonus-daily.create')}}" class="btn btn-sm bg-success" title="Activate all bonus">
            {{-- @lang('admin.btn.activateall') --}}
            Add Percentage
        </a>
    </div>
    <div class="form-group float-right">
        <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
    </div>
    <span class="counter float-right"></span>
    <table class="table table-hover table-bordered results">
        <thead>
            <tr>
                <th>
                    ID
                    {{-- @lang('admin.unilevel.table.col1') --}}
                </th>
                {{-- <th>Description</th> --}}
                <th>
                    User

                    {{-- @lang('admin.unilevel.table.col2') --}}
                </th>
                <th>
                    Percentage
                    {{-- @lang('admin.unilevel.table.col6') --}}
                </th>
                <th>
                    Date Create

                    {{-- @lang('admin.unilevel.table.col3') --}}
                </th>
                <th>
                    Status

                    {{-- @lang('admin.unilevel.table.col3') --}}
                </th>

                <th>
                    Actions

                    {{-- @lang('admin.unilevel.table.col5') --}}
                </th>
                {{-- <th>Action</th> --}}
            </tr>
            <tr class="warning no-result">
                <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
            </tr>
        </thead>
        <tbody>
            @forelse($bonus_All as $config)
            <tr>
                <th>{{$config->id}}</th>
                {{-- <td>{{$config->decription}}</td> --}}
                <td>{{$config->user_id}}</td>
                <td>{{$config->value_perc}}</td>
                <td>{{$config->created_at}}</td>
                @if($config->status == 1)
                <td>@lang('admin.unilevel.table.active')</td>
                @else
                <td>@lang('admin.unilevel.table.inactive')</td>
                @endif
                @switch($config->status)
                @case(0)
                <td>
                    <button class="btn   btn-danger btn-sm m-0" onclick="location.href = '{{route('admin.bonus-daily.activate', $config->id)}}'">@lang('admin.unilevel.table.inactivate')</button>
                    <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{route('admin.bonus-daily.edit', $config->id)}}'">@lang('admin.unilevel.table.edit')</button>
                </td>
                @break
                @case(1)
                <td>
                    <button class="btn btn-success btn-sm m-0">
                        @lang('admin.unilevel.table.activate')
                    </button>
                    <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{route('admin.bonus-daily.edit', $config->id)}}'">@lang('admin.unilevel.table.edit')</button>
                </td>
                @break
                @default
                @endswitch
                @empty
                <td colspan="6" class="text-center">
                    <p>You don't have any Bonus Configuration registered!</p>
                </td>
                @endforelse
        </tbody>
    </table>
</div>
</div>

@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $(".search").keyup(function() {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {
                'containsi': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
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
