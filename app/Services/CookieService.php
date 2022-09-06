<?php

namespace App\Services;

use App\Dto\CookieDto;
use App\Facades\CustomCookie;

class CookieService
{
    private const HOURLY = 'hourly_cookie';
    private const FOREVER = 'forever_cookie';
    private const HOUR = 60;

    public function getCookie(): array
    {
        return [
            'cookie_hourly' => $this->incrementCookie(static::HOURLY),
            'cookie_forever' => $this->incrementCookie(static::FOREVER),
        ];
    }

    private function incrementCookie(string $name): string
    {
        return CustomCookie::incrementCookie($name) ? CustomCookie::getCookie($name) : "not set";
    }

    public function addCookie(CookieDto $dto)
    {
        $this->setHourly($dto->numberHourly);
        $this->setForever($dto->numberForever);
    }

    private function setHourly(?int $value)
    {
        if (!$value) {
            return;
        }

        CustomCookie::setCookie(static::HOURLY, $value, self::HOUR);
    }

    private function setForever(?int $value)
    {
        if (!$value) {
            return;
        }

        CustomCookie::setCookie(static::FOREVER, $value);
    }
}
