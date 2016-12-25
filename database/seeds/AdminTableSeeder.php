<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        /*$administrator = Role::addRole('administrator', 'administrator');
        $staffs = DB::table('staff')->all();
        foreach ($staffs as $key => $staff) {
            $staff->attachRole($administrator);
        }*/


    }
}