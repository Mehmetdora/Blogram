<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies
{

     /**
     * List of trusted proxies.
     */
    protected $proxies = '*'; // Tüm proxy'lere güven anlamına gelir.

    /**
     * Trusted header names.
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;

     /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Laravel'in HTTP üzerinden HTTPS'e güvenli şekilde yönlendirme yapmasını sağla
        if ($this->proxies === '*') {
            $request->setTrustedProxies(['*'], $this->headers);
        }
        return $next($request);
    }
}
