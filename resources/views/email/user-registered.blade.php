@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<style>
    table,
    td,
    div,
    h1,
    p {
        font-family: Georgia;
    }
</style>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:40px 0 30px 0;background:#272727;">
                            <img src="{{asset('storage/logo-removebg-preview.png')}}" alt="Infinity ClubCards Logo" width="300" style="height:auto;display:block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Georgia,sans-serif;">Hi {{$user->name}}!!</h1>
                                        <p style="margin:0 0 12px 0;font-size:17px;line-height:1.7;font-family: Georgia">Thank you for registering with us.</p>
                                        {{-- <p style="margin:0;font-size:14px;line-height:24px;font-family:Georgia;"><a style="color:goldenrod;">Enjoy Shopping in our store</a></p> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                                    <p>Your registration email is: <strong>{{$user->email}}</strong></p>
                                                </td>
                                                <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Georgia;">Your Password: <strong>For security reasons we do not send your password.</strong></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @component('mail::button', ['url' => route('login'), 'color' => 'primary'])
                            Login to your backoffice
                            @endcomponent
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#272727;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Georgia;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p style="margin:0;font-size:16px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                            &reg; Infinity ClubCards<br /><a style="color:#ffffff;font-size:12px;">Email sent in {{date('d/m/Y H:i:s')}}.</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
@endcomponent
@endslot
@slot('footer')

@endslot
@endcomponent