<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '99',
            'name' => 'Admin',

        ]);
        DB::table('roles')->insert([
            'id' => '98',
            'name' => 'Moderator',

        ]);
        DB::table('roles')->insert([
            'id' => '90',
            'name' => 'Developer',

        ]);
    }
}
