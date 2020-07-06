<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CorporatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corporates')->insert([
	        [
	          'corporate_name' => '株式会社中西',
	          'contact_name' => '中西',
	          'email' => 'test1@gmail.com',
	          'password' => Hash::make('pass1111'),
	          'email_verified_at' => Carbon::now(),
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_name' => '鈴木コーポレーション',
	          'contact_name' => '鈴木',
	          'email' => 'test2@gmail.com',
	          'password' => Hash::make('pass2222'),
	          'email_verified_at' => Carbon::now(),
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_name' => '株)高橋',
	          'contact_name' => '高橋',
	          'email' => 'test3@gmail.com',
	          'password' => Hash::make('pass3333'),
	          'email_verified_at' => Carbon::now(),
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_name' => '有限会社佐藤',
	          'contact_name' => '佐藤',
	          'email' => 'test4@gmail.com',
	          'password' => Hash::make('pass4444'),
	          'email_verified_at' => Carbon::now(),
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
        ]);
    }
}
