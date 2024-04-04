<?php

namespace App\Http\Controllers\Admin;

use App\Helper\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Npc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class NpcController extends Controller
{
    public function showAllNpcs()
    {
        $npcs = Npc::all();
        $timeHelper = new TimeHelper();

        return view('npc.index', compact('npcs'));
    }

    public function createNpcForm()
    {
        return view('npc.create');
    }

   public function createNpc(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:npcs|string|max:100',
        'access' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'role' => 'required|in:doctor,blacksmith,merchant,tailor,innkeeper,quest_giver',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $uploadedFile = $request->file('access');
    $cloudinaryResponse = Cloudinary::upload($uploadedFile->getRealPath());

    $npc = new Npc([
        'name' => $request->input('name'),
        'access' => $cloudinaryResponse->getSecurePath(),
        'role' => $request->input('role'),
    ]);
    $npc->save();

    return redirect('/admin/npc-manage')->with(['success' => 'Npc created successfully!']);
}


    public function deleteNpc($id)
    {
        $npc = Npc::find($id);
        if (!$npc) {
            return redirect()->back()->with(['error' => 'Npc not found']);
        }
        // Logic xóa npc tùy theo yêu cầu của bạn

        $npc->delete();

        return redirect()->back()->with(['success' => 'Npc deleted successfully']);
    }

    public function updateNpcForm($id)
    {
        $npc = Npc::find($id);
        return view('npc.update', compact('npc'));
    }

   public function updateNpc(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:100',
        'access' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Sửa thành 'nullable' để cho phép không cần upload ảnh mới
        'role' => 'required|in:doctor,blacksmith,merchant,tailor,innkeeper,quest_giver',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $npc = Npc::find($id);
    if (!$npc) {
        return redirect()->back()->with(['error' => 'Npc not found']);
    }

    $npc->name = $request->input('name');

    // Kiểm tra nếu có file ảnh mới được tải lên
    if ($request->hasFile('access')) {
        $uploadedFile = $request->file('access');
        $cloudinaryResponse = Cloudinary::upload($uploadedFile->getRealPath());
        $npc->access = $cloudinaryResponse->getSecurePath();
    }

    $npc->role = $request->input('role');
    $npc->save();

    return redirect('/admin/npc-manage')->with(['success' => 'Npc updated successfully']);
}


    public function npcDetail($id)
    {
        $npc = Npc::find($id);
        return view('npc.detail', compact('npc'));
    }
}
