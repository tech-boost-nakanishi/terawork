<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'PHP',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'Java',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'Swift',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'Ruby',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'C言語',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'name' => 'C++',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
        ]);
    }
}
