<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Kinsman\KinsmanCollection;
use App\Http\Resources\Kinsman\KinsmanSingleResource;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KinsmanController extends ApiController
{
    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): JsonResponse
    {
        $kinsmans = $this->repository->getAll($request->query());

        return (new KinsmanCollection($kinsmans))
            ->response()
            ->setStatusCode(200);
    }

    public function store(Request $request)
    {
        //
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
