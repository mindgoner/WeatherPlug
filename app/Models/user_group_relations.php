<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_group_relations extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'groupId',
        'status',

    ];
    public function autor_1(){
        return user::where('id',$this->userId)->first();
    }

}
