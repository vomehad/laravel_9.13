<?php

namespace App\Orchid\Layouts\Kinsman;

use App\Models\Kinsman;
use Carbon\Carbon;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KinsmanListLayout extends Table
{
    protected $target = 'kinsmans';

    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Kinsman.Label.Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->width('250px')
                ->render(function(Kinsman $kinsman) {
                    return new KinsmanPersona($kinsman->presenter());
                }
            ),

            TD::make('middle_name', __('Kinsman.Label.MiddleName'))
                ->sort()
                ->filter(Input::make())
                ->defaultHidden(),

            TD::make('gender', __('Kinsman.Label.Gender'))
                ->render(function(Kinsman $kinsman) {
                    return $kinsman->presenter()->gender();
                }
            )->defaultHidden(),

            TD::make('active', __('Kinsman.Label.Active'))
                ->sort()
                ->render(function(Kinsman $kinsman) {
                    return Switcher::make()
                        ->sendTrueOrFalse()
                        ->value($kinsman->active)
                        ->disabled(true);
                }
            )->defaultHidden(),

            TD::make('birth_date', __('Kinsman.Label.BirthDate'))
                ->cantHide()
                ->render(function(Kinsman $kinsman) {
                    if (!empty($kinsman->life->birth_date)) {
                        return $kinsman->presenter()->birthDate();
                    }

                    return null;
                }),

            TD::make('father_id', __('Kinsman.Label.Father'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $father */
                    $father = $kinsman->father ?? null;

                    if ($father) {
                        return Link::make($father->presenter()->title())
                            ->route('platform.kinsman.edit', ['kinsman' => $father->id]);
                    }

                    return null;
                }
            ),

            TD::make('mother_id', __('Kinsman.Label.Mother'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $mother */
                    $mother = $kinsman->mother ?? null;

                    if ($mother) {
                        return Link::make($mother->name ." ". $mother->middle_name)
                            ->route('platform.kinsman.edit', ['kinsman' => $mother->id]);
                    }

                    return null;
                }
            ),

            TD::make('kin_id', __('Kinsman.Label.Kin'))
                ->render(function(Kinsman $kinsman) {
                    $kin = $kinsman->kin ?? null;

                    if ($kin) {
                        return Link::make($kin->name)->route('platform.kin.edit', $kin->id);
                    }

                    return null;
                }
            )->defaultHidden(),

            TD::make('updated_at', __('Kinsman.Label.Updated'))
                ->sort()
                ->render(function(Kinsman $kinsman) {
                    return Carbon::make($kinsman->updated_at)->format('j-M-Y H:i');
                }),
            TD::make('created_at', __('Kinsman.Label.Created'))
                ->sort()
                ->defaultHidden(),

            TD::make(__('Kinsman.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function(Kinsman $kinsman) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Kinsman.Button.Update'))
                                ->icon('pencil')
                                ->route('platform.kinsman.edit', $kinsman->id),

                            /*Button::make(__('Kinsman.Button.Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove'),*/
                        ]
                    );
                }
            ),
        ];
    }
}
