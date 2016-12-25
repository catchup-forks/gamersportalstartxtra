<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array(
            0 =>
            array(
                'id'          => 1,
                'parent_id'   => 0,
                'post_count'  => 0,
                'weight'      => 100,
                'name'        => 'zhao-pin',
                'slug'        => 'zhao-pin',
                'description' => 'PHPHub',
                'created_at'  => '2016-07-03 10:00:00',
                'updated_at'  => '2016-07-03 10:00:00',
                'deleted_at'  => null,
            ),
            1 =>
            array(
                'id'          => 3,
                'parent_id'   => 0,
                'post_count'  => 0,
                'weight'      => 97,
                'name'        => 'gong-gao',
                'slug'        => 'gong-gao',
                'description' => 'PHPHub',
                'created_at'  => '2016-07-03 10:00:00',
                'updated_at'  => '2016-07-03 10:00:00',
                'deleted_at'  => null,
            ),
            2 =>
            array(
                'id'          => 4,
                'parent_id'   => 0,
                'post_count'  => 0,
                'weight'      => 99,
                'name'        => 'wen-da',
                'slug'        => 'wen-da',
                'description' => 'PHPHub',
                'created_at'  => '2016-07-03 10:00:00',
                'updated_at'  => '2016-07-03 10:00:00',
                'deleted_at'  => null,
            ),
            3 =>
            array(
                'id'          => 5,
                'parent_id'   => 0,
                'post_count'  => 0,
                'weight'      => 98,
                'name'        => 'fen-xiang',
                'slug'        => 'fen-xiang',
                'description' => 'PHPHub',
                'created_at'  => '2016-07-03 10:00:00',
                'updated_at'  => '2016-07-03 10:00:00',
                'deleted_at'  => null,
            ),
            4 =>
            array(
                'id'          => 6,
                'parent_id'   => 0,
                'post_count'  => 0,
                'weight'      => 98,
                'name'        => 'tutorial',
                'slug'        => 'tutorial',
                'description' => 'PHPHub',
                'created_at'  => '2016-07-03 10:00:00',
                'updated_at'  => '2016-07-03 10:00:00',
                'deleted_at'  => null,
            ),
        ));
    }
}
