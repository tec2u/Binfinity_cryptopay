@extends('adminlte::page')

@section('title', 'Active Members')

@section('content_header')
    <h4>Active Members</h4>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>Members</h3>
      </div>
   </div>
   <div class="card-body table-responsive">
            <div class="form-group float-right">
               <input type="text" class="search form-control" placeholder="Search">
            </div>
         <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>Sr. No.</th>
               <th>Image</th>
               <th>User</th>
               <th>Phone No</th>
               <th>Balance</th>
               <th>Coin Balance</th>
               <th>Direct/Team</th>
               <th>Status</th>
               <th>Active</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> No result</td>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th>Junior</th>
               <td>#</td>
               <td><b>Testador</b><br>teste12345<br>teste@1234.com</td>
               <td>5345324532</td>
               <td>0</td>
               <td>0</td>
               <td>1/2</td>
               <td><button class="btn btn-primary btn-sm m-0">Active</button></td>
               <td>
                  <div class="btn-group">
                     <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                     </button>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&ensp;View</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-network-wired"></i>&ensp;User Network</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-ban"></i>&ensp;Mark as Ban</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-power-off"></i>&ensp;Mark as Inactive</a></li>
                     </ul>
                  </div>
               </td>
            </tr>
           <tr>
               <th>Junior</th>
               <td>#</td>
               <td><b>Testador</b><br>teste12345<br>teste@1234.com</td>
               <td>5345324532</td>
               <td>0</td>
               <td>0</td>
               <td>1/2</td>
               <td><button class="btn btn-primary btn-sm m-0">Active</button></td>
               <td>
                  <div class="btn-group">
                     <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                     </button>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&ensp;View</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-network-wired"></i>&ensp;User Network</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-ban"></i>&ensp;Mark as Ban</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-power-off"></i>&ensp;Mark as Inactive</a></li>
                     </ul>
                  </div>
               </td>

            </tr>
            <tr>
               <th>Junior</th>
               <td>#</td>
               <td><b>Testador</b><br>teste12345<br>teste@1234.com</td>
               <td>5345324532</td>
               <td>0</td>
               <td>0</td>
               <td>1/2</td>
               <td><button class="btn btn-danger btn-sm m-0">Disable</button></td>
               <td>
                  <div class="btn-group">
                     <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                     </button>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&ensp;View</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-network-wired"></i>&ensp;User Network</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-ban"></i>&ensp;Mark as Ban</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-power-off"></i>&ensp;Mark as Inactive</a></li>
                     </ul>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
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
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
    </script>
@stop
