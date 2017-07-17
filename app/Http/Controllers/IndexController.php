<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\SlidersRepository;
use Corp\Menu;

class IndexController extends SiteController
{
    public function __construct(SlidersRepository $s_rep)
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
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
}
