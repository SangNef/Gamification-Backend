<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enemy;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class EnemyController extends Controller
{
    //
    public function index()
    {
        $enemies = Enemy::paginate(10);
        return view('pages.enemy.index', compact('enemies'));
    }

    public function createEnemyForm()
    {
        return view('pages.enemy.create');
    }

    public function createEnemy(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'hp' => 'required|integer',
            'dame' => 'required|integer',
            'def' => 'required|integer',
            'access' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'rank' => 'required|string|max:50',
        ]);

        Enemy::create([
            'name' => $request->input('name'),
            'hp' => $request->input('hp'),
            'dame' => $request->input('dame'),
            'def' => $request->input('def'),
            'access' => Cloudinary::upload($request->file('access')->getRealPath())->getSecurePath(),
            'type' => $request->input('type'),
            'rank' => $request->input('rank'),
        ]);

        return redirect('/admin/enemy-manage')->with(['success' => 'Enemy created successfully']);
    }

    public function enemyDetail($id)
    {
        $enemy = Enemy::find($id);
        return view('pages.enemy.detail', compact('enemy'));
    }

    public function deleteEnemy($id)
    {
        $enemy = Enemy::find($id);
        $enemy->delete();
        return redirect('/admin/enemy-manage')->with(['success' => 'Enemy deleted successfully']);
    }

    public function updateEnemyForm($id)
    {
        $enemy = Enemy::find($id);
        return view('pages.enemy.update', compact('enemy'));
    }

    public function updateEnemy(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'hp' => 'required|integer',
            'dame' => 'required|integer',
            'def' => 'required|integer',
            'access' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'rank' => 'required|string|max:50',
        ]);

        $enemy = Enemy::find($id);
        $enemy->name = $request->input('name');
        $enemy->hp = $request->input('hp');
        $enemy->dame = $request->input('dame');
        $enemy->def = $request->input('def');
        $enemy->access = Cloudinary::upload($request->file('access')->getRealPath())->getSecurePath();
        $enemy->type = $request->input('type');
        $enemy->rank = $request->input('rank');
        $enemy->save();

        return redirect('/admin/enemy-manage')->with(['success' => 'Enemy updated successfully']);
    }
}
