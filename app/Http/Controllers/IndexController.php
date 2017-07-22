<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\SlidersRepository;
use Corp\Menu;

class IndexController extends SiteController
{
    public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep)
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
        $this->template = env('THEME').'.index';
        $this->bar = 'right';

        $this->s_rep = $s_rep;

        $this->p_rep = $p_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        /*
         * Создаём контент используя функцию для получения данных
         */
        $portfolios = $this->getPortfolio();

        /*
         * Для отображения данных формируем формируем строку из шаблона content.blade.php
         * используя функцию-хелпер view с передачей в качестве параметров полного пути к шаблону
         * и коллекцию работ в переменной $portfolios.
         */
        $content = view(env('THEME') . '.content')->with('portfolios', $portfolios)->render();
        $this->vars['content'] = $content;

//        dd($portfolio);
        /*
         * Слайдер отображается только на главной странице сайта,
         * поэтому формированме слайдера осуществляется в этом методе
         */

        /*
         * Формируем метод последник, который будет обращаться к репозиторию
         * для получения необходимой информации.
         *
         * Такие методы посредники необходимы для обеспечения высокой гибкости
         * создаваемого приложения.
         */
        $sliderItems = $this->getSliders();
//        dd($sliderItems);
        $sliders = view(env('THEME') . '.slider',
            ['sliders' => $sliderItems])->render();

        $this->vars['sliders'] = $sliders;

        return $this->renderOutput();
    }


    public function getSliders()
    {
        /*
         * Всё что касается работы с базой данный выносится в репозиторий.
         * Значит запрашиваем данные из БД через репозиторий.
         */
        $sliders = $this->s_rep->get();

        /*
         * Метод isEmpty - это хелпер фреймворка, который используется для
         * работы с коллекциями.
         * Возвращает TRUE в случае ПУСТОЙ коллекции.
         */
        if ($sliders->isEmpty()) {
            return false;
        }

        /*
         * Метод transform() позволяет описать функцию, которая будет
         * вызвана для КАЖДОГО элемента коллекции (Обходит все элементы коллекции по циклу).
         * При этом в $item попадает модель для которой вызывается эта функция,
         * а в переменную $key попадает индекс этой коллекции.
         */
        $sliders->transform(function ($item, $key) {
            /*
             * Добавляем информацию о директории в которой хранятся изображения.
             * Эту информацию будем брать из файла настроек settings.php
             */
            $item->img = \Config::get('settings.slider_path') . '/' . $item->img;
            return  $item;
        });

//        dd($sliders);

        return $sliders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getPortfolio()
    {
        $portfolio = $this->p_rep->get('*', \Config::get('settings.home_port_count'));

        return $portfolio;
    }
}
