<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $table = 'question_information'; //表格名稱
    public $primaryKey = 'qus_no'; //主鍵
    protected $fillable = ['place', 'topic', 'question', 'direction', 'action']; //其他可修改的欄位
    

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'place', 'place');
    }

}
