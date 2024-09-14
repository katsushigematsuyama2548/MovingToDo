<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = DB::table('users')->get();

        $titles = [
            '引っ越し先の物件が決まったらやること',
            '引っ越しの1か月～1週間前までにやること',
            '引っ越し前日までにやること',
            '引っ越し当日にやること',
            '引っ越し後にやること'
        ];
    
        foreach ($users as $user) {
            foreach ($titles as $title) {
                DB::table('folders')->insert([
                    'title' => $title,
                    'user_id' => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // 公開フォルダーを追加
        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
