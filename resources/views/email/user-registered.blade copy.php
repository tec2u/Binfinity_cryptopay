<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{env('APP_URL')}}/vendor/adminlte/dist/css/adminlte.min.css">
    <title>Registration Confirmation</title>
</head>
<body>
    <div class="container-fluid mt-3">
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6">
                <div class="card card-outline">
                    <div class="card-body box-profile">
                        <div class="card-header">
                            <h2>Hi {{$user->name}}, how are you? I hope you are well!</h2> 
                        </div>
                        <div class="card-body pb-0" style="display: block">
                            <h3>Thank you for your subscription</h3>
                            <br>
                            <p>Enjoy Shopping in our store</p>
                            <p>Your registration email is: <strong>{{$user->email}}</strong></p>
                            <p>Your Password: <strong>For security reasons we do not send your password, but you must remember it!</strong></p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('index')}}" class="btn btn-lg btn-primary">Go To Store</a>
                        </div>
                        <hr>
                        Email sent in {{date('d/m/Y H:i:s')}}.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>