<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function (User $user) {
            User::assignRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(User::class, 10)->create()->each(function (User $user) {
            if(!$user->userable) {
                User::assignRole($user, User::ROLE_TEACHER);
                User::assignEnrolment(new User(), User::ROLE_TEACHER);
                $user->save();
            }
        });

        factory(User::class, 10)->create()->each(function (User $user) {
            if(!$user->userable) {
                User::assignRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}
