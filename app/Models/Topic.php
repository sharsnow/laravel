<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model

{   
    public $timestamps = false;
    protected $table = 'topic'; //表格名稱
    public $primaryKey = 'id'; //主鍵
    protected $fillable = ['place', 'topic']; //其他可修改的欄位

    public function questions()
    {
        return $this->hasMany(Question::class, 'place', 'place');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'place', 'place');
    }
}
