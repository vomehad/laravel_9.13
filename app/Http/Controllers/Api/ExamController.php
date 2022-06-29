<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SplitRequest;
use App\Http\Requests\TextRequest;
use App\Services\ExamService;

class ExamController extends Controller
{
    private ExamService $service;

    public function __construct(ExamService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function processWord(SplitRequest $request): string
    {
        $dto = $request->createDto();

        return $this->service->splitWordByChars($dto);
    }

    public function switchDates(TextRequest $request)
    {
        $dto = $request->createDto();

        return $this->service->textWithReplacedDates($dto);
    }
}
