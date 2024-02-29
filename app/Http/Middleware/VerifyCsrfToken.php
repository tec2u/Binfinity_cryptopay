<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/packages/packagepay/notify',
        '/packages/wallets/notify',
        '/packages/wallets/decrypt',
        '/packages/wallets/encrypt',
        '/send/email'
    ];
}