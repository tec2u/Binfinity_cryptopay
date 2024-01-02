@component('mail::layout')
{{--  --}}
@slot('')
@component('mail::', ['url' => config('app.url')])
<div class="t">
    <img src="{{asset('storage/' . $system->logo)}}" class="elogo" alt="{{$system->name}} Logo" ><span class="etitle">{{ $system->name ?? config('app.name') }}</span>

</div>
@endcomponent
@endslot
<h1>Alert New Order</h1>
<p>Hi {{$user->name}},</p>
<p>Your store has received a new order.</p>
@component('mail::table')
| Order Id: | {{$order->id}} | Date: {{$order->created_at}} | Hour: {{$order->hour}} |
| ---------:| --------------:| ------------------------:| -----------:|
@endcomponent
<h2>Customer Information</h2>
<p><b>Name:</b> {{$order->user->name}}<br>
    <b>Email:</b> {{$order->user->email}}<br>
    <b>Phone:</b> {{$order->user->telephone}}</p>     
@component('mail::table')
|User Notes:|
| :---|
| {{$order->obs_user}}|
@endcomponent
<h2>List Items</h2>
@component('mail::table')
| Image | Name Product | Price |
| -----:| ------------:| -----:|
@foreach($order->items()->get() as $item)
| ![product]({{asset("storage/" . $item->product->pictures()->where('cover', true)->first()->image)}}) | {{$item->product->name}} | $ {{formatPriceToHuman($item->price)}} |
@endforeach
| <b>Total:</b> | | $ {{formatPriceToHuman($order->total)}} |
@endcomponent
@component('mail::button', ['url' => route('index'), 'color' => 'success'])
    Go To store
@endcomponent
    Email sent in {{date('d/m/Y H:i:s')}}.
{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent