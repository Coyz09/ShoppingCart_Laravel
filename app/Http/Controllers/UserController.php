<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Customer;
use App\Order;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

     public function postSignup(Request $request){
        $this->validate($request, [
            'fname' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4'
        ]);
         $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
         $user->save();
         $customer = new Customer;
         $customer->user_id = $user->id;
          $customer->fname = $request->fname;
          $customer->lname = $request->lname;
          $customer->addressline = $request->addressline;
          $customer->town = $request->town;
          $customer->phone = $request->phone;
          $customer->zipcode = $request->zipcode;
          $customer->save();

         Auth::login($user);
         return redirect()->route('user.profile');
    }

     public function getSignin(){
        return view('user.signin');
     }

    // public function postSignin(Request $request){
    //     $this->validate($request, [
    //         'email' => 'email| required',
    //         'password' => 'required| min:4'
    //     ]);
    //      if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])){
    //         return redirect()->route('user.profile');
    //     }else{
    //         return redirect()->back();
    //     };
    //  }

     public function getProfile() {
        //$orders = Auth::user()->with('orders')->get();
        $orders = Auth::user()->orders;
        // dd($orders);
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

     $customer = Customer::where('user_id',Auth::id())->first();
     $orders = Order::with('customer','items')->where('customer_id',$customer->customer_id)->get();
        return view('user.profile',compact('orders'));
    }

    //  public function getLogout(){
    //     Auth::logout();
    //     return redirect()->route('product.index');
    // }

    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
    }

}


