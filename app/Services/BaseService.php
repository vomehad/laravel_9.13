<?php

namespace App\Services;

use App\Exceptions\YandexNotAuthException;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class BaseService
{
    protected Client $client;
    protected array $headers;

    public function __construct()
    {
        $this->client = app(Client::class);
    }

    /**
     * @throws \App\Exceptions\YandexNotAuthException
     */
    protected function send(string $url, string $method = 'GET', array $options = [])
    {
        try {
            $options = array_merge(['headers' => $this->headers], $options);
            $response = $this->client->request($method, $url, $options);
        } catch (\Throwable $exception) {
            if ($exception->getCode() === Response::HTTP_UNAUTHORIZED) {
                throw new YandexNotAuthException('Не удалось авторизоваться в Яндекс.Диск');
            }
        }

        return json_decode($response->getBody()->getContents());
    }
}
