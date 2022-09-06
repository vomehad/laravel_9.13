<?php

namespace App\Orchid\Layouts\Life;

use App\Models\Life;
use Carbon\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LifeListLayout extends Table
{
    protected $target = 'life';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('user_id', __('Life.Label.Username'))
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Life $life) {
                    $kinsman = $life->kinsman;
                    $name = $kinsman->name . " " . $kinsman->middle_name;

                    return Link::make($name)->route('platform.kinsman.edit', ['kinsman' => $kinsman->id]);
                }),

            TD::make('birth_date', __('Life.Label.BirthDate'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Life $life) {
                    if (!empty($life->birth_date)) {
                        return Carbon::make($life->birth_date)->format('j M Y');
                    }

                    return null;
                }),

            TD::make('active', __('Life.Label.Active'))
                ->sort()
                ->render(function (Life $life) {
                    return Switcher::make()->sendTrueOrFalse()->value($life->active)->disabled(true);
                }),

            TD::make('updated_at', __('Life.Label.Updated'))->sort(),
            TD::make('created_at', __('Life.Label.Created'))->sort(),

            TD::make(__('Life.Label.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Life $life) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Life.Button.Update'))
                                ->icon('pencil')
                                ->route('platform.life.edit', ['id' => $life->id]),

                            Button::make(__('Life.Button.Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove'),
                        ]);
                }),
        ];
    }
}
