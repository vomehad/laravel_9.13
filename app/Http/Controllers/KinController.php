<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKinRequest;
use App\Http\Requests\UpdateKinsmanRequest;
use App\Repositories\KinRepository;
use Illuminate\Http\RedirectResponse;

class KinController extends Controller
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private KinRepository $repository;

    public function __construct(KinRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $kins = $this->repository->getAll(self::OPTIONS);

        return view('kins.index', [
            'models' => $kins,
            'nav' => $this->nav
        ]);
    }

    public function create()
    {
        $kin = $this->repository->add();

        return view('kins.create', [
            'model' => $kin,
            'nav' => $this->nav
        ]);
    }

    public function store(CreateKinRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinId = $this->repository->create($dto);

        return redirect()->route('kins.show', $kinId);
    }

    public function show(int $id)
    {
        $kin = $this->repository->getOne($id);

        return view('kins.show', [
            'model' => $kin,
            'nav' =>$this->nav
        ]);
    }

    public function edit(int $id)
    {
        [$kinsman, $fathers, $mothers, $kins] = $this->repository->edit($id);

        return view('kinsmans.edit', [
            'model' => $kinsman,
            'fathers' => $fathers,
            'mothers' => $mothers,
            'kins' => $kins,
            'nav' => $this->nav
        ]);
    }

    public function update(UpdateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinsmanId = $this->repository->update($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

    public function destroy($id)
    {
        //
    }
}
