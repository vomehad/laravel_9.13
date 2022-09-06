<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\NameHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Factory|View|Application
    {
        $categories = Category::where(['is_active' => true])->paginate();

        return view('categories.index', [
            'models' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function create(): Factory|View|Application
    {
        $category = new Category();

        return view('categories.edit', [
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $category = $request->id ? Category::find($request->id) : new Category();

        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('test.categories.show', $category->id);
    }

    public function show(int $id): string
    {
        $category = Category::find($id);

        return view('categories.show', [
            'title' => $category->name,
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): Factory|View|Application
    {
        $category = Category::find($id);

        return view('categories.edit', [
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $category = Category::find($id);
        $category->delete();

        return NameHelper::getActionName();
    }
}
