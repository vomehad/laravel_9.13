<?php

namespace App\Services;

class YandexStorageService extends BaseService
{
    const YANDEX_DISK_URL = 'https://cloud-api.yandex.net/v1/disk/';
    const YANDEX_OAUTH_URL = 'https://oauth.yandex.ru/';

    public function __construct()
    {
        parent::__construct();

        $this->headers = [];
    }

    /**
     * @throws \App\Exceptions\YandexNotAuthException
     */
    public function getDiskInfo()
    {
        $query = ['path' => 'src'];
        $this->headers = ['Authorization' => 'OAuth y0_AgAAAAAflZqxAAf39AAAAADQKTFALN7FpOmyQu-gnc8gqECxyd5uad8'];
        $response = $this->send(self::YANDEX_DISK_URL . 'resources', 'GET', ['query' => $query]);

        dump(__FILE__.":".(__LINE__+1));
        dd(__METHOD__, $response);
    }

    /**
     * @throws \App\Exceptions\YandexNotAuthException
     */
    public function login()
    {
        $query = [
//            'response_type' => 'token',
            'response_type' => 'code',
            'client_id' => 'b86a8cd8f8f246c4bb64e9c4d91b55df',
        ];

        $response = $this->send(self::YANDEX_OAUTH_URL . 'authorize', 'GET', ['query' => $query], false);

        return $response;
    }
}
