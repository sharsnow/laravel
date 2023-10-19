<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false;
    protected $table = 'action'; //表格名稱
    public $primaryKey = 'no'; //主鍵
    protected $fillable = ['english_name', 'action']; //其他可修改的欄位
}
