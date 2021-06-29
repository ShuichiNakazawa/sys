<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Cart;

class CartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // セッション内カートID存在チェック
        if (!Session::has('cart')) {
            // カートレコード作成
            $cart = Cart::create();
            // セッションへカートID保存
            Session::put('cart', $cart->id);
        }
        return $next($request);
    }
}
