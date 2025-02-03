<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $table = 'friends';

    protected $fillable = [ 'user_id','friend_id','status',];

    public function user()
   {

    return $this->belongsTo(User::class, 'user_id');
   
    }


    public function friend()
   {

    return $this->belongsTo(User::class, 'friend_id');

   }

   const STATUS_PENDING = 'pending';
   const STATUS_ACCEPTED = 'accepted';
   const STATUS_DECLINED = 'declined';

   public static $status = [
    self::STATUS_PENDING,
    self::STATUS_ACCEPTED,
    self::STATUS_DECLINED,
    
   ];

}
