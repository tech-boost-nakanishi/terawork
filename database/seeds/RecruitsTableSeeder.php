<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RecruitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recruits')->insert([
	        [
	          'corporate_id' => 1,
	          'title' => 'javaアプリエンジニア募集',
	          'monthly_income' => 30,
	          'pref_name' => '北海道',
	          'body' => "javaアプリエンジニアを募集します。
	          			■勤務時間
	          			9:00~18:00
	          			■休日
	          			土日祝
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 2,
	          'title' => 'phpエンジニア募集',
	          'monthly_income' => 40,
	          'pref_name' => '東京都',
	          'body' => "phpエンジニアを募集します。
	          			■勤務時間
	          			10:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 3,
	          'title' => 'WEBデザイナー募集',
	          'monthly_income' => 25,
	          'pref_name' => '大阪府',
	          'body' => "WEBデザイナー募集します。
	          			■勤務時間
	          			10:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 4,
	          'title' => 'iOSアプリエンジニア募集',
	          'monthly_income' => 33,
	          'pref_name' => '福岡県',
	          'body' => "iOSアプリエンジニア募集します。
	          			■勤務時間
	          			9:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 2,
	          'title' => 'バックエンドエンジニア募集',
	          'monthly_income' => 45,
	          'pref_name' => '東京都',
	          'body' => "バックエンドエンジニア募集します。
	          			■勤務時間
	          			10:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 3,
	          'title' => 'フロントエンドエンジニア募集',
	          'monthly_income' => 30,
	          'pref_name' => '大阪府',
	          'body' => "フロントエンドエンジニア募集します。
	          			■勤務時間
	          			10:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
	        [
	          'corporate_id' => 2,
	          'title' => 'rubyエンジニア募集',
	          'monthly_income' => 45,
	          'pref_name' => '東京都',
	          'body' => "rubyエンジニアを募集します。
	          			■勤務時間
	          			10:00~18:00
	          			■休日
	          			土日
	          			",
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now(),
	        ],
        ]);
    }
}
