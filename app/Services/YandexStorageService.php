<?php

namespace App\Services;

class YandexStorageService extends BaseService
{
    const YANDEX_DISK_URL = 'https://cloud-api.yandex.net/v1/disk/';

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
        $response = $this->send(self::YANDEX_DISK_URL);

        dump(__FILE__.":".(__LINE__+1));
        dd(__METHOD__, $response);
    }
}
