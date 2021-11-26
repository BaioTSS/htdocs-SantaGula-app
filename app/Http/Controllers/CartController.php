<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Hora;

class CartController extends Controller
{
    public function update(Request $request)
    {

        $cart = auth()->user()->cart;

        $cart->status = 'pendiente';
        if ($request->deliveryBtn == "Enable") {
          $cart->entrega_tipo = 'delivery';
          $cart->direccion =  $request->direccion;
          $cart->total = $cart->getTotal()+100;
        }else {
            $cart->entrega_tipo = 'takeaway';
        }

        $turnos = Hora::where('cupos', '>=', 1)->get();

        $cart->horario = $request->horario;
        if ($cart->total <=100) {
          $notificacion = 'Tu pedido no presenta platos';
        }elseif ($request->deliveryBtn == "Enable" and empty($request->direccion)) {
          $notificacion = 'Indique su domicilio';
        }elseif (empty($turnos)){
          $notificacion = 'No hay disponibilidad';
        }else{
          $hora = Hora::where('horarios', '=', $request->input('horario'))->first();
          $hora->cupos -= 1;
          $cart->save(); //UPDATE
          $hora->save();
          $notificacion = 'Tu pedido se ha enviado correctamente';
        }


        return back()->with(compact('notificacion'));
    }

}
