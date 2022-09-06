<?php

namespace App\Http\Controllers;

use App\Helpers\NameHelper;
use Illuminate\Support\Facades\Lang;

class GameController extends Controller
{
    public function playGame(): string
    {
        $title = Lang::get(NameHelper::getActionName() . '.Title');
        $rows = 4;
        $startItem = 1;

        return view('play.game', [
            'title' => $title,
            'nav' => $this->nav,
            'rows' => $rows,
            'item' => $startItem,
        ]);
    }

    public function createRecord()
    {

    }
}
