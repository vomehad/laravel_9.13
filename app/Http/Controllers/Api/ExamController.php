<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SplitRequest;
use App\Http\Requests\TextRequest;
use App\Services\ExamService;

class ExamController extends ApiController
{
    private ExamService $service;

    public function __construct(ExamService $service)
    {
        $this->service = $service;
    }

    public function processWord(SplitRequest $request): string
    {
        $dto = $request->createDto();

        return $this->service->splitWordByChars($dto);
    }

    public function switchDates(TextRequest $request): array|string|null
    {
        $dto = $request->createDto();

        return $this->service->textWithReplacedDates($dto);
    }
}
