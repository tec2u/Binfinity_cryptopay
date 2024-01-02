@component('mail::message')
<h1>New Contact</h1>
<p>Hi {{$user->name}},</p>
<p>Your store has received a new contact.</p>
<hr>
<p><b>Contact</b></p>

<p>
    <b>Name:</b> {{ $dataMessage['name']}} <br>
    <b>Email:</b> {{ $dataMessage['email']}} <br>
    <b>Message:</b> {{ $dataMessage['message']}}
</p>
<hr>
Email sent in {{date('d/m/Y H:i:s')}}

@endcomponent