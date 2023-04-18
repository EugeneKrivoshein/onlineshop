<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class OrderController extends Controller
{

    public function show() {
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

        $orders = Order::where('user_id', $user_id)->get(); 
         
        return response()->json($orders);      
    }

    public function store(Request $request) {
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

        $order = Order::create(array(
            'user_id' => $user_id,
            'email' => $user ? $user->email : $request->email,
            'product_id' => $request->product_id
        ));

        return response()->json([
            'status' => 'success',
            'message' => 'order added successfully'
        ]);
    }
    
}
