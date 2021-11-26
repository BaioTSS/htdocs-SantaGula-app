<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    //con el belongsto decimos que un detailcarrito le pertenece a un producto determinado
    public function producto()
    {
        return $this->belongsTo(Productos::class);   //un detalle de un carrito
                                                  //de compras pertenece a un producto
    }
}
