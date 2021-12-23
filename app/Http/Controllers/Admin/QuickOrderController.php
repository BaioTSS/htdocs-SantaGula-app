<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Hora;
use App\Models\Productos;

class QuickOrderController extends Controller
{
  public function index(Request $request)
  {

    $turnos = Hora::where('cupos', '>=', 1)->get();

    $query = $request->input('query');
    if (is_numeric($query) == true) {
      $productos = Productos::where('codigo', 'like', "%$query%")->paginate(10);
    }else {
      $productos = Productos::where('nombre', 'like', "%$query%")->paginate(10);
    }


    return view('admin.quickOrder')->with(compact('turnos','productos', 'query'));
  }

  public function update(Request $request)
  {

      $cart = auth()->user()->cart;

      $turnos = Hora::where('cupos', '>=', 1)->get();

      $cart->horario = $request->horario;
      if(count($cart->details) == 0){
        $notificacion = 'Tu pedido no presenta platos';
        return back()->with(compact('notificacion'));
      }elseif (empty($request->no_user)) {
        $notificacion = 'El pedido debe tener un responsable';
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
        $cart->status = 'cocinando';
        $cart->no_user = $request->input('no_user');
        $hora = Hora::where('horarios', '=', $request->input('horario'))->first();
        $hora->cupos -= 1;
      }

      $cart->save(); //UPDATE
      $hora->save();
      $notificacion = 'Tu pedido se ha enviado correctamente';



      return back()->with(compact('notificacion'));
  }

}
