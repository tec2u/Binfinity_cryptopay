@extends('adminlte::page')

@section('title', 'Special Commission')

@section('content_header')
<div class="alignHeader">
    <h4>@lang('admin.specialcommission.title')</h4>
</div>
@stop

@section('content')
@include('flash::message')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                    <form action="{{route('admin.users.upspecialcomission', ['id' => $user->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-7">
                                <label for="special_comission">@lang('admin.specialcommission.title')</label>
                                <div class="input-group">
                                    <input 
                                    type="number" 
                                    class="form-control form-control-lg @error('special_comission') is-invalid @enderror" 
                                    id="special_comission" 
                                    name="special_comission"
                                    min="0" 
                                    step=".05"
                                    placeholder="9.99"
                                    value="{{$user->special_comission}}">
                                    @error('special_comission')
                                        <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="inputState5">@lang('admin.specialcommission.active')</label>
                                <div class="input-group">
                                    <select id="special_comission_active" name="special_comission_active" class="form-control form-control-lg @error('special_comission_active') is-invalid @enderror">
                                        @if ($user->special_comission_active == 1)
                                        <option value="1" selected>@lang('admin.specialcommission.activated')</option>
                                        <option value="0">@lang('admin.specialcommission.desactivated')</option>
                                        @else
                                        <option value="1" >@lang('admin.specialcommission.activated')</option>
                                        <option value="0" selected>@lang('admin.specialcommission.desactivated')</option>
                                        @endif                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <button type="submit" class="btn btn-warning">@lang('admin.specialcommission.save')</button>
                    </form>
                </div>
            </div>
        </div>

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