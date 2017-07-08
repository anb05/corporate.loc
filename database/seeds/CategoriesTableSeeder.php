<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'title'     => 'Блог',
                    'parent_id' => 0,
                    'alias'     => 'blog',
                ],
                [
                    'title'     => 'Компьютеры',
                    'parent_id' => 0,
                    'alias'     => 'computers',
                ],
                [
                    'title'     => 'Интересное',
                    'parent_id' => 0,
                    'alias'     => 'interesting',
                ],
                [
                    'title'     => 'Советы',
                    'parent_id' => 0,
                    'alias'     => 'tips',
                ],
            ]
        );
    }
}
