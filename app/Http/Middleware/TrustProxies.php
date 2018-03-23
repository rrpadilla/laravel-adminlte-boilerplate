<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Contracts\Config\Repository;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Create a new trusted proxies middleware instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        parent::__construct($config);
        $this->proxies = config('trustedproxy.proxies');
        $this->headers = config('trustedproxy.headers');
    }
}
