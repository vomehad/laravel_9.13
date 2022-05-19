<?php

namespace App\Facades;

use App\Services\CustomCookieService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void setLifeTime(int $minutes)
 * @method static int getLifeTime()
 * @method static string setCookie(string $name, string $value, int $minutes = 0)
 * @method static null|string getCookie(string $name)
 * @method static bool incrementCookie(string $name)
 * @method static string setSessionCookie(string $name, string $value)
 * @method static string getSessionCookie(string $name)
 * @method static string incrementSessionCookie(string $name)
 * @see \App\Services\CustomCookieService
 */
class CustomCookie extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomCookieService::class;
    }
}
