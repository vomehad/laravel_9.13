<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCookieRequest;
use App\Services\CookieService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CookieController extends Controller
{
    private CookieService $service;

    public function __construct(CookieService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $cookies = $this->service->getCookie();

        return view('cookies.index', [
            'models' => $cookies,
            'nav' => $this->nav,
        ]);
    }

    public function store(CreateCookieRequest $request)
    {
        $dto = $request->createDto();

        $this->service->addCookie($dto);
    }
}
