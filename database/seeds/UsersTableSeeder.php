<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = factory(User::class)->times(500)->make()->each(function ($user, $i) {
            if ($i == 0) {
                $user->name = 'admin';
                $user->email = 'admin@estgroupe.com';
                $user->password = bcrypt('admin');
            }

            $user->password = bcrypt('secret');
            //$user->github_id = $i + 1;
        });







        User::insert($users->toArray());


        $hall_of_fame = Role::addRole('HallOfFame', 'HallOfFame');
        $users = User::all();
        foreach ($users as $key => $user) {
            $user->attachRole($hall_of_fame);
        }

    }
}
