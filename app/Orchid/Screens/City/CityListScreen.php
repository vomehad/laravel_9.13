<?php

namespace App\Orchid\Screens\City;

use App\Orchid\Layouts\City\CityListLayout;
use App\Repositories\CityRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CityListScreen extends Screen
{
    private const DEFAULT_SORT = 'updated_at';
    private const PER_PAGE = 10;
    private const OPTIONS = [
        'defaultSort' => self::DEFAULT_SORT,
        'perPage' => self::PER_PAGE,
    ];

    private CityRepository $repository;

    public function __construct(CityRepository $repository)
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
            'cities' => $this->repository->getAll(self::OPTIONS),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('City.Orchid.Name');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('City.Button.Create'))
                ->icon('plus')
                ->route('platform.city.create')
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
            CityListLayout::class,
        ];
    }

//    public function remove(Request $request): RedirectResponse
//    {
//        $this->repository->remove($request->id);
//
//        Alert::info(__('City.Message.Deleted'));
//
//        return redirect()->route('platform.city.index');
//    }
}
