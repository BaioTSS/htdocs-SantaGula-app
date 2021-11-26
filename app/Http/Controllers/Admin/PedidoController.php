<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Caja;
use App\Models\Ventas;
use App\Models\Hora;
use PDF;

class PedidoController extends Controller
{
  public function index($menu)
  {
      if ($menu == "enespera") {
        $carritos = Cart::orderBy('horario')->get();
        return view('admin.gestion.espera')->with(compact('carritos'));
      }elseif ($menu == "cocinando") {
        $carritos = Cart::orderBy('horario')->get();
        return view('admin.gestion.cocinando')->with(compact('carritos'));
      }elseif ($menu == "delivery") {
        $carritos = Cart::orderBy('horario')->get();
        return view('admin.gestion.delivery')->with(compact('carritos'));
      }elseif ($menu == "takeaway") {
        $carritos = Cart::orderBy('horario')->get();
        return view('admin.gestion.takeaway')->with(compact('carritos'));
      }elseif ($menu == "ventas") {
        $ultimaCaja = Caja::orderBy('id', 'desc')->first();
        $carts = Cart::where('status', '=','entregado')->get();
        $cartsEntregados = $carts->count();
        $cartsEntrDelivery = $carts->where('entrega_tipo', '=', 'delivery')->count();
        $cartsEntrTakeaway = $carts->where('entrega_tipo', '=', 'takeaway')->count();
        $ventas = Ventas::where('caja_id', '=', $ultimaCaja->id)->paginate(20);
        return view('admin.gestion.ventas')->with(compact('ultimaCaja', 'ventas', 'cartsEntregados', 'cartsEntrDelivery', 'cartsEntrTakeaway'));
      }elseif ($menu == "config") {
        $turnos = Hora::all();
        return view('admin.gestion.config')->with(compact('turnos'));
      }elseif ($menu == "pdf") {
        //$ultimaCaja = Caja::orderBy('id', 'desc')->first();
        //$carts = Cart::where('status', '=','entregado')->get();
        //$cartsEntregados = $carts->count();
        //$cartsEntrDelivery = $carts->where('entrega_tipo', '=', 'delivery')->count();
        //$cartsEntrTakeaway = $carts->where('entrega_tipo', '=', 'takeaway')->count();
        //$ventas = Ventas::where('caja_id', '=', $ultimaCaja->id)->paginate(20);
        //return view('admin.gestion.pdf')->with(compact('ultimaCaja', 'ventas', 'cartsEntregados', 'cartsEntrDelivery', 'cartsEntrTakeaway'));
        //$pdf = PDF::loadView('admin.gestion.pdf',
        //  ['ultimaCaja'=>$ultimaCaja,
        //  'ventas'=>$ventas,
        //  'cartsEntregados'=>$cartsEntregados,
        //  'cartsEntrDelivery'=>$cartsEntrDelivery,
        //  'cartsEntrTakeaway'=>$cartsEntrTakeaway]
        //);
        //$pdf->loadHTML('<h1>Test</h1>');
        //return $pdf->stream();
        return view('admin.gestion.tiket');
      }

  }

  public function update(Request $request, $menu)
  {
      $id = $request->input('cart_id');
      $cart = Cart::find($id);
      //actualizamos es estado del plato al cambio de estación
      if ($menu == "enespera") {
        $cart->status = "cocinando";
        $cart->save();
        return back();


      }elseif($menu == "cocinando") {
          if($cart->entrega_tipo == "delivery") {
            $cart->status = "en camino";
            $cart->save();
          }elseif($cart->entrega_tipo == "takeaway") {
            $cart->status = "listo";
            $cart->save();
          }
        return back();


      }elseif($menu == "delivery") {
        $cart->status = "entregado";
        $ultimaCaja = Caja::orderBy('id', 'desc')->first();
        $ultimaCaja->total += $cart->total;
        $ultimoProdSell = Ventas::orderBy('id', 'desc')->first();
        //funcion para desglosar cantidad de productos por venta y sumatoria a ultima caja
        foreach ($cart->details as $detail) {
          if (Ventas::where('producto_code', '=', $detail->producto->codigo)->exists()){
            $ultProdSellwCode = Ventas::where('producto_code', '=', $detail->producto->codigo)->orderBy('id', 'desc')->first();
            if ($ultProdSellwCode->caja_id == $ultimaCaja->id) {
              $ultProdSellwCode->sumar($detail->quantity);
              $ultProdSellwCode->save();
            }else {
               $newProductSell = new Ventas();
               $newProductSell->nombre = $detail->producto->nombre;
               $newProductSell->producto_code = $detail->producto->codigo;
               $newProductSell->sumar($detail->quantity);
               $newProductSell->caja_id = $ultimaCaja->id;
               $newProductSell->save();
            }
          }else {
             $newProductSell = new Ventas();
             $newProductSell->nombre = $detail->producto->nombre;
             $newProductSell->producto_code = $detail->producto->codigo;
             $newProductSell->sumar($detail->quantity);
             $newProductSell->caja_id = $ultimaCaja->id;
             $newProductSell->save();
          }
        }
        $ultimaCaja->save();
        $cart->save();
        return back();


      }elseif($menu == "takeaway") {
        $cart->status = "entregado";
        $ultimaCaja = Caja::orderBy('id', 'desc')->first();
        $ultimaCaja->total += $cart->total;
        //funcion para desglosar cantidad de productos por venta y sumatoria a ultima caja
        foreach ($cart->details as $detail) {
          if (Ventas::where('producto_code', '=', $detail->producto->codigo)->exists()){
            $ultProdSellwCode = Ventas::where('producto_code', '=', $detail->producto->codigo)->orderBy('id', 'desc')->first();
            if ($ultProdSellwCode->caja_id == $ultimaCaja->id) {
              $ultProdSellwCode->sumar($detail->quantity);
              $ultProdSellwCode->save();
            }else {
               $newProductSell = new Ventas();
               $newProductSell->nombre = $detail->producto->nombre;
               $newProductSell->producto_code = $detail->producto->codigo;
               $newProductSell->sumar($detail->quantity);
               $newProductSell->caja_id = $ultimaCaja->id;
               $newProductSell->save();
            }
          }else {
             $newProductSell = new Ventas();
             $newProductSell->nombre = $detail->producto->nombre;
             $newProductSell->producto_code = $detail->producto->codigo;
             $newProductSell->sumar($detail->quantity);
             $newProductSell->caja_id = $ultimaCaja->id;
             $newProductSell->save();
          }
        }
        $ultimaCaja->save();
        $cart->save();
        return back();


      }elseif($menu == "ventas") {

        $nuevaCaja = new Caja();
        $nuevaCaja->dia = $request->input('fecha');
        $nuevaCaja->total = 0;
        $nuevaCaja->save();
        return back();
      }elseif($menu == "config") {

        $turno = Hora::find($request->input('turno_id'));
        $turno->cupos = $request->input('cupos');
        $turno->save();
        return back();
      }
  }

  //public function pdf()
  //{


        //$ultimaCaja = Caja::orderBy('id', 'desc')->first();
        //$carts = Cart::where('status', '=','entregado')->get();
        //$cartsEntregados = $carts->count();
        //$cartsEntrDelivery = $carts->where('entrega_tipo', '=', 'delivery')->count();
        //$cartsEntrTakeaway = $carts->where('entrega_tipo', '=', 'takeaway')->count();
        //$ventas = Ventas::where('caja_id', '=', $ultimaCaja->id)->paginate(20);
        //return view('admin.gestion.pdf');//->with(compact('ultimaCaja', 'ventas', 'cartsEntregados', 'cartsEntrDelivery', 'cartsEntrTakeaway'));


  //}

  public function destroy($id)
  {
      ///Eliminación de producto
      $productos = Categorias::find($id); //aca buscamos al producto
      $productos->delete(); //DELETE

      return redirect('/admin/categorias');
  }
}
