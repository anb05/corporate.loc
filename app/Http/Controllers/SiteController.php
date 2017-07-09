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
    protected $contentLeftBar = false;

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
        $navigation = view(env('THEME').'.navigation')->render();
        $this->vars['navigation'] = $navigation;
        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {
        $menu = $this->m_rep->get();
        return $menu;
    }
}
