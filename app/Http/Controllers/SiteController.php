<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Свойство для хранения экземпляра класса Portfolio Repository
     * @var PortfolioRepository
     */
    protected $p_rep;

    /**
     * Свойство для хранения экземпляра сласса слайдера
     * @var object
     */
    protected $s_rep;

    /**
     * Свойство для хранения объекта репозитория для работы со статьями
     * @var
     */
    protected $a_rep;

    /**
     * Свойство для репозитория меню
     * @var
     */
    protected $m_rep;

    // Lesson 10
    // Вводятся свойства для формирования хедера
    /**
     * @var $keywords string Ключевые слова для хедера
     */
    protected $keywords;

    /**
     * @var string Описание
     */
    protected $meta_desc;

    /**
     * @var string $title Для хедера
     */
    protected $title;

    /**
     * Имя шаблона для отображения конкретной страницы
     * @var string
     */
    protected $template;

    /**
     * Свойство для хранения значений, передаваемых в шаблоны
     * @var array
     */
    protected $vars = [];

    /**
     * Свойство указывающее на отсутствие (false) или наличие (left | right) сайдбара
     * @var bool|string
     */
    protected $bar = false;

    /**
     * Свойство содержащее контент правого сайдбара
     * @var bool|string
     */
    protected $contentRightBar = false;

    /**
     * Свойство содержащее контент левого сайдбара
     * @var bool|string
     */
    protected $contentLeftBar = 'no';

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    /**
     * @return string
     */
    protected function renderOutput()
    {
        $menu = $this->getMenu();
        $navigation = view(env('THEME').'.navigation',['menu' => $menu])->render();
        $this->vars['navigation'] = $navigation;

        if($this->contentRightBar) {
            $rightBar = view(env('THEME') . '.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
            $this->vars['rightBar'] = $rightBar;
        }

        $this->vars['bar'] = $this->bar;

        /*
         * Lesson 10
         * Формируем переменную футер
         */
        $footer = view(env('THEME') . '.footer')->render();
        $this->vars['footer'] = $footer;

        /**
         * Добавляем переменные для хедера
         */
        $this->vars['keywords'] = $this->keywords;
        $this->vars['meta_desc'] = $this->meta_desc;
        $this->vars['title'] = $this->title;

        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {
        $menus = $this->m_rep->get()->toArray();
        /*
         * Методами PHP формируем главное меню приложения
         * Меню состоит из основного или главного меню и подменю.
         * Отличительным признаком основного меню и подменю является
         * значение колонки parent таблицы menus БД.
         * В эту колонку заносится число:
         *              0 - основное меню;
         *              1,2..n - номер основновного пункта меню, к которому
         *                       относится подменю (например, число 3
         *                       означает, что это подменю, относящееся к
         *                       третьему пукту меню.
         * Результирующий массив имеет следующий вид:
         *
         * $menu = [
         *            `menus.id` => [
         *                              'title' => `menus.title`,
         *                              'path'  => `menus.path`,
         *                              'child' => [
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *                                         ]
         *                          ],
         *
         *            `menus.id` => [
         *                              'title' => `menus.title`,
         *                              'path'  => `menus.path`,
         *                              'child' => [
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *                                         ]
         *                          ],
         *
         *            `menus.id` => [
         *                              'title' => `menus.title`,
         *                              'path'  => `menus.path`,
         *                              'child' => [
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *
         *                                             `menus.id` => [
         *                                                               'title' => `menus.title`,
         *                                                               'path'  => `menus.path`,
         *                                                           ]
         *                                         ]
         *                          ],
         *         ]
         */
        $menu = [];
        foreach ($menus as $item) {
            if ($item['parent'] === 0) {
                $menu[$item['id']]['title'] = $item['title'];
                $menu[$item['id']]['path']  = $item['path'];
            } else {
                $menu[$item['parent']]['child'][$item['id']]['title'] = $item['title'];
                $menu[$item['parent']]['child'][$item['id']]['path'] = $item['path'];
            }
        }

        return $menu;
    }
}
