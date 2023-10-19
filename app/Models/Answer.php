<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $table = 'answer_information'; //表格名稱
    public $primaryKey = 'ans_no'; //主鍵
    protected $fillable = ['place', 'topic', 'answer', 'direction']; //其他可修改的欄位

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'place', 'place');
    }
}
