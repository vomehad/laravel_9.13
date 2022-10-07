<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreatePhotoRequest;
use App\Http\Resources\Kinsman\KinsmanCollection;
use App\Http\Resources\Kinsman\KinsmanSingleResource;
use App\Repositories\KinsmanRepository;
use App\Services\YandexStorageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KinsmanController extends ApiController
{
    private KinsmanRepository $repository;
    private YandexStorageService $service;

    public function __construct(KinsmanRepository $repository, YandexStorageService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $kinsmans = $this->repository->getAll($request->query());

        return (new KinsmanCollection($kinsmans))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * @throws \App\Exceptions\YandexNotAuthException
     */
    public function storePhoto(CreatePhotoRequest $request)
    {
        $dto = $request->createDto();
        $this->service->getDiskInfo();
        dump(__FILE__.":".(__LINE__+1));
        dd(__METHOD__, $dto);
    }

    /**
     * @throws \App\Exceptions\YandexNotAuthException
     */
    public function yandexLogin()
    {
        return $this->service->login();
    }

    public function show(int $id): KinsmanSingleResource
    {
        $kinsman = $this->repository->getOne($id);

        return new KinsmanSingleResource($kinsman);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
