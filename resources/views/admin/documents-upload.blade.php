@extends('adminlte::page')

@section('title', 'Upload Documents')

@section('content_header')
  <h4>Upload Documents</h4>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@stop

@section('content')
  @php
    $packages = Illuminate\Support\Facades\DB::select('SELECT *  FROM packages where activated=1;');
  @endphp


  <div class="card">
    <div class="card-header">
      <div class="alignPackage">
        <h3>Upload Document</h3>
      </div>
    </div>
    <div class="panel-body">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @endif

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.documents-upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-md-12">
            <div class="col-md-6 form-group">
              <label>Title:</label>
              <input type="text" name="title" class="form-control" />
            </div>

            <div class="col-md-6 form-group">
              <label>Tutorial for create account?</label>
              <select class="form-select" aria-label="Default select example" name="tutorial_account">
                <option selected></option>
                <option value="">No</option>
                <option value="blueberrymarkets">blueberrymarkets</option>
                <option value="icmarkets">icmarkets</option>
                <option value="exness">exness</option>
                <option value="vantagemarkets">vantagemarkets</option>
              </select>
            </div>
            <div class="col-md-6 form-group">
              <label>Select Document:</label>
              <input type="file" name="video" class="form-control" />
            </div>

            <div class="col-md-6 form-group">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </form>
      <div class="card-body table-responsive">
        <table class="table table-hover table-bordered results">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Created at</th>
              <th>Download</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <tr class="warning no-result">
              <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
            </tr>
          </thead>
          <tbody>
            @forelse($videos as $video)
              <tr>
                <td>{{ $video->id }}</td>
                <td>{{ $video->title }}</td>
                <td>{{ $video->created_at }}</td>
                <td><a href="{{ route('admin.documents-upload.download', $video->id) }}">download</a></td>
                <td><a href="{{ route('admin.documents-upload.edit', ['id' => $video->id]) }}" class="btn bg-teal"
                    title="Edit">
                    <i class="fas fa-edit"></i>
                </td>
                <td>
                  <div class="btn-group">
                    <form action="{{ route('admin.documents-upload.delete', ['id' => $video->id]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" title="Delete"><i
                          class="fas fa-trash-alt"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <p>empty</p>
            @endforelse
          </tbody>
        </table>
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
