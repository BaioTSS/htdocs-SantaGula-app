<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function details()
    {
          return $this->hasMany(CartDetail::class);
    }

    public function cliente()
    {
      return $this->belongsTo(User::class, 'user_id');//De esta manera podemos consultar a que
                                                 //user pertenece un carrito
    }

    public function getTotal()
    {
          $total = 0.0;
          foreach ($this->details as $detail) {
            $total += $detail->quantity * $detail->producto->precio;
          }
          return $total;
    }

}
