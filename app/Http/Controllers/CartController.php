<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $token = JWTAuth::getToken();
        if ($token) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                $user_id = $user->id;
            } catch (JWTException $e) {
                throw new JWTException;
            }
        } else {
            $user_id = null;
        }
        
        $cart = Cart::create(array(
            'user_id' => $user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
        ));
        
        return response()->json([
            'status' => 'success',
            'message' => 'product added successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $token = JWTAuth::getToken();
        if ($token) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                $user_id = $user->id;
            } catch (JWTException $e) {
                throw new JWTException;
            }
        } else {
            $user_id = null;
        }

        $cartItem = Cart::where('id', $id)
            ->where('user_id', $user_id)
            ->first()
            ->update([
                'quantity' => $request->quantity ?? 1,
            ]);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'product updated successfully'
        ]);
    }

    public function delete($id)
    {
        $token = JWTAuth::getToken();
        if ($token) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                $user_id = $user->id;
            } catch (JWTException $e) {
                throw new JWTException;
            }
        } else {
            $user_id = null;
        }

        $cartItem = Cart::where('id', $id)->where('user_id', $user_id)->first()->delete();

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'product deleted successfully'
        ]);
    }
}
