<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    public function employee(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
