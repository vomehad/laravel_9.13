<?php

namespace App\Orchid\Layouts\Kinsman;

use App\Orchid\Presenters\KinsmanPresenter;
use Orchid\Screen\Layouts\Content;

class KinsmanPersona extends Content
{
    protected $template = 'layouts.persona';

    public function render(KinsmanPresenter $kinsman)
    {
        return view($this->template, [
            'title' => $kinsman->title(),
            'subTitle' => $kinsman->subTitle(),
            'image' => $kinsman->image(),
            'url' => $kinsman->url(),
            'color' => $kinsman->color(true),
        ]);
    }
}
