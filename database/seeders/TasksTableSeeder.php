<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = DB::table('users')->get();

        $tasks = [
            '引っ越し先の物件が決まったらやること' => [
                '旧居の退去日を決定',
                '引っ越し業者またはレンタカーの手配・引っ越し日を決定',
                '賃貸物件の解約手続き',
                '旧居駐車場の解約手続きと新居の駐車場の契約',
                'インターネット・固定電話・衛星テレビの住所変更',
                '転居はがきや挨拶メールの作成'
            ],
            '引っ越しの1か月～1週間前までにやること' => [
                '不用品・粗大ごみの処分',
                '家電製品・パソコンの処分',
                '新居の間取り図の作成、必要なものの準備',
                '荷造り（使用頻度の低いもの）',
                '梱包資材の準備',
                '転出届の提出（異なる市区町村への引っ越しのみ）',
                '子どもの転校・転園手続き',
                '勤務先への住所変更の届出',
                'ライフラインの手続き',
                '住所変更が必要なその他サービスの手続き',
                '郵便物の転送手配'
            ],
            '引っ越し前日までにやること' => [
                '荷造り（使用頻度の高いもの）',
                '食品の整理',
                '挨拶用の手土産を用意',
                '新居の掃除や下見',
                'パソコンのバックアップ',
                'テレビなどの映像機器・オーディオ機器の配線まとめ',
                '引っ越し当日の段取り確認',
                '冷蔵庫と洗濯機の水抜きとコンセント抜き',
                '旧居の掃除やごみの最終処分'
            ],
            '引っ越し当日にやること' => [
                '荷物の最終梱包と搬出',
                '電気・ガス・水道の閉栓と精算',
                '旧居の掃除',
                '旧居の明け渡し・鍵返却',
                '引っ越し料金の精算',
                '電気・ガス・水道の開栓・開通',
                '管理人・ご近所への挨拶'
            ],
            '引っ越し後にやること' => [
                '転入届・転居届の提出',
                'その他役所での手続き',
                '転入先の学校や幼稚園、保育園での手続き',
                '自動車やバイク関連の登録内容を変更',
                '飼い犬の登録変更手続き',
                'パスポートの手続き（本籍を変更した場合）',
                '通販サイト等の登録内容を変更',
                '荷解き・ダンボールの片付け',
                '旧居敷金の精算'
            ]
        ];
        
        foreach ($users as $user) {
            $folders = DB::table('folders')->where('user_id', $user->id)->get();
            foreach ($folders as $folder) {
                foreach ($tasks[$folder->title] as $index => $taskTitle) {
                    DB::table('tasks')->insert([
                        'folder_id' => $folder->id,
                        'title' => $taskTitle,
                        'status' => 1,
                        'due_date' => Carbon::now()->addDay($index + 1),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }

        // 公開フォルダーにタス���を追加
        $publicFolders = DB::table('folders')->whereNull('user_id')->get();

        foreach ($publicFolders as $folder) {
            foreach ($tasks[$folder->title] as $index => $taskTitle) {
                DB::table('tasks')->insert([
                    'folder_id' => $folder->id,
                    'title' => $taskTitle,
                    'status' => 1,
                    'due_date' => Carbon::now()->addDay($index + 1),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
