<?php

namespace App\Orchid\Screens\Life;

use App\Orchid\Layouts\Life\LifeListLayout;
use App\Repositories\LifeRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class LifeListScreen extends Screen
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private LifeRepository $repository;

    public function __construct(LifeRepository $repository)
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
            'life' => $this->repository->getAll(self::OPTIONS),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Life.Orchid.Name');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Life.Button.Create'))
                ->icon('plus')
                ->route('platform.life.create'),
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
            LifeListLayout::class,
        ];
    }
}
