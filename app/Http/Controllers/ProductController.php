<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cartitem;
use Auth;

class ProductController extends Controller
{
    public function product_list()
    {
        $list = Product::all();

        return view('Product.product_list', get_defined_vars());
    }

    public function add_cart($id)
    {
        $product_price = Product::find($id);

        $user_id = Auth::user()->id;
        $cart_exist = Cart::where('user_id', $user_id)->first();
        
        if(empty($cart_exist)) {
            // Create a new cart if it doesn't exist
            $cart_create = new Cart;
            $cart_create->user_id = $user_id;
            $cart_create->total_price = $product_price->price;
            $cart_create->save();
        } else {
            $cart_create = $cart_exist;
            $cart_create->total_price += $product_price->price;
            $cart_create->save();
        }
        
        // Check if the product is already in the cart
        $existing_cart_item = Cartitem::where('user_id', $user_id)
                                        ->where('product_id', $id)
                                        ->first();
        
        if($existing_cart_item) {
            // If the product is already in the cart, update the quantity and total price
            $existing_cart_item->qty += 1;
            $existing_cart_item->Price += $product_price->price;
            $existing_cart_item->save();
        } else {
            // If the product is not in the cart, create a new cart item
            $cart_item = new Cartitem;
            $cart_item->cart_id = $cart_create->id;
            $cart_item->user_id = $user_id;
            $cart_item->product_id = $id;
            $cart_item->qty = 1;
            $cart_item->Price = $product_price->price;
            $cart_item->save();
        }
        

        return redirect()->route('view_cart')->with('success', 'Item Added Successfully');
    }

    public function view_cart()
    {
        $user_id = Auth::user()->id;
        $cart_item = Cartitem::with('Product_Details','total_price')->where('user_id', $user_id)->get();
        // dd($cart_item);
        return view('Cart.view_cart', get_defined_vars());
    }

    public function add_moreqty(Request $request)
    {
        $product_price = Product::find($request->productId);

        $addmore = Cartitem::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->first();
        $addmore->qty += $request->value;
        $addmore->Price += $request->value*$product_price->price;
        $addmore->save();

        $cart_create = Cart::where('user_id', Auth::user()->id)->first();;
        $cart_create->total_price += $request->value*$product_price->price;
        $cart_create->save();

        return response()->json([
            'message' => 'Updated Successfully',
            'status' => 200,
            'success' => true
        ]);

    }
    public function removeFromCart(Request $request)
    {
   
        $productId = $request->input('productId');
        $product_price = CartItem::where('product_id',$productId)->first();
        // dd($product_price);
        // Find the cart item by product ID and user ID, and delete it
        CartItem::where('product_id', $productId)
                ->where('user_id', auth()->id())
                ->delete();

        $remove_total = Cart::where('user_id', Auth::user()->id)->first();
        $remove_total->total_price = $remove_total->total_price-$product_price->Price;
        $remove_total->save();

        return response()->json([
            'message' => 'Product removed from cart successfully',
            'status' => 200
        ]);
    }
}
