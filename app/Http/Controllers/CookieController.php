<?php

namespace App\Http\Controllers;

use App\Facades\CustomCookie;
use App\Http\Requests\AjaxRequest;
use JetBrains\PhpStorm\ArrayShape;

class CookieController extends Controller
{
    private string $hourlyCookie = 'hourly_cookie';
    private string $foreverCookie = 'forever_cookie';

    /**
     * Start Page with forms
     *
     * @return string
     */
    public function testingPage(): string
    {
        $cookies = [
            'cookie_hourly' => $this->incrementCookie($this->hourlyCookie),
            'cookie_forever' => $this->incrementCookie($this->foreverCookie),
        ];

        return view('cookies.index', [
            'models' => $cookies,
            'nav' => $this->nav,
        ]);
    }

    /**
     * Set cookie value
     *
     * @param AjaxRequest $request
     */
    public function addCookie(AjaxRequest $request)
    {
        $hourly = $request->numberHourly;
        $forever = $request->numberForever;

        if ($hourly) {
            $oneHour = 60;

            CustomCookie::setCookie($this->hourlyCookie, $hourly, $oneHour);
        }

        if ($forever) {
            CustomCookie::setCookie($this->foreverCookie, $forever);
        }
    }

    /**
     * Get new cookie`s value
     *
     * @return array
     */
    #[ArrayShape(['cookie_hourly' => "null|string", 'cookie_forever' => "null|string"])]
    public function getCookie(): array
    {
        $cookieHourly = CustomCookie::getCookie($this->hourlyCookie);
        $cookieForever = CustomCookie::getCookie($this->foreverCookie);

        return [
            'cookie_hourly' => $cookieHourly,
            'cookie_forever' => $cookieForever,
        ];
    }

    private function incrementCookie(string $name): string
    {
        return CustomCookie::incrementCookie($name) ? CustomCookie::getCookie($name) : "not set";
    }
}
