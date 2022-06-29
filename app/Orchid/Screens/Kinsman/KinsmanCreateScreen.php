<?php

namespace App\Orchid\Screens\Kinsman;

use App\Http\Requests\CreateKinsmanRequest;
use App\Models\Kin;
use App\Models\Kinsman;
use App\Repositories\KinsmanRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class KinsmanCreateScreen extends Screen
{
    public Kinsman $kinsman;

    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function query(Kinsman $kinsman): iterable
    {
//        $kinsman->load('photo');

        return [
            'kinsman' => $kinsman,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->kinsman->exists ? __('Kinsman.Orchid.Update') : __('Kinsman.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Kinsman.Button.Create'))
                ->icon('plus')
                ->method('create')
                ->canSee(!$this->kinsman->exists),

            Button::make(__('Kinsman.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->kinsman->exists),

            Button::make(__('Kinsman.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->kinsman->exists),

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
        $geo = $this->kinsman->nativeCity->first()->geo ?? null;
        $coordinates = $geo ? json_decode($geo) : null;

        if ($this->kinsman->id) {
            $children = $this->repository->getChildren($this->kinsman->id);
        }

        return [
            Layout::columns([
                Layout::rows([
                    Input::make('kinsman.id')->hidden(),

                    CheckBox::make('kinsman.active')
                        ->hidden()
                        ->vertical()
                        ->value(true),

//                        CheckBox::make('kinsman.active')
//                            ->view('platform::field.checkbox')
//                            ->vertical()
//                            ->title(__('Kinsman.Label.Active'))
//                            ->sendTrueOrFalse()
//                            ->value($this->kinsman->exists ? $this->kinsman->active : true),

                    Group::make([
                        Input::make('kinsman.name')
                            ->title(__('Kinsman.Label.Name'))
                            ->placeholder(__('Kinsman.Placeholder.Name')),

                        Input::make('kinsman.middle_name')
                            ->title(__('Kinsman.Label.MiddleName'))
                            ->placeholder(__('Kinsman.Placeholder.MiddleName')),
                    ]),

                    Group::make([
                        Select::make('kinsman.gender')
                            ->options([
                                'male' => __('Kinsman.Select.Male'),
                                'female' => __('Kinsman.Select.Female'),
                            ])
                            ->empty('Not selected')
                            ->title('Kinsman.Label.Gender'),

                        Relation::make('kinsman.kin_id')
                            ->fromModel(Kin::class, 'name', 'id')
                            ->title('Kinsman.Label.Kin'),
                    ]),

                    Group::make([
                        Relation::make('kinsman.father_id')
                            ->fromModel(Kinsman::class, 'name', 'id')
                            ->applyScope('fathers')
                            ->displayAppend('fullName')
                            ->title('Kinsman.Label.Father'),

                        Relation::make('kinsman.mother_id')
                            ->fromModel(Kinsman::class, 'name', 'id')
                            ->applyScope('mothers')
                            ->displayAppend('fullName')
                            ->title('Kinsman.Label.Mother'),
                    ]),

                    Group::make([
                        DateTimer::make('life.birth_date')
                            ->title(__('Life.Label.BirthDate'))
                            ->placeholder(__('Life.Placeholder.BirthDate'))
                            ->value($this->kinsman->life->birth_date ?? null)
                            ->enableTime(),

                        DateTimer::make('life.end_date')
                            ->title(__('Life.Label.EndDate'))
                            ->placeholder(__('Life.Placeholder.EndDate'))
                            ->value($this->kinsman->life->end_date ?? null)
                            ->enableTime(),
                    ]),

                    Relation::make('marriage.partner_id')
                        ->fromModel(Kinsman::class, 'name', 'id')
                        ->applyScope('wed', $this->kinsman->gender, $children ?? [])
                        ->displayAppend('fullName')
                        ->value($this->kinsman->gender === 'male' ? $this->kinsman->wife->first()->id ?? '' : $this->kinsman->husband->first()->id ?? '')
                        ->title($this->kinsman->gender === 'male' ? __('Kinsman.Label.Wife') : __('Kinsman.Label.Husband'))
                        ->canSee($this->kinsman->exists),
                ]),

                Layout::rows([
                    Group::make([
                        Input::make('city.city_name')
                            ->title(__('City.Label.City'))
                            ->value($this->kinsman->nativeCity->first()->name ?? null)
                            ->placeholder(__('City.Placeholder.City')),

                        Input::make('city.country_name')
                            ->title(__('City.Label.Country'))
                            ->value($this->kinsman->nativeCity->first()->country ?? null)
                            ->placeholder(__('City.Placeholder.Country')),
                    ]),

                    Map::make('city.native')
                        ->title(__('City.Label.Native'))
                        ->zoom(4)
                        ->value([
                            'lat' => $coordinates->lat ?? 50,
                            'lng' => $coordinates->lng ?? 40,
                        ]),
                ]),
            ]),
        ];
    }

    public function create(CreateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Kinsman.Message.Created'));

        return redirect()->route('platform.kinsmans');
    }
}
