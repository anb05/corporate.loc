<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Menu;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {
        /*
         * Конструктор контроллера.
         * Вначале выполняем конструктор родительского класса.
         * Затем определяем какой будем использовать шаблон для
         * отображения страницы.
         *
         * свойство bar содержит часть имени html сласса указывающее
         * на место расположения сайдбара
         */
        parent::__construct(new MenusRepository(new Menu()));

        $this->template = env('THEME').'.articles';

        $this->bar = 'right';

        $this->p_rep = $p_rep;

        $this->a_rep = $a_rep;
    }

    public function index()
    {
        /*
         * Главная задача метода индекс - ОТОБРАЖЕНИЕ статей на экране.
         * Для этого вначале необходимо получить список статей для отображения на экран.
         */

        $articles = $this->getArticles();

        $content = view(env('THEME') . '.articles_content')->with('articles', $articles)->render();

        $this->vars['content'] = $content;

        return $this->renderOutput();
    }

    public function getArticles($alias = false)
    {
        $articles = $this->a_rep->get(['id', 'title', 'alias', 'created_at', 'img', 'desc', 'user_id', 'category_id'], false, true);

        if ($articles) {
//            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }
}
