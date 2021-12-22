<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\CartDetail;
use App\Models\Cart;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {

        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->producto_id = $request->producto_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->observacion = $request->observaciones;

        $cart = auth()->user()->cart;
        $cart->total += $cartDetail->quantity * $cartDetail->producto->precio;
        $cart->save();
        $cartDetail->save();

        $notificacion = 'El plato se ha cargado a tu lista de pedidos exitosamente';
        if (auth()->user()->admin == 1) {
          return redirect('/admin/quick-order')->with(compact('notificacion'));
        }else {
          return back()->with(compact('notificacion'));
        }

    }

    public function destroy(Request $request)
    {
        $cartDetail = CartDetail::find($request->cart_detail_id);
        $cartDetail->delete();
        $notificacion = 'El plato se ha eliminado correctamente de la lista de pedidos';

        //anexo quick-order
        if (auth()->user()->admin == 1) {
          return redirect('/admin/quick-order')->with(compact('notificacion'));
        }else {
          return redirect('/home')->with(compact('notificacion'));
        }


    }

}
