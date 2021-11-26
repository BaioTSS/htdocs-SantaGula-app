<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Hora;

class DashboardController extends Controller
{/**
 * Create a new controller instance.
 *
 * @return void
 */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

   public function index()
   {

       $turnos = Hora::where('cupos', '>=', 1)->get();
       return view('home')->with(compact('turnos'));

   }

   public function estadoPedido()
   {

        $user = auth()->user()->id;
       $carts = cart::where('user_id', '=', $user)->get();
       return view('estadopedido')->with(compact('carts'));
   }
}
