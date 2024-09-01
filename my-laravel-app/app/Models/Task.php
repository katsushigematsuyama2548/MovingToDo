<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Task extends Model
{
    use HasFactory;

    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'bg-red-500'],
        2 => ['label' => '着手中', 'class' => 'bg-green-500'],
        3 => ['label' => '完了', 'class' => 'bg-gray-500'],
    ];

    /**
     * ステータス（状態）ラベルのアクセサメソッド
     * 
     * @return string
     */
    public function getStatusLabelAttribute() {
        
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];

    }

    /**
     * ステータスクラスのアクセサメソッド
     * 
     * @return string
     */
    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
        ->format('Y/m/d');
    }
}