<?php

namespace App\Http\Controllers;

use App\Helpers\NameHelper;
use App\Http\Requests\SplitRequest;
use App\Http\Requests\TextRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contacts = Contact::all();

        return view('home', [
            'models' => $contacts,
            'nav' => $this->nav,
        ]);
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();

        return view('users.index', [
            'models' => $users,
            'nav' => $this->nav
        ]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = new User();

        return view('users.edit', [
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->id ? User::find($request->id) : new User();
        $user->username = $request->get('username');
        $user->email = $request->get('email');

        return redirect()->route('users.show', $user->id);
    }

    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $user */
        $user = User::find($id);

        return view('users.show', [
            'title' => $user->name,
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): string
    {
        /** @var User $user */
        $user = User::find($id);

        return view('users.edit', [
            'title' => $user->name,
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $tag = User::find($id);
        $tag->delete();

        return NameHelper::getActionName();
    }

    public function search(Request $request)
    {
//        $string = $request->get('search') ?? $request->query->get('query') ?? '';
//        $title = Lang::get(Helper::getActionName());
//        $articles = $this->getArticleList($string);
//
//        return view('user.index', [
//            'title' => $title,
//            'models' => $articles,
//            'nav' => $this->nav,
//            'string' => $string,
//        ]);
    }

/*    public function roles(int $id)
    {
        $user = User::find($id)->with('role')->get();
//        $user->role()->attach($roleId);
    }*/

    /**
     * "Whitespaced" word
     *
     * @param SplitRequest $request
     * @return string
     */
    public function processWord(SplitRequest $request): string
    {
        $split = '';
        $wordSplit = $request->input('wordSplit');

        for ($char = 0; $char < mb_strlen($wordSplit); $char++) {
            $split .= mb_substr($wordSplit, $char, 1) . ' ';
        }

        return $split;
    }

    public function switchDates(TextRequest $request): array|string|null
    {
        $text = $request->input('text');
        $pattern = '/(\d{2})\.(\d{2})\.(\d{4})/';
        $replacement = '$1.$3.$2';

        return preg_replace($pattern, $replacement, $text);
    }

    public function account(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.account', [
            'nav' => $this->nav,
        ]);
    }
}
