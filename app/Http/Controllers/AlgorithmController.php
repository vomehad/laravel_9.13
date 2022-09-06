<?php

namespace App\Http\Controllers;

use App\Services\AlgorithmService;

class AlgorithmController extends Controller
{
    private AlgorithmService $service;

    public function __construct(AlgorithmService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        [$source, $bubbled] = $this->service->bubble();

        return view('algorithms.index', [
            'source' => $source,
            'bubbled' => $bubbled,
            'nav' => $this->nav,
        ]);
    }
}
