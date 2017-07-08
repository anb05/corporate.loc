<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'title'  => 'Главная',
                'path'   => 'http://corporate.loc',
                'parent' => 0,
            ],
            [
                'title'  => 'Блог',
                'path'   => 'http://corporate.loc/articles',
                'parent' => 0,
            ],
            [
                'title'  => 'Компьютеры',
                'path'   => 'http://corporate.loc/articles/cat/computers',
                'parent' => 0,
            ],
            [
                'title'  => 'Интересное',
                'path'   => 'http://corporate.loc/articles/cat/interesting',
                'parent' => 0,
            ],
            [
                'title'  => 'Советы',
                'path'   => 'http://corporate.loc/articles/cat/soveti',
                'parent' => 0,
            ],
            [
                'title'  => 'Портфолио',
                'path'   => 'http://corporate.loc/portfolios',
                'parent' => 0,
            ],
            [
                'title'  => 'Контакты',
                'path'   => 'http://corporate.loc/contacts',
                'parent' => 0,
            ],
        ]);
    }
}
