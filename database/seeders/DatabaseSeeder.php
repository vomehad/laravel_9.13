<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $orchidAdminPermissions = [
//            "platform.index" => true,
//            "platform.systems.roles" => true,
//            "platform.systems.users" => true,
//            "platform.systems.attachment" => true
//        ];
//
//        User::create([
//            'name' => 'den',
//            'email' => 'vomehad@yandex.ru',
//            'password' => Hash::make('keys'),
//            'permissions' => $orchidAdminPermissions,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now(),
//        ]);

        $faker = Factory::create('Ru_RU');

        for ($i = 0; $i < 100000; $i++) {
            Contact::create([
                'username' => $faker->name,
                'email' => $faker->unique()->email,
                'subject' => $faker->city,
                'name' => $faker->name,
                'message' => $faker->chrome,
            ]);
        }
    }
}
