@extends('adminlte::page')

@section('title', 'Edit Packages')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('admin.editPackage.title')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('admin.editPackage.subtitle')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">@lang('admin.editPackage.subtitle2')</a></li>
                    <li class="breadcrumb-item active">@lang('admin.editPackage.title')</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash::message')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#long_description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#description_fees', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>

    <div class="row d-flex justify-content-center ">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('admin.editPackage.data')</h3>
                </div>
                <form action="{{ route('admin.packages.update', ['id' => $package->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">@lang('admin.editPackage.edit.name')</label>
                            <input type="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="@lang('admin.editPackage.edit.entername')" value="{{ $package->name }}">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">@lang('admin.editPackage.edit.price')</label>
                                    <input type="number"
                                        class="form-control form-control-lg @error('price') is-invalid @enderror"
                                        id="price" name="price" step=".05" placeholder="9.99"
                                        value="{{ $package->price }}">
                                    @error('price')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="commission">@lang('admin.editPackage.edit.comission')</label>
                                    <input type="number"
                                        class="form-control form-control-lg @error('commission') is-invalid @enderror"
                                        id="commission" name="commission" step=".05" placeholder="9.99"
                                        value="{{ $package->commission }}">
                                    @error('commission')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">@lang('admin.editPackage.edit.type')</label>
                                    <select class="form-control form-control-lg @error('type') is-invalid @enderror"
                                        name="type" id="type">
                                        <option value="packages" @if ($package->type == 'packages') selected @endif>
                                            @lang('admin.editPackage.edit.typeedit.package')</option>
                                        <option value="activator" @if ($package->type == 'activator') selected @endif>
                                            @lang('admin.editPackage.edit.typeedit.active')</option>
                                    </select>
                                    @error('rule')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                        </div>
                        <div class="col md 12">
                            <div class="form-group">
                                <label for="long_description">@lang('admin.editPackage.edit.long')</label>
                                <textarea id="long_description" name="long_description">
                            {{ $package->long_description }}
                        </textarea>
                            </div>
                        </div>

                        <div class="col md 12">
                            <div class="form-group">
                                <label for="description_fees">@lang('admin.editPackage.edit.longfees')</label>
                                <textarea id="description_fees" name="description_fees">
                            {{ $package->description_fees }}
                        </textarea>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col md 6">
                                <div class="form-group">
                                    <label for="activated">@lang('admin.editPackage.edit.active')</label>
                                    <select class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="activated" id="activated">
                                        <option value="1" @if ($package->activated == 1) selected @endif>
                                            @lang('admin.editPackage.edit.activetype.activated')</option>
                                        <option value="0" @if ($package->activated == 0) selected @endif>
                                            @lang('admin.editPackage.edit.activetype.desactivated')</option>
                                    </select>
                                    @error('rule')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col md 6">
                                <div class="form-group">
                                    <label for="image">@lang('admin.editPackage.edit.image')</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control form-control-lg @error('image.*') is-invalid @enderror">
                                    @error('image.*')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col md 12">
                                <div class="form-group">
                                    <label for="plan_id">Plan ID</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('plan_id') is-invalid @enderror"
                                        id="plan_id" name="plan_id" placeholder=""
                                        value="{{ $package->plan_id }}">
                                    @error('plan_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn brn-lager btn-success">@lang('admin.editPackage.edit.register')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (isset($errors) && count($errors))

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
        </ul>

    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "classic"
            });
        });
    </script>
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@stop
