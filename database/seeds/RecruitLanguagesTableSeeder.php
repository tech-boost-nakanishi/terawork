<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RecruitLanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recruit_languages')->insert([
	        [
	          'recruit_id' => 1,
	          'language_id' => 3,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 2,
	          'language_id' => 1,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 2,
	          'language_id' => 2,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 3,
	          'language_id' => 1,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 3,
	          'language_id' => 2,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 4,
	          'language_id' => 4,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 5,
	          'language_id' => 1,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 5,
	          'language_id' => 2,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 6,
	          'language_id' => 1,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 6,
	          'language_id' => 2,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 7,
	          'language_id' => 1,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'recruit_id' => 7,
	          'language_id' => 5,
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
        ]);
    }
}
