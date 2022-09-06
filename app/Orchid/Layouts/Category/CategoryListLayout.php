<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use Carbon\Carbon;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Category.Label.Name'))
                ->cantHide()
                ->render(function (Category $category) {
                    return Link::make($category->name)->route('platform.category.edit', $category->id);
                }
            )->sort(),

            TD::make('active', __('Category.Label.Active'))
                ->defaultHidden()
                ->render(function (Category $category) {
                    return Switcher::make()
                        ->sendTrueOrFalse()
                        ->value($category->active)
                        ->disabled(true);
                }
            )->sort(),

            TD::make('article', __('Category.Label.Article'))
                ->width('130px')
                ->render(function (Category $category) {
                    return $category->article()->count();
                }
            ),

            TD::make('note', __('Category.Label.Note'))
                ->width('130px')
                ->render(function (Category $category) {
                    return $category->note()->count();
                }
            ),

            TD::make('updated_at', __('Category.Label.Updated'))
                ->render(function (Category $category) {
                    return Carbon::make($category->updated_at)->format('j-M-Y H:i');
                })
                ->sort(),
            TD::make('created_at', __('Category.Label.Created'))
                ->defaultHidden()
                ->sort(),

            TD::make(__('Category.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Category $category) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                                Link::make(__('Category.Button.Update'))
                                    ->icon('pencil')
                                    ->route('platform.category.edit', $category->id),
                            ]
                        );
                }
            ),
        ];
    }
}
