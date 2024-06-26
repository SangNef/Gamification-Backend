<?php

namespace App\Http\Controllers\Admin;

use App\Helper\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Reward;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //
    public function itemManage()
    {
        $items = Item::orderBy('stt')->get();
        $rewards = Reward::join('users', 'rewards.user_id', '=', 'users.id')
            ->join('items', 'rewards.item_id', '=', 'items.id')
            ->select('rewards.*', 'users.name as user_name', 'items.name as item_name')
            ->orderByDesc('rewards.created_at')
            ->paginate(10);

        $timeHelper = new TimeHelper();
        foreach ($rewards as $item) {
            $item->formatted_created_at = $timeHelper->formatTime($item->created_at);
        }

        return view('pages.item.index', compact('items', 'rewards'));
    }
    public function createItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rank' => 'required|in:common,uncommon,rare,epic,legendary',
            'type' => 'required|in:shirt,trouser,weapon,shield,prize,point',
            'is_limit' => 'boolean',
            'can_sell' => 'boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $item = new Item([
            'name' => $request->input('name'),
            'image' => Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath(),
            'rank' => $request->input('rank'),
            'type' => $request->input('type'),
            'is_limit' => $request->input('is_limit'),
            'can_sell' => $request->input('can_sell'),
        ]);
        $item->save();
        return redirect('/admin/item-manage')->with(['success' => 'Item created successfully'])->withInput();
    }
    public function createItemForm()
    {
        return view('pages.item.create');
    }
    public function itemDetail($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return redirect()->back()->with(['error' => 'Item not found']);
        }
        return view('pages.item.detail', compact('item'));
    }
    public function deleteItem($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return redirect()->back()->with(['error' => 'Item not found']);
        }
        $rewardExists = Reward::where('item_id', $id)->exists();
        if ($rewardExists) {
            return redirect()->back()->with(['error' => 'Cannot delete this item!']);
        }
        $item->delete();
        return redirect()->back()->with(['success' => 'Delete successfully']);
    }
    public function updateItemForm($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return redirect()->back()->with(['error' => 'Item not found']);
        }
        return view('pages.item.update', compact('item'));
    }
    public function updateItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rank' => 'required|in:1,2,3,4,5',
            'qty' => 'required|integer|min:0',
            'can_reduce' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->image = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $item->rank = $request->input('rank');
        $item->qty = $request->input('qty');
        $item->can_reduce = $request->has('can_reduce') ? 1 : 0;
        $item->save();
        return redirect('/admin/item-manage')->with(['success' => 'Update successfully']);
    }
    public function updateRewardStatus($id)
    {
        $reward = Reward::find($id);
        if (!$reward) {
            return redirect()->back()->with(['error' => 'Reward not found']);
        }
        if ($reward->status === 0) {
            $reward->status = 1;
        } elseif ($reward->status === 1) {
            $reward->status = 2;
        } else {
            return redirect()->back()->with(['error' => 'Reward is claimed']);
        }
        $reward->save();
        return redirect()->back()->with(['success' => 'Completed awarding']);
    }
}
