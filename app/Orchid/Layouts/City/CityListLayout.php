<?php

namespace App\Orchid\Layouts\City;

use App\Models\City;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CityListLayout extends Table
{
    protected $target = 'cities';

    protected function columns(): iterable
    {
        return [
            TD::make('geo', __('City.Label.Geo')),

            TD::make('name', __('City.Label.Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function(City $city) {
                    return Link::make($city->name)->route('platform.city.edit', ['id' => $city->id]);
                }),

            TD::make('country', __('City.Label.Country')),

            TD::make('modern_name', __('City.Label.ModernName')),

            TD::make('active', __('City.Label.Active'))
                ->sort()
                ->render(function(City $city) {
                    return Switcher::make()->sendTrueOrFalse()->value($city->active)->disabled(true);
                }),

            TD::make('updated_at', __('City.Label.Updated'))->sort(),
            TD::make('created_at', __('City.Label.Created'))->sort(),

            TD::make(__('Kinsman.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function(City $city) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('City.Button.Update'))
                                ->icon('pencil')
                                ->route('platform.city.edit', $city->id),

                            Button::make(__('City.Button.Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', ['id', $city->id]),
                        ]);
                }),
        ];
    }
}
