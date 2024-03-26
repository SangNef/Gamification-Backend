<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index()
    {
        $shop = Shop::join('rewards', 'rewards.id', 'shop.reward_id')
            ->join('items', 'items.id', 'rewards.item_id')
            ->select('shop.*', 'items.name as item_name', 'items.image as item_image', 'items.rank as item_rank')
            ->where('shop.status', 1)
            ->orderBy("id","desc")->paginate(10);
        return view('pages.shop.index', compact('shop'));
    }
}
