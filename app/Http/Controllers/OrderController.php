<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();
        
        // 處理訂單格式檢查與轉換
        $name = $validated['name'];

        //name包含非英文字元
        if (preg_match('/[^A-Za-z\s]/', $name)) {
            return response()->json(['error' => 'Name contains non-English characters'], 400);
        }

        //name首字元沒有大寫字母
        if (preg_match('/\b[a-z]/', $name)) {
            return response()->json(['error' => 'Name is not capitalized'], 400);
        }

        //price超過2000
        if ($validated['price'] > 2000) {
            return response()->json(['error' => 'Price is over 2000'], 400);
        }

        //currency format錯誤
        if ($validated['currency'] != 'USD' && $validated['currency'] != 'TWD') {
            return response()->json(['error' => 'Currency format is wrong'], 400);
        }


        //currency轉換，TWD = USD * 31
        if ($validated['currency'] === 'USD') {
            $validated['price'] = $validated['price'] * 31;
            $validated['currency'] = 'TWD';
        }

        return response()->json($validated);
    }
}
