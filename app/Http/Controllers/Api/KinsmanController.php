<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Kinsman\KinsmanCollection;
use App\Http\Resources\Kinsman\KinsmanSingleResource;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\Request;

class KinsmanController extends Controller
{
    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(): KinsmanCollection
    {
        $kinsmans = $this->repository->getAll();

        return new KinsmanCollection($kinsmans);
    }

    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
