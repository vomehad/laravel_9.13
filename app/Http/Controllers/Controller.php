<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Lang;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 *
 * @property array $nav
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('test.cookie.index'), 'name' => Lang::get('Test.Menu.Top')],
            ['url' => route('test.notes.index'), 'name' => Lang::get('Note.Menu.Top')],
            ['url' => route('sort'), 'name' => Lang::get('Algorithm.Menu.Top')],
            ['url' => route('articles.index'), 'name' => Lang::get('Article.Menu.Top')],
            ['url' => route('Game'), 'name' => Lang::get('Game.Menu.Top')],
            ['url' => route('kinsmans.index'), 'name' => Lang::get('Kinsman.Menu.Top')],
            ['url' => route('platform.index'), 'name' => Lang::get('Admin.Menu.Top')],
        ];
    }
}
