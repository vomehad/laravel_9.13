<?php

namespace App\Orchid\Screens\Kin;

use App\Http\Requests\CreateKinRequest;
use App\Http\Requests\UpdateKinRequest;
use App\Models\Kin;
use App\Repositories\KinRepository;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class KinEditScreen extends Screen
{
    public Kin $kin;

    private KinRepository $repository;

    public function __construct(KinRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @param Kin $kin
     * @return array
     */
    public function query(Kin $kin): iterable
    {
        return [
            'kin' => $kin,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->kin->exists ? __('Kin.Orchid.Update') : __('Kin.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Kin.Button.Create'))
                ->icon('note')
                ->method('create')
                ->canSee(!$this->kin->exists),

            Button::make(__('Kin.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->kin->exists),

            Button::make(__('Kin.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->kin->exists),
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
            Layout::rows([
                Input::make('kin.id')->type('hidden'),

                Input::make('kin.name')
                    ->title(__('Kin.Label.Name'))
                    ->placeholder(__('Kin.Placeholder.Name')),

                Input::make('kin.slug')
                    ->title(__('Kin.Label.Slug'))
                    ->placeholder(__('Kin.Placeholder.Slug')),

                Input::make('kin.color')
                    ->type('color')
                    ->title('Color')
                    ->value($this->kin->color)
                    ->horizontal(),

//                Relation::make('kinsman')
//                    ->fromModel(Kinsman::class, 'name')
//                    ->displayAppend('fullName')
//                    ->multiple(),

                CheckBox::make('kin.active')
                    ->title(__('Kin.Label.Active'))
                    ->value($this->kin->exists ? $this->kin->active : false)
                    ->sendTrueOrFalse(),
            ]),
        ];
    }

    public function create(CreateKinRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Kin.Message.Created'));

        return redirect()->route('platform.kins');
    }

    public function update(UpdateKinRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('Kin.Message.Updated'));

        return redirect()->route('platform.kins');
    }

    public function remove(Kin $kin): RedirectResponse
    {
        $this->repository->remove($kin->id);

        Alert::info(__('Kin.Message.Deleted'));

        return redirect()->route('platform.kins');
    }
}
