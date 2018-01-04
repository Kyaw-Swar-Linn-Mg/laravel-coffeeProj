<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    public function getDashboard(){
        return view('admin/dashboard');
    }

    public function postNewData(Request $request){

        $this->validate($request,[
           'title'=>'required|unique:products',
            'price'=>'required',
            'cover'=>'required|mimes:jpg,jpeg,png',
        ]);

        $pd = new Product();

        $cover_file = $request->file('cover');
        $cover_ext = $request->file('cover')->getClientOriginalExtension();
        $cover_name = $request['title'].'.'.$cover_ext;

        $pd -> title = $request['title'];
        $pd -> price = $request['price'];
        $pd -> cover = $cover_name;

        $pd ->save();
        Storage::disk('cover_img')->put($cover_name,file($cover_file));
        return redirect()->back()->with('alert','You have successfully Item added.');

    }

    public function getOrder(){
        $date = date('Y-m-d');

        $orders = Order::Where('created_at','like',"%$date%")->get();
        $orders -> transform(function ($order,$key){
           $order->cart=unserialize($order->cart);
           return $order;
        });
        return view('admin/order')->with(['order'=>$orders]);
    }

    public function getCash($id){
        $order = Order::find($id);
        $order->status=1;
        $order->update();
        return redirect()->back()->with(['order'=>$order])->with(['msg'=>'You have been cash']);
    }
}
