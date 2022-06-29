<?php

namespace App\Orchid\Screens\Kinsman;

use App\Orchid\Layouts\Kinsman\KinsmanListLayout;
use App\Orchid\Layouts\Kinsman\KinsmanFilterLayout;
use App\Repositories\KinsmanRepository;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class KinsmanListScreen extends Screen
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
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
            'kinsmans' => $this->repository->getAll(self::OPTIONS),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Kinsman.Orchid.Name');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Kinsman.Button.Create'))
                ->icon('plus')
                ->route('platform.kinsman.create')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            KinsmanFilterLayout::class,
            KinsmanListLayout::class,
        ];
    }
}
