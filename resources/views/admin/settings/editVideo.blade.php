@extends('adminlte::page')

@section('title', 'Level Commission')

@section('content_header')
<div class="alignHeader">
    <h4>@lang('admin.levelcommission.title')</h4>
</div>
<i class="fa fa-home ml-3"></i> - @lang('admin.levelcommission.subtitle')
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <div class="alignPackage">
            <h3>@lang('admin.levelcommission.title')</h3>
        </div>
    </div>
    <form action="{{route('admin.settings.updateVideo', ['id' => $videos->id])}}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label for="description">@lang('admin.levelcommission.col3')</label>
                <input type="text" class="form-control form-control-lg" value="{{ $videos-> description}}" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="description">@lang('admin.levelcommission.col4')</label>
                <input type="text" class="form-control form-control-lg" value="{{ $videos-> img_url}}" id="img_url" name="img_url">
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn brn-lager btn-success">@lang('admin.levelcommission.register')</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
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