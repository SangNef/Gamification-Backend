<?php

namespace App\Http\Controllers\Admin;

use App\Helper\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameProcess;
use App\Models\Item;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    public function index()
    {
        $games = Game::orderBy("stt", "asc")->paginate(10); // Sắp xếp theo số thứ tự (stt)
        $timeHelper = new TimeHelper();
        $game_process = GameProcess::orderBy("id", "desc")->with("user")->with("game")->paginate(10);
        foreach ($game_process as $process) {
            $process->formatted_completed_at = $timeHelper->formatTime($process->completed_at);
        }
        return view('pages.game.index', compact('games', 'game_process'));
    }

    public function createGameForm()
    {
        $items = Item::where('status', 1)->orderBy('rank', 'desc')->select('id', 'name', 'image')->get();
        return view('pages.game.create', compact('items'));
    }

    public function createGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'point' => 'required|integer',
            'rank' => 'required',
            'level' => 'required',
        ]);

        $maxStt = Game::max('stt');
        $stt = $maxStt + 1;

        Game::create([
            'name' => $request->input('name'),
            'point' => $request->input('point'),
            'rank' => $request->input('rank'),
            'level' => $request->input('level'),
            'stt' => $stt,
        ]);

        return redirect('/admin/game-manage')->with(['success' => 'Game created successfully']);
    }

    public function gameDetail($id)
    {
        $game = Game::find($id);
        return view('pages.game.detail', compact('game'));
    }

    public function deleteGame($id)
    {
        $game = Game::find($id);
        $game->delete();

        // Không cần phải làm gì thêm vì logic cập nhật stt được xử lý trong model Game

        return redirect('/admin/game-manage')->with(['success' => 'Game deleted successfully']);
    }

    public function updateGameForm($id)
    {
        $game = Game::find($id);
        return view('pages.game.update', compact('game'));
    }

    public function updateGame(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'point' => 'required|integer',
            'status' => 'required',
            'rank' => 'required',
            'level' => 'required',
        ]);

        $game = Game::find($id);
        $game->name = $request->input('name');
        $game->point = $request->input('point');
        $game->special_reward = $request->input('special_reward');
        $game->status = $request->input('status');
        $game->rank = $request->input('rank');
        $game->level = $request->input('level');
        $game->save();

        return redirect('/admin/game-manage')->with(['success' => 'Game updated successfully']);
    }
}
