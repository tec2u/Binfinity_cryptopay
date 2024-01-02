@extends('adminlte::page')

@section('title', 'Upload Image')

@section('content_header')
<h4>Upload Image</h4>
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <div class="alignPackage">
      <h3>Upload Image</h3>
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

    <form action="{{ route('admin.dailyhome.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">

        <div class="col-md-12">
          <div class="col-md-6 form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required />
          </div>
          <div class="col-md-6 form-group">
            <label>Date:</label>
            <input type="text" name="date" class="form-control" pattern="(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}" placeholder="MM/DD/YYYY" required>
          </div>
          <div class="col-md-6 form-group">
            <label>Select Image:</label>
            <input type="file" name="video" class="form-control" required />
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
            <th>Image</th>
            <th>Edit</th>
            <th>Date</th>
            <th>Delete</th>
          </tr>
          <tr class="warning no-result">
            <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
          </tr>
        </thead>
        <tbody>
          @forelse($images as $image)
          <tr>
            <td>{{$image->id}}</td>
            <td>{{$image->title}}</td>
            <td style="text-align: center; vertical-align: middle;">
              <img style="max-width: 100px" src="{{asset('storage/'.$image->path)}}" />
            </td>
            <td><a href="{{route('admin.dailyhome.edit', ['id' => $image->id])}}" class="btn bg-teal" title="Edit">
                <i class="fas fa-edit"></i>
            </td>
            <td>{{date('m/d/Y ', strtotime($image->date))}}</td>
            <td>
              <div class="btn-group">
                <form action="{{route('admin.dailyhome.delete', ['id' => $image->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
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