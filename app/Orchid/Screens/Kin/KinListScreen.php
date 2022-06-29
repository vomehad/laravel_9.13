<?php

namespace App\Orchid\Screens\Kin;

use App\Orchid\Layouts\Kin\KinLayout;
use App\Repositories\KinRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class KinListScreen extends Screen
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
        $this->repository = $repository;
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'kins' => $this->repository->getAll(self::OPTIONS)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Kin.Orchid.Name');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Kin.Button.Create'))
                ->icon('pencil')
                ->route('platform.kin.create')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            KinLayout::class,
        ];
    }
}
