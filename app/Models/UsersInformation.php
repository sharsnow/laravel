<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInformation extends Model
{
    protected $table = 'users_information'; //表格名稱
    public $primaryKey = 'id'; //主鍵
    protected $fillable = ['username', 'sex', 'password', 'email', 'created_at', 'updated_at']; //其他可修改的欄位
    
    // use HasFactory;
}
