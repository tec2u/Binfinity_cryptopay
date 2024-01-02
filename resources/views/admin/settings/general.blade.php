@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
<div class="alignHeader">
    <h4>General Settings</h4>
</div>
<i class="fa fa-home ml-3"></i> - Settings
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                    <form>
                        <div class="row mt-5 align-items-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">Brown, Asher</h4>
                                        <p class="small mb-3"><span class="badge badge-dark">New York, USA</span></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-7">
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                                            pretium blandit sapien.
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                                        <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                                        <p class="small mb-0 text-muted">(537) 315-1481</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control" placeholder="Brown" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Last name</label>
                                <input type="text" id="lastname" class="form-control" placeholder="Asher" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState5">Gender</label>
                                <select id="inputState5" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option value="F" selected>Female</option>
                                    <option value="M" selected>Male</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="lastname">Email</label>
                                <input type="text" id="email" class="form-control" placeholder="user@celebrity" />
                            </div>
                            <div class="form-group col-md-5">
                                <label for="lastname">Cell</label>
                                <input type="number" id="number" class="form-control" placeholder="Your Number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress5">Address</label>
                            <input type="text" class="form-control" id="inputAddress5" placeholder="P.O. Box 464, 5975 Eget Avenue" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCompany5">Company</label>
                                <input type="text" class="form-control" id="inputCompany5" placeholder="Nec Urna Suscipit Ltd" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState5">State</label>
                                <select id="inputState5" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip5">Zip</label>
                                <input type="text" class="form-control" id="inputZip5" placeholder="98232" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState5">Rule</label>
                                <select id="inputState5" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Profile Picture</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <hr class="my-4" />
                        <button type="submit" class="btn btn-warning">Save Change</button>
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