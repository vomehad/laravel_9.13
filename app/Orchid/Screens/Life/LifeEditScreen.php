<?php

namespace App\Orchid\Screens\Life;

use App\Http\Requests\CreateLifeRequest;
use App\Http\Requests\UpdateLifeRequest;
use App\Models\Kinsman;
use App\Models\Life;
use App\Repositories\LifeRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class LifeEditScreen extends Screen
{
    public Life $life;

    private LifeRepository $repository;

    public function __construct(LifeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @param Life $life
     * @return array
     */
    public function query(Life $life): iterable
    {
        return [
            'life' => $life,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->life->exists ? __('Life.Orchid.Update') : __('Life.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Life.Button.Create'))
                ->icon('plus')
                ->method('create')
                ->canSee(!$this->life->exists),

            Button::make(__('Life.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->life->exists),

            Button::make(__('Life.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->life->exists),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * @throws BindingResolutionException
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([

                Input::make('life.id')->type('hidden'),

                Relation::make('life.kinsman_id')
                    ->fromModel(Kinsman::class, 'name')
                    ->applyScope('kinsman')
                    ->displayAppend('fullName')
                    ->title('Life.Label.Kinsman'),

                DateTimer::make('life.birth_date')
                    ->title(__('Life.Label.BirthDate'))
                    ->placeholder(__('Life.Placeholder.BirthDate'))
                    ->enableTime(),

                DateTimer::make('life.end_date')
                    ->title(__('Life.Label.EndDate'))
                    ->placeholder(__('Life.Placeholder.EndDate'))
                    ->enableTime(),

                CheckBox::make('life.active')
                    ->title(__('Life.Label.Active'))
                    ->value(true)
                    ->sendTrueOrFalse(),

            ]),

        ];
    }

    public function create(CreateLifeRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Life.Message.Created'));

        return redirect()->route('platform.life.index');
    }

    public function update(UpdateLifeRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('Life.Message.Updated'));

        return redirect()->route('platform.life.index');
    }

    public function remove(Life $life): RedirectResponse
    {
        $this->repository->remove($life->id);

        Alert::info(__('Life.Message.Deleted'));

        return redirect()->route('platform.life.index');
    }
}
