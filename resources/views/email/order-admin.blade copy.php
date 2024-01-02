<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order</title>
</head>
<body>
    <p>Hi {{$user->name}}</p>
    <p>Your store has received a new order.</p>
    <br/>

    <table style="width: 600px; text-align:right">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items()->get() as $item)
            <tr>
                <td><img src="{{$message->embed('storage/' . $item->product->pictures()->where('cover', true)->first()->image)}}" width="100"></td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->amount}}</td>
                <td>${{$item->price * $item->amount}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="font-size:22px;font-weight:bold;border-top:1px solid #ccc;"></td>
                <td>Total : ${{$order->total}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>