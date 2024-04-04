<?php

namespace App\Http\Controllers\Admin;

use App\Helper\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\QuestContent;
use App\Models\QuestProgess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestController extends Controller
{
    //
    public function questManage()
    {
        $quests = Quest::all();
        $progess = QuestProgess::join('users', 'quest_progess.user_id', '=', 'users.id')
            ->join('quests', 'quest_progess.quest_id', '=', 'quests.id')
            ->select('quest_progess.*', 'users.name as user_name', 'quests.name as quest_name')
            ->orderByDesc('created_at')->paginate(10);

        $timeHelper = new TimeHelper();
        foreach ($progess as $item) {
            $item->formatted_created_at = $timeHelper->formatTime($item->created_at);
        }

        return view('pages.quest.index', compact('quests', 'progess'));
    }

    public function createQuestForm()
    {
        return view('pages.quest.create');
    }

    public function createQuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250|unique:quests,name',
            'type' => 'required|in:daily,one_time',
            'max_completion' => 'required|integer|min:0',
            'point' => 'required|integer|min:0',
            'exp' => 'required|integer|min:0', // Added validation rule for 'exp'
            'content' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quest = new Quest([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'max_completion' => $request->input('type') == 'daily' ? 1 : $request->input('max_completion'),
            'point' => $request->input('point'),
            'exp' => $request->input('exp'),
            'gold' => 0,
            'level_requirement' => 0,
            'status' => true,
        ]);

        $quest->save();

        $questContent = new QuestContent([
            'quest_id' => $quest->id,
            'content' => $request->input('content'),
        ]);

        $questContent->save();

        return redirect('/admin/quest-manage')->with(['success' => 'Quest and associated content created successfully']);
    }


    public function updateQuestForm($id)
    {
        $quest = Quest::find($id);
        if (!$quest) {
            return redirect()->back()->with(['error' => 'Quest not found']);
        }
        return view('pages.quest.update', compact('quest'));
    }

   public function updateQuest(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'type' => 'required|in:daily,one_time',
            'max_completion' => 'required|integer|min:0',
            'point' => 'required|integer|min:0',
            'exp' => 'required|integer|min:0', // Added validation rule for 'exp'
            'content' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quest = Quest::find($id);
        if (!$quest) {
            return redirect()->back()->with(['error' => 'Quest not found']);
        }

        $quest->name = $request->input('name');
        $quest->type = $request->input('type');
        $quest->max_completion = $request->input('type') == 'daily' ? 1 : $request->input('max_completion');
        $quest->point = $request->input('point');
        $quest->exp = $request->input('exp');
        $quest->save();

        // Update associated QuestContent
        $questContent = QuestContent::where('quest_id', $id)->first();
        if (!$questContent) {
            $questContent = new QuestContent();
            $questContent->quest_id = $id;
        }
        $questContent->content = $request->input('content');
        $questContent->save();

        return redirect('/admin/quest-manage')->with(['success' => 'Quest and associated content updated successfully'])->withInput();
    }
public function questDetail($id)
{
    $quest = Quest::findOrFail($id);
    $questContent = QuestContent::where('quest_id', $id)->first(); // Lấy nội dung của quest
    return view('pages.quest.detail', compact('quest', 'questContent'));
}
public function deleteQuest($id)
{
    try {
        $quest = Quest::findOrFail($id);

        $quest->questContent()->delete();

        $quest->delete();

        return redirect('/admin/quest-manage')->with('success', 'Quest deleted successfully');
    } catch (\Exception $e) {
        return redirect('/admin/quest-manage')->with('error', 'Failed to delete quest. This quest may have associated records.');
    }
}


}
