<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Роутер создаваемый фреймворком по умолчанию можно удалить
 */
//Route::get('/', function () {
//    return view('welcome');
//});

/**
 * Группа роутов для аутентификации пользователей.
 * Созданы командой:
 *
 * php artisan make:auth
 *
 * В данном проеэкте будет использоваться самописная аутентификация.
 * Поэтому эта группа маршрутов удаляется (или комментируется)
 */
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

/**
 * Создаем группу роутов типа resource, т.е. роутеры определяющие
 * архитектуру REST full приложения.
 * Т.к. в данном проекте концепция REST использоваться не будет,
 * то используются только некоторые роуты (Для главной страницы сайта
 * полный набор REST маршрутов не нужен, поэтому указываем только нужный).
 * Выбор используемого роута определяется третим параметром - массивом.
 *
 * Контроллер для обработки маршрутов создается в командной строке:
 *
 * php artisan make:controller IndexController --resource
 */
Route::resource('/', 'IndexController',
    [
        'only' => ['index'],
        'names' => ['index' => 'home'],
    ]);

/**
 * В приложении будет использоваться несколько контроллеров.
 * Для уменьшения дублирования кода, общие методы всех контроллеров
 * сосредоточим в РОДИТЕЛЬСКОМ контроллере - SiteController
 * Это обычный стандартный контроллер (не REST)
 * В нём будет сосредоточена основная логика пользовательской части.
 */

/**
 *
 */
Route::resource('portfolios', 'PortfolioController', [
    'parameters' => [
        'portfolios' => 'alias',
    ]
]);

Route::resource('articles', 'ArticlesController', [
    'parameters' => [
        'articles' => 'alias',
        ],
]);

Route::get('articles/cat/{cat_alias?}', ['uses' => 'ArticleController@index', 'as' => 'articlesCat']);
