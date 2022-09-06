<?php

namespace App\Orchid\Layouts\Kin;

use App\Models\Kin;
use Carbon\Carbon;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KinLayout extends Table
{
    protected $target = 'kins';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Kin.Label.Name'))
                ->render(function (Kin $kin) {
                    return Link::make($kin->name)->route('platform.kin.edit', $kin->id);
                })->sort(),

            TD::make('slug', __('Kin.Label.Slug'))->sort(),

            TD::make('color', __('Kin.Label.Color'))
                ->render(function (Kin $kin) {
                    return "<span style='background-color: {$kin->color};'>$kin->color</span>";
                }),

            TD::make('active', __('Kin.Label.Active'))->render(function (Kin $kin) {
                return Switcher::make()->sendTrueOrFalse()->value($kin->active)->disabled(true);
            })->sort(),

            TD::make('updated_at', __('Kin.Label.Updated'))
                ->sort()
                ->render(function (Kin $kin) {
                    return Carbon::make($kin->updated_at)->format('j-M-Y H:i');
                }),
            TD::make('created_at', __('Kin.Label.Created'))->sort(),

            TD::make(__('Kin.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Kin $kin) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                                Link::make(__('Kin.Button.Update'))
                                    ->icon('pencil')
                                    ->route('platform.kin.edit', $kin->id),

                                /*Button::make(__('Kin.Button.Delete'))
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
