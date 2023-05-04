<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Http\Requests;
// use App\Models\Product;
// use App\Models\Order;
use App\Cart;
use Session;
use Auth;
use DB;
use App\Customer;
use App\Item;
use App\Stock;
use App\Order;
use App\Product;
use App\User;


class ProductController extends Controller
{
    public function getIndex(){
        $products = Stock::with('item')->get();

        // $products = Product::all();
        // dd($products);
        return view('shop.index',compact('products'));
    }

    public function getAddToCart(Request $request , $id){
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->item_id);
        // dd($cart);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        // Session::get('cart');
        // $request->session()->forget('cart');

        return redirect()->route('product.index');
 	}

 	public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // public function getSession()
    // {
    //     Session::flush();
    // }

    // public function postCheckout(Request $request){
    //     if (!Session::has('cart')) {
    //         return redirect()->route('shop.shopping-cart');
    //     }
    //     $oldCart = Session::get('cart');
    //     $cart = new Cart($oldCart);
    //       try {
    //          DB::beginTransaction();
    //         $order = new Order();
    //         // $order->cart = serialize($cart);
    //         $customer =  Customer::where('user_id',Auth::id())->first();

    //         Auth::user()->orders()->save($order);
    //     }catch (\Exception $e) {
    //         return redirect()->route('checkout')->with('error', $e->getMessage());
    //     }
    //     Session::forget('cart');
    //     return redirect()->route('product.index')->with('success','Successfully Purchased Your Products!!!');
    // }

    public function postCheckout(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }
        $oldCart = Session::get('cart');
        // dd(Session::get('cart'));
        $cart = new Cart($oldCart);
       // dd($cart);
          try {
            DB::beginTransaction();
            $order = new Order();
            // dd($order);
            $customer =  Customer::where('user_id',Auth::id())->first();
            // dd($cart->items);
             
          $customer->orders()->save($order); 
            // dd($customer);
        foreach($cart->items as $items){
          // dd($items);
          $id = $items['item']['item_id'];
          //dd($items['qty']);
          $order->items()->attach($id,['quantity'=>$items['qty']]);
           //dd($items['qty']);
          // dd($id);
          $stock = Stock::find($id);
          //dd($stock);
          $stock->quantity = $stock->quantity - $items['qty'];
          //dd($stock->quantity);
          $stock->save();
          }
        }
        catch (Exception $e) {
           DB::rollback();
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        DB::commit();
        Session::forget('cart');
        //session_destroy();
        //return redirect()->back();
        return redirect()->route('product.index')->with('success','Successfully Purchased Your Products!!!');
    }


    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
         return redirect()->route('product.shoppingCart');
    }
    
    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }
}
