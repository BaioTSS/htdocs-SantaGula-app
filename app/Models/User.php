<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
      return $this->hasMany(Cart::class);
    }

    // cart_id
    public function getCartAttribute()
    {
      $cart = $this->carts()->where('status', 'activo')->first();
      if ($cart){
        return $cart;
      }else {
         $cart = new Cart();
         $cart->total = 0;
         $cart->status = 'activo';
         $cart->user_id = $this->id;
         $cart->save();

         return $cart;
      }

    }
}
