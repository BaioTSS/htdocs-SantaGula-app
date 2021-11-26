<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];
    //nosotros queremos que desde un objeto categoria poder
    //acceder a los productos que estan dentro de dicha categoria
    public function productos()
    {
        return $this->hasMany(Productos::class);  //De esta manera decimos que una categoria
    }                                             // tiene muchos productos y acceso a ellos

    public function getFeaturedImagenUrlAttribute()
    {
        $featuredPlato = $this->productos()->first();
        return $featuredPlato->featured_imagen_url;
    }
}
