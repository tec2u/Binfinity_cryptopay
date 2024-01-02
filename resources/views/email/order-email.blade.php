@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<div class="theader">
    <img src="{{asset('storage/' . $system->logo)}}" class="elogo" alt="{{$system->name}} Logo" ><span class="etitle">{{ $system->name ?? config('app.name') }}</span>

</div>
@endcomponent
@endslot
<h1>Order Confirmation</h1>    
<p>Hi {{$user->name}},</p>
<p>Your order has been successfully placed.</p>
@component('mail::table')
| Order Id: | {{$order->id}} | Date: {{$order->created_at}}| Hour: {{$order->hour}} |
| ---------:| --------------:|--------------------:| ----------------:|
@endcomponent
@component('mail::table')
|Your Observation:|
| :---|
| {{$order->obs_user}}|
@endcomponent
<h2>List Items</h2>
@component('mail::table')
| Image | Name Product| Price|
| -----:| --------------:| ----:| 
@foreach($order->items()->get() as $item)
| ![product]({{asset("storage/" . $item->product->pictures()->where('cover', true)->first()->image)}}) | {{$item->product->name}} | $ {{formatPriceToHuman($item->price)}} |
@endforeach
| <b>Total:</b> | | $ {{formatPriceToHuman($order->total)}} |
@endcomponent
@component('mail::button', ['url' => route('index'), 'color' => 'success'])
    Go To Store
@endcomponent
    Email sent in {{date('d/m/Y H:i:s')}}.

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent