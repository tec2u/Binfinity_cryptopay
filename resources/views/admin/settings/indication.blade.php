@extends('adminlte::page')

@section('title', 'Landing Page Configuration')

@section('content')
@include('flash::message')
<div class="alignHeader"> 
    <h4>@lang('admin.indication.title')</h4>
</div>
<div class="card">
    <div class="card-header">
        <h3>@lang('admin.indication.title2')</h3>
    </div>
    <div class="col-sm-12 col-md-4">
    </div>
    <div class="card-body table-responsive">
        <div class="text-left">
            
        {{--<a href="{{route('admin.settings.create')}}" class="btn btn-lg bg-success" title="Create Configuration">
                <i class="fas fa-plus-circle"></i> Create Indication Page
            </a>--}}
            <div class="form-group float-right">
                <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
            </div>
        </div>
        <span class="counter float-right"></span>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('admin.indication.table.col1')</th>
                    <th>@lang('admin.indication.table.col2')</th>
                    <th>@lang('admin.indication.table.col3')</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($indication as $config)
                <tr>
                    <th>{{$config->id}}</th>
                    <td>{{$config->description}}</td>
                    <td>{{$config->img_url}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{route('admin.settings.editVideo', $config->id)}}'">@lang('admin.indication.table.col3')</button>
                    </td>
                </tr>
                @empty
                <p>@lang('admin.indication.table.empty')</p>   
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