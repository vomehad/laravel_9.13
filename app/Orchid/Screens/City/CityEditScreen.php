<?php

namespace App\Orchid\Screens\City;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CityEditScreen extends Screen
{
    public City $city;

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
    public function query(City $city): iterable
    {
        return [
            'city' => $city,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->city->exists ? __('City.Orchid.Update') : __('City.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('City.Button.Create'))
                ->icon('plus')
                ->method('create')
                ->canSee(!$this->city->exists),

            Button::make(__('City.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->city->exists),

            Button::make(__('City.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->city->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     * @throws BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('city.id')->type('hidden'),

                Input::make('city.name')
                    ->title(__('City.Label.Name'))
                    ->placeholder(__('City.Placeholder.Name')),

                Input::make('city.country')
                    ->title(__('City.Label.Country'))
                    ->placeholder(__('City.Placeholder.Country')),

                Input::make('city.modern_name')
                    ->title(__('City.Label.ModernName'))
                    ->placeholder(__('City.Placeholder.ModernName')),

//                Relation::make('city.life')
//                    ->fromModel(Life::class, 'id', 'id')
//                    ->title('City.Label.Life'),

                CheckBox::make('city.active')
                    ->title(__('City.Label.Active'))
                    ->sendTrueOrFalse()
                    ->value(true),
            ]),
        ];
    }

    public function create(CreateCityRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('City.Message.Created'));

        return redirect()->route('platform.city.index');
    }

    public function update(UpdateCityRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('City.Message.Updated'));

        return redirect()->route('platform.city.index');
    }

    public function remove(City $city): RedirectResponse
    {
        $this->repository->remove($city->id);

        Alert::info(__('City.Message.Deleted'));

        return redirect()->route('platform.city.index');
    }
}
