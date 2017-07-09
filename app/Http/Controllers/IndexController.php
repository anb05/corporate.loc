<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Corp\Menu;

class IndexController extends SiteController
{
    public function __construct()
    {
        /**
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return $this->renderOutput();
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