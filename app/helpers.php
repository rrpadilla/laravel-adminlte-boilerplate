<?php

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

if (! function_exists('cdn_asset')) {
    /**
     * Generate a cdn asset path.
     *
     * @param string $path
     *
     * @return string
     */
    function cdn_asset(string $path)
    {
        return \App\Utils::cdnAsset($path);
    }
}

if (! function_exists('trustedproxy_config')) {
    /**
     * Get Trusted Proxy value
     *
     * @param string $key
     * @param string $env_value
     *
     * @return mixed
     */
    function trustedproxy_config($key, $env_value)
    {
        if ($key === 'proxies') {
            if ($env_value === '*' || $env_value === '**') {
                return $env_value;
            }

            return $env_value ? explode(',', $env_value) : null;
        } elseif ($key === 'headers') {
            if ($env_value === 'HEADER_X_FORWARDED_AWS_ELB') {
                return Request::HEADER_X_FORWARDED_AWS_ELB;
            } elseif ($env_value === 'HEADER_FORWARDED') {
                return Request::HEADER_FORWARDED;
            }

            return Request::HEADER_X_FORWARDED_ALL;
        }

        return null;
    }
}

if (! function_exists('redirect_back_field')) {
    /**
     * Generate a redirect back url form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function redirect_back_field()
    {
        return new HtmlString('<input type="hidden" name="_redirect_back" value="'.old('_redirect_back', back()->getTargetUrl()).'">');
    }
}

if (! function_exists('redirect_back_to')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $callbackUrl
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function redirect_back_to($callbackUrl = null, $status = 302, $headers = [], $secure = null)
    {
        $to = request()->input('_redirect_back', back()->getTargetUrl());
        if ($callbackUrl) {
            if (! starts_with($to, $callbackUrl)) {
                $to = $callbackUrl;
            }
        }

        return redirect($to, $status, $headers, $secure);
    }
}
