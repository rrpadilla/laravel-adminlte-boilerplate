<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DateTimeZone;

final class Utils
{
    /**
     * Generate a cdn asset path.
     *
     * @param string $path
     *
     * @return string
     */
    public static function cdnAsset(string $path)
    {
        $base = config('app.cdn') ?: config('app.url');
        $file = ltrim($path, '/');

        return "{$base}/{$file}";
    }

    /**
     * @param array|string $routes
     * @return bool
     */
    public static function checkRoute($routes)
    {
        if (is_string($routes)) {
            return Route::currentRouteName() == $routes;
        } elseif (is_array($routes)) {
            return in_array(Route::currentRouteName(), $routes);
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getLogosNumber()
    {
        return [1, 2, 3, 4, 5];
    }

    /**
     * @param int $logoNumber
     * @return string
     */
    public static function logoPath($logoNumber = 1)
    {
        $logoNumber = static::getValidLogoNumber($logoNumber);

        return "/adminlte/img/avatar_{$logoNumber}.png";
    }

    /**
     * @param int $logoNumber
     * @return string
     */
    public static function getValidLogoNumber($logoNumber = 1)
    {
        return (in_array($logoNumber, static::getLogosNumber())) ? $logoNumber : 1;
    }

    /**
     * @param null $guard
     * @return string
     */
    public static function getUserRoleLabel($guard = null)
    {
        if (! Auth::guard($guard)->guest()) {
            $user = Auth::guard($guard)->user();
            if ($user->isAdmin()) {
                return 'Administrator';
            } else {
                return 'Member';
            }
        }

        return 'Anonymous';
    }

    /**
     * Returns a numerically indexed array with all timezone identifiers
     * @param int $what
     * @param string $country
     * @return array
     * @link http://php.net/manual/en/datetimezone.listidentifiers.php
     */
    public static function getDateTimezoneIdentifiersList($what = DateTimeZone::ALL, $country = null)
    {
        return DateTimeZone::listIdentifiers($what, $country);
    }
}
