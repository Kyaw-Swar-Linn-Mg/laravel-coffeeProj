<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class homeController extends Controller
{
    public function getWelcome(){
        $pd = Product::all();
        $cart = Session::has('cart') ? Session::get('cart') :null;
        if(Session::has('cart')){
            return view('welcome')->with(['pd'=>$pd])->with(['items'=>$cart->items])->with(['totalQty'=>$cart->totalQty])->with(['totalPrice'=>$cart->totalPrice]);
        }
        return view('welcome')->with(['pd'=>$pd]);
    }

    public function getImg($cover){
        $file = Storage::disk('cover_img')->get($cover);
        return response($file,200)->header('Content-Type','jpg/jpeg/png');
    }

    public function getAddToCart($id){

        $pd = Product::Where('id',$id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->Add($pd, $pd->id);
        Session::put('cart',$cart);
        return redirect()->back();
    }

    public function getClearCart(){
        Session::forget('cart');
        return redirect()->back();
    }

    public function getDecrease($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->decrease($id);
        if(count($cart->items)<=0){
            Session::forget('cart');
        }else{
            Session::put('cart',$cart);
        }
        return redirect()->back();

    }

    public function getIncrease($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart -> increase($id);

        Session::put('cart',$cart);
        return redirect()->back();
    }

    public function CheckOut(Request $request){

        if(Auth::User()){
            $od = new Order();
            $od -> tb_name = $request['tb_name'];
            $cart = Session::has('cart') ? Session::get('cart') : null;
            $od -> cart = serialize($cart);
            $od -> user_id = Auth::User()->id;
            $od -> save();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
