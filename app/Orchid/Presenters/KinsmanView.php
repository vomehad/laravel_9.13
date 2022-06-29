<?php

namespace App\Orchid\Presenters;

use Illuminate\View\View;
use Orchid\Screen\Layouts\Content;

class KinsmanView extends Content
{
    /**
     * @var string
     */
    protected $template = 'platform::layouts.persona';

    public function render(KinsmanPresenter $kinsman): View
    {
        return view($this->template, [
            'title'    => $kinsman->title(),
            'subTitle' => $kinsman->subTitle(),
            'image'    => $kinsman->image(),
            'url'      => $kinsman->url(),
        ]);
    }
}
