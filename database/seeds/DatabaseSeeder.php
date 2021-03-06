<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguagesTableSeeder::class,
            UsersTableSeeder::class,
            CorporatesTableSeeder::class,
            RecruitsTableSeeder::class,
            RecruitLanguagesTableSeeder::class,
        ]);
    }
}
