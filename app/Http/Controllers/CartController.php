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

        $turnos = Hora::where('cupos', '>=', 1)->get();

        $cart->horario = $request->horario;
        if(count($cart->details) == 0){
          $notificacion = 'Tu pedido no presenta platos';
          return back()->with(compact('notificacion'));
        }elseif ($request->deliveryBtn == "Enable" and empty($request->direccion)) {
          $notificacion = 'Indique su domicilio';
          return back()->with(compact('notificacion'));
        }elseif ($request->input('horario') == 'false'){
          $notificacion = 'Sin disponibilidad horaria';
          return back()->with(compact('notificacion'));
        }else{ //if(count($cart->details) > 0)

          if ($request->deliveryBtn == "Enable") {
            $cart->entrega_tipo = 'delivery';
            $cart->direccion =  $request->direccion.' '.$request->localidad;
            $cart->total = $cart->getTotal()+100;
          }else {
            $cart->entrega_tipo = 'takeaway';
            $cart->total = $cart->getTotal()+0;
          }
          $cart->status = 'pendiente';

          $hora = Hora::where('horarios', '=', $request->input('horario'))->first();
          $hora->cupos -= 1;
        }

        $cart->save(); //UPDATE
        $hora->save();
        $notificacion = 'Tu pedido se ha enviado correctamente';



        return back()->with(compact('notificacion'));
    }

}
