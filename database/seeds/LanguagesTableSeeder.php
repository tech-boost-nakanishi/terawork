<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
	        [
	          'name' => 'HTML+CSS',
	        ],
	        [
	          'name' => 'PHP',
	        ],
	        [
	          'name' => 'Java',
	        ],
	        [
	          'name' => 'Swift',
	        ],
	        [
	          'name' => 'Ruby',
	        ],
	        [
	          'name' => 'C言語',
	        ],
	        [
	          'name' => 'C++',
	        ],
        ]);
    }
}
