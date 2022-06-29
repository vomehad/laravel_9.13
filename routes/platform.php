<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Kin;
use App\Models\Kinsman;
use App\Models\Note;
use App\Orchid\Screens\Article\ArticleEditScreen;
use App\Orchid\Screens\Article\ArticleListScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;
use App\Orchid\Screens\Category\CategoryListScreen;
use App\Orchid\Screens\City\CityEditScreen;
use App\Orchid\Screens\City\CityListScreen;
use App\Orchid\Screens\Datetime\DatetimeScreen;
use App\Orchid\Screens\Datetime\DatetimeViewScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Kin\KinEditScreen;
use App\Orchid\Screens\Kin\KinListScreen;
use App\Orchid\Screens\Kinsman\KinsmanCreateScreen;
use App\Orchid\Screens\Kinsman\KinsmanEditScreen;
use App\Orchid\Screens\Kinsman\KinsmanListScreen;
use App\Orchid\Screens\Life\LifeEditScreen;
use App\Orchid\Screens\Life\LifeListScreen;
use App\Orchid\Screens\Note\NoteEditScreen;
use App\Orchid\Screens\Note\NoteListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail->parent('platform.systems.users')->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.systems.users')->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail->parent('platform.systems.roles')->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.systems.roles')->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');

// Platform > Datetime
Route::screen('datetime', DatetimeScreen::class)
    ->name('platform.datetime')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push('Datetime');
    });

// Platform > Datetime > View
Route::screen('datetime/view', DatetimeViewScreen::class)
    ->name('platform.datetime.view')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')
            ->push('platform.datetime', route('platform.datetime'))
            ->push('Time diff');
    });

// Platform > Articles
Route::screen('articles', ArticleListScreen::class)
    ->name('platform.articles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Article.Orchid.Menu'));
    });

// Platform > Articles > Edit
Route::screen('articles/{article}/edit', ArticleEditScreen::class)
    ->name('platform.article.edit')
    ->breadcrumbs(function (Trail $trail, Article $article) {
        return $trail->parent('platform.index')
            ->push(__('Article.Orchid.Menu'), route('platform.articles'))
            ->push($article->title);
    });

// Platform > Articles > Create
Route::screen('articles/create', ArticleEditScreen::class)
    ->name('platform.article.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Article.Orchid.Menu'), route('platform.articles'))
            ->push('Create');
    });

// Platform > Categories
Route::screen('categories', CategoryListScreen::class)
    ->name('platform.categories')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Category.Orchid.Menu'));
    });

// Platform > Categories > Edit
Route::screen('categories/{category}/edit', CategoryEditScreen::class)
    ->name('platform.category.edit')
    ->breadcrumbs(function (Trail $trail, Category $category) {
        return $trail->parent('platform.index')
            ->push(__('Category.Orchid.Menu'), route('platform.categories'))
            ->push($category->name);
    });

// Platform > Categories > Create
Route::screen('categories/create', CategoryEditScreen::class)
    ->name('platform.category.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Category.Orchid.Menu'), route('platform.categories'))
            ->push('Create');
    });

// Platform > Kinsmans
Route::screen('kinsmans', KinsmanListScreen::class)
    ->name('platform.kinsmans')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Kinsman.Orchid.Menu'));
    });

// Platform > Kinsmans > Edit
Route::screen('kinsmans/{kinsman?}/edit', KinsmanEditScreen::class)
    ->name('platform.kinsman.edit')
    ->breadcrumbs(function(Trail $trail, Kinsman $kinsman) {
        return $trail->parent('platform.index')
            ->push(__('Kinsman.Orchid.Menu'), route('platform.kinsmans'))
            ->push($kinsman->name);
    });

// Platform > Kinsmans > Create
Route::screen('kinsmans/create', KinsmanCreateScreen::class)
    ->name('platform.kinsman.create')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Kinsman.Orchid.Menu'), route('platform.kinsmans'))
            ->push(__('Kinsman.Orchid.Create'));
    });

// Platform > Kins
Route::screen('kins', KinListScreen::class)
    ->name('platform.kins')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Kin.Orchid.Menu'));
    });

// Platform > Kins > Edit
Route::screen('kins/{kin}/edit', KinEditScreen::class)
    ->name('platform.kin.edit')
    ->breadcrumbs(function(Trail $trail, Kin $kin) {
        return $trail->parent('platform.index')
            ->push(__('Kin.Orchid.Menu'), route('platform.kins'))
            ->push($kin->name);
    });

// Platform > Kins > Create
Route::screen('kins/create', KinEditScreen::class)
    ->name('platform.kin.create')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Kin.Orchid.Menu'), route('platform.kins'))
            ->push(__('Kin.Orchid.Create'));
    });

// Platform > Notes
Route::screen('notes', NoteListScreen::class)
    ->name('platform.notes')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Note.Orchid.Menu'));
    });

// Platform > Notes > Edit
Route::screen('notes/{note}/edit', NoteEditScreen::class)
    ->name('platform.note.edit')
    ->breadcrumbs(function(Trail $trail, Note $note) {
        return $trail->parent('platform.index')
            ->push(__('Note.Orchid.Menu'), route('platform.notes'))
            ->push($note->name);
    });

// Platform > Notes > Create
Route::screen('notes/create', NoteEditScreen::class)
    ->name('platform.note.create')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Note.Orchid.Menu'), route('platform.notes'))
            ->push('Create');
    });

// Platform > Life
Route::screen('life', LifeListScreen::class)
    ->name('platform.life.index')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Life.Orchid.Menu'));
    });

// Platform > Life > Edit
Route::screen('life/{id}/edit', LifeEditScreen::class)
    ->name('platform.life.edit')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Life.Orchid.Menu'), route('platform.life.index'))
            ->push('life');
    });

// Platform > Life > Create
Route::screen('life/create', LifeEditScreen::class)
    ->name('platform.life.create')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('Life.Orchid.Menu'), route('platform.life.index'))
            ->push('Create');
    });

// Platform > City
Route::screen('cities', CityListScreen::class)
    ->name('platform.city.index')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('City.Orchid.Menu'));
    });

// Platform > City > Edit
Route::screen('city/{id}/edit', CityEditScreen::class)
    ->name('platform.city.edit')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('City.Orchid.Menu'), route('platform.city.index'))
            ->push(__('City.Orchid.Update'));
    });

// Platform > City > Create
Route::screen('city/create', CityEditScreen::class)
    ->name('platform.city.create')
    ->breadcrumbs(function(Trail $trail) {
        return $trail->parent('platform.index')
            ->push(__('City.Orchid.Menu'), route('platform.city.index'))
            ->push(__('City.Orchid.Create'));
    });
