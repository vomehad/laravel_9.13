<?php

namespace App\Services;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager as Session;
use Illuminate\Support\Facades\Cookie;

class CustomCookieService extends CookieJar
{
    private Request $request;
    private Session $session;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = session();
    }

    public function getCookie(string $name): ?string
    {
        return $this->request->cookie($name);
    }

    public function incrementCookie(string $name): bool
    {
        $cookieNumber = $this->request->cookie($name);

        if (!is_numeric($cookieNumber)) {
            return false;
        }

        $cookieNumber = intval($cookieNumber);

        return !!$this->setCookie($name, ++$cookieNumber);
    }

    public function setCookie(string $name, string $value, int $minutes = 0): string
    {
        Cookie::queue($name, $value, $minutes);

        return 'queued';
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function setSessionCookie(string $name, string $value): string
    {
        $this->session->put([$name => $value]);

        return $this->session->get($name);
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getSessionCookie(string $name): string
    {
        return $this->session->get($name) ?? '';
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function incrementSessionCookie(string $name): string
    {
        if (!$this->session->has($name)) {
            $this->session->put([$name => 0]);
        }

        $this->session->increment($name);

        return $this->session->get($name);
    }
}
