<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Chapter;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request){
        $cart = []; $countCartItem=0;  $price = [];
        if(Auth::check()){
            $cart = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->get();
            $countCartItem = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->count();
            foreach($cart as $item){
                $countPrice = Chapter::where('id', $item->chapter_id)->sum('price');
               array_push($price, $countPrice);

            }
        }
        return view('website.cart.cart')->with(['cart' => $cart, 'countCartItem' => $countCartItem, 'countPrice' =>  array_sum($price)]);
        
    }

    public function addToCart(Request $request){
        $course_id = $request->course_id;
        $chapter_id = $request->chapter_id;

       $check_item_exists_inside_cart = Cart::where('user_id', Auth::user()->id)->where('chapter_id', $chapter_id)->exists();
       if($check_item_exists_inside_cart == true){
            return response()->json(['message' => 'Item Already present inisde cart. Please check cart', 'status' => 2]);
       }else{
            foreach($chapter_id as $item){
                $create = Cart::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $course_id,
                    'chapter_id' => $item
                ]);    
            }
            return response()->json(['message' => "Item added to cart successfully." , 'status' => 1]);
       }
    }


    public function removeFromCart(Request $request){
        if(Auth::check()){
            Cart::where('user_id', Auth::user()->id)->where('is_paid', 0)->where('chapter_id', $request->chapter_id)->delete();
            return response()->json(['message' => 'Item removed successfully']);
        }
    }
}
