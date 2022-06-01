<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CORSMiddleware {
    /**
     * Redirects to the HTTPS version of the site if the request does't use HTTPS.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->method() === 'OPTIONS') $response = new Response;
        else $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', 'X-Requested-With, X-Auth-Token, Content-Type');
        $response->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE');
        return $response;
    }
}
